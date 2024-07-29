<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Models\Items;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

//==================== Controller Routes ====================//

// Admin Controller
Route::controller(AdminController::class)->group(function() {

    //Our team
    Route::get('/our-team', 'our_team');

    // Home
    Route::get('/admin/home', 'home')->middleware('auth');
    // Showing Data from the Home
    Route::get('/admin/home/{item_data}','show')->middleware('auth'); //Shows item list table at home

    // Fogot password
    Route::get('/forgot_password/', 'forgot_password')->name('forget.password');
    // Forgot Password Post
    Route::post('/forgot_password/', 'forgot_password_post')->name('forget.password.post');
    // Reset Password
    Route::get('/reset_password/{token}','reset_password')->name('reset.password');
    // Reset Password Post
    Route::post('/reset_password', 'reset_password_post')->name('reset.password.post');


    // Inventory List
    Route::get('/admin/inventory-list', 'inventory_list');
    // Inventory List Add Item
    Route::get('/admin/inventory-list/add', 'add_item')->middleware('auth');
     // Inventory List Add Caregory
     Route::get('/admin/inventory-list/modify-category', 'modify_category')->middleware('auth');
    // Inventory List Store Item Created
    Route::put('/admin/inventory-list/add', 'store_item')->middleware('auth');
    // Inventory List Add Item
    Route::get('/admin/inventory-list/add/', 'add_item')->middleware('auth');
    // Inventory List Edit Item
    Route::get('/admin/inventory-list/edit/{item_id}', 'edit_item')->middleware('auth');
    // Inventory List Altering Item
    Route::put('/admin/inventory-list/edit/{item_id}', 'alter_item')->middleware('auth');
    // Inventory List Destroying Item
    Route::delete('/admin/inventory-list/edit/{item_id}', 'destroy_item')->middleware('auth');

    // Search inventory
    Route::post('/admin/inventory-list/item', 'view_item');
    // Inventory List Search
    Route::get('/admin/inventory-list/search', 'item_search');

    // Header Sorts
    Route::get('/admin/inventory-list/sort_name', 'name_sort');
    // Inventory List Sort Name    
    Route::get('/admin/inventory-list/sort_code', 'code_sort');
    // Inventory List Sort Code
    Route::get('/admin/inventory-list/sort_category', 'cat_sort');
    // Inventory List Sort Brand
    Route::get('/admin/inventory-list/sort_brand', 'brd_sort');
    // Inventory List Sort Quantity
    Route::get('/admin/inventory-list/sort_quantity', 'qty_sort');
    // Inventory List Sort Status
    Route::get('/admin/inventory-list/sort_status', 'sts_sort');
    
    // Borrow Header Sorts
    Route::get('/admin/borrow-request/add/sort_name', 'br_name_sort');
    // Borrow Code Sort
    Route::get('/admin/borrow-request/add/sort_code', 'br_code_sort');
    // Borrow Category Sort
    Route::get('/admin/borrow-request/add/sort_category', 'br_cat_sort');
    // Borrow Brand Sort
    Route::get('/admin/borrow-request/add/sort_brand', 'br_brd_sort');
    // Borrow Quantity Sort
    Route::get('/admin/borrow-request/add/sort_quantity', 'br_qty_sort');
    // Borrow Status Sort
    Route::get('/admin/borrow-request/add/sort_status', 'br_sts_sort');

    // Category Sorts
    Route::get('/admin/inventory-list/accessories', 'access_sort');
    // Category Contols Sort
    Route::get('/admin/inventory-list/consoles', 'con_sort');
    // Inventory List Category Sort 
    Route::get('/admin/inventory-list/controllers', 'cont_sort');
    // Inventory List Games Sort
    Route::get('/admin/inventory-list/games', 'pg_sort');
    // Inventory List Speakers Sort
    Route::get('/admin/inventory-list/speakers', 'spkr_sort');
    // InventoryList Others Sort
    Route::get('/admin/inventory-list/others', 'other_sort');

    // Borrow Category Sorts
    Route::get('/admin/borrow-request/add/accessories', 'br_access_sort');
    // Borrow Console Sort
    Route::get('/admin/borrow-request/add/consoles', 'br_con_sort');
    // Borrow Controller Sort
    Route::get('/admin/borrow-request/add/controllers', 'br_cont_sort');
    // Borrow Games Sort
    Route::get('/admin/borrow-request/add/games', 'br_pg_sort');
    // Borrow Speakers Sort
    Route::get('/admin/borrow-request/add/speakers', 'br_spkr_sort');
    // Borrow Others Sort
    Route::get('/admin/borrow-request/add/others', 'br_other_sort');
    
    // Borrow Request
    Route::get('/borrow-request', 'borrow_request')->middleware('auth');
    // Route to borrow request
    Route::get('admin/borrow-request', 'borrow_request')->middleware('auth');
    // Route to add request
    Route::get('/borrow-request/add/', 'add_request')->middleware('auth');
    // Route when searching borrow
    Route::get('/borrow-request/add/search', 'borrow_search');
    // route when adding at clicking table
    Route::get('/borrow-request/add/{item_id}', 'click_table');

    // Borrow Search
    Route::get('admin/borrow-request/search', 'rent_search')->middleware('auth');
    // Sorting date in the borrow request
    Route::get('/borrow-request/sort_date', 'sort_date')->middleware('auth');
    // sorting id in the borrow request
    Route::get('/borrow-request/sort_id', 'sort_id')->middleware('auth');

    // Employee Profile
    Route::get('/admin/inventory-list/view-details', 'view_details')->middleware('auth');
    // Employee Profile
    Route::get('/admin/employee-profile/', 'employee_profile')->middleware('auth');
    // Sorting name for employee
    Route::get('/admin/employee-profile/sort_name', 'ep_namesort')->middleware('auth');
    // Sorting position
    Route::get('/admin/employee-profile/sort_position', 'ep_positionsort')->middleware('auth');
    // Editting employee
    Route::get('/admin/employee-profile/employee', 'edit_employee')->middleware('auth');
    // Registering an employee
    Route::get('/register', 'employee_register')->middleware('auth');
    // Storing the user that is registered
    Route::post('/admin/register/store', 'store')->middleware('auth');
    // Showing single user
    Route::get('/admin/employee-profile/employee/{id}', 'show_user');
    // Searching for user
    Route::get('/admin/employee-profile/search', 'user_search');
    // Editing the user
    Route::put('/admin/employee-profile/employee/update/{user}', 'update_user')->middleware('auth');
    // Delete a user
    Route::delete('/admin/employee-profile/employee/{user}', 'delete_user')->middleware('auth');
    // Routing home
    Route::get('/', 'home');    
    // Exporting history
    Route::get('/admin/history-logs/export', 'export_history')->name('export_user')->middleware('auth');
});
// ==================== Employee Controller Routes ====================//
// > login - to go to login screen
// > store - will create a new account

Route::controller(EmployeeController::class)->group(function() {
    // for logging in: di pa sure kung sa employee or sa admin eto, gawin nalang generic
    Route::get('/login','login')->name('login')->middleware('guest');   
    // for process when logging in
    Route::post('/login/process', 'process');
    // logout Route
    Route::post('/logout','logout');
});
//===================================================================//

//==================== Item Controller Routes ====================//

Route::controller(ItemController::class)->group(function() {
    Route::get('/check','check');
    // History Logs
    Route::get('/admin/history-logs', 'history_logs')->middleware('auth');
    // History searching
    Route::get('/admin/history-logs/search', 'history_search')->middleware('auth');
    // History Sort
    Route::get('/admin/history-logs/sort-id', 'his_sort_id')->middleware('auth');
    // Sorting name
    Route::get('/admin/history-logs/sort-name', 'his_sort_name')->middleware('auth');
    // Sorting item
    Route::get('/admin/history-logs/sort-item', 'his_sort_item')->middleware('auth');
    // Sorting category
    Route::get('/admin/history-logs/sort-cat', 'his_sort_cat')->middleware('auth');
    // Sorting quantity
    Route::get('/admin/history-logs/sort-qty', 'his_sort_qty')->middleware('auth');
    // Sorting pickup date
    Route::get('/admin/history-logs/sort-pickup', 'his_sort_dpckp')->middleware('auth');
    // Sorting return date
    Route::get('/admin/history-logs/sort-return', 'his_sort_drtrn')->middleware('auth');
    // Sorting status
    Route::get('/admin/history-logs/sort-status', 'his_sort_status')->middleware('auth');

    // Add Category
    Route::put('/admin/inventory-list/modify-category/add_category', 'add_category')->middleware('auth');
    // Update Category
    Route::put('/admin/inventory-list/modify-category/edit_category', 'edit_category')->middleware('auth');
    // Delete Category
    Route::put('/admin/inventory-list/modify-category/drop_category', 'drop_category')->middleware('auth');
});

// checking if the user is a user, admin or employee
function homeRoute() {
    $userIdentity = auth()->user()->isAdmin;
    if ($userIdentity == 0) {
        return 'User is Admin';
    } elseif ($userIdentity == 1) {
        return 'User is Employee';
    } elseif ($userIdentity == null) {
        return 'User is User';
    }
}
//===================================================================//


//==================== Borrow Controller Routes ====================//
Route::controller(BorrowController::class)->group(function() {
    // route for form for customer details
    Route::post('/borrow-request/add/customer-details', 'customer_details')->middleware('auth');
    // route for getting the receipt of the overall item borrowed
    Route::post('/borrow-request/customer-details/receipt/', 'receipt')->middleware('auth');;
    // route for viewing details of borrowed item
    Route::get('/admin/borrow-request/view-details/{transaction_id}', 'borrow_view_details');
    // route for return form
    Route::get('/admin/borrow-request/return-form/{transaction_id}', 'return_form');
    // will trigger when the confirm button in the return was clicked
    Route::put('/admin/borrow-request/complete/{transaction_id}', 'return_request');
    // deleting history
    Route::delete('/admin/history-logs/{history_id}', 'delete_history')->middleware('auth');
    // outbound an item
    Route::get('/admin/borrow-request/outbound/{transaction_id}', 'outbound_borrow')->middleware('auth');
});
//====================================================================//

//==================== User Controller Routes ====================//
Route::controller(UserController::class)->group(function() {
    // Pending Request
    Route::get('/pending-request/', 'pending_request')->middleware('auth');
    // Pending request view detail button
    Route::get('/pending-request/view-details/{pending_id}', 'pending_request_view_details')->middleware('auth');
    // deleting pending request made by a user
    Route::get('/pending-request/delete-request/{pending_id}', 'delete_request')->middleware('auth');
    // search bar for request pending
    Route::get('/pending/search', 'pending_search')->middleware('auth');
    // accepting the request
    Route::get('/pending-request/accept/{pending_id}', 'accept_request')->middleware('auth');
    // declining request 
    Route::post('/pending-request/decline/{pending_id}', 'decline_request')->middleware('auth');
    // sorting for sort date
    Route::get('/pending-request/sort_date', 'sort_date')->middleware('auth');
    // sorting id
    Route::get('/pending-request/sort_id', 'sort_id')->middleware('auth');
});
//===================================================================//
