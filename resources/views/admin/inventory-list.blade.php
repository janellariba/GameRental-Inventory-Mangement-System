{{--==================== Inventory List ====================--}}

@include('partials.header')

{{-- Nav --}}
<x-nav/>

{{-- Main Container --}}
<div class="min-h-screen flex flex-col ml-60 p-20 pl-24 gap-5 text-[#E6EDF3] bg-[#0D1117] max-lg:ml-0 max-lg:p-4 max-xl:p-10 max-xl:pl-14 max-lg:pt-20">
    
    <div class="w-full flex flex-col flex-grow">
        {{-- Header here --}}
        <div class="flex flex-wrap justify-between mb-4 max-lg:justify-center">
            {{-- Section title --}}
            <h1 class="text-4xl max-lg:pb-4 max-sm:text-3xl">
                Inventory List
            </h1>
            <div class="flex max-lg:w-full max-sm:flex-col">
                @if(auth()->user())
                    @if(auth()->user()->position != 'User')
                        <div class="flex items-center mr-4 text-[#C9D1D9] rounded-lg max-h-11 gap-3">
                            {{-- Link to add item page --}}
                            <a href="/admin/inventory-list/add/" class="bg-[#21262D] border border-[#30363D] rounded-lg">
                                <div class="py-2 px-4 text-[#C9D1D9] transition rounded-lg hover:bg-[#238636] !truncate">
                                    Add Item
                                </div>
                            </a>
                            <a href="/admin/inventory-list/modify-category" class="bg-[#21262D] border border-[#30363D] rounded-lg">
                                <div class="py-2 px-4 text-[#C9D1D9] transition rounded-lg hover:bg-[#238636] !truncate">
                                    Modify Category
                                </div>
                            </a>
                        </div>
                    @else
                        {{-- New request button --}}
                        <div class="flex items-center mr-4 bg-[#21262D] border border-[#30363D] text-[#C9D1D9] rounded-lg max-h-11">
                            {{-- Link to add borrow request page --}}
                            <a href="/borrow-request/add" class="whitespace-nowrap">
                                <div class="py-2 px-4 text-[#C9D1D9] transition rounded-lg hover:bg-[#238636]">
                                    New Request
                                </div>
                            </a>
                        </div>
                    @endif
                @endif
                {{-- Search bar --}}
                <div class="w-full min-w-96 max-xl:min-w-72 max-md:min-w-10 max-sm:max-w-full max-sm:mt-4">
                    <form class="w-full" action="/admin/inventory-list/search" method="GET" autocomplete="off">   
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

        {{-- Item table --}}
        <div class="p-3 pl-0 flex flex-grow rounded-lg border border-[#30363D] bg-[#0D1117] h-full max-sm:p-3 min-h-96">
            <div class="relative w-full p-5 pr-3 flex-grow overflow-hidden max-sm:p-3">
                <div class="absolute top-0 left-0 w-full custom-max-h p-5 pt-0 pr-3 overflow-y-auto custom-scrollbar h-full">
                    @if($items->isEmpty())
                        {{-- Message if data is empty --}}
                        <div class="empty-state">                                
                            <p class="text-xl text-center text-[#30363D]">No item in inventory.</p>
                        </div>
                    @else   
                        {{-- Inventory items table --}}
                        <table class="w-full mx-auto text-sm text-left text-gray-500 table-fixed">
                            {{-- Table head --}}
                            <thead class="sticky-header">
                                <tr>
                                    <th scope="col" style="width: 100px;" class="px-2">
                                    </th>
                                    {{-- Item name --}}
                                    <th scope="col" style="width: 250px;" class="px-2">
                                        <a href="/admin/inventory-list/sort_name" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
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
                                    {{-- Item ID --}}
                                    <th scope="col" style="width: 200px;" class="px-2">
                                        <a href="/admin/inventory-list/sort_code" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
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
                                    <th scope="col" style="width: 200px;" class="px-2">
                                        <a href="/admin/inventory-list/sort_brand" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
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
                                    <th scope="col" style="width: 200px;" class="px-2">
                                        <a href="/admin/inventory-list/sort_category" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
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
                                    <th scope="col" style="width: 200px;" class="px-2">
                                        <a href="/admin/inventory-list/sort_quantity" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
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
                                    <th scope="col" style="width: 150px;" class="px-2">
                                        <a href="/admin/inventory-list/sort_status" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
                                            Status
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
                                    {{-- Edit --}}
                                    @if(auth()->user())
                                        @if(auth()->user()->position !='User')
                                            <th scope="col" class="py-1 text-sm font-normal text-center" style="width: 100px;">
                                                <div class="flex justify-center items-center h-full">
                                                    Edit
                                                </div>
                                            </th>
                                        @endif
                                    @endif
                                </tr>
                            </thead>
                            
                            {{-- Table body --}}
                            <tbody>
                                @foreach($items as $item)
                                    <tr class="text-[#E6EDF3] text-base truncate">
                                        {{-- Item image --}}
                                        <td class="px-6 py-1 border-b border-[#30363D] rounded-full" style="width: 100px;">
                                        
                                            {{-- insert item image here --}}
                                            @if($item->item_image!=null)
                                                <div class="flex justify-center items-center h-[50px] w-[50px]">
                                                    <img class="rounded-full p-1 object-contain" style="max-height: 100%; max-width: 100%; height: 100%; width: 100%; object-fit: cover;" src={{asset($item->item_image)}}>
                                                </div>
                                            @else
                                                <div class="w-[50px] h-[50px] p-1">
                                                    <svg class="rounded-full p-2 w-full h-full fill-[#8D96A0] bg-[#292f36]" fill="#000000" width="50px" height="50px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>no-image</title><path d="M30,3.4141,28.5859,2,2,28.5859,3.4141,30l2-2H26a2.0027,2.0027,0,0,0,2-2V5.4141ZM26,26H7.4141l7.7929-7.793,2.3788,2.3787a2,2,0,0,0,2.8284,0L22,19l4,3.9973Zm0-5.8318-2.5858-2.5859a2,2,0,0,0-2.8284,0L19,19.1682l-2.377-2.3771L26,7.4141Z"/><path d="M6,22V19l5-4.9966,1.3733,1.3733,1.4159-1.416-1.375-1.375a2,2,0,0,0-2.8284,0L6,16.1716V6H22V4H6A2.002,2.002,0,0,0,4,6V22Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
                                                </div>
                                            @endif

                                        </td>
                                        {{-- Item name --}}
                                        <td class="list-none px-5 max-w-80 border-b border-[#30363D] " style="width: 250px;">
                                            <div class="!truncate" title="{{$item->item_name}}">
                                                {{$item->item_name}}
                                            </div>
                                        </td>
                                        {{-- Item ID --}}
                                        <td class="list-none px-5 border-b border-[#30363D] !truncate" style="width: 150px;">
                                                    <li>{{$item->item_code}}</li>
                                        </td>
                                        {{-- Brand --}}
                                        <td class="list-none px-5 border-b border-[#30363D]">
                                            <div class="mb-1 !truncate" title="{{$item->item_brand}}">
                                                {{$item->item_brand}}
                                            </div>
                                        </td>
                                        {{-- Category --}}
                                        <td class="list-none px-5 border-b border-[#30363D]" style="width: 150px;">
                                                    <li>{{$item->item_category}}</li>
                                        </td>
                                        {{-- Quantity --}}
                                        <td class="list-none px-5 border-b border-[#30363D]" style="width: 150px;">
                                                    <li>{{$item->item_quantity}}</li>
                                        </td>
                                        {{-- Status --}}
                                        <td class="px-5 border-b border-[#30363D]" style="width: 150px;">
                                            {{-- color of status will depend on no. of stocks --}}
                                            <div class="flex">
                                                @if($item->item_quantity > 0)
                                                    <div class="w-[8px] h-[8px] rounded bg-[#238636] ml-4">
                                                @else
                                                    <div class="w-[8px] h-[8px] rounded bg-[#B42934] ml-4">
                                                @endif  
                                            </div>
                                        </td>
                                        {{-- Edit --}}
                                        @if(auth()->user())
                                            @if(auth()->user()->position !='User')
                                                <td class="px-5 border-b border-[#30363D]" style="width: 100px;">
                                                    {{-- /admin/inventory-list/item/{{$item->id}} --}}
                                                    <div class="flex items-center justify-center w-full h-full">
                                                        <a href="/admin/inventory-list/edit/{{$item->item_id}}">
                                                            <svg class="w-[28px] h-[28px] transition rounded-lg hover:bg-[#21262D] fill-[#8D96A0] hover:fill-[#C9D1D9]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Glyph" version="1.1" xml:space="preserve"><path d="M16,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S17.654,13,16,13z" id="XMLID_287_"/><path d="M6,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S7.654,13,6,13z" id="XMLID_289_"/><path d="M26,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S27.654,13,26,13z" id="XMLID_291_"/></svg>
                                                        </a>
                                                    </div>     
                                                </td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>   
        </div>

    </div>

    {{-- Item value/sorting here --}}
    <div class="grid grid-cols-4 max-lg:grid-cols-3 gap-x-5 max-sm:gap-x-3 max-lg:gap-y-5 max-sm:gap-y-3">
        <!-- Optional Debugging Line -->
        {{-- @if(Session::has('category_totals')) --}}
        @php
            $category_totals = Session::get('category_totals');
        @endphp
        {{-- @endif --}}
        <!-- Display categories dynamically -->
        @if(isset($category_totals) && is_array($category_totals))
            <div id="categoryContainer" class="grid grid-cols-4 col-span-3 gap-5 max-sm:gap-3 overflow-y-auto custom-scrollbar max-h-[240px] max-sm:grid-cols-3">
                @foreach($category_totals as $category => $total)
                    <div class="col-span-1 p-5 rounded-lg bg-[#161B22] border border-[#30363D] max-sm:p-3 max-w-96">
                        <h3 class="text-lg mb-2 max-md:text-base max-sm:text-sm max-sm:mb-1">{{ $category }}</h3>
                        <p class="text-2xl text-[#8D96A0] max-md:text-xl max-sm:text-lg">{{ $total }}</p>
                    </div>
                @endforeach
            </div>
        @endif               
        <a href="/admin/inventory-list/" class="p-5 col-span-1 rounded-lg bg-[#161B22] border border-[#30363D] max-lg:col-span-3 max-lg:row-start-1 max-sm:p-3 hover:bg-[#292f36] transition duration-200">
            <div>
                <h3 class="text-lg mb-2 max-md:text-base max-sm:text-sm max-sm:mb-1">Total Stocks</h3>
                <p class="text-2xl text-[#8D96A0] max-md:text-xl max-sm:text-lg">{{$totals}}</p>
            </div>
        </a>
    </div>

</div>

@include('partials.footer')