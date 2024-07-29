{{--==================== View Details ====================--}}

@include('partials.header')
    <x-nav/>
    <div class="content-center p-20 min-h-screen ml-64 bg-[#0D1117] relative max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24">

        <div class="max-w-lg p-8 mx-auto bg-[#161B22] border border-[#30363D] rounded-lg shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">

            {{-- Back button --}}
            <a href="/admin/borrow-request/" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
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
                {{-- Form title --}}

                 {{-- Transaction ID--}}
                <h1 class="pb-2 mb-4 text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Transaction ID: {{$borrow_id}}</h1>
            
                 {{-- Customer details--}}
                <div class="flex flex-col">
                    @csrf                  
                    <div class="text-[#8D96A0] mb-1 text-center border-y border-[#30363D]">
                        <h1 class="text-[#E6EDF3] text-base mb-2 mt-2">Customer Details</h1>
                    </div>

                    <div class="mt-2">                   
                        {{-- Name--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Name:</p>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['customer_name']}}</p>
                        </div>
                        {{-- Address--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Address: </p>
                            <p class="text-sm max-sm:text-xs text-right max-md:text-left">{{$borrow_data['customer_address']}}</p>
                        </div>
                        {{-- Email--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Email:</p>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['customer_email']}}</p>
                        </div>
                        {{-- Contact Number --}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Contact number:</p>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['customer_number']}}</p> 
                        </div> 
                    </div>

                     {{-- Item details --}}
                    <div class="text-[#8D96A0]  text-center text-xl border-y border-[#30363D] mt-5">
                        <h1 class="text-[#E6EDF3] text-center text-base border-[#30363D] pt-2 pb-2">Item Details</h1>  
                    </div>    

                    <div class="mt-2 mb-4">
                        {{-- Item--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Item:</p>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_item_name']}}</p>
                        </div> 
                        {{-- Brand --}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Brand:</label>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_item_brand']}}</p>
                        </div> 
                        {{-- Quantity--}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Quantity:</label>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_quantity']}}</p>
                        </div> 
                        {{-- Category--}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Category:</label>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_item_category']}}</p>
                        </div>
                        {{-- Duration--}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Duration:</label>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['brw_duration']}}
                                @if($borrow_data->brw_duration == 1)
                                    day
                                @else
                                    days
                                @endif
                            </p>
                        </div>
                        {{-- Date Requested--}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Date requested:</label>
                            <p class="text-sm max-sm:text-xs">{{$borrow_data['date_requested']}}</p>
                        </div>
                        {{-- Date to be Returned--}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Date to be returned:</label>
                            <p class="text-sm max-sm:text-xs ">{{$borrow_data['date_to_return']}}</p>
                        </div>     
                        {{-- Borrow Status--}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Borrow status:</label>
                            <p class="text-sm italic max-sm:text-xs text-[#BD9423]">{{$borrow_data['borrow_status']}}</p>
                        </div>
                        {{-- Status--}}
                        <div class="flex justify-between"> 
                            <label class="text-sm text-[#8D96A0] max-sm:text-xs">Status:</label>
                            @php
                                use Carbon\Carbon;
                                use App\Models\Borrow;
                                $target_borrow = Borrow::find($borrow_data['transaction_id']);

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
                            
                                $target_borrow->late_status = $late_status;
                                $target_borrow->save();
                            @endphp                        
                            @if($late_status != "On time")
                                <p class="text-sm italic max-sm:text-xs text-[#B42934]">{{$late_status}}</p>
                            @else
                                <p class="text-sm italic max-sm:text-xs text-[#238636]">{{$late_status}}</p>
                            @endif
                        </div>     
                        
                    </div>
                </div>
                <div class="flex gap-3">
                    {{-- Back button of view details --}}
                    <a href="/admin/borrow-request/" class="w-full">
                        <div class="py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                            Back
                        </div>
                    </a>
                    {{-- Outbound of view details --}}
                    <a href="/admin/borrow-request/outbound/{{$borrow_data['transaction_id']}}" class="w-full">
                        <div class="py-2 text-center text-white bg-[#238636] hover:bg-[#1A6328] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                            Outbound
                        </div>
                    </a>  
                </div>               
        </div>
    </div>
    
@include('partials.footer')