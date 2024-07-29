<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    // Function for checking customer name
    public function check(Request $request) {
        $customerName = $request->query('customer_name');

        // Perform any logic with $customerName here

        // return view('your.view.name', [
        //     'customer_name' => $customerName,
        // ]);
        dd($customerName);  
    }

    // Function for history logs
    public function history_logs() {
        $category_data = Category::all();
        $history_logs = History::orderBy('created_at', 'desc')->get();
        foreach ($history_logs as $history) {

            $borrow_id = 0;
            $latestBorrow = $history->transaction_id;
            $borrow_id = $latestBorrow;
            
            
            $zero = '0';
            $limit = 6 - 2;
            $num_length = strlen((string)$borrow_id);
            for($i = 0 ; $i <= $limit - $num_length ; $i++){
                $zero = $zero . '0';
            }
            
            $borrow_id = $zero.$borrow_id;
            $history->transaction_id = $borrow_id;
        }
        // return Excel::download(new HistoryExport($history_logs),'');
        return view('admin.history-logs')->with('history_data', $history_logs)->with('categories', $category_data);
    }

    // Function for history log's search bar
    public function history_search(Request $request){
        $category_data = Category::all();
        $search = $request->search;
        if($search == "On Time" || $search == "On time" || $search == "on Time" || $search == "on time"){
            $data = History::where(function ($query) use ($search) {
                $query->where('history_late', '=', null);
            })->orderBy('history_id', 'asc')->get();
        } else {
            $data = History::where(function ($query) use ($search) {
                $query->where('history_id', 'like', '%' . $search . '%')
                      ->orWhere('transaction_id', 'like', '%' . $search . '%')
                      ->orWhere('history_cus_name', 'like', '%' . $search . '%')
                      ->orWhere('history_cus_add', 'like', '%' . $search . '%')
                      ->orWhere('history_cus_email', 'like', '%' . $search . '%')
                      ->orWhere('history_cus_no', 'like', '%' . $search . '%')
                      ->orWhere('history_item', 'like', '%' . $search . '%')
                      ->orWhere('history_brand', 'like', '%' . $search . '%')
                      ->orWhere('history_category', 'like', '%' . $search . '%')
                      ->orWhere('history_returned', 'like', '%' . $search . '%')
                      ->orWhere('history_late', 'like', '%' . $search . '%');
                    })->orderBy('history_id', 'asc')->get();
        }
        
                return view("admin.history-logs", ['history_data' => $data])->with('categories', $category_data);
    }

// ======================== History Sorting Functions ========================== //
    // Function sorting history by ID
    public function his_sort_id(){ 
        $category_data = Category::all();
        $order=Session::get('his_id');
        if( $order == 'asc' ){
            Session::put('his_id', 'desc');
        }else{
            Session::put('his_id', 'asc');
        }
        $order = Session::get('his_id');
        $data = History::orderBy('transaction_id', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }

    // Function sorting history name
    public function his_sort_name(){ 
        $category_data = Category::all();
        $order=Session::get('his_name');
        if( $order == 'asc' ){
            Session::put('his_name', 'desc');
        }else{
            Session::put('his_name', 'asc');
        }
        $order = Session::get('his_name');        
        $data = History::orderBy('history_cus_name', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }

    // Function sorting history item
    public function his_sort_item(){ 
        $category_data = Category::all();
        $order=Session::get('his_item');
        if( $order == 'asc' ){
            Session::put('his_item', 'desc');
        }else{
            Session::put('his_item', 'asc');
        }
        $order = Session::get('his_item');        
        $data = History::orderBy('history_item', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }

    // Function History sorting by category
    public function his_sort_cat(){ 
        $category_data = Category::all();
        $order=Session::get('his_cat');
        if( $order == 'asc' ){
            Session::put('his_cat', 'desc');
        }else{
            Session::put('his_cat', 'asc');
        }
        $order = Session::get('his_cat');        
        $data = History::orderBy('history_category', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }
    
    // Function history by quantity
    public function his_sort_qty(){ 
        $category_data = Category::all();
        $order=Session::get('his_qty');
        if( $order == 'asc' ){
            Session::put('his_qty', 'desc');
        }else{
            Session::put('his_qty', 'asc');
        }
        $order = Session::get('his_qty');        
        $data = History::orderBy('history_quantity', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }

    // Function History sorting by date to pick up
    public function his_sort_dpckp(){ 
        $category_data = Category::all();
        $order=Session::get('his_dpckp');
        if( $order == 'asc' ){
            Session::put('his_dpckp', 'desc');
        }else{
            Session::put('his_dpckp', 'asc');
        }
        $order = Session::get('his_dpckp');        
        $data = History::orderBy('history_pickup', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }

    // Function history sorting by date returned
    public function his_sort_drtrn(){ 
        $category_data = Category::all();
        $order=Session::get('his_drtrn');
        if( $order == 'asc' ){
            Session::put('his_drtrn', 'desc');
        }else{
            Session::put('his_drtrn', 'asc');
        }
        $order = Session::get('his_drtrn');        
        $data = History::orderBy('history_returned', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }

    // Function history sorting the status
    public function his_sort_status(){ 
        $category_data = Category::all();
        $order=Session::get('his_status');
        if( $order == 'asc' ){
            Session::put('his_status', 'desc');
        }else{
            Session::put('his_status', 'asc');
        }
        $order = Session::get('his_status');        
        $data = History::orderBy('history_late', $order)->get(); // limit = display | desc = descending order
        return view('admin.history-logs', ['history_data' => $data])->with('categories', $category_data);  
    }
// ============================================================================= //
    public function add_category(Request $request){
        $request->validate([
            'category_name' => 'required',
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $res = $category->save();
        return redirect('/admin/inventory-list/modify-category')->with('add-message', 'Category was successfully added')->with('title', 'Added');
    }

    public function edit_category(Request $request){
        $request->validate([
            'rename_category' => 'required',
            'item_category' => 'required',
        ]);    
        $identifier = Category::where('category_name', '=', $request->item_category)->get('id');
       
        $category = Category::find($identifier)->first();
        $category->category_name = $request->rename_category;
        $category->save();



        return redirect('/admin/inventory-list/modify-category')->with('update-message', 'Category was successfully updated')->with('title', 'Updated');
    }

    public function drop_category(Request $request){
        $request->validate([
            'item_category' => 'required',
        ]);    
        $identifier = Category::where('category_name', '=', $request->item_category)->get('id');
        $category = Category::find($identifier)->first();
        $category->delete();

        return redirect('/admin/inventory-list/modify-category')->with('delete-message', 'Category was deleted')->with('title', 'Deleted');
    }
}
