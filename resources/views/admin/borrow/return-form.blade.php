{{--==================== Return Form ====================--}}

@include('partials.header')

{{-- nav --}}
<x-nav/>

<div class="content-center p-20 min-h-screen ml-64 bg-[#0D1117] relative max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24">

    {{-- Back button --}}
    <a href="/borrow-request" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
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
        
    <form action="/admin/borrow-request/complete/{{$borrow_data['transaction_id']}}" method="POST">
        @method('PUT')
        @csrf
        
        {{-- Return details --}}
        <div class="p-8 mx-auto max-w-3xl bg-[#161B22] border border-[#30363D] rounded-lg shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">

            {{-- Transaction ID--}}
            <h1 class="pb-2 mb-4 text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Transaction ID: {{$borrow_id}}</h1>
        
            <div class="flex border-y border-[#30363D]">
                @csrf
                <div class="w-6/12 p-5 pl-0 max-sm:p-3 max-sm:pl-0">
                    {{-- Customer Details --}}
                    <h1 class="text-[#E6EDF3] text-2xl mb-2 max-sm:text-base max-sm:mb-2">Customer Details</h1>
                    <div class="mb-5">
                        {{-- Name--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Name:</p>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['customer_name']}}</p>
                        </div>
                        {{-- Address--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Address: </p>
                            <p class="text-sm max-sm:text-xs text-right max-md:text-left">{{$borrow_data['customer_address']}}</p>
                        </div>
                        {{-- Email--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Email:</p>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['customer_email']}}</p>
                        </div>
                        {{-- Contact Number --}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Contact number:</p>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['customer_number']}}</p> 
                        </div>                           
                    </div>
                </div>
                          
                <div class="w-6/12 p-5 pr-0 max-sm:p-3 max-sm:pr-0 border-dashed border-l border-[#30363D]">
                    {{-- Item Details --}}
                    <h1 class="text-2xl mb-2 max-sm:text-base max-sm:mb-2">Item Details</h1>  
                    {{-- Item--}}
                    <div class="flex justify-between max-md:flex-col max-md:mb-1">
                        <p class="text-sm text-[#8D96A0] max-sm:text-xs">Item:</p>
                        <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_item_name']}}</p>
                    </div> 
                    {{-- Brand --}}
                    <div class="flex justify-between max-md:flex-col max-md:mb-1"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Brand:</label>
                        <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_item_brand']}}</p>
                    </div> 
                    {{-- Quantity--}}
                    <div class="flex justify-between max-md:flex-col max-md:mb-1"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Quantity:</label>
                        <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_quantity']}}</p>
                    </div> 
                    {{-- Category--}}
                    <div class="flex justify-between max-md:flex-col max-md:mb-1"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Category:</label>
                        <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_item_category']}}</p>
                    </div>
                    {{-- Duration--}}
                    <div class="flex justify-between max-md:flex-col max-md:mb-1"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Duration:</label>
                        <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_duration']}} days</p>
                    </div>
                    {{-- Date Requested--}}
                    <div class="flex justify-between max-md:flex-col max-md:mb-1"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Date requested:</label>
                        <p class="text-sm max-sm:text-xs">{{$borrow_data['date_requested']}}</p>
                    </div>
                    {{-- Date to be Returned--}}
                    <div class="flex justify-between max-md:flex-col max-md:mb-1"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Date to be returned:</label>
                        <p class="text-sm max-sm:text-xs ">{{$borrow_data['date_to_return']}}</p>
                    </div>   
                    @php
                        use Carbon\Carbon;
                        use App\Models\Borrow;

                        // Find the borrow record by transaction ID
                        $target_borrow = Borrow::find($borrow_data['transaction_id']);

                        // Get the current date
                        $current_date = Carbon::now();
                        // Get the return date from borrow data
                        $date_return = $borrow_data['date_to_return'];

                        // Parse the return date using Carbon
                        $carbonDate = Carbon::parse($date_return);

                        // Calculate the difference in days and ensure it is an integer
                        $days_late = intval($carbonDate->diffInDays($current_date, false));

                        // Determine the late status based on the days late
                        if ($days_late > 0) {
                            $late_status = $days_late . ' Day' . ($days_late > 1 ? 's' : '') . ' Late';
                        } else {
                            $late_status = 'On time';
                        }


                        $current_date = Carbon::now();
                        $date_return = $borrow_data['date_to_return'];
                        $carbonDate = Carbon::parse($date_return);
                        
                        // $days_late = intval($carbonDate->diffInDays($current_date, false));
                        // $days_late = intval($carbonDate->diffInDays($current_date, false));  
                        $days_late = intval($current_date->diffInDays($carbonDate, false));
                        $abs_days_late = abs($days_late);
                        if ($days_late < 0) {
                            $late_status = $abs_days_late . ' Day' . ($abs_days_late > 1 ? 's' : '') . ' Late';
                        } else {
                            $late_status = 'On time';
                        }

                        // Update the borrow record's late status
                        $target_borrow->late_status = $late_status;
                        $target_borrow->save();
                    @endphp

                    {{-- Borrow Status --}}
                    <div class="flex justify-between"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Borrow status:</label>
                        <p class="text-sm italic max-sm:text-xs text-[#BD9423]">{{$borrow_data['borrow_status']}}</p>
                    </div> 
                    {{-- Status --}}
                    <div class="flex justify-between"> 
                        <label class="text-sm text-[#8D96A0] max-sm:text-xs">Status:</label>
                        @if($borrow_data['late_status'] != "On time")
                            <p class="text-sm italic max-sm:text-xs text-[#B42934]">{{$borrow_data['late_status']}}</p>
                        @else
                            <p class="text-sm italic max-sm:text-xs text-[#238636]">{{$borrow_data['late_status']}}</p>
                        @endif
                    </div>
                      
                </div>
            </div>
            
            {{-- Note --}}
            <div class="border-b border-[#30363D] mb-4 max-sm:text-sm">
                <div class="w-full py-5 max-sm:py-3">
                    <textarea type="text" rows="4" name="history_note" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2 no-resize custom-scrollbar" placeholder="Put your note here." value="{{ old('name') }}"></textarea>
                </div>   
            </div>

            <div class="flex gap-3">
                {{-- Back button of return form --}}
                <a href="/admin/borrow-request/" class="w-full">
                    <div class="py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                        Back
                    </div>
                </a>
                {{-- Confirm button of return form --}}
                <button type="submit" class="w-full">
                    <div class="py-2 text-center text-white bg-[#238636] hover:bg-[#1A6328] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                        Confirm
                    </div>
                </buton>    
            </div>
    </form>  
</div>

@include('partials.footer')