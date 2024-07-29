<?php
// Models and Controllers (Imports)
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\History;
use App\Models\Items;
use App\Models\Pending;
use Carbon\Carbon;
use DateTime;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class BorrowController extends Controller
{
    // Function for showing data in the borrow database example
    public function show(){
        // creating dummy data for testing purposes
        $borrow_data = array(
            "customer_name" => "",
            "duration" => "Nintendo",
            "date_requested" => "Game Console",
            "date_to_return" => 20,
            "borrow_status" => "Available"
        );

        return view('admin.dashboard', $borrow_data); 
    }

    // form when picking an item to be borrowed
    public function customer_details(Request $request){
        
        $item_det = Session::get('current_item_quantity');
        $itemMin = $item_det->item_quantity;
        if($request->type == 'borrow'){
            $data = $request->validate([
                'item_name'=> 'required',
                'item_brand'=> 'required',
                'item_category'=> 'required',
                // 'item_quantity'=> 'required | min:$item_det',
                'item_quantity' => ['required', function ($attribute, $value, $fail) use ($itemMin) {
                                        if ($value > $itemMin) {
                                            $fail('The '.$attribute.' must be at least '.$itemMin.'.');
                                        }
                                    }],
                'item_requested_at'=> 'required',
                'item_returned'=> 'required',
                'type' => 'required'
                // 'day_interval' => 'required'
            ]);
            // calculating days interval from requested at to return
            $fdate = $data['item_requested_at'];
            $tdate = $data['item_returned'];
            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);

            // Filter for date entered
            if ($datetime2 < $datetime1) {
            return redirect()->back()->with('error', 'Return date cannot be before requested date.');
            }
            
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            $data['days_interval'] = $days;
        } else {
            $data = $request->validate([
                'item_name'=> 'required',
                'item_brand'=> 'required',
                'item_category'=> 'required',
                // 'item_quantity'=> 'required | min:$item_det',
                'item_quantity' => ['required', function ($attribute, $value, $fail) use ($itemMin) {
                                        if ($value > $itemMin) {
                                            $fail('The '.$attribute.' must be at least '.$itemMin.'.');
                                        }
                                    }],
                'type'=>'required'
            ]);
        }
        
        
        
        // storing transaction id to session
        $latestBorrow = Borrow::latest('transaction_id')->first();
        
        if ($latestBorrow == null) {
            $borrow_id = 1;
        } else {
            $borrow_id = $latestBorrow->transaction_id;
            $borrow_id += 1;
        }
        $zero = '0';
        $limit = 6 - 2;
        $num_length = strlen((string)$borrow_id);
        for($i = 0 ; $i <= $limit - $num_length ; $i++){
            $zero = $zero . '0';
        }
        $borrow_id = $zero.$borrow_id;
        $data['transaction_id'] = $borrow_id;
        
        Session::put('customer_data', $data);
        return view('admin.borrow.customer-details', ['borrow_data' => $data]);
    }

    // Function form for entering the name email etc. when borrowing after picking an item
    public function receipt(Request $request){
        $data = $request->validate([
            'name'=> 'required',
            'email'=> 'email',
            'address'=> 'required',
            'contact_number'=> 'required',
            // ''=> shopper_id,
        ]);
        $date_today = Carbon::now()->format('Y-m-d');
        // searching for the item in the database
        $item_id = Session::get('current_item');
        $itemData = Items::find($item_id);
        $customerData = Session::get('customer_data');
        if(Session::get('customer_data')['type'] != 'outbound'){
            if(auth()->user()->position != 'User'){
                // Retrieve the latest Borrow record based on transaction_id
                $latestTransactionID = Borrow::latest('transaction_id')->first();

                if ($latestTransactionID === null) {
                    // No records found, start with transaction_id = 1
                    $newTransactionID = 1;
                } else {
                    // Increment the latest transaction_id
                    $newTransactionID = $latestTransactionID->transaction_id + 1;
                }
                // storing data into the database
                $borrow_db = new Borrow();
                // transaction ID
                $borrow_db->transaction_id = $newTransactionID;
                // customer name
                $borrow_db->customer_name = $data['name'];
                // customer email
                $borrow_db->customer_email = $data['email'];
                // customer address
                $borrow_db->customer_address = $data['address'];
                // customer contact number
                $borrow_db->customer_number = $data['contact_number'];
                // item name
                $borrow_db->brw_item_name = $customerData['item_name'];
                // item brand
                $borrow_db->brw_item_brand = $customerData['item_brand'];
                // item quantity
                $borrow_db->brw_quantity = $customerData['item_quantity'];
                // item category
                $borrow_db->brw_item_category = $customerData['item_category'];
                // duration
                $borrow_db->brw_duration = $customerData['days_interval'];
                // date requested
                $borrow_db->date_requested = $customerData['item_requested_at'];
                // date returned
                $borrow_db->date_to_return = $customerData['item_returned'];
                // borrow status
                $borrow_db->borrow_status = 'Ongoing';
                $items = $customerData['item_quantity'];
                
                $itemNewData = $itemData->item_quantity -  $items;
                // checking if the item quantity went to 0
                if ($itemNewData == 0 ) {
                    $itemData->item_status = "Not Available";
                }

                $itemData->item_quantity = $itemNewData;
                $itemData->save();
                $borrow_db->save();
                $pending_db = 0;
                return view('admin.borrow.receipt', [ 
                'full_customer_data' => $customerData, 
                'pending_id' => $pending_db])
                ->with('full_borrow_data', $borrow_db)
                ->with('add-message', 'Borrow Request Added Successfully');
            }
            else {
                // storing data into the database
                $latestID = Pending::latest('pending_id')->first();
                if ($latestID == null) {
                    $newID = 1;
                }else {
                    $newID = $latestID->pending_id + 1;
                }
                
                // creating object for pending to store for a new pending record in database
                $pending_db = new Pending();
                $pending_db->pending_id = $newID;
                // transaction ID
                $pending_db->transaction_id = $customerData['transaction_id'];
                // custormer ID
                $pending_db->user_id = auth()->user()->id;
                // customer name
                $pending_db->customer_name = $data['name'];
                // customer email
                $pending_db->customer_email = $data['email'];
                // customer address
                $pending_db->customer_address = $data['address'];
                // customer contact number
                $pending_db->customer_number = $data['contact_number'];
                // item name
                $pending_db->brw_item_name = $customerData['item_name'];
                // item brand
                $pending_db->brw_item_brand = $customerData['item_brand'];
                // item quantity
                $pending_db->brw_quantity = $customerData['item_quantity'];
                // item category
                $pending_db->brw_item_category = $customerData['item_category'];
                // duration
                $pending_db->brw_duration = $customerData['days_interval'];
                // date requested
                $pending_db->date_requested = $customerData['item_requested_at'];
                // date returned
                $pending_db->date_to_return = $customerData['item_returned'];
                // pending status
                $pending_db->borrow_status = 'Pending';
                // user note
                $pending_db->user_note = $request->user_note;
                $pending_db->save();
                return view('admin.borrow.receipt', ['full_borrow_data' => $data], ['full_customer_data' => $customerData])
                                        ->with('pending_id', $newID)
                                        ->with('add-message', 'The Request are now pending');
            }
        } else {
            // if outbound
            if(auth()->user()->position != 'User'){
                $latestTransactionID = Borrow::latest('transaction_id')->first();

                if ($latestTransactionID === null) {
                    // No records found, start with transaction_id = 1
                    $newTransactionID = 1;
                } else {
                    // Increment the latest transaction_id
                    $newTransactionID = $latestTransactionID->transaction_id + 1;
                }

                // Storing data into the database
                $history_db = new History();
                // transaction ID
                $history_db->transaction_id = $newTransactionID; // Updated to 'transaction_id'
                // customer name
                $history_db->history_cus_name = $data['name'];
                // customer email
                $history_db->history_cus_email = $data['email'];
                // customer address
                $history_db->history_cus_add = $data['address'];
                // customer contact number
                $history_db->history_cus_no = $data['contact_number'];
                // item name
                $history_db->history_item = $customerData['item_name'];
                // item brand
                $history_db->history_brand = $customerData['item_brand'];
                $history_db->history_duration = 'N/A';
                $history_db->history_returned = 'N/A';
                // item quantity
                $history_db->history_quantity = $customerData['item_quantity'];
                // item category
                $history_db->history_category = $customerData['item_category'];
                $history_db->history_pickup = $date_today;
                $history_db->history_remarks = 'Outbound';

                // Update item quantity and status
                $items = $customerData['item_quantity'];
                $itemNewData = $itemData->item_quantity - $items;
                if ($itemNewData == 0) {
                    $itemData->item_status = "Not Available";
                }
                $itemData->item_quantity = $itemNewData;
                $itemData->save();

                // Save history record
                $history_db->save();
                $pending_db = 0;

                return view('admin.borrow.receipt', [ 
                    'full_customer_data' => $customerData, 
                    'pending_id' => $pending_db
                ])->with('full_borrow_data', $history_db)
                ->with('add-message', 'Borrow Request Added Successfully');

            }
            else {
                // storing data into the database
                $latestID = Pending::latest('pending_id')->first();
                if ($latestID == null) {
                    $newID = 1;
                }else {
                    $newID = $latestID->pending_id + 1;
                }
                
                // creating object for pending to store for a new pending record in database
                $pending_db = new Pending();
                $pending_db->pending_id = $newID;
                // transaction ID
                $pending_db->transaction_id = $customerData['transaction_id'];
                // custormer ID
                $pending_db->user_id = auth()->user()->id;
                // customer name
                $pending_db->customer_name = $data['name'];
                // customer email
                $pending_db->customer_email = $data['email'];
                // customer address
                $pending_db->customer_address = $data['address'];
                // customer contact number
                $pending_db->customer_number = $data['contact_number'];
                // item name
                $pending_db->brw_item_name = $customerData['item_name'];
                // item brand
                $pending_db->brw_item_brand = $customerData['item_brand'];
                // item quantity
                $pending_db->brw_quantity = $customerData['item_quantity'];
                // item category
                $pending_db->brw_item_category = $customerData['item_category'];
                // duration
                // $pending_db->brw_duration = $customerData['days_interval'];
                $pending_db->brw_duration = '0 ';
                // date requested
                $pending_db->date_requested = $date_today;
                // // date returned
                $pending_db->date_to_return = $date_today;
                // pending status
                $pending_db->borrow_status = 'Pending Outbound';
                // user note
                $pending_db->user_note = $request->user_note;
                $pending_db->save();
                return view('admin.borrow.receipt', ['full_borrow_data' => $data], ['full_customer_data' => $customerData])
                                        ->with('pending_id', $newID)
                                        ->with('add-message', 'The Request are now pending');
            }
        }
    }

    // Function showing the full receipt of the borrow
    public function borrow_view_details($transaction_id){
        $borrow_db = Borrow::find($transaction_id);
        $borrow_id = 0;
        $latestBorrow = $borrow_db->transaction_id;
        $borrow_id = $latestBorrow;
        
        $zero = '0';
        $limit = 6 - 2;
        $num_length = strlen((string)$borrow_id);
        for($i = 0 ; $i <= $limit - $num_length ; $i++){
            $zero = $zero . '0';
        }
        
        $borrow_id = $zero.$borrow_id;
        $borrow_db['transaction_id'] = $borrow_id;
        // dd($borrow_db['transaction_id']);
        // dd($borrow_db);
        return view('admin.borrow.view-details', ['borrow_data' => $borrow_db], ['borrow_id' => $borrow_id]);
    }

    // Function for returning in the form
    public function return_form($transaction_id) {
        $borrow_db = Borrow::find($transaction_id);
        $borrow_id = 0;
        $latestBorrow = $borrow_db->transaction_id;
        $borrow_id = $latestBorrow;
        
        $zero = '0';
        $limit = 6 - 2;
        $num_length = strlen((string)$borrow_id);
        for($i = 0 ; $i <= $limit - $num_length ; $i++){
            $zero = $zero . '0';
        }
        
        $borrow_id = $zero.$borrow_id;
        $borrow_db['transaction_id'] = $borrow_id;
        // dd($borrow_db['transaction_id']);
        return view('admin.borrow.return-form', ['borrow_data' => $borrow_db], ['borrow_id' => $borrow_id]);
    }

    // Function for confirm button clicked in the return
    public function return_request(Request $request, $transaction_id) {
        $borrow_data = Borrow::find($transaction_id);
        $pending_data = Pending::where('transaction_id', '=', $transaction_id)
                                ->where('customer_name', '=', $borrow_data->customer_name)
                                ->first();
        $item_namee = $borrow_data->brw_item_name;
        $item_data = Items::where( function ($query) use ($item_namee){
            $query->where('item_name', '=', $item_namee);
        })->first();
        // Format the date if needed
        $formatted_date = Carbon::now()->format('Y-m-d'); // "Y-m-d" format
            
        $item_id_ = $item_data->item_id;
        $item_quantity_ = $item_data->item_quantity;
        
        $history_db = new History();
        $history_db->transaction_id = $transaction_id;
        $history_db->history_cus_name = $borrow_data->customer_name;
        $history_db->history_cus_add = $borrow_data->customer_address;
        $history_db->history_cus_email = $borrow_data->customer_email;
        $history_db->history_cus_no = $borrow_data->customer_number;
        $history_db->history_item = $borrow_data->brw_item_name;
        $history_db->history_brand = $borrow_data->brw_item_brand;
        $history_db->history_category = $borrow_data->brw_item_category;
        $history_db->history_quantity = $borrow_data->brw_quantity;
        $item_back = $history_db->history_quantity;

        // updated item quantity
        $returned_item_quantity = $item_back + $item_quantity_;
        $items_db = Items::find($item_id_);
        $items_db->item_quantity = $returned_item_quantity;
        $history_db->history_duration = $borrow_data->brw_duration;
        $history_db->history_pickup = $borrow_data->date_requested;
        $history_db->history_returned = $formatted_date;
        $history_db->history_remarks = "Returned";
        $history_db->history_late = $borrow_data->late_status;
        $borrow_data->borrow_status = "Returned";
        $history_db->history_note = $request->history_note;
        $pending_id = Pending::where("transaction_id", "=", $transaction_id)->first();
        
        if ($pending_id) {
        $pending_id->borrow_status = 'Returned';
        $pending_id->save();
        }
        // Changed from
        // $pending_data->borrow_status = 'Returned';
        // $pending_data->save();
        if ($pending_data) {
            $pending_data->borrow_status = 'Returned';
            $pending_data->save();
        }

        $history_db->save();
        $items_db->save();
        $borrow_data->save();
        return redirect('/admin/borrow-request/')->with('add-message','Item successfully returned')->with('title', 'Returned');
    }

    // Function when outbounding borrowed item
    public function outbound_borrow($borrow_id){
        $borrow_data = Borrow::find($borrow_id);
        $pending_data = Pending::where('transaction_id', $borrow_id)->first();
        $item_namee = $borrow_data->brw_item_name;
        $item_data = Items::where( function ($query) use ($item_namee){
            $query->where('item_name', '=', $item_namee);
        })->first();
        $formatted_date = Carbon::now()->format('Y-m-d'); // "Y-m-d" format
            
        $item_id_ = $item_data->item_id;
        $item_quantity_ = $item_data->item_quantity;
        
        $history_db = new History();
        $history_db->transaction_id = $borrow_data->transaction_id;
        $history_db->history_cus_name = $borrow_data->customer_name;
        $history_db->history_cus_add = $borrow_data->customer_address;
        $history_db->history_cus_email = $borrow_data->customer_email;
        $history_db->history_cus_no = $borrow_data->customer_number;
        $history_db->history_item = $borrow_data->brw_item_name;
        $history_db->history_brand = $borrow_data->brw_item_brand;
        $history_db->history_category = $borrow_data->brw_item_category;
        $history_db->history_quantity = $borrow_data->brw_quantity;
        $item_back = $history_db->history_quantity;

        // updated item quantity
        $items_db = Items::find($item_id_);
        $history_db->history_duration = $borrow_data->brw_duration;
        $history_db->history_pickup = $borrow_data->date_requested;
        $history_db->history_returned = $formatted_date;
        $history_db->history_remarks = "Outbound";
        $history_db->history_late = $borrow_data->late_status;
        $borrow_data->borrow_status = "Outbound";
        if($pending_data){
            $pending_data->borrow_status = "Outbound";
            $pending_data->save();
        }
        

        $history_db->save();
        $items_db->save();
        $borrow_data->save();
        return redirect('/admin/borrow-request/')->with('add-message','Item successfully released')->with('title', 'Item outbound');
    }

    // Function for Deleting History
    public function delete_history($history_id) {
        $history_data = History::find($history_id);
        $history_data->delete();
        return redirect('/admin/history-logs')->with('delete-message', 'Data was successfully deleted')->with('title', 'Deleted');
    }
}
