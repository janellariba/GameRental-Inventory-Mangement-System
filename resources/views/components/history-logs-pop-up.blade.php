<div x-data="{open : false}">
    {{--  --}}
    {{-- <a href="">
        <svg class="w-[42px] h-[42px] p-2 transition rounded-lg hover:bg-[#21262D] fill-[#8D96A0] hover:fill-[#C9D1D9]" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><title/><path d="M150,48a30.2,30.2,0,0,0-30-30.5H80a30.09,30.09,0,0,0-30,30V48C30.5,50.5,15,67.5,15,87.5v40a30.09,30.09,0,0,0,30,30h5v5a20.06,20.06,0,0,0,20,20h60a20.06,20.06,0,0,0,20-20v-5h5a30.09,30.09,0,0,0,30-30v-40A40,40,0,0,0,150,48ZM80,37.5h40a10,10,0,0,1,10,10H70A10,10,0,0,1,80,37.5Zm50,125H70v-40h60Zm35-35a10,10,0,0,1-10,10h-5v-15a20.06,20.06,0,0,0-20-20H70a20.06,20.06,0,0,0-20,20v15H45a10,10,0,0,1-10-10v-40a20.06,20.06,0,0,1,20-20h90a20.06,20.06,0,0,1,20,20v40Z"/></svg>
    </a> --}}
    
    <button @click="open = !open" data-collapse-toggle="navBar">
        <div class="flex items-center bg-[#21262D] border border-[#30363D] text-[#C9D1D9] rounded-lg max-h-11 mr-4">
            <div class="py-2 px-4 text-[#C9D1D9] transition rounded-lg hover:bg-[#1F6FEB]">
                Export
            </div>
        </div>
    </button>

    
    
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black z-50 bg-opacity-75 p-5" id="navBar">
        
        <div class="w-auto bg-[#161B22] z-30 p-5 pt-6 text-[#E6EDF3] shadow-xl border border-[#30363D] rounded-lg relative max-w-lg">            
            <button @click="open = !open" data-collapse-toggle="navBar" class="absolute top-1 right-1">
                <svg class="w-[28px] h-[28px] transition rounded-lg hover:bg-[#21262D] stroke-[#8D96A0] hover:stroke-[#C9D1D9]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Menu / Close_SM">
                    <path id="Vector" d="M16 16L12 12M12 12L8 8M12 12L16 8M12 12L8 16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    </svg>
            </button>

            {{-- Form --}}
            <form action="{{route('export_user')}}">
                {{-- Title --}}
                <h1 class="max-xl:mb-4 text-3xl text-center text-[#E6EDF3] max-sm:text-2xl">Export</h1>

                {{-- Border --}}
                <div class="pt-2 pb-4 my-4 max-sm:mb-2 border-y border-[#30363D]">
                    
                    {{--========== Date section ==========--}}
                    {{-- Section title --}}
                    <h3 class="text-base text-[#8D96A0]">Date:</h3>                
                    <fieldset class="flex gap-3 items-center mb-4 max-sm:mb-2">
                        {{-- All --}}
                        <div class="flex items-center">
                            <input id="option-1" type="radio" name="date" value="all" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none" checked>
                            <label for="option-1" class="block ms-2 text-[#E6EDF3]">
                                All
                            </label>
                        </div>
                    
                        {{-- Selected --}}
                        <div class="flex items-center">
                            <input id="option-2" type="radio" name="date" value="selected" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none">
                            <label for="option-2" class="block ms-2 text-[#E6EDF3]">
                                Selected
                            </label>
                        </div>
                    </fieldset>
                    
                    {{-- Start and end dates --}}
                    <div class="grid grid-cols-2 gap-3 mb-4 max-sm:mb-2">
                        {{-- Date Requested --}}
                        <div class="relative">
                            <label for="item_requested_at" class="mb-2 text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Start Date</label>
                            <input datepicker name="item_requested_at" id="start-date" type="date" class="bg-[#0D1117] border border-[#30363D] text-[#E6EDF3] rounded w-full py-1 px-3 focus:outline-none date-input" value="{{old('item_requested_at')}}">
                            <span class="text-danger text-xs text-[#B42934]">@error('item_requested_at') {{$message}}@enderror</span>
                            @php
                                $fdate = old('item_requested_at'); // Get requested date from old input
                                $tdate = old('item_returned'); // Get returned date from old input
                                $error_message = '';
                                if ($fdate && $tdate) {
                                    $datetime1 = new DateTime($fdate);
                                    $datetime2 = new DateTime($tdate);
                    
                                    if ($datetime2 < $datetime1) {
                                        $error_message = 'Return date cannot be before requested date.';
                                    }
                                }
                            @endphp
                            <p class="text-[#B42934] text-xs mt-1">{{$error_message}}</p>
                        </div>
                    
                        {{-- Date To be Returned --}}
                        <div class="relative">
                            <label for="item_returned" class="mb-2 text-[#8D96A0] max-sm:text-sm max-sm:mb-1">End Date</label>
                            <input datepicker name="item_returned" id="end-date" type="date" class="bg-[#0D1117] border border-[#30363D] text-[#E6EDF3] rounded w-full py-1 px-3 focus:outline-none date-input" placeholder="Select date" value="{{old('item_returned')}}">
                            <span class="text-danger text-xs text-[#B42934]">@error('item_returned') {{$message}}@enderror</span>
                            @php
                                $fdate = old('item_requested_at'); // Get requested date from old input
                                $tdate = old('item_returned'); // Get returned date from old input
                                $error_message = '';
                                if ($fdate && $tdate) {
                                    $datetime1 = new DateTime($fdate);
                                    $datetime2 = new DateTime($tdate);
                    
                                    if ($datetime2 < $datetime1) {
                                        $error_message = 'Return date cannot be before requested date.';
                                    }
                                }
                            @endphp
                            <p class="text-[#B42934] text-xs mt-1">{{$error_message}}</p>
                        </div>
                    </div>
                        
                    {{--========== Category ==========--}}
                    <div class="mb-4 max-sm:mb-2 ">
                        {{-- Section title --}}
                        <label for="item_category" class="text-base text-[#8D96A0] max-sm:text-sm">Category:</label>

                        {{-- Select All --}}
                        <div class="flex items-center mb-2 max-sm:mb-1">
                            <input name="select_cat" type="hidden" value="off_cat" class="custom-checkbox w-4 h-4 focus:outline-none">
                            <input name="select_cat" id="select-all-checkbox" type="checkbox" value="on_cat" class="custom-checkbox w-4 h-4 focus:outline-none">
                            <label for="select-all-checkbox" class="ms-2 text-[#E6EDF3]">Select All</label>
                        </div>

                        {{-- Categories container --}}
                        <div class="grid grid-cols-4 row-auto gap-3 max-h-32 overflow-y-auto custom-scrollbar gap-y-0">
                            @foreach($categories as $category)
                                <div class="col-span-1 flex items-center">
                                    <input name="{{$category->category_name}}" id="accessory-checkbox" class="category-checkbox custom-checkbox w-4 h-4 focus:outline-none" type="checkbox" value="{{$category->category_name}}">
                                    <label for="{{$category->category_name}}-checkbox" class="ms-2 text-[#E6EDF3] !truncate" title="{{$category->category_name}}">{{$category->category_name}}</label>
                                </div>
                            @endforeach   
                        </div>
                        <span class="text-[#B42934] text-xs">@error('item_category') {{$message}}@enderror</span>
                    </div>



                    {{--========== Status and remark ==========--}}
                    <div class="flex gap-3 mb-4 max-sm:mb-2">
                        {{-- Status --}}
                        <div class=" w-full">
                            <label for="status" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Status</label>
                            <select name="status" class="w-full px-3 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                <option value="All" {{old('item_category') == 'All' ? 'selected' : ''}}>All</option>                        
                                <option value="Late" {{old('item_category') == 'Accessories' ? 'selected' : ''}}>Late</option>
                                <option value="On Time" {{old('item_category') == 'Consoles' ? 'selected' : ''}}>On Time</option>
                            </select>
                            <span class="text-[#B42934] text-xs">@error('item_category') {{$message}}@enderror</span>
                        </div>

                        {{-- Remark --}}
                        <div class=" w-full">
                            <label for="remarks" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Remark</label>
                            <select name="remarks" class="w-full px-3 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                <option value="All" {{old('item_category') == 'All' ? 'selected' : ''}}>All</option>                        
                                <option value="Returned" {{old('Returned') == 'Accessories' ? 'selected' : ''}}>Returned</option>
                                <option value="Outbound" {{old('item_category') == 'Consoles' ? 'selected' : ''}}>Outbound</option>
                            </select>
                            <span class="text-[#B42934] text-xs">@error('item_category') {{$message}}@enderror</span>
                        </div>
                    </div>
                    
                
                {{--========== Format ==========--}}
                <h3 class="text-base text-[#8D96A0]">Format:</h3>                
                <fieldset class="flex gap-3 items-center">
                    {{-- All --}}
                    <div class="flex items-center">
                        <input id="option-3" type="radio" name="format" value="excel" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none" checked>
                        <label for="option-3" class="block ms-2 text-[#E6EDF3]">
                            Spreadsheet (.xlsx)
                        </label>
                    </div>
                
                    {{-- Selected --}}
                    <div class="flex items-center">
                        <input id="option-4" type="radio" name="format" value="pdf" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none">
                        <label for="option-4" class="block ms-2 text-[#E6EDF3]">
                            Printable Document File (.pdf)
                        </label>
                    </div>
                </fieldset>

                </div>    
                <div class="flex gap-3">
                    {{-- Back button --}}
                    <a href="/admin/history-logs" class="w-full">
                        <div class="py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                            Back
                        </div>
                    </a>
                    {{-- Outbound --}}
                    <button class="w-full" action="submitvf">
                        <div class="py-2 text-center text-white bg-[#1F6FEB] hover:bg-[#1A5FC9] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                            Export
                        </div>
                    </button>                        
                    {{-- </a>  --}}
                </div> 
            </form>
        </div>           
    </div>
</div>
