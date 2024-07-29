{{--==================== HOME ====================--}}

@include('partials.header')

{{-- Nav --}}
<x-nav/>

<div class="min-h-screen flex gap-10 ml-60 p-20 pl-24 text-[#E6EDF3] bg-[#0D1117] max-lg:ml-0 max-lg:p-4 max-xl:p-10 max-xl:pl-14 max-lg:pt-20 max-xl:flex-col max-xl:gap-5 max-sm:gap-3">
    {{-- Left Container --}}
    <div class="w-9/12 text-3xl flex flex-col gap-5 max-xl:w-full max-sm:gap-3">
        {{-- Section title --}}
        <h1 class="text-4xl max-sm:text-center max-lg:text-3xl max-md:text-2xl max-sm:text-xl">These are the summary status of your store.</h1>
        <div class="grid grid-cols-3 gap-5 max-sm:gap-3">
            <div class="w-full bg-[#161B22] rounded-lg border border-[#30363D] p-5 max-sm:p-3">
                {{-- Calculated total rents here --}}
                <h3 class="text-lg mb-2 max-md:text-base max-sm:text-sm max-sm:mb-1">
                    Total Rents
                </h3>
                <p class="text-sm text-[#8D96A0]">
                    {{$total_count}}
                </p>
            </div>
            <div class="w-full bg-[#161B22] rounded-lg border border-[#30363D] p-5 max-sm:p-3">
                {{-- Total ongoing rents here --}}
                @if($borrow_count == '0')
                    <h3 class="text-lg text-[#8D96A0] mb-2 max-md:text-md max-sm:text-sm">
                        Ongoing Rents
                    </h3>
                @else
                    <h3 class="text-lg mb-2 max-md:text-md max-sm:text-sm">
                        Ongoing Rents
                    </h3>
                @endif
                
                <div class="flex items-center ">
                    @if($borrow_count == '0')
                        <div class="w-[8px] h-[8px] rounded bg-[#30363D]"></div>
                    @else
                        <div class="w-[8px] h-[8px] rounded bg-[#238636]"></div>
                    @endif
                    <p class="text-sm text-[#8D96A0] ml-1">
                        {{$borrow_count}}
                    </p>
                </div>
            </div>

            <div class="w-full bg-[#161B22] rounded-lg border border-[#30363D] p-5 max-sm:p-3">
                {{-- Total Pending Rents here --}}
                @if($pendings == '0')
                    <h3 class="text-lg text-[#8D96A0] mb-2 max-md:text-md max-sm:text-sm">
                        Pending Request
                    </h3>
                @else
                    <h3 class="text-lg mb-2 max-md:text-md max-sm:text-sm">
                        Pending Request
                    </h3>
                @endif
                <div class="flex items-center ">
                    @if($pendings == '0')
                        <div class="w-[8px] h-[8px] rounded bg-[#30363D]"></div>
                    @else
                        <div class="w-[8px] h-[8px] rounded bg-[#BD9423]"></div>
                    @endif
                    <p class="text-sm text-[#8D96A0] ml-1">
                        {{$pendings}}
                    </p>
                </div>
            </div>
        </div>
        <div class="p-3 pl-0 flex flex-grow rounded-lg border border-[#30363D] bg-[#0D1117] h-full max-sm:p-3 min-h-96">
            {{-------------------- ITEM TABLE ----------------------- }}
            {{---! This file contains callable item list/table for all user !---}}
            <div class="relative w-full p-5 pr-3 flex-grow overflow-hidden max-sm:p-3">
                <div class="absolute top-0 left-0 w-full custom-max-h p-5 pt-0 pr-3 overflow-y-auto custom-scrollbar h-full">
                    @if($items->isEmpty())
                        <div class="empty-state">                                
                            <p class="text-xl text-center text-[#30363D]">No item in inventory.</p>
                        </div>
                    @else
                        <table class="w-full mx-auto text-sm text-left text-gray-500 table-fixed">
                        <thead class="sticky-header">
                            <tr>
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;"></th>
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 200px;">Item Name</th>
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 150px;">Brand</th>
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 150px;">Category</th>
                                <th scope="col" class="py-1 px-6 text-sm font-normal" style="width: 100px;">Quantity</th>
                                <th scope="col" class="py-1 text-sm font-normal text-center" style="width: 100px;">
                                    <div class="flex justify-center items-center h-full">
                                        Status
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr class="text-[#E6EDF3] text-base">
                                    <td class="py-2 px-6 border-b border-[#30363D]" style="width: 100px;">
                                        @if($item->item_image!=null)
                                            <div class="flex justify-center items-center h-[50px] w-[50px]">
                                                <img src={{asset($item->item_image)}} class="rounded-full p-1 object-contain" style="max-height: 100%; max-width: 100%; height: 100%; width: 100%; object-fit: cover;">
                                            </div>
                                        @else
                                            <svg class="w-[50px] h-[50px] rounded-full p-2 fill-[#8D96A0] bg-[#292f36]" fill="#000000" width="50px" height="50px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>no-image</title><path d="M30,3.4141,28.5859,2,2,28.5859,3.4141,30l2-2H26a2.0027,2.0027,0,0,0,2-2V5.4141ZM26,26H7.4141l7.7929-7.793,2.3788,2.3787a2,2,0,0,0,2.8284,0L22,19l4,3.9973Zm0-5.8318-2.5858-2.5859a2,2,0,0,0-2.8284,0L19,19.1682l-2.377-2.3771L26,7.4141Z"/><path d="M6,22V19l5-4.9966,1.3733,1.3733,1.4159-1.416-1.375-1.375a2,2,0,0,0-2.8284,0L6,16.1716V6H22V4H6A2.002,2.002,0,0,0,4,6V22Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
                                        @endif
                                    </td>
                                    <td class="list-none py-2 px-4 border-b border-[#30363D]" style="width: 200px;">
                                        <div class="mb-1 !truncate" title="{{$item->item_name}}">
                                            {{$item->item_name}}
                                        </div>
                                    </td>
                                    <td class="list-none py-2 px-4 border-b border-[#30363D]" style="width: 150px;">
                                        <div class="mb-1 !truncate" title="{{$item->item_brand}}">
                                            {{$item->item_brand}}
                                        </div>
                                    </td>
                                    <td class="list-none py-2 px-4 border-b border-[#30363D]" style="width: 150px;">
                                        <div class="mb-1 !truncate" title="{{$item->item_category}}">
                                            {{$item->item_category}}
                                        </div>
                                    </td>
                                    <td class="list-none py-2 px-4 border-b border-[#30363D]" style="width: 100px;">
                                        <li>{{$item->item_quantity}}</li>
                                    </td>
                                    <td class="py-2 px-4 border-b border-[#30363D]" style="width: 100px;">
                                        <div class="flex justify-center items-center">
                                            @if($item->item_quantity > 0)
                                                <div class="w-[8px] h-[8px] rounded-full bg-[#238636]"></div>
                                            @else
                                                <div class="w-[8px] h-[8px] rounded-full bg-[#B42934]"></div>
                                            @endif
                                        </div>
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
    
    {{-- Right container --}}
    <div class="w-3/12 flex flex-grow flex-col gap-5 max-xl:flex-row max-xl:w-full max-sm:flex-col max-sm:gap-3 min-h-96">
        
        <div class="p-5 pr-3 flex-grow rounded-lg border border-[#30363D] bg-[#0D1117]">
            @if($borrows->isEmpty())
                <h3 class="text-base mb-4 text-[#8D96A0]">
            @else
                <h3 class="text-base mb-4">
            @endif
                Latest Rents
            </h3>                
            {{-- Return History --}}
            <div class="relative flex-grow overflow-hidden max-sm:p-3 min-h-44 custom-full-h">
                <div class="absolute top-0 left-0 w-full h-full pr-3 overflow-y-auto custom-scrollbar">
                    @if($borrows->isEmpty())
                        <div class="empty-state">                                
                            <x-svg-sleepy-hermit/>
                            <p class="text-sm text-center text-[#30363D]">No ongoing rents available</p>
                        </div>
                    @else
                        @foreach($borrows as $borrow)
                        <div class="border-l border-[#30363D] pl-4 pb-4 relative">
                            {{-- Name --}}
                            <h3 class="truncate">
                                {{$borrow->customer_name}}
                            </h3>
                            {{-- Address --}}
                            <div class="text-xs text-[#8D96A0]   flex">
                                <p class="mr-1">
                                    Address: 
                                </p>                                
                                <div class="text-xs text-[#8D96A0]   !truncate" title="{{$borrow->customer_address}}">
                                    {{$borrow->customer_address}}
                                </div>       
                            </div>                     
                            {{-- Item name --}}
                            <div class="text-xs text-[#8D96A0]   flex">
                                <p class="mr-1">
                                    Item: 
                                </p>                                
                                <div class="text-xs text-[#8D96A0]   !truncate" title="{{$borrow->brw_item_name}}">
                                    {{$borrow->brw_item_name}}
                                </div>       
                            </div>
                            <p class="text-xs text-[#8D96A0]     truncate">
                                Return date: {{$borrow->date_to_return}}
                            </p>
                        </div>                
                        @endforeach
                    @endif
                </div>  
                {{-- View more here --}}
                @if($borrows->isEmpty())
                    <a href="/admin/borrow-request" class="hidden text-xs absolute right-0 bottom-0 text-[#8D96A0] hover:text-[#1F6FEB] transition mr-4 bg-[#0D1117] p-1 rounded">
                        View more
                    </a> 
                @else
                    <a href="/admin/borrow-request" class="text-xs absolute right-0 bottom-0 text-[#8D96A0] hover:text-[#1F6FEB] transition flex mr-4 bg-[#0D1117] p-1 rounded">
                        View more
                    </a> 
                @endif                
            </div> 
        </div>

        {{-- Latest return here --}}
        <div class="p-5 pr-3 flex-grow rounded-lg border border-[#30363D] bg-[#0D1117] relative">
            @if($returns->isEmpty())
                <h3 class="text-base mb-4 text-[#8D96A0]">
            @else
                <h3 class="text-base mb-4">
            @endif
                Latest Returned
            </h3>                
            {{-- Return History --}}
            <div class="relative  flex-grow overflow-hidden max-sm:p-3 min-h-44 custom-full-h">
                <div class="absolute top-0 left-0 w-full h-full pr-3 overflow-y-auto custom-scrollbar">
                    @if($returns->isEmpty())
                        <div class="empty-state">                                
                            <x-svg-sleepy-hermit/>
                            <p class="text-sm text-center text-[#30363D]">No returned rents available</p>
                        </div>
                    @else
                        @foreach($returns as $return)
                    
                            <div class="border-l border-[#30363D] pl-4 pb-4 relative">
                                {{-- Name --}}
                                <h3 class="truncate">
                                    {{$return->history_cus_name}}
                                </h3>
                                {{-- Address --}}
                                <div class="text-xs text-[#8D96A0] flex">
                                    <p class="mr-1">
                                        Address
                                    </p>                                
                                    <div class=" text-xs text-[#8D96A0] !truncate" title="{{$return->history_cus_add}}">
                                        {{$return->history_cus_add}}
                                    </div>       
                                </div>
                                {{-- Item name --}}
                                <div class="text-xs text-[#8D96A0] flex">
                                    <p class="mr-1">
                                        Item: 
                                    </p>                                
                                    <div class=" text-xs text-[#8D96A0] !truncate" title="{{$return->history_item}}">
                                        {{$return->history_item}}
                                    </div>       
                                </div>
                                <p class="text-xs text-[#8D96A0] truncate">
                                    Date returned: 07/12/2024
                                </p>
                            </div> 
                        @endforeach
                    @endif
                </div>           
            </div>
            {{-- View more here --}}
            {{-- /{{ $user }}/history-logs --}}
            @if($returns->isEmpty())
                <a href="/admin/history-logs" class="hidden text-xs absolute right-0 bottom-0 text-[#8D96A0] hover:text-[#1F6FEB] transition mr-7 mb-3 bg-[#0D1117] p-1 rounded">
                    View more
                </a>
            @else
                <a href="/admin/history-logs" class="text-xs absolute right-0 bottom-0 text-[#8D96A0] hover:text-[#1F6FEB] transition flex mr-7 mb-3 bg-[#0D1117] p-1 rounded">
                    View more
                </a>
            @endif          
        </div>            
    </div>
</div>

@include('partials.footer')