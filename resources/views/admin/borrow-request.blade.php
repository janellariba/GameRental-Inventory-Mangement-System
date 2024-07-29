{{--================= Borrow Request ====================--}}

@php
    use Carbon\Carbon;
        // Get the current date
        $current_date = Carbon::now()->day;
@endphp

@include('partials.header')
{{-- Nav --}}
<x-nav/>

<div class="min-h-screen flex ml-60 p-20 pl-24 text-[#E6EDF3] bg-[#0D1117] max-lg:ml-0 max-lg:p-4 max-xl:p-10 max-xl:pl-14 max-lg:pt-20 gap-10 max-xl:gap-5">

    {{-- Left container --}}
    <div class="w-9/12 flex flex-col max-lg:w-full max-2xl:w-7/12 min-h-full">
        {{-- Header here --}}
        <div class="w-full">
            <div class="flex flex-wrap justify-between mb-4 max-2xl:justify-center max-lg:justify-between max-sm:justify-center">
                {{-- Section title --}}
                <h1 class="text-4xl max-2xl:pb-4 max-lg:pb-0 max-sm:pb-4 max-sm:text-3xl">
                    Item Request
                </h1>
                <div class="flex max-2xl:w-full max-lg:w-auto max-sm:w-full">
                    {{-- Add button --}}
                    <div class="flex items-center mr-4 bg-[#21262D] border border-[#30363D] text-[#C9D1D9] rounded-lg max-h-11">
                        {{-- Link to add item page --}}
                        <a href="/borrow-request/add">
                            <div class="py-2 px-8 text-[#C9D1D9] transition rounded-lg hover:bg-[#238636]">
                                Add
                            </div>
                        </a>
                    </div>
                    {{-- Search bar --}}
                    <div class="w-full min-w-96 max-xl:min-w-72  max-md:min-w-10 max-md:max-w-56 max-sm:max-w-full">
                        <form class="w-full" action="/admin/borrow-request/search" method="GET" autocomplete="off">   
                            <label for="default-search" class="mb-2 text-sm font-medium sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>          
                                </div>
                                <input name="search" type="text" id="default-search" class="block w-full max-h-11 p-2 ps-10 bg-[#0d1117] border border-[#30363D] text-[#C9D1D9] rounded-lg focus:outline-none" placeholder="Search"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content container --}}
       
        <div class="p-5 pr-3  rounded-lg border border-[#30363D] bg-[#0D1117] h-full max-sm:p-3 min-h-96">
            @if($borrows->isEmpty())
                <div class="empty-state">                                
                    <p class="text-xl text-center text-[#30363D]">No borrow request.</p>
                </div>
            @else
                {{-- Sorting of requests --}}
                <div class="flex mb-4 gap-5 max-sm:mb-2 items-center">
                    {{-- Total Request --}}
                    <h2 class="text-base text-[#8d96a0] max-sm:text-sm">Total request: <span class="text-[#E6EDF3]">{{$borrows->count()}}</span></h2>
                    {{-- By Date --}}
                    <a href="/borrow-request/sort_date" id="sort-date" class="flex items-center py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded" onclick="rotateIcon('sort-date')">
                        <h2 class="text-base text-[#8d96a0] max-sm:text-sm mr-1">By date</h2>
                        <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                            width="10px" height="10px" viewBox="0 0 562.392 562.391"
                            xml:space="preserve">
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
                    <a href="/borrow-request/sort_id" id="sort-id" class="flex items-center py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded" onclick="rotateIcon('sort-id')">
                        <h2 class="text-base text-[#8d96a0] max-sm:text-sm mr-1">By ID</h2>
                        <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                            width="10px" height="10px" viewBox="0 0 562.392 562.391"
                            xml:space="preserve">
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
                </div>

                {{-- Borrow request content container --}}
                <div class="relative flex-grow overflow-hidden max-sm:p-3 custom-max-h bottom-3 max-sm:bottom-2">
                    <div class="absolute top-0 left-0 w-full h-full pr-3 overflow-y-auto custom-scrollbar">
                        {{-- Grid container for customer's request --}}
                        <div class="w-full grid grid-cols-2 gap-5 text-3xl max-2xl:grid-cols-1 max-xl:grid-cols-1 max-sm:gap-3">
                            @foreach($borrows as $borrow)
                                {{-- ===== Content Container ===== --}}
                                <div class="w-full col-span-1 row-span-1">
                                    {{-- Request header --}}
                                    <div class="bg-[#0d1117] border border-[#30363D] border-b-0 py-2 px-5 rounded-t-lg">
                                        <div class="flex flex-wrap justify-between">
                                            {{-- Transaction ID here --}}

                                            <h2 class="text-base">Transaction ID: 00000{{$borrow->transaction_id}}</h2>
                                            <a href="/admin/borrow-request/view-details/{{$borrow->transaction_id}}">
                                                <div class="text-xs text-[#8D96A0] bg-[#0a0d13] border border-[#666e79] rounded-lg px-2 py-1 focus:outline-none hover:bg-[#21262D]">
                                                    {{-- Link to view details --}}
                                                    View Details
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- Request's details --}}
                                    <div class="w-full bg-[#161B22] border border-[#30363D] p-5 rounded-b-lg">
                                        {{-- Name here --}}
                                        <div class="flex flex-wrap justify-between items-center">
                                            <h3 class="text-base text-[#E6EDF3]">
                                                {{$borrow->customer_name}}
                                            </h3>
                                            {{-- Date to be returned--}}
                                            <p class="text-xs text-[#8D96A0]">To be returned at {{$borrow->date_to_return}}</p>
                                        </div>
                                        <div class="flex flex-wrap justify-between mt-2">
                                            <div class="relative border-l border-[#30363D] pl-4">
                                                {{-- Duration --}}
                                                <p class="mb-1 text-xs text-[#8d96a0]">
                                                    Duration: {{$borrow->brw_duration}} 
                                                    @if($borrow->brw_duration == 1)
                                                        day
                                                    @else
                                                        days
                                                    @endif
                                                </p>                                                
                                                {{-- Quantity --}}
                                                <p class="mb-1 text-xs text-[#8d96a0]">Quantity: {{$borrow->brw_quantity}}</p>
                                                {{-- Date Requested --}}
                                                <p class="mb-1 text-xs text-[#8d96a0]">Date Requested: {{$borrow->date_requested}}</p>
                                            </div>
                                            {{-- Release Button --}}
                                            <div class="mt-auto">
                                                @php
                                                    $current_date = Carbon::now();
                                                    $date_return = $borrow->date_to_return;
                                                    $carbonDate = Carbon::parse($date_return);
                                                    $days_late = intval($current_date->diffInDays($carbonDate, false));
                                                    $abs_days_late = abs($days_late);
                                                    if ($days_late < 0) {
                                                        $status = 'Return Late';
                                                        $button_color = 'bg-[#BD9423]';
                                                        $late_status = $abs_days_late . ' Day' . ($abs_days_late > 1 ? 's' : '') . ' Late';
                                                        $borrow->late_status = $late_status;
                                                    } else {
                                                        $late_status = 'On time';
                                                        $status = 'Return';
                                                        $button_color = 'bg-[#238636]';
                                                    }
                                                    $borrow->save();
                                                @endphp
                                                <a href="/admin/borrow-request/return-form/{{$borrow->transaction_id}}">
                                                    <div class="text-xs text-white {{$button_color}} border border-[#666e79] rounded-lg px-2 py-1 focus:outline-none hover:bg-[#21262D]">{{$status}}
                                                    </div>
                                                </a>                                                
                                            </div> 
                                        </div>
                                    </div>  
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif                
        </div>
    
    </div>
 
    {{-- Right container--}}
    <div class="w-3/12 max-lg:hidden max-2xl:w-5/12 p-5 pr-3  rounded-lg border border-[#30363D] bg-[#0D1117] min-h-full"> 

        {{-- Title --}}
        @if($returns->isEmpty())
            <h3 class="text-base mb-4 text-[#8D96A0]">
        @else
            <h3 class="text-base mb-4">
        @endif
            Recently returned
        </h3>

        {{-- Content container --}}
        @if($returns->isEmpty())
            <div class="empty-state">
                <x-svg-sleepy-hermit/>
                <p class="text-sm text-center text-[#30363D]">No returned rents available</p>
            </div>
        @else
            <div class="relative flex-grow overflow-hidden max-sm:p-3 custom-max-h min-h-96">
                <div class="absolute top-0 left-0 w-full h-full pr-3 overflow-y-auto custom-scrollbar">
                    @foreach($returns as $return)
                        {{-- Sidebar Returned item --}}
                        <div class="border-l border-[#30363D] pl-4 pb-4 relative">
                            <a href="" class="absolute right-0 text-sm flex gap-1 text-[#238636]">
                                Returned  
                                <div class="mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 -960 960 960" width="15px" fill="#238636">
                                        <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                                    </svg>
                                </div>
                            </a>

                            {{-- Name Here --}}
                            <h3 class="text-base">
                                {{$return->customer_name}}
                            </h3>
                            {{-- Transaction ID --}}
                            <p class="text-xs text-[#8D96A0]">
                                Transaction ID: {{$return->transaction_id}}
                            </p>
                            {{-- Item --}}
                            <p class="text-xs text-[#8D96A0]">
                                Item: {{$return->brw_item_name}}
                            </p>
                            {{-- Category --}}
                            <p class="text-xs text-[#8D96A0]">
                                Category: {{$return->brw_item_category}}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</div>
@include('partials.footer')