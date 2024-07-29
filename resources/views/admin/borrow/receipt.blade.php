{{--==================== Receipt ====================--}}
@include('partials.header')
    <x-nav/>
    <div class="content-center p-20 min-h-screen ml-64 bg-[#0D1117] relative max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24">

        <div class="p-8 mx-auto max-w-lg bg-[#161B22] border border-[#30363D] rounded-lg shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">

                @if(auth()->user()->position != 'User')
                    {{-- Back button --}}
                    <a href="/admin/borrow-request" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
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
                @else
                    {{-- Back button --}}
                    <a href="/pending-request" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
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
                @endif

                {{-- Form title --}}

                {{-- Transaction ID/ Pending ID
                @if($pending_id == 0)
                    <h1 class="text-[#E6EDF3] text-center text-2xl pb-4 mb-4">Transaction ID: 00000{{$full_borrow_data['transaction_id']}}</h1>
                @else
                    <h1 class="text-[#E6EDF3] text-center text-2xl pb-4 mb-4">Pending ID: 00000{{$pending_id}}</h1>
                @endif --}}
            
                    @php
                        $transactionId = $full_borrow_data['history_id'] ?? 'N/A';
                        $pendingId = $pending_id ?? 0;
                    @endphp

                    @if($pendingId == 0)
                        @if($full_customer_data['type'] != 'outbound')
                            <h1 class="text-[#E6EDF3] text-center text-2xl ">
                                Transaction ID: {{ str_pad($transactionId, 5, '0', STR_PAD_LEFT) }}
                            </h1>
                            <h1 class="text-[#E6EDF3] text-center text-m pb-4 mb-4">
                                Borrow
                            </h1>
                        @else
                            <h1 class="text-[#E6EDF3] text-center text-2xl ">
                                Transaction ID: {{ str_pad($transactionId, 5, '0', STR_PAD_LEFT) }}
                            </h1>
                            <h1 class="text-[#E6EDF3] text-center text-m pb-4 mb-4">
                                Outbound
                            </h1>
                        @endif
                    @else
                        <h1 class="text-[#E6EDF3] text-center text-2xl pb-4 mb-4">
                            Pending ID: {{ str_pad($pendingId, 5, '0', STR_PAD_LEFT) }}
                        </h1>
                    @endif

                {{-- Customers details --}}
                <div class="flex flex-col">
                    @csrf                  
                    <div class="text-[#8D96A0]  text-center text-xl border-y border-[#30363D]">
                        <h1 class="text-[#E6EDF3] text-center text-base border-[#30363D] pt-2 pb-2">Customer Details</h1>  
                    </div> 
                    @if($full_customer_data['type'] != 'outbound')
                    <div class="mb-5">
                        {{-- Name--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Name: </p>
                            @if($full_borrow_data['name'])
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['name']}}</p>
                            @else
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['customer_name']}}</p>
                            @endif
                        </div>
                        {{-- Address--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Address: </p>
                            @if($full_borrow_data['address'])
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['address']}}</p>
                            @else
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['customer_address']}}</p>
                            @endif
                        </div>
                        {{-- Email--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Email: </p>
                            @if($full_borrow_data['email'])
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['email']}}</p>
                            @else
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['customer_email']}}</p>
                            @endif
                        </div>
                        {{-- Contact Number --}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Contact Number: </p>
                            @if($full_borrow_data['contact_number'])
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['contact_number']}}</p>
                            @else
                                <p class="text-sm max-sm:text-xs">{{$full_borrow_data['customer_number']}}</p>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="mb-5">
                        {{-- Name--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Name: </p>
                            <p class="text-sm max-sm:text-xs">
                                {{ $full_borrow_data['history_cus_name'] ?? $full_borrow_data['name'] }}
                            </p>
                        </div>
                        {{-- Address--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Address: </p>
                            <p class="text-sm max-sm:text-xs">{{ $full_borrow_data['history_cus_add'] ?? $full_borrow_data['address'] }}</p>
                        </div>
                        {{-- Email--}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Email: </p>
                            <p class="text-sm max-sm:text-xs">{{ $full_borrow_data['history_cus_email'] ?? $full_borrow_data['email'] }}</p>
                        </div>
                        {{-- Contact Number --}}
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Contact Number: </p>
                            <p class="text-sm max-sm:text-xs">{{ $full_borrow_data['history_cus_no'] ?? $full_borrow_data['contact_number'] }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Item details--}}
                    <div class="text-[#8D96A0]  text-center text-xl border-y border-[#30363D] mt-5 mb-2">
                        <h1 class="text-[#E6EDF3] text-center text-base border-[#30363D] pt-2 pb-2">Item Details</h1>  
                    </div>   
                    <div class="mb-8">
                        {{-- Item--}}
                    @if($full_customer_data['item_name'])
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Item:</p>
                                <p class="text-sm max-sm:text-xs">{{$full_customer_data['item_name']}}</p>
                        </div> 
                        {{-- Brand --}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Brand:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['item_brand']}}</p>
                        </div> 
                        {{-- Quantity--}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Quantity:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['item_quantity']}}</p>
                        </div> 
                        {{-- Category--}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Category:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['item_category']}}</p>
                        </div>
                        {{-- Duration--}}
                        <div class="flex justify-between"> 
                            @if($full_customer_data['type'] != 'outbound')
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Duration:</p>
                                <p class="text-sm max-sm:text-xs">{{$full_customer_data['days_interval']}} days</p>
                            @endif
                        </div>
                        {{-- Date Requested--}}
                        <div class="flex justify-between"> 
                            
                            @if($full_customer_data['type'] != 'outbound')
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Date Requested:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['item_requested_at']}}</p>
                            @endif
                        </div>
                        {{-- Date to be Returned--}}
                        <div class="flex justify-between"> 
                            @if($full_customer_data['type'] != 'outbound')
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Date to be returned:</p>
                            <p class="text-sm max-sm:text-xs ">{{$full_customer_data['item_returned']}}</p>
                            @endif
                        </div>
                    @else
                        <div class="flex justify-between max-md:flex-col max-md:mb-1">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Item:</p>
                                <p class="text-sm max-sm:text-xs">{{$full_customer_data['brw_item_name']}}</p>
                        </div> 
                        {{-- Brand --}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Brand:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['brw_item_brand']}}</p>
                        </div> 
                        {{-- Quantity--}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Quantity:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['brw_quantity']}}</p>
                        </div> 
                        {{-- Category--}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Category:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['brw_item_category']}}</p>
                        </div>
                        {{-- Duration--}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Duration:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['brw_duration']}} days</p>
                        </div>
                        {{-- Date Requested--}}
                        <div class="flex justify-between"> 
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Date Requested:</p>
                            <p class="text-sm max-sm:text-xs">{{$full_customer_data['date_requested']}}</p>
                        </div>
                        {{-- Date to be Returned--}}
                        <div class="flex justify-between"> 
                            
                            @if($full_customer_data['type'] != 'outbound')
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Date to be returned:</p>
                            <p class="text-sm max-sm:text-xs ">{{$full_customer_data['date_to_return']}}</p>
                            @endif
                        </div>
                    @endif
                    </div>
                </div>

                {{-- Back button for user receipt--}}
                @if(auth()->user()->position != 'User')
                    <a href="/admin/borrow-request">
                        <div class="py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                            Back
                        </div>
                    </a> 
                @else
                    {{-- Back button for user receipt--}}
                    <a href="/pending-request">
                        <div class="py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                            Back
                        </div>
                    </a> 
                @endif
        </div>
    </div> 
@include('partials.footer')