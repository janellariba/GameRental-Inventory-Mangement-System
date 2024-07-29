{{--==================== HISTORY LOGS ====================--}}

@include('partials.header')
{{-- Nav --}}
<x-nav/>

{{-- Main Container --}}
<div class="min-h-screen flex flex-col ml-60 p-20 pl-24 text-[#E6EDF3] bg-[#0D1117] max-lg:ml-0 max-lg:p-4 max-xl:p-10 max-xl:pl-14 max-lg:pt-20">

    {{-- Header --}}
    <div class="w-full">
        <div class="flex flex-wrap justify-between mb-4 max-sm:justify-center">
            {{-- Section title --}}
            <h1 class="text-4xl max-sm:pb-4 max-sm:text-3xl">
                History Logs
            </h1>
            <div class="flex max-sm:w-full items-center">
                {{-- Search bar --}}
                {{-- Export --}}
                <x-history-logs-pop-up :categories="$categories"/>

                <div class="max-sm:w-full">
                    <form class="w-full min-w-96 max-xl:min-w-72" action="/admin/history-logs/search" method="GET" autocomplete="off">   
                        <label for="default-search" class="mb-2 text-sm font-medium sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>          
                            </div>
                            <input type="text" id="default-search" name="search" class="block w-full p-2 ps-10 bg-[#0d1117] border border-[#30363D] text-[#C9D1D9] rounded-lg max-h-11 focus:outline-none" placeholder="Search"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Item table --}}
    <div class="p-5 pr-3 flex flex-grow rounded-lg border border-[#30363D] bg-[#0D1117] h-full max-sm:p-3 min-h-96">
        <div class="relative w-full p-5 pr-3 flex-grow overflow-hidden max-sm:p-3">
            <div class="absolute top-0 left-0 w-full custom-max-h px-5 pr-3 overflow-y-auto custom-scrollbar h-full">
                @if($history_data->isEmpty())
                    {{-- Message if data is empty --}}
                    <div class="empty-state">                                
                        <p class="text-xl text-center text-[#30363D]">No logs available.</p>
                    </div>
                @else
                    {{-- History logs table --}}
                    <table class="w-full mx-auto text-sm text-left text-gray-500">
                        {{-- Table head --}}
                        <thead class="sticky-header">
                            <tr class="truncate">
                                {{-- Item ID --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-id" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate">
                                    Transaction ID
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
                                {{-- Customer name --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-name" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate">
                                    Customer Name
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
                                {{-- Item name --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-item" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate w-max">
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
                                {{-- Category --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-cat" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate w-max">
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
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-qty" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate">
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
                                {{-- Date picked up --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-pickup" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate">
                                    Date Picked Up
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
                                {{-- Date returned --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-return" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate w-max">
                                    Date Returned
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
                                {{-- Return status --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-status" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate"> 
                                    Return Status
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
                                {{-- Remark --}}
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">
                                    <a href="/admin/history-logs/sort-status" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center !truncate"> 
                                    Remark
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
                            </tr>
                        </thead>
                        {{-- Table body --}}
                        <tbody>
                            @foreach($history_data as $history)
                                <tr class="text-[#E6EDF3] text-base truncate">
                                    {{-- Transaction ID --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        <li class="px-1">{{$history -> transaction_id}}</li>
                                    </td>
                                    {{-- Customer names --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D]" style="width: 100px;">
                                        <div class="!truncate" title="{{$history -> history_cus_name}}">
                                            <span class="px-1">{{$history -> history_cus_name}}</span>
                                        </div>
                                    </td>
                                    {{-- Item name --}}
                                    <td class="list-none py-2 px-4 max-w-44 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        <div class="!truncate" title="{{$history->history_item}}">
                                            <span class="px-1">{{$history->history_item}}</span>
                                        </div>
                                    </td>
                                    {{-- Category --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        <div class="!truncate" title="{{$history -> history_category}}">
                                            <span class="px-1">{{$history -> history_category}}</span>
                                        </div>
                                    </td>
                                    {{-- Quantity --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        <li class="px-1">{{$history -> history_quantity}}</li>
                                    </td>
                                    {{-- Date picked up --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        <li class="px-1">{{$history -> history_pickup}}</li>
                                    </td>
                                    {{-- Date returned --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        {{-- @if($history -> history_returned == 'N/A')
                                            @php
                                                $history_db = App\Models\History::find($history -> transaction_id)->get()->first();
                                                if($history -> history_returned == 'N/A'){
                                                    $history -> history_returned = $history -> history_pickup;
                                                }                                          
                                            @endphp
                                            <li class="px-1">N/A</li>
                                        @elseif($history -> history_remarks == 'Outbound')
                                        <li class="px-1">N/A</li>
                                        @else
                                            <li class="px-1">{{$history -> history_returned}}</li>
                                        @endif --}}
                                        {{-- @if($history -> history_remarks == 'Outbound')
                                            @php
                                                $history_db = App\Models\History::find($history -> transaction_id)->get()->last();
                                                if($history -> history_returned == 'N/A'){
                                                    $history -> history_returned = $history -> history_pickup;
                                                }                                          
                                            @endphp
                                            <li class="px-1">N/A</li>
                                        @else
                                            <li class="px-1">{{$history -> history_returned}}</li>
                                        @endif --}}
                                            {{-- @php
                                            
                                                $history_db = App\Models\History::find($history -> transaction_id)->get()->last();
                                                dd(App\Models\History::all());
                                                if($history -> history_returned == 'N/A'){
                                                    $history -> history_returned = $history -> history_pickup;
                                                }                          
                                                // dd($history_db);                
                                            @endphp --}}
                                        <li class="px-1">{{$history -> history_returned}}</li>
                                    </td>
                                    {{-- Late status --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        @php
                                            if($history -> history_late == null){
                                                $status = 'On Time';
                                            } else{
                                                $status = $history -> history_late;
                                            }
                                        @endphp
                                        <li class="px-1">{{$status}}</li>
                                    </td>
                                    {{-- Remark --}}
                                    <td class="list-none py-2 px-4 border-b border-[#30363D] !truncate" style="width: 100px;">
                                        <li class="px-1">{{$history -> history_remarks}}</li>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>   
    </div>
</div>

@include('partials.footer')