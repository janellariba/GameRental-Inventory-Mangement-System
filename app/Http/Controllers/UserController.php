<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\History;
use App\Models\Items;
use App\Models\Pending;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Function showing all data from the pending request 
    public function pending_request(){
        if(auth()->user()->position == 'User'){
            $data = Pending::where('user_id', auth()->user()->id)->get();
        } else {
            $pending = 'Pending';
            $data = Pending::where('borrow_status', $pending)
                        ->orWhere('borrow_status', 'Pending Outbound')->get();
        }
        return view('user.pending-request')->with('pending_data', $data);
    }

    // Function for clicking the view details in the pending requests lists.
    public function pending_request_view_details($id){
        $data = Pending::find($id);
        $item_data = Items::where('item_name', $data->brw_item_name)->first();
        $item_quantity = $item_data->item_quantity;
        return view('user.view-details')->with('pending_details', $data)
                                        ->with('item_quantity', $item_quantity);
    }

    // Function for deleting an specific pending request or cancel them
    public function delete_request($id){
        $data = Pending::find($id);
        $data->delete();
        return redirect('/pending-request')->with('success','The request has been successfully deleted');
    }

    // Function for searching data in the pending request
    public function pending_search(Request $request){
        $search = $request->search;
        // not used? ===============================================================================
        $data = Pending::where(function ($query) use ($search) {
            $query->where('pending_id', 'like', '%' . $search . '%')
                  ->orWhere('user_id', 'like', '%' . $search . '%')
                  ->orWhere('transaction_id', 'like', '%' . $search . '%')
                  ->orWhere('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('customer_address', 'like', '%' . $search . '%')
                  ->orWhere('customer_email', 'like', '%' . $search . '%')
                  ->orWhere('customer_number', 'like', '%' . $search . '%')
                  ->orWhere('customer_number', 'like', '%' . $search . '%')
                  ->orWhere('brw_item_name', 'like', '%' . $search . '%')
                  ->orWhere('brw_item_brand', 'like', '%' . $search . '%')
                  ->orWhere('brw_item_category', 'like', '%' . $search . '%')
                  ->orWhere('date_requested', 'like', '%' . $search . '%')
                  ->orWhere('date_to_return', 'like', '%' . $search . '%')
                  ->orWhere('borrow_status' , '=', $search);
                })->where('borrow_status', "=", "Pending")->get();

        return view("user.pending-request", ['pending_data' => $data]);
    }

// =================== Functions on sorting headers ===================== //
    // Function sort for date    
    public function sort_date(){
        $order=Session::get('req_date_key_p');
        $return_status_ = "Returned";

       if( $order == 'asc' ){
           Session::put('req_date_key_p', 'desc');
       }else{
           Session::put('req_date_key_p', 'asc');
       }

       $order = Session::get('req_date_key_p');
       
              $data = Pending::orderBy('date_requested', $order)->orderBy('customer_name', 'asc')->where('borrow_status','=', 'Pending')->get();
             
               // show all returned data
               $return_data = Pending::where( function ($query) use ($return_status_){
                   $query->where('borrow_status', '=', $return_status_);
               })->limit(8)->get();

       return view("user.pending-request", ['pending_data' => $data]);
   }

   // Function sort for ID
   public function sort_id(){
       $order=Session::get('req_id_key_p');
       $borrow_status_ = "Pending";

      if( $order == 'asc' ){
          Session::put('req_id_key_p', 'desc');
      }else{
          Session::put('req_id_key_p', 'asc');
      }

      $order = Session::get('req_id_key_p');
         
      $data = Pending::orderBy('transaction_id', $order)->where('borrow_status', '=', $borrow_status_)->get();
      return view("user.pending-request", ['pending_data' => $data]);
  }
// ================================================================ //

    // Function for accepting the pending request
    public function accept_request($id){
        $data = Pending::find($id);
        if($data->borrow_status != 'Pending Outbound'){
            // if borrow pending
            $latestID = Borrow::latest('transaction_id')->first();
            if ($latestID == null) {
                $borrow_id = 1;
            } else {
                $borrow_id = $latestID->transaction_id;
                $borrow_id += 1; 
            }
            // will store the pending item's name into a variable
            $item_name = $data->brw_item_name;
            // will search the exact item from the Items DB by comparing it to its actual name
            $itemData = Items::where(function($query) use ($item_name) {
                $query->where('item_name', '=', $item_name);
            })->first();
            // will store the current item quantity in the Items DB
            $currentQuantity = $itemData->item_quantity;
            // 
            $borrow_new = new Borrow();
            $borrow_new->transaction_id = $borrow_id;
            $borrow_new->customer_name = $data->customer_name;
            $borrow_new->customer_address = $data->customer_address;
            $borrow_new->customer_email = $data->customer_email;
            $borrow_new->customer_number = $data->customer_number;
            $borrow_new->brw_item_name = $data->brw_item_name;
            $borrow_new->brw_item_brand = $data->brw_item_brand;
            $borrow_new->brw_item_category = $data->brw_item_category;
            $borrow_new->brw_quantity = $data->brw_quantity;
            $borrow_new->brw_duration = $data->brw_duration;
            $borrow_new->date_requested = $data->date_requested;
            $borrow_new->date_to_return = $data->date_to_return;
            $borrow_new->borrow_status = 'Ongoing';
            $data->borrow_status = 'Ongoing';
            // dd($currentQuantity);
            // dd($data->brw_quantity);

            // will now store the new quantity by getting the difference between the current and how many is being borrowed
            $newQuantity = $currentQuantity - $data->brw_quantity;
            $itemData->item_quantity = $newQuantity;
            // dd($itemData->item_quantity);
            $itemData->save();
            $borrow_new->save();
            $data->save();
            return view('admin.borrow.receipt', ['full_borrow_data' => $borrow_new], ['full_customer_data' => $borrow_new])->with('add-message', 'The Request has been accepted')->with('pending_id', $data->pending_id);
        } else {
            // if outbound request
            $latestID = Borrow::latest('transaction_id')->first();
            if ($latestID == null) {
                $borrow_id = 1;
            } else {
                $borrow_id = $latestID->transaction_id;
                $borrow_id += 1; 
            }
            // will store the pending item's name into a variable
            $item_name = $data->brw_item_name;
            // will search the exact item from the Items DB by comparing it to its actual name
            $itemData = Items::where(function($query) use ($item_name) {
                $query->where('item_name', '=', $item_name);
            })->first();
            // will store the current item quantity in the Items DB
            $currentQuantity = $itemData->item_quantity;
            // 
            // Storing data into the database
            $history_db = new History();
            $data->borrow_status = 'Outbound';
            // transaction ID
            $history_db->transaction_id = $borrow_id;
            // customer name
            $history_db->history_cus_name = $data->customer_name;
            // customer email
            $history_db->history_cus_email = $data->customer_address;
            // customer address
            $history_db->history_cus_add = $data->customer_email;
            // customer contact number
            $history_db->history_cus_no = $data->customer_number;
            // item name
            $history_db->history_item = $data->brw_item_name;
            // item brand
            $history_db->history_brand = $data->brw_item_brand;
            $history_db->history_duration = 'N/A';
            $history_db->history_returned = 'N/A';
            // item quantity
            $history_db->history_quantity = $data->brw_quantity;
            // item category
            $history_db->history_category = $data->brw_item_category;
            $history_db->history_pickup = $data->date_requested;
            $history_db->history_remarks = 'Outbound';

            // dd($currentQuantity);
            // dd($data->brw_quantity);

            // will now store the new quantity by getting the difference between the current and how many is being borrowed
            $newQuantity = $currentQuantity - $data->brw_quantity;
            $itemData->item_quantity = $newQuantity;
            // dd($itemData->item_quantity);
            $itemData->save();
            // $borrow_new->save();\
            $history_db->save();
            $data->save();
            return redirect('/pending-request')->with('add-message', 'The Request has been accepted')->with('title', 'The Request has been accepted');
        }
    }

    // Function for declining request
    public function decline_request($id, Request $request) {
        $data = Pending::find($id);
        $data->borrow_status = 'Declined';
        $data->feedback = $request->input('feedback');
        $data->save();
        return redirect('/pending-request')->with('message', 'The Request has been successfully declined.');
    }
}

