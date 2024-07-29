{{--==================== Add Borrow Request ====================--}}

@include('partials.header')
    <x-nav/>
        <div class="min-h-screen relative ml-60 p-20 pl-24 text-[#E6EDF3] bg-[#0D1117] max-lg:ml-0 max-lg:p-4 max-xl:p-10 max-xl:pt-20 max-xl:pl-14 max-lg:pt-20 max-xl:flex-col max-xl:gap-5 max-sm:gap-3 flex flex-col gap-5">
            {{-- Back button --}}
            @if(auth()->user()->position != 'User')
            <a href="/borrow-request" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
            @else
            <a href="/pending-request" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
            @endif
                <div class="flex p-2 items-center">
                    <svg class="transition fill-[#8D96A0] w-[28px] h-[28px]" fill="#000000" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <g data-name="Layer 2">
                            <g data-name="arrow-ios-back">
                                <rect width="24" height="24" transform="rotate(90 12 12)" opacity="0"/>
                                <path d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64z"/>
                            </g>
                        </g>
                    </svg>
                    <span class="text-[#8D96A0] text-lg">Back</span>
                </div>                   
            </a>

            <div class="w-full border flex border-[#30363D] rounded-lg max-md:flex-col-reverse">
                
                <div class="mx-auto p-5 border-dashed border-r border-[#30363D] rounded-l-lg w-4/12 max-2xl:w-5/12 max-xl:w-6/12 max-md:w-full max-md:border-0 max-sm:p-3">
                    {{-- Item request --}}
                    <h1 class="mb-4 pb-4 border-b border-[#30363D] text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Item Request</h1>
                    {{-- @for($data_click as $item_clicked) --}}

                    <form action="/borrow-request/add/customer-details" method="POST" class="flex flex-col" >
                        @csrf  

                        {{-- Item name --}}
                        <div class="mb-2">
                            <label for="item_name" class="mb-2  text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Item Name</label>
                            <input type="text" name="item_name" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none" value="{{$clicked_table->item_name}}" readonly>
                        </div>
                        <span class="text-danger text-xs text-[#B42934]">@error('item_name') {{$message}}@enderror</span>

                        {{-- Brand --}}
                        <div class="mb-2">
                            <label for="item_brand" class="mb-2  text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Brand</label>
                            <input type="text" name="item_brand" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none " value="{{$clicked_table->item_brand}}" readonly>
                            <span class="text-danger text-xs text-[#B42934]">@error('item_brand') {{$message}}@enderror</span>
                        </div>
        
                        {{-- Category and Quantity --}}
                        <div class="grid grid-cols-2 gap-4">
                            {{-- Input field for name="category" --}}
                            <div class="mb-2">
                                <label for="item_category" class="mb-2  text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Category</label>
                                <input type="text" name="item_category" value="{{$clicked_table->item_category}}" class="w-full  px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none " readonly></input>
                            </div>

                            {{-- Input field for name="quantity" --}}
                            <div class="mb-2">
                                <label for="item_quantity" class="mb-2  text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Quantity</label>
                                <input type="number" name="item_quantity" min="1" class="w-full  px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none " value={{old('item_quantity')}}>
                                <span class="text-danger text-xs text-[#B42934]">@error('item_quantity') {{$message}}@enderror</span>
                            </div>
                        </div>        
                        
                        {{-- Start and end dates --}}
                        <h3 class="text-base text-[#8D96A0]">Type of request</h3>                
                        <fieldset class="flex gap-3 items-center mb-4 max-sm:mb-2">
                            {{-- Selected --}}
                            <div class="flex items-center">
                                <input id="option-borrow" type="radio" name="type" value="borrow" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none">
                                <label for="option-borrow" class="block ms-2 text-[#E6EDF3]">
                                    Borrow
                                </label>
                            </div>

                            {{-- All --}}
                            <div class="flex items-center">
                                <input id="option-outbound" type="radio" name="type" value="outbound" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none" checked>
                                <label for="option-outbound" class="block ms-2 text-[#E6EDF3]">
                                    Outbound
                                </label>
                            </div>      
                            @php
                                // put value of radio here using Session::
                            @endphp
                        </fieldset>
                        {{-- Dates --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            {{-- Date Requested --}}
                            <div class="relative">
                                <label for="item_requested_at" class="mb-2  text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Requested at</label>
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                </div>
                                <input datepicker name="item_requested_at" id="default-datepicker" type="date" class="bg-[#0D1117]  border border-[#30363D] text- text-[#E6EDF3] rounded-lg w-full ps-4 p-2.5 focus:outline-none date-input" value="{{old('item_requested_at')}}">
                                <span class="text-danger text-xs text-[#B42934]">@error('item_requested_at') {{$message}}@enderror</span>
                                @php
                                    $fdate = old('item_requested_at'); // Get requested date from old input
                                    $tdate = old('item_returned'); // Get returned date from old input
                                    $error_message = '';
                                    if ($fdate && $tdate) {
                                        $datetime1 = new DateTime($fdate);
                                        $datetime2 = new DateTime($tdate);

                                        if ($datetime2 < $datetime1) {
                                            // echo '<p class="text-red-500 text-xs mt-1">Return date cannot be before requested date.</p>';
                                            $error_message = 'Return date cannot be before requested date.';
                                        }
                                    }
                                @endphp
                                {{-- @dd({{$error_message}}) --}}
                                <p class="text-[#B42934] text-xs mt-1">{{$error_message}}</p>
                            </div>
        
                            {{-- Date To be Returned --}}
                            <div class="relative">
                                <label for="item_returned" class="mb-2  text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Return at</label>
                                <input datepicker name="item_returned" id="default-datepicker" type="date" class=" bg-[#0D1117] border border-[#30363D]  text-[#E6EDF3]  rounded-lg w-full ps-4 p-2.5 focus:outline-none date-input" placeholder="Select date" value="{{old('item_returned')}}">
                                <span class="text-danger text-xs text-[#B42934]">@error('item_returned') {{$message}}@enderror</span>
                                @php
                                    $fdate = old('item_requested_at'); // Get requested date from old input
                                    $tdate = old('item_returned'); // Get returned date from old input
                                    $error_message = '';
                                    if ($fdate && $tdate) {
                                        $datetime1 = new DateTime($fdate);
                                        $datetime2 = new DateTime($tdate);

                                        if ($datetime2 < $datetime1) {
                                            // echo '<p class="text-red-500 text-xs mt-1">Return date cannot be before requested date.</p>';
                                            $error_message = 'Return date cannot be before requested date.';
                                        }
                                    }
                                @endphp
                                {{-- @dd({{$error_message}}) --}}
                                <p class="text-[#B42934] text-xs mt-1">{{$error_message}}</p>
                            </div>       
                        </div>
                        
                        {{-- Orig add button --}}
                        <button type="submit" class="mb-4 py-2 text-center text-white bg-[#238636] hover:bg-[#1A6328] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2">
                            Add
                        </button>
                    </form>
        
                    {{-- Cancel button and resubmission /admin/inventory-list --}}
                    @if(auth()->user()->position != 'User')
                        <a href="/borrow-request">
                    @else
                        <a href="/pending-request">
                    @endif
                        <div class="py-2 text-center text-white bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                            Cancel
                        </div>
                    </a>
                </div>
                
                <div class="w-8/12 p-5 max-2xl:w-7/12 max-xl:w-6/12 max-md:w-full max-md:border-b border-dashed border-[#30363D] max-sm:p-3 flex">
                    <div class="w-full">
                        {{-- Header here --}}
                        <div class="flex flex-wrap justify-between mb-4 max-sm:justify-center max-xl:justify-center">
                            {{-- Inventory list title --}}
                            <h1 class="max-xl:mb-4 text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">
                                Inventory List
                            </h1>
                            <div class="max-xl:w-full">
                                {{-- Search bar --}}
                                <div class="">
                                    <form class="w-full" action="/borrow-request/add/search" method="GET" autocomplete="off">   
                                        <label for="default-search" class="mb-2 text-sm font-medium sr-only">Search</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>          
                                            </div>
                                            <input type="text" name="search" id="default-search" class="block w-full max-h-11 p-2 ps-10 bg-[#0d1117] border border-[#30363D] text-[#C9D1D9] rounded-lg focus:outline-none" placeholder="Search"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
    
                        {{-- Item table here --}}
                        <div class="w-full p-5 rounded-lg bg-[#0D1117] border border-[#30363D] max-sm:p-3">
                            {{-------------------- ITEM TABLE ----------------------- }}
                            {{--- This file contains callable item list/table for all user  ---}}
                            <div class="overflow-x-auto overflow-y-scroll h-[380px] max-xl:max-h-[325px] custom-scrollbar">
                                <table class=" w-full mx-auto text-sm text-left text-gray-500">
                                    <thead class="">
                                        <tr>
                                            <th scope="col" class="py-1 px-3 text-sm font-normal">
                                                
                                            </th>
                                             {{-- Item Name--}}
                                            <th scope="col" class="py-1 px-3 min-w-28 text-sm font-normal">
                                                <a href="/admin/borrow-request/add/sort_name" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
                                                    Item Name
                                                    <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="10px" height="10px" viewBox="0 0 562.392 562.391"
                                                    xml:space="preserve" class="ml-1">
                                                    <g>
                                                    <g>
                                                        <path d="M123.89,262.141h314.604c19.027,0,17.467-31.347,15.496-47.039c-0.605-4.841-3.636-11.971-6.438-15.967L303.965,16.533
                                                        c-12.577-22.044-32.968-22.044-45.551,0L114.845,199.111c-2.803,3.996-5.832,11.126-6.438,15.967
                                                        C106.43,230.776,104.863,262.141,123.89,262.141z"/>
                                                        <path d="M114.845,363.274l143.569,182.584c12.577,22.044,32.968,22.044,45.551,0l143.587-182.609
                                                        c2.804-3.996,5.826-11.119,6.438-15.967c1.971-15.691,3.531-47.038-15.496-47.038H123.89c-19.027,0-17.46,31.365-15.483,47.062
                                                        C109.019,352.147,112.042,359.277,114.845,363.274z"/>
                                                    </g>
                                                    </g>
                                                    </svg>
                                                </a>
                                            </th>
                                              {{-- ID--}}
                                            <th scope="col" class="py-1 px-3 min-w-28 text-sm font-normal">
                                                <a href="/admin/borrow-request/add/sort_code" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
                                                    ID
                                                    <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="10px" height="10px" viewBox="0 0 562.392 562.391"
                                                    xml:space="preserve" class="ml-1">
                                                    <g>
                                                    <g>
                                                        <path d="M123.89,262.141h314.604c19.027,0,17.467-31.347,15.496-47.039c-0.605-4.841-3.636-11.971-6.438-15.967L303.965,16.533
                                                        c-12.577-22.044-32.968-22.044-45.551,0L114.845,199.111c-2.803,3.996-5.832,11.126-6.438,15.967
                                                        C106.43,230.776,104.863,262.141,123.89,262.141z"/>
                                                        <path d="M114.845,363.274l143.569,182.584c12.577,22.044,32.968,22.044,45.551,0l143.587-182.609
                                                        c2.804-3.996,5.826-11.119,6.438-15.967c1.971-15.691,3.531-47.038-15.496-47.038H123.89c-19.027,0-17.46,31.365-15.483,47.062
                                                        C109.019,352.147,112.042,359.277,114.845,363.274z"/>
                                                    </g>
                                                    </g>
                                                    </svg>
                                                </a>
                                            </th>
                                            {{-- Brand --}}
                                            <th scope="col" class="py-1 px-3 text-sm font-normal">
                                                <a href="/admin/borrow-request/add/sort_brand" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
                                                    Brand
                                                    <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="10px" height="10px" viewBox="0 0 562.392 562.391"
                                                xml:space="preserve" class="ml-1">
                                                <g>
                                                <g>
                                                    <path d="M123.89,262.141h314.604c19.027,0,17.467-31.347,15.496-47.039c-0.605-4.841-3.636-11.971-6.438-15.967L303.965,16.533
                                                    c-12.577-22.044-32.968-22.044-45.551,0L114.845,199.111c-2.803,3.996-5.832,11.126-6.438,15.967
                                                    C106.43,230.776,104.863,262.141,123.89,262.141z"/>
                                                    <path d="M114.845,363.274l143.569,182.584c12.577,22.044,32.968,22.044,45.551,0l143.587-182.609
                                                    c2.804-3.996,5.826-11.119,6.438-15.967c1.971-15.691,3.531-47.038-15.496-47.038H123.89c-19.027,0-17.46,31.365-15.483,47.062
                                                    C109.019,352.147,112.042,359.277,114.845,363.274z"/>
                                                </g>
                                                </g>
                                                    </svg>
                                                </a>
                                            </th>
                                            {{-- Category --}}
                                            <th scope="col" class="py-1 px-3 text-sm font-normal">
                                                <a href="/admin/borrow-request/add/sort_category" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
                                                    Category
                                                    <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="10px" height="10px" viewBox="0 0 562.392 562.391"
                                                xml:space="preserve" class="ml-1">
                                                <g>
                                                <g>
                                                    <path d="M123.89,262.141h314.604c19.027,0,17.467-31.347,15.496-47.039c-0.605-4.841-3.636-11.971-6.438-15.967L303.965,16.533
                                                    c-12.577-22.044-32.968-22.044-45.551,0L114.845,199.111c-2.803,3.996-5.832,11.126-6.438,15.967
                                                    C106.43,230.776,104.863,262.141,123.89,262.141z"/>
                                                    <path d="M114.845,363.274l143.569,182.584c12.577,22.044,32.968,22.044,45.551,0l143.587-182.609
                                                    c2.804-3.996,5.826-11.119,6.438-15.967c1.971-15.691,3.531-47.038-15.496-47.038H123.89c-19.027,0-17.46,31.365-15.483,47.062
                                                    C109.019,352.147,112.042,359.277,114.845,363.274z"/>
                                                </g>
                                                </g>
                                                    </svg>
                                                </a>
                                            </th>
                                            {{-- Quantity --}}
                                            <th scope="col" class="py-1 px-3 text-sm font-normal">
                                                <a href="/admin/borrow-request/add/sort_quantity" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
                                                    Quantity
                                                    <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="10px" height="10px" viewBox="0 0 562.392 562.391"
                                                xml:space="preserve" class="ml-1">
                                                <g>
                                                <g>
                                                    <path d="M123.89,262.141h314.604c19.027,0,17.467-31.347,15.496-47.039c-0.605-4.841-3.636-11.971-6.438-15.967L303.965,16.533
                                                    c-12.577-22.044-32.968-22.044-45.551,0L114.845,199.111c-2.803,3.996-5.832,11.126-6.438,15.967
                                                    C106.43,230.776,104.863,262.141,123.89,262.141z"/>
                                                    <path d="M114.845,363.274l143.569,182.584c12.577,22.044,32.968,22.044,45.551,0l143.587-182.609
                                                    c2.804-3.996,5.826-11.119,6.438-15.967c1.971-15.691,3.531-47.038-15.496-47.038H123.89c-19.027,0-17.46,31.365-15.483,47.062
                                                    C109.019,352.147,112.042,359.277,114.845,363.274z"/>
                                                </g>
                                                </g>
                                                    </svg>
                                                </a>
                                            </th>
                                            {{-- Status --}}
                                            <th scope="col" class="py-1 px-3 text-sm font-normal">                 
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        {{-- Items From Database --}}
                                        {{-- Use this to populate tables --}}
                                        @foreach($item_list as $item)
                                        {{-- url /admin/borrow-request/add/{{$item->item_id}} --}}
                                        <tr class="text-[#E6EDF3] text-base hover:bg-[#292F36] transition duration-200" 
                                        onclick="window.location='/borrow-request/add/{{$item->item_id}}';" 
                                        {{-- onclick="redirectToPage('{{ $item->item_id }}');" --}}
                                        style="cursor: pointer;">
                                            <td class="px-3 py-1 border-b border-[#30363D]">
                                                {{-- Insert item image here --}}
                                                @if($item->item_image != null)
                                                <div class="flex justify-center items-center h-[50px] w-[50px]">
                                                    <img class="rounded-full p-1 object-contain" style="width: 100%; max-height: 100%; max-width: 100%; height: 100%; object-fit: cover;" src="{{ asset($item->item_image) }}">
                                                </div>
                                                @else
                                                <div class="w-[50px] h-[50px] p-1">
                                                    <svg class="rounded-full p-2 w-full h-full fill-[#8D96A0] bg-[#292f36]" fill="#000000" width="50px" height="50px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>no-image</title><path d="M30,3.4141,28.5859,2,2,28.5859,3.4141,30l2-2H26a2.0027,2.0027,0,0,0,2-2V5.4141ZM26,26H7.4141l7.7929-7.793,2.3788,2.3787a2,2,0,0,0,2.8284,0L22,19l4,3.9973Zm0-5.8318-2.5858-2.5859a2,2,0,0,0-2.8284,0L19,19.1682l-2.377-2.3771L26,7.4141Z"/><path d="M6,22V19l5-4.9966,1.3733,1.3733,1.4159-1.416-1.375-1.375a2,2,0,0,0-2.8284,0L6,16.1716V6H22V4H6A2.002,2.002,0,0,0,4,6V22Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
                                                </div>
                                                @endif
                                            </td>
                                    
                                            {{-- item name --}}
                                            <td class="list-none px-3 border-b border-[#30363D]">
                                                <li>{{ $item->item_name }}</li>
                                            </td>                                   
                                             {{-- item id --}}
                                            <td class="list-none px-3 border-b border-[#30363D]">
                                                <li>{{ $item->item_code }}</li>
                                            </td>
                                            {{-- item brand --}}
                                            <td class="list-none px-3 border-b border-[#30363D]">
                                                <li>{{ $item->item_brand }}</li>
                                            </td>
                                            {{-- item category --}}
                                            <td class="list-none px-3 border-b border-[#30363D]">
                                                <li>{{ $item->item_category }}</li>
                                            </td>
                                            {{-- item quantity --}}
                                            <td class="list-none px-3 border-b border-[#30363D]">
                                                <li>{{ $item->item_quantity }}</li>
                                            </td>
                                            {{-- item status --}}
                                            <td class="px-3 border-b border-[#30363D]">

                                                {{-- Color of status will depend on number of stocks --}}
                                                <div class="flex">
                                                    @if($item->item_status == 'Available')
                                                        <div class="w-[8px] h-[8px] rounded bg-[#238636] ml-4"></div>
                                                    @else
                                                        <div class="w-[8px] h-[8px] rounded bg-[#B42934] ml-4"></div>
                                                    @endif  
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-5 max-md:grid-cols-3 max-sm:gap-3 max-md:hidden gap-y-0 max-lg:gap-y-5">
                {{-- Item value/sorting here --}}
                <div class="grid col-span-3 max-lg:grid-cols-3 gap-x-5 max-sm:gap-x-3 max-lg:gap-y-5 max-sm:gap-y-3 max-lg:col-span-4">
                    <!-- Optional Debugging Line -->
                    {{-- @if(Session::has('category_totals')) --}}
                        @php
                            $category_totals = Session::get('category_totals');
                        @endphp
                    {{-- @endif --}}
                    <!-- Display categories dynamically -->
                    @if(isset($category_totals) && is_array($category_totals))
                        <div class="col-span-3 grid grid-cols-3 gap-5 max-sm:gap-3 h-[240px] overflow-y-auto custom-scrollbar max-md:h-[225px] max-sm:h-[170px] ">
                            @foreach($category_totals as $category => $total)
                                <div class="p-5 col-span-1 rounded-lg bg-[#161B22] border border-[#30363D] max-sm:p-3">
                                    <h3 class="text-lg mb-2 max-md:text-base max-sm:text-sm max-sm:mb-1">{{ $category }}</h3>
                                    <p class="text-2xl text-[#8D96A0] max-md:text-xl max-sm:text-lg">{{ $total }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif               
                    
                </div>
                <a href="/admin/inventory-list/" class="p-5 col-span-1 row-span-2 rounded-lg bg-[#161B22] border border-[#30363D] max-md:row-start-2 max-sm:p-3 hover:bg-[#292f36] transition duration-200 max-lg:col-span-4">
                    <div>
                        <h3 class="text-lg mb-2 max-md:text-base max-sm:text-sm max-sm:mb-1">Total Stocks</h3>
                        <p class="text-2xl text-[#8D96A0] max-md:text-xl max-sm:text-lg">{{$totals}}</p>
                    </div>
                </a>
            </div>
        </div>
@include('partials.footer')