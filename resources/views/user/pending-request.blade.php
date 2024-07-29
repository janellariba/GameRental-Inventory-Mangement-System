{{--================= PENDING REQUEST ====================--}}

@include('partials.header')

{{-- Nav --}}
<x-nav/>

{{-- Main Container --}}
<div class="min-h-screen flex ml-60 p-20 pl-24 text-[#E6EDF3] bg-[#0D1117] max-lg:ml-0 max-lg:p-4 max-xl:p-10 max-xl:pl-14 max-lg:pt-20 gap-10 max-xl:gap-5">
    <div class="w-full flex flex-col">
        {{-- Header --}}
        <div class="w-full">
            <div class="flex flex-wrap justify-between mb-4 max-2xl:justify-center max-lg:justify-between max-sm:justify-center">
                {{-- Section title --}}
                <h1 class="text-4xl max-2xl:pb-4 max-lg:pb-0 max-sm:pb-4 max-sm:text-3xl">
                    Pending Request
                </h1>
                <div class="flex max-sm:w-full">
                    {{-- Add borrow request button --}}
                    @if(auth()->user()->position == 'User')
                        <div class="flex items-center mr-4 bg-[#21262D] border border-[#30363D] text-[#C9D1D9] rounded-lg max-h-11">
                            {{-- Link to add item page --}}
                            <a href="/borrow-request/add" class="whitespace-nowrap">
                                <div class="py-2 px-4 text-[#C9D1D9] transition rounded-lg hover:bg-[#238636]">
                                    New Request
                                </div>
                            </a>
                        </div>
                    @endif
                    {{-- Search bar --}}
                    <div class="w-full min-w-96 max-xl:min-w-72  max-md:min-w-10 max-md:max-w-56 max-sm:max-w-full">
                        <form class="w-full" action="/pending/search" method="GET" autocomplete="off">   
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
        {{-- Content --}}
        <div class="p-5 pr-3 rounded-lg border border-[#30363D] bg-[#0D1117] h-full max-sm:p-3 min-h-96">
            {{-- Sorting of request--}}
            <div class="flex mb-4 gap-5 max-sm:mb-2 items-center">
                {{-- Total request --}}
                <h2 class="text-base text-[#8d96a0] max-sm:text-sm">Total request: <span class="text-[#E6EDF3]">{{$pending_data->count()}}</span></h2>
                {{-- By date --}}
                <a href="/pending-request/sort_date" id="sort-date" class="flex items-center py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded" onclick="rotateIcon('sort-date')">
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
                {{-- By ID --}}
                <a href="/pending-request/sort_id" id="sort-id" class="flex items-center py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded" onclick="rotateIcon('sort-id')">
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
            @if($pending_data->isEmpty())
                {{-- Message if data is empty --}}
                <div class="empty-state">                                
                    <p class="text-xl text-center text-[#30363D]">No pending request.</p>
                </div>
            @else
                <div class="relative flex-grow overflow-hidden max-sm:p-3 custom-max-h bottom-3 max-sm:bottom-2">
                    <div class="absolute top-0 left-0 w-full h-full pr-3 overflow-y-auto custom-scrollbar">
                        {{-- Grid container for pending request --}}
                        <div class="w-full grid grid-cols-2 gap-5 text-3xl max-2xl:grid-cols-1 max-xl:grid-cols-1 max-sm:gap-3">
                            @foreach($pending_data as $pending)
                                {{-- Pending request card --}}
                                <div class="w-full col-span-1 row-span-1">
                                    {{-- Request header --}}
                                    <div class="bg-[#0d1117] border border-[#30363D] border-b-0 py-2 px-5 rounded-t-lg">
                                        <div class="flex flex-wrap justify-between">
                                            {{-- Transaction ID --}}
                                            <h2 class="text-base">Pending ID: {{$pending->pending_id}}</h2>
                                            {{-- Link to view details --}}
                                            <a href="/pending-request/view-details/{{$pending->pending_id}}">
                                                <div class="text-xs text-[#8D96A0] bg-[#0a0d13] border border-[#666e79] rounded-lg px-2 py-1 focus:outline-none hover:bg-[#21262D]">
                                                    View Details
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- Request details --}}
                                    <div class="w-full bg-[#161B22] border border-[#30363D] p-5 rounded-b-lg relative">
                                        {{-- Grid for card details --}}
                                        <div class="grid grid-cols-2 gap-5">                                            
                                            {{-- Left part of details --}}
                                            <div class="w-full">
                                                @if(auth()->user()->position == 'User') 
                                                    {{-- Item name --}}
                                                    <h3 class="text-base text-[#E6EDF3] mb-2 !truncate" title="{{$pending->brw_item_name}}">
                                                        {{$pending->brw_item_name}}
                                                    </h3>  
                                                @else
                                                    {{-- Customer name --}}
                                                    <h3 class="text-base text-[#E6EDF3] mb-2 !truncate" title="{{$pending->customer_name}}">
                                                        {{$pending->customer_name}}
                                                    </h3>
                                                @endif
                                                <div class="relative border-l border-[#30363D] pl-4">
                                                    @if(auth()->user()->position == 'User')
                                                        {{-- Item brand --}}
                                                        <p class="mb-1 text-xs text-[#8d96a0]">Brand: {{$pending->brw_item_brand}}</p>
                                                    @else     
                                                        {{-- Item name --}}
                                                        <p class="mb-1 text-xs text-[#8d96a0] !truncate ml-auto" title="{{$pending->brw_item_name}}">
                                                            Item: {{$pending->brw_item_name}}
                                                        </p>
                                                    @endif
                                                    {{-- Borrow duration --}}
                                                    <p class="mb-1 text-xs text-[#8d96a0]">Duration: {{$pending->brw_duration}}
                                                        @if($pending->brw_duration == 1)
                                                            day
                                                        @else
                                                            days
                                                        @endif
                                                    </p>
                                                    {{-- Quantity --}}
                                                    <p class="mb-1 text-xs text-[#8d96a0]">Quantity: {{$pending->brw_quantity}}</p>
                                                    {{-- Date requested --}}
                                                    <p class="mb-1 text-xs text-[#8d96a0] !truncate ml-auto" title="{{$pending->date_requested}}">
                                                        Date Request: {{$pending->date_requested}}
                                                    </p>                                            
                                                </div>
                                            </div>
                                            
                                            {{-- Right part of details --}}
                                            <div class="w-full flex flex-col justify-between">
                                                <div class="text-right">
                                                    {{-- Date to be returned --}}
                                                    <p class="mb-1 text-xs ml-auto text-[#8d96a0] !truncate" title="{{$pending->date_to_return}}">
                                                        To be returned at {{$pending->date_to_return}}
                                                    </p>
                                                    {{-- Status --}}
                                                    <p class="text-xs text-[#8d96a0] !truncate">Status:
                                                        @if($pending->borrow_status == 'Declined')
                                                            {{-- Declined --}}
                                                            <span class="mb-1 text-xs text-[#B42934] italic">{{$pending->borrow_status}}</span>
                                                        @elseif($pending->borrow_status == 'Pending' || $pending->borrow_status == 'Pending Outbound')
                                                            {{-- Pending --}}
                                                            <span class="mb-1 text-xs text-[#BD9423] italic">{{$pending->borrow_status}}</span>
                                                        @elseif($pending->borrow_status == 'Ongoing')
                                                            {{-- Ongoing --}}
                                                            <span class="mb-1 text-xs text-[#BD9423] italic">{{$pending->borrow_status}}</span>
                                                        @else
                                                            {{-- Returned --}}
                                                            <span class="mb-1 text-xs text-[#238636] italic">{{$pending->borrow_status}}</span>
                                                        @endif
                                                    </p>
                                                    {{-- Note --}}
                                                    <p class="text-xs text-[#8d96a0] !truncate ml-auto" title="{{$pending->user_note}}">
                                                        Note: {{$pending->user_note}}
                                                    </p>

                                                    {{-- Remark --}}
                                                    <p class="text-xs text-[#8D96A0] !truncate ml-auto" title="{{$pending->feedback}}">
                                                        Remark: {{$pending->feedback}}
                                                    </p>
                                                    {{-- @if($pending->borrow_status == 'Ongoing' || $pending->borrow_status == 'Pending' )
                                                        @if($pending->feedback)
                                                            <p class="text-xs text-[#BD9423] !truncate ml-auto" title="{{$pending->feedback}}">
                                                                Remark: {{$pending->feedback}}
                                                            </p>
                                                        @endif
                                                    @elseif($pending->borrow_status == 'Returned')
                                                        @if($pending->feedback)
                                                            <p class="text-xs text-[#238636] !truncate ml-auto" title="{{$pending->feedback}}">
                                                                Remark: {{$pending->feedback}}
                                                            </p>
                                                        @endif
                                                    @else
                                                        <p class="text-xs text-[#B42934] !truncate ml-auto" title="{{$pending->feedback}}">
                                                            Remark: {{$pending->feedback}}
                                                        </p>
                                                    @endif --}}
                                                </div>
                                                
                                                {{-- Buttons --}}
                                                <a href="/admin/borrow-request/return-form/" class="ml-auto">
                                                    @if(auth()->user()->position != 'User')
                                                        <div class="flex gap-1">
                                                            @if($pending->borrow_status == 'Declined' || $pending->borrow_status == 'Returned')
                                                                <a href="/pending-request/delete-request/{{$pending->pending_id}}" class="text-xs text-white border border-[#666e79] bg-[#B42934] rounded-lg px-2 py-1 focus:outline-none hover:bg-[#21262D]" onclick="checker()">Delete</a>
                                                            @endif
                                                            @if($pending->borrow_status == 'Declined')
                                                                <a href="" class="text-xs text-white border border-[#666e79] bg-[#21262D] rounded-lg px-2 py-1 focus:outline-none hover:bg-[#21262D]">Request Declined</a>
                                                            @else
                                                                <a href="/pending-request/view-details/{{$pending->pending_id}}" class="text-xs text-white border border-[#666e79] bg-[#1F6FEB] rounded-lg px-2 py-1 focus:outline-none hover:bg-[#21262D] truncate">Check Request</a>
                                                            @endif
                                                        </div> 
                                                    @else
                                                        <div class="flex gap-1">
                                                        @if($pending->borrow_status == 'Declined' || $pending->borrow_status == 'Returned' || $pending->borrow_status == 'Pending' || $pending->borrow_status == 'Outbound')
                                                            <a href="/pending-request/delete-request/{{$pending->pending_id}}" class="text-xs text-white border border-[#666e79] bg-[#B42934] rounded-lg px-2 py-1 focus:outline-none hover:bg-[#21262D]" onclick="checker()">Delete</a>
                                                            @endif
                                                        </div> 
                                                    @endif
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
</div>

@include('partials.footer')
