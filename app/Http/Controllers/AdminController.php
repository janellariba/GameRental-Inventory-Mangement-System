<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Borrow;
use App\Models\Employee;
use App\Models\History;
use App\Models\Items;
use App\Models\Category;
use App\Models\User;
use App\Models\Pending;
use Carbon\Carbon;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Laravel\Facades\Image;
use Dompdf\Dompdf;

//================================== Admin Controller ==================================//
class AdminController extends Controller
{
    //========== Home Tab ===========//
    public function home()
    {
        if(auth()->check()){
                $data = Items::orderBy('item_id', 'desc')->limit(10)->get(); // limit = display | desc = descending order
                $borrow_status_ = "Ongoing";
                $returned_status_ = "Returned";

                // show all borrow data
                $borrow_data = Borrow::where( function ($query) use ($borrow_status_){
                    $query->where('borrow_status', '=', $borrow_status_);
                })->orderBy('created_at', 'desc')->limit(3)->get();
                // show all returned data
                $return_data = History::orderBy('created_at', 'desc')->limit(3)->get();

                $number_of_borrow = Borrow::where( function ($query) use ($borrow_status_){
                    $query->where('borrow_status', '=', $borrow_status_);
                })->count();
                
                $total_borrow = Borrow::where( function ($query) use ($returned_status_ ){
                    $query->where('borrow_status', '=', $returned_status_);
                })->count();

                $total_pending = Pending::where('borrow_status','=','Pending')->count();
                $total_history = History::all()->count();

                $total = $number_of_borrow + $total_history;
                //  sends view to the blade
                return view('admin.home', [
                    'pendings' => $total_pending,
                    'items' => $data,
                    'borrows'=> $borrow_data,
                    'returns'=> $return_data,
                    'borrow_count'=> $number_of_borrow,
                    'total_count' => $total,
                ]);
        } else {
            $data = Items::orderBy('item_id', 'desc')->limit(10)->get(); // limit = display | desc = descending order
            $total = Items::all();
            $overall = $total->sum('item_quantity');
            $totalaccessories = Items::where('item_category','like','%Accessories%');
            $overallaccessories = $totalaccessories->sum('item_quantity');
            $totalconsoles = Items::where('item_category','like','%Consoles%');
            $overallconsoles = $totalconsoles->sum('item_quantity');
            $totalcontrollers = Items::where('item_category','like','%Controller%');
            $overallcontrollers = $totalcontrollers->sum('item_quantity');
            $totalgames = Items::where('item_category','like','%Physical Games%');
            $overallgames = $totalgames->sum('item_quantity');
            $totalspeakers = Items::where('item_category','like','%Speakers%');
            $overallspeakers = $totalspeakers->sum('item_quantity');
            $totalothers = Items::where('item_category','like','%Others%');
            $overallothers = $totalothers->sum('item_quantity');
            return view('/admin/inventory-list', 
                ['items' => $data],
                [ 'totals' => $overall,
                    'totals' => Session::get('overall'),
                    'accessories' => $overallaccessories,
                    'consoles' => $overallconsoles, 
                    'controller' => $overallcontrollers,
                    'games' => $overallgames,
                    'speaker' => $overallspeakers,
                    'other' => $overallothers]);
        } 
    }

    //========== Inventory List ===========//

    public function inventory_list()
    {
        // data setup
        $data = Items::orderBy('item_id', 'desc')->get(); // limit = display | desc = descending order
        $category_data = Category::all();
        // quantity display 
        $total = Items::all();
        // displaying of total quantity of items per category
        Session::put('overall', $total->sum('item_quantity'));

        $category_total = [];
        foreach($category_data as $category){
            $totalCategory = Items::where('item_category','like', '%'.$category->category_name . '%')->sum('item_quantity');
            Session::put('total' . $category->category_name, $totalCategory);
            $category_totals[$category->category_name] = $totalCategory;
        }
        Session::put('category_totals', $category_totals);
        return view('admin.inventory-list', 
        ['items' => $data], 
        ['totalsin'=> Session::get('overall'),
            'category_totals'=> Session::get('category_totals'),
            'totals' => Session::get('overall'),
        ]);
    }

    //================================== Header Sort Function (Inventory List) ==================================//

    //========== Sort By Item Name Function ===========//

    public function name_sort()
    {   
        $order=Session::get('namekey');

        if( $order == 'asc' ){
            Session::put('namekey', 'desc');
        }else{
            Session::put('namekey', 'asc');
        }

        $order = Session::get('namekey');
        
        $data = Items::orderBy('item_name', $order)->get(); // limit = display | desc = descending order


        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Item Code Function ===========//

    public function code_sort()
    {   
        $order=Session::get('codekey');

        if( $order == 'asc' ){
            Session::put('codekey', 'desc');
        }else{
            Session::put('codekey', 'asc');
        }

        $order = Session::get('codekey');
        
        $data = Items::orderBy('item_code', $order)->get(); // limit = display | desc = descending order


        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Item Category Function ===========//

    public function cat_sort()
    {   
        $order=Session::get('catkey');

        if( $order == 'asc' ){
            Session::put('catkey', 'desc');
        }else{
            Session::put('catkey', 'asc');
        }

        $order = Session::get('catkey');
        
        $data = Items::orderBy('item_category', $order)->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order


        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Item Brand Function ===========//

    public function brd_sort()
    {   
        $order=Session::get('brdkey');

        if( $order == 'asc' ){
            Session::put('brdkey', 'desc');
        }else{
            Session::put('brdkey', 'asc');
        }

        $order = Session::get('brdkey');
        
        $data = Items::orderBy('item_brand', $order)->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Item Quantity Function ===========//

    public function qty_sort()
    {   
        $order=Session::get('qtykey');

        if( $order == 'asc' ){
            Session::put('qtykey', 'desc');
        }else{
            Session::put('qtykey', 'asc');
        }

        $order = Session::get('qtykey');
        
        $data = Items::orderBy('item_quantity', $order)->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order


        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Item Status Function ===========//

    public function sts_sort()
    {   
        $order=Session::get('stskey');

        if( $order == 'asc' ){
            Session::put('stskey', 'desc');
        }else{
            Session::put('stskey', 'asc');
        }

        $order = Session::get('stskey');
        
        $data = Items::orderBy('item_status', $order)->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order


        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //================================== Button Sort Function (Inventory List) ==================================//

    //========== Sort By Category (Accessory) Function ===========//

    public function access_sort()
    {   
        
        $data = Items::where('item_category','=','Accessories')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Console) Function ===========//

    public function con_sort()
    {   
        
        $data = Items::where('item_category','=','Consoles')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Controller) Function ===========//

    public function cont_sort()
    {   
        
        $data = Items::where('item_category','=','Controller')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Physical Game) Function ===========//

    public function pg_sort()
    {   
        
        $data = Items::where('item_category','=','Physical Games')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        return view('admin.inventory-list', 
        ['items' => $data], 
        ['totals'=> Session::get('overall'),
        'total' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Speaker) Function ===========//

    public function spkr_sort()
    {   
        
        $data = Items::where('item_category','=','Speakers')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Others) Function ===========//

    public function other_sort()
    {   
        
        $data = Items::where('item_category','=','Others')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        return view('admin.inventory-list', 
        ['items' => $data], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //================================== Header Sort Function (Borrow Inventory List) ==================================//

    //========== Sort By Item Name Function ===========//
    
    public function br_name_sort()
    {   
        $order=Session::get('namekey');

        if( $order == 'asc' ){
            Session::put('namekey', 'desc');
        }else{
            Session::put('namekey', 'asc');
        }

        $order = Session::get('namekey');
        
        $data = Items::orderBy('item_name', $order)->where('item_quantity','>', 0)->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
    ]);
    }

    //========== Sort By Item Code Function ===========//

    public function br_code_sort()
    {   
        $order=Session::get('codekey');

        if( $order == 'asc' ){
            Session::put('codekey', 'desc');
        }else{
            Session::put('codekey', 'asc');
        }

        $order = Session::get('codekey');
        
        $data = Items::orderBy('item_code', $order)->where('item_quantity','>', 0)->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
    ]);
    }

    //========== Sort By Item Brand Function ===========//

    public function br_brd_sort()
    {   
        $order=Session::get('brandkey');

        if( $order == 'asc' ){
            Session::put('brandkey', 'desc');
        }else{
            Session::put('brandkey', 'asc');
        }

        $order = Session::get('brandkey');
        
        $data = Items::orderBy('item_brand', $order)->where('item_quantity','>', 0)->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
    ]);
    }

    //========== Sort By Item Category Function ===========//

    public function br_cat_sort()
    {   
        $order=Session::get('categorykey');

        if( $order == 'asc' ){
            Session::put('categorykey', 'desc');
        }else{
            Session::put('categorykey', 'asc');
        }

        $order = Session::get('categorykey');
        
        $data = Items::orderBy('item_category', $order)->where('item_quantity','>', 0)->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
    ]);
    }

    //========== Sort By Item Quantity Function ===========//

    public function br_qty_sort()
    {   
        $order=Session::get('quantitykey');

        if( $order == 'asc' ){
            Session::put('quantitykey', 'desc');
        }else{
            Session::put('quantitykey', 'asc');
        }

        $order = Session::get('quantitykey');
        
        $data = Items::orderBy('item_quantity', $order)->where('item_quantity','>', 0)->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
    ]);
    }

    //================================== Button Sort Function (Borrow Inventory List) ==================================//

    //========== Sort By Category (Accessory) Function ===========//

    public function br_access_sort()
    {   
        
        $data = Items::where('item_category','=','Accessories')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table], 
        ['total'=> Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Consoles) Function ===========//

    public function br_con_sort()
    {   
        
        $data = Items::where('item_category','=','Consoles')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table], 
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Controller) Function ===========//

    public function br_cont_sort()
    {   
        
        $data = Items::where('item_category','=','Controller')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table],
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Physical Games) Function ===========//

    public function br_pg_sort()
    {   
        
        $data = Items::where('item_category','=','Physical Games')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table],
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Speaker) Function ===========//

    public function br_spkr_sort()
    {   
        
        $data = Items::where('item_category','=','Speakers')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table],
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //========== Sort By Category (Other) Function ===========//

    public function br_other_sort()
    {   
        
        $data = Items::where('item_category','=','Others')->orderBy('item_name', 'asc')->get(); // limit = display | desc = descending order

        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];

        return view('admin.borrow.add', 
        ['item_list' => $data, 'clicked_table' => $clicked_table],
        ['total'=> Session::get('overall'),
        'totals' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
        ]);
    }

    //================================== Search Functions ==================================//

    //========== Borrow Inventory List Search Function ===========//

    public function borrow_search(Request $request){
        $search = $request->search;
        $data = Items::where(function ($query) use ($search) {
            $query->where('item_name', 'like', '%' . $search . '%')
                  ->orWhere('item_code', 'like', '%' . $search . '%')
                  ->orWhere('item_brand', 'like', '%' . $search . '%')
                  ->orWhere('item_category', 'like', '%' . $search . '%')
                  ->orWhere('item_quantity', 'like', '%' . $search . '%')
                  ->orWhere('item_status' , '=', $search);
                })->where('item_status','=','Available')->orderBy('item_name', 'asc')->get();

                $clicked_table = (object)[
                    'item_name' => '',
                    'item_brand' => '',
                    'item_status' => '',
                    'item_category' => ''
                ];    

                Session::put('tableclick', $clicked_table);

            return view("admin.borrow.add", ['item_list' => $data, 'clicked_table' => $clicked_table], 
            ['totals'=> Session::get('overall'),
            'total' => Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
            ]);          
    }

    //========== Borrow Request Search Function ===========//

    public function rent_search(Request $request){
        $search = $request->search;
        $return_status = "Returned";
        $data = Borrow::where(function ($query) use ($search) {
            $query->where('transaction_id', 'like', '%' . $search . '%')
                  ->orWhere('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('customer_address', 'like', '%' . $search . '%')
                  ->orWhere('customer_email', 'like', '%' . $search . '%')
                  ->orWhere('brw_item_name', 'like', '%' . $search . '%')
                  ->orWhere('brw_item_brand', 'like', '%' . $search . '%')
                  ->orWhere('brw_item_category', 'like', '%' . $search . '%')
                  ->orWhere('date_requested', 'like', '%' . $search . '%')
                  ->orWhere('date_to_return', 'like', '%' . $search . '%')
                  ->orWhere('customer_number' , '=', $search);
                })->where('borrow_status','=', 'Ongoing')->get();
        
                // show all returned data
                $return_data = Borrow::where( function ($query) use ($return_status){
                    $query->where('borrow_status', '=', $return_status);
                })->limit(10)->get();

                Session::put('return_data', $return_data);

        return view("admin.borrow-request", ['borrows' => $data, 'returns'=> $return_data]);
    }

    //================================== Sorting Functions (Borrow Request) ==================================//

    //========== Sort by Date Function ===========//

    public function sort_date(){
         $order=Session::get('req_date_key');
         $return_status_ = "Returned";

        if( $order == 'asc' ){
            Session::put('req_date_key', 'desc');
        }else{
            Session::put('req_date_key', 'asc');
        }

        $order = Session::get('req_date_key');
        
               $data = Borrow::orderBy('date_requested', $order)->orderBy('customer_name', 'asc')->where('borrow_status','=', 'Ongoing')->get();
              
                // show all returned data
                $return_data = Borrow::where( function ($query) use ($return_status_){
                    $query->where('borrow_status', '=', $return_status_);
                })->limit(8)->get();

        return view("admin.borrow-request", ['borrows' => $data, 'returns'=> $return_data]);
    }

    //========== Sort by ID of Request Function ===========//

    public function sort_id(){
        $order=Session::get('req_id_key');

       if( $order == 'asc' ){
           Session::put('req_id_key', 'desc');
       }else{
           Session::put('req_id_key', 'asc');
       }

       $order = Session::get('req_id_key');

       $borrow_status_ = "Ongoing";
                $return_status_ = "Returned";
        
                // show all borrow data
                $borrow_data = Borrow::where( function ($query) use ($borrow_status_){
                    $query->where('borrow_status', '=', $borrow_status_);
                })->get();
        
                // show all returned data
                $return_data = Borrow::where( function ($query) use ($return_status_){
                    $query->where('borrow_status', '=', $return_status_);
                })->limit(8)->get();
       
       $data = Borrow::orderBy('transaction_id', $order)->where('borrow_status', '=', $borrow_status_)->get();
       return view("admin.borrow-request", ['borrows' => $data,'returns'=> $return_data]);
   }

    //================================== Inventory Search (Inventory List) ==================================//

    //========== Item Search Function ===========//

    public function item_search(Request $request)
    {
        $search = $request->search;
        $data = Items::where(function ($query) use ($search) {
            $query->where('item_name', 'like', '%' . $search . '%')
                  ->orWhere('item_code', 'like', '%' . $search . '%')
                  ->orWhere('item_brand', 'like', '%' . $search . '%')
                  ->orWhere('item_category', 'like', '%' . $search . '%')
                  ->orWhere('item_quantity', 'like', '%' . $search . '%')
                  ->orWhere('item_status' , '=', $search);
                })->get();

        return view('admin.inventory-list', 
            ['items' => $data],
            ['totals'=> Session::get('overall'),
            'accessories' => Session::get('totalaccessories'),
            'consoles' => Session::get('totalconsoles'),
            'controller' => Session::get('totalcontrollers'),
            'games' => Session::get('totalgames'),
            'speaker' => Session::get('totalspeakers'),
            'other' => Session::get('totalothers')
            ]);
    }

    //================================== Data Handling (Inventory List) ==================================//

    //========== Adding New Items ===========//

    public function store_item(Request $request)
    {
        // fetching of data
        $request->validate([
            'item_name' => 'required',
            'item_brand' => 'required',
            'item_category' => 'required',
            'item_quantity' => 'required|numeric|min:0',
            'item_code' => 'nullable|unique',
            'item_image' => 'nullable|mimes:png,jpeg,jpg,webp'
        ]);

        if ($request->file('item_image')) {
            $file = $request->file('item_image');
            $extension = $file->getClientOriginalExtension();

            $path = 'uploads/items/';
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
        } else {
            $path = null;
        }
        // storing of the data verified
        $item = new Items();
        $item->item_name = $request->item_name;
        $item->item_brand = $request->item_brand;
        $item->item_category = $request->item_category;
        $item->item_quantity = $request->item_quantity;
        if($request->item_quantity == 0){
            $item->item_status = 'Not Available';
        }else{
            $item->item_status = 'Available';
        }

        if ($path != null) {
            $item->item_image = $path . $filename;
        }

        // item Code Generator
        if ($item->item_category == 'Accessories'){
            $catcode = 'ACC';
        } else if($item->item_category == 'Consoles'){
            $catcode = 'CNS';
        } else if($item->item_category == 'Controller'){
            $catcode = 'CTR';
        } else if($item->item_category == 'Physical Games'){
            $catcode = 'ACC';
        } else if($item->item_category == 'Speaker'){
            $catcode = 'SPK';
        } else {
            $catcode = 'OTR';
        }

        if ($item->item_brand == 'Nintendo'){
            $brdcode = 'NTD';
        } else if($item->item_brand == 'Xbox'){
            $brdcode = 'XBX';
        } else if($item->item_brand == 'Playstation'){
            $brdcode = 'PSN';
        } else {
            $brdcode = 'NNE';
        }
        
        $itemsnum = Items::orderBy('item_id', 'desc')->limit(1)->get();;

        $idcount = $itemsnum->sum('item_id')+1;

        $item->item_code = $catcode."-".$brdcode."-ID".$idcount;
        
        $res = $item->save();
        return redirect('/admin/inventory-list')->with('add-message', 'Item was successfully added')->with('title', 'Added');
    }

    //========== Inventory List View ===========//

    public function add_item()
    {
        $category_data = Category::all();
        return view('admin.item.add')->with('categories', $category_data);
    }

    public function modify_category()
    {
        $category_data = Category::all();
        return view('admin.item.modify-category')->with('categories', $category_data);
    }

    //========== Edit List View ===========//

    public function edit_item($item_id)
    {
        $category_data = Category::all();
        if(auth()->user()->position != 'User'){
            $data = Items::findOrFail($item_id);
            return view('admin.item.edit', ['items' => $data])->with('categories', $category_data);
        }
        else {
            return redirect('/admin/inventory-list')->with('error','You are not authorized');
        }
    }

    //========== Editing of Existing Items ===========//

    public function alter_item(Request $request, $item_id)
    {
        // getting of new inputs 
        $request->validate([
            'item_name' => 'required',
            'item_brand' => 'required',
            'item_category' => 'required',
            'item_quantity' => 'required',
            'item_status' => 'required',
            'item_code' => 'nullable',
            'item_image' => 'nullable|mimes:png,jpeg,jpg,webp'
        ]);

        // setting up of images
        if ($request->file('item_image')) {
            $file = $request->file('item_image');
            $extension = $file->getClientOriginalExtension();

            $path = 'uploads/items/';
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
        } else {
            $path = null;
        }

        // get the item and store new ones
        $item = Items::find($item_id);
        $item->item_name = $request->item_name;
        $item->item_brand = $request->item_brand;
        $item->item_category = $request->item_category;

        // changing of status based on quantity
        if($request->item_quantity >= 0){
            $item->item_quantity = $request->item_quantity;
        }else{
            return back()->with('error','Invalid Quantity Input');
        }
        if($request->item_quantity == 0){
            $item->item_status = 'Not Available';
        }else{
            $item->item_status = 'Available';
        }
        if ($path != null) {
            $item->item_image = $path . $filename;
        }

        // item code generator
        if ($item->item_category == 'Accessories'){
            $catcode = 'ACC';
        } else if($item->item_category == 'Consoles'){
            $catcode = 'CNS';
        } else if($item->item_category == 'Controller'){
            $catcode = 'CTR';
        } else if($item->item_category == 'Physical Games'){
            $catcode = 'ACC';
        } else if($item->item_category == 'Speaker'){
            $catcode = 'SPK';
        } else {
            $catcode = 'OTR';
        }

        if ($item->item_brand == 'Nintendo'){
            $brdcode = 'NTD';
        } else if($item->item_brand == 'Xbox'){
            $brdcode = 'XBX';
        } else if($item->item_brand == 'Playstation'){
            $brdcode = 'PSN';
        } else {
            $brdcode = 'NNE';
        }

        $item->item_code = $catcode."-".$brdcode."-ID".$item_id;

        $res = $item->save();

        return redirect('/admin/inventory-list')->with('update-message', 'Item was successfully updated')->with('title', 'Updated');
    }

    //========== Dropping of Existing Items ===========//

    public function destroy_item(Request $request, $item_id)
    {
        $item = Items::find($item_id);
        $res = $item->delete();
        return redirect('/admin/inventory-list')->with('delete-message', 'Item was successfully deleted')->with('title', 'Deleted');
    }

    //========== Creation of Image Thumbnail ===========//

    public function createImageThumbnail($path, $width, $height)
    {
        $img = Image::read($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    //================================== Borrow Request Functions ==================================//

    //========== Requesting of Items ===========//

    public function borrow_request()
    {
        $borrow_status_ = "Ongoing";
        $return_status_ = "Returned";

        // show all borrow data
        $borrow_data = Borrow::where( function ($query) use ($borrow_status_){
            $query->where('borrow_status', '=', $borrow_status_);
        })->get();

        // show all returned data
        $return_data = Borrow::where( function ($query) use ($return_status_){
            $query->where('borrow_status', '=', $return_status_);
        })->limit(10)->orderBy('created_at', 'desc')->get();
        return view('admin.borrow-request', [
            'borrows' => $borrow_data,
            'returns'=> $return_data
        ]);
    }

    public function add_request()
    {
        $clicked_table = (object)[
            'item_name' => '',
            'item_brand' => '',
            'item_status' => '',
            'item_category' => ''
        ];
        
        $item_data = Items::all()->where('item_status', '=', 'Available');

        // $total = Items::all();
        // $overall = $total->sum('item_quantity');

        // $totalaccessories = Items::where('item_category','like','%Accessories%');
        // $overallaccessories = $totalaccessories->sum('item_quantity');

        // $totalconsoles = Items::where('item_category','like','%Consoles%');
        // $overallconsoles = $totalconsoles->sum('item_quantity');

        // $totalcontrollers = Items::where('item_category','like','%Controller%');
        // $overallcontrollers = $totalcontrollers->sum('item_quantity');

        // $totalgames = Items::where('item_category','like','%Physical Games%');
        // $overallgames = $totalgames->sum('item_quantity');

        // $totalspeakers = Items::where('item_category','like','%Speakers%');
        // $overallspeakers = $totalspeakers->sum('item_quantity');

        // $totalothers = Items::where('item_category','like','%Others%');
        // $overallothers = $totalothers->sum('item_quantity');
        // data setup
        $data = Items::orderBy('item_id', 'desc')->get(); // limit = display | desc = descending order
        $category_data = Category::all();
        // quantity display 
        $total = Items::all();
        // displaying of total quantity of items per category
        Session::put('overall', $total->sum('item_quantity'));

        $category_total = [];
        foreach($category_data as $category){
            $totalCategory = Items::where('item_category','like', '%'.$category->category_name . '%')->sum('item_quantity');
            Session::put('total' . $category->category_name, $totalCategory);
            $category_totals[$category->category_name] = $totalCategory;
        }
        Session::put('category_totals', $category_totals);
        return view('admin.borrow.add', 
        ['items' => $data], 
        ['totals'=> Session::get('overall'),
            'category_totals'=> Session::get('category_totals'),
            'clicked_table' => $clicked_table,
            'item_list' => $item_data,
        ]);



        // return view('admin.borrow.add', [
        //     'item_list' => $item_data,
            
        //     'total'=> $overall,
        //     'accessories' => $overallaccessories,
        //     'consoles' => $overallconsoles, 
        //     'controller' => $overallcontrollers,
        //     'games' => $overallgames,
        //     'speaker' => $overallspeakers,
        //     'other' => $overallothers
        // ]);
    }

    //========== Click Transfer Data Function ===========//

    public function click_table($item_id){
        Session::put('current_item', $item_id);
        $clicked_table = Items::findOrFail($item_id);
        Session::put('current_item_quantity', $clicked_table);
        $item_data = Items::all()->where('item_status', '=', 'Available');

        $data = Items::orderBy('item_id', 'desc')->get(); // limit = display | desc = descending order
        $category_data = Category::all();
        // quantity display 
        $total = Items::all();
        // displaying of total quantity of items per category
        Session::put('overall', $total->sum('item_quantity'));

        $category_total = [];
        foreach($category_data as $category){
            $totalCategory = Items::where('item_category','like', '%'.$category->category_name . '%')->sum('item_quantity');
            Session::put('total' . $category->category_name, $totalCategory);
            $category_totals[$category->category_name] = $totalCategory;
        }
        Session::put('category_totals', $category_totals);
        return view('admin.borrow.add', 
        ['items' => $data], 
        ['totals'=> Session::get('overall'),
            'category_totals'=> Session::get('category_totals'),
            'clicked_table' => $clicked_table,
            'item_list' => $item_data,
        ]);

        // return view('admin.borrow.add', [
        //     // 'transaction_id_next' => $borrow_id,
        //     'item_list' => $item_data,
        //     'clicked_table' => $clicked_table,
        //     'total'=> $overall,
        //     'accessories' => $overallaccessories,
        //     'consoles' => $overallconsoles, 
        //     'controller' => $overallcontrollers,
        //     'games' => $overallgames,
        //     'speaker' => $overallspeakers,
        //     'other' => $overallothers
        //     // 'data_click' => $data
        //     // 'item_data' => $item_id
        // ]);

    }

    //========== View Item Detail ===========//

    public function view_details()
    {
        return view('admin.item.view-details');
    }

    //================================== Employee Profiles Functions ==================================//

    //========== Sending of Employee View ===========//

    // nav button checking all employees and users
    public function employee_profile()
    {
        $data = User::all();
        if (auth()->user()->isAdmin == 1 || auth()->user()->isAdmin == 0) {
        return view('admin.employee-profile', ['users' => $data]);
        } else {
            // message after going back to the same link with message 
            return back()->with('error', 'You are not authorized');
        }
    }

    //========== Sort by User's Names ===========//

    public function ep_namesort()
    {
        $order=Session::get('epnamekey');

        if( $order == 'asc' ){
            Session::put('epnamekey', 'desc');
        }else{
            Session::put('epnamekey', 'asc');
        }

        $order = Session::get('epnamekey');
        
        $data = User::orderBy('name', $order)->get();
        return view('admin.employee-profile', ['users' => $data]);
    }

    //========== Sort by User's Position (User/Employee/Admin) ===========//

    public function ep_positionsort()
    {
        $order=Session::get('eppositionkey');

        if( $order == 'asc' ){
            Session::put('eppositionkey', 'desc');
        }else{
            Session::put('eppositionkey', 'asc');
        }

        $order = Session::get('eppositionkey');
        
        $data = User::orderBy('position', $order)->get();
        return view('admin.employee-profile', ['users' => $data]);
    }

    //========== User/Person Search ===========//

    public function user_search(Request $request)
    {
        $search = $request->search;
        if (strcasecmp($search, 'Employee') == 0) {
            $search = 0;
        }

        $data = User::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('position', 'like', '%' . $search . '%');
        })
        ->where(function ($query) use ($search) {
            if (strcasecmp($search, 'Admin') == 0) {
                $query->where('isAdmin', 1); // isAdmin = 1 for Admin users
            } elseif (strcasecmp($search, 'Employee') == 0) {
                $query->where('isAdmin', 0); // isAdmin = 0 for Employee users
            }
        })
        ->get();
        return view('admin.employee-profile', ['users' => $data]);
    }

    //========== Show Single User Data ===========//
    
    public function show_user($id)
    {
        if(auth()->user()->position == 'Admin') {
            $data = User::findorFail($id);
            return view('admin.employee.edit', ['user' => $data]);
        } else if(auth()->user()->position == 'Employee'){
            return redirect('/admin/employee-profile')->with('error', 'You are not authorized to visit that page.');
        } else {
            return redirect('/admin/inventory-list')->with('error', 'You are not authorized to visit that page.');
        }
       
    }

    //========== Update User Data ===========//
    
    public function update_user(Request $request, User $user)
    {
        
        $user_data = User::find($user->id);
        $validated = $request->validate([
            "name" => ['required', 'min:4'],
            "email" => ["required", "email"],
            "user_image" => 'nullable | mimes:jpeg,jpg,png,bmp,tiff,webp | max:4096'
        ]);
        
        if ($request->file('user_image')) {
            $file = $request->file('user_image');
            $extension = $file->getClientOriginalExtension();
            $path = 'uploads/users/';
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
        } else {
            $path = null;
        }

        if ($path != null) {
            $user_data->user_image = $path . $filename;
        }
        // $user->update($validated);  
        $user_data->name = $validated['name'];
        $user_data->email = $validated['email'];
        $user_data->save();
        // back with message
        return redirect('/admin/employee-profile/')->with('update-message', 'Data was successfully updated')->with('title', 'Updated');
    }

    //========== Create Thumbnail for Employee ===========//

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::read($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    //========== Delete User from Table ===========//

    public function delete_user(Request $request, User $user)
    {
        $user->delete();
        return redirect('/admin/employee-profile')->with('delete-message', 'Data was successfully deleted')->with('title', 'Deleted');
    }

    //========== Redirect Ongoing View ===========//

    public function ongoing_rents()
    {
        return view('admin.ongoing-rents');
    }

    //========== Employee Register View with Authentication ===========//

    public function employee_register()
    {
        $userIdentification = auth()->user()->position;
        if ($userIdentification == 'Admin' || $userIdentification == 'Employee') {
            return view('admin.register');
        } else {
            return back()->with('error','You are not authorized to add a user');
        }
    }

    //========== Employee Register Storing to Table ===========//

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email', Rule::unique('employees', 'email')],
            "password" => 'required | confirmed | min:6',
            "user_image" => 'nullable | mimes:jpeg,jpg,png,bmp,tiff,webp | max:4096',
            'position' => 'nullable'
        ]);


        $user_confirm = $validated['position'];
        $validated['password'] = bcrypt($validated['password']);
        if ($request->file('user_image')) {
            $file = $request->file('user_image');
            $extension = $file->getClientOriginalExtension();

            $path = 'uploads/users/';
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
        } else {
            $path = null;
        }
        if ($path != null) {
            $validated['user_image'] = $path . $filename;
        }
        User::create($validated);

        return redirect('/admin/employee-profile/')->with('add-message', 'User was successfully registered')->with('title', 'Registered');
    }

    //========== View Borrowed Items ===========//

    public function customer_details(Request $request){
        $data = $request->validate([
            'item_name'=> 'required',
            'item_brand'=> 'required',
            'item_category'=> 'required',
            'item_quantity'=> 'required',
            'item_requested_at'=> 'required',
            'item_returned'=> 'required'
        ]);
        // dd($data);
        return view()->with('admin.borrow.customer-details', ['borrow_items', $data]);
    }

    //================================== Password Change and Email OTP ==================================//

    //========== Route to Forgot Password Route ===========//

    public function forgot_password()
        {
            return view('forgot_password');
        }

    //========== Sends Data from the Forgot Password Tab ===========//

    public function forgot_password_post(Request $request)
        {
            $request->validate([
                'email' => "required|email|exists:users",
            ]);

            $token = Str::random(50);

            DB::table('reset_password')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send("emails.forget-pass-email", ['token' => $token], function ($message) use ($request){
                $message->to($request->email);
                $message->subject("Reset Password");
            });

            return redirect()->to(route("forget.password"))->with('message', 'Check Your Email')->with('title', 'Notice');
        }  
    
    //========== Reset Password Route with Unique Token ===========//
    
    public function reset_password($token){
        return view('new_password', compact('token'));
    }

    //========== Resetting of the Password (New Password) ===========//
        
    public function reset_password_post(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('reset_password')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return redirect()->to(route("reset.password"))->with("error","Invalid");
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('reset_password')->where(['email' => $request->email])->delete();

        return redirect()->to(route("login"))->with('message', 'Password Updated Sucessfully')->with('title', 'Updated');
    }

    //================================== About the Team View ==================================//

    public function our_team(){
        return view('our-team');
    }
    //===================================== Excel Export ======================================// 
    public function export_history(Request $request){
        
        $query= $request->query();
        $rules = [];

        if($request->date== 'all'){
        foreach($query as $key => $value){
                $rules[$key] = 'nullable';
        }
        $validatedData = $request->validate($rules);
        }else{
            foreach($query as $key => $value){
                $rules[$key] = 'nullable';
                if($rules[$key] == "item_requested_at" || $rules[$key] == "item_returned"){
                    $rules[$key] = 'required';
                }
            }
            $validatedData = $request->validate($rules);
        }

        if($validatedData["format"]=="pdf"){
            return Excel::download(new UsersExport($validatedData), 'Inventory_Report.pdf');
        } else {
            return Excel::download(new UsersExport($validatedData), 'Inventory_Report.xlsx');
        }
        
        // return Excel::download(new UsersExport($validated))->exportToPDF();
        // return (new UsersExport($validated))->exportToPDF();
        return back()->with('message', 'History Exported Successfully');
    }
}


