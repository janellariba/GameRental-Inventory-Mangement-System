{{--==================== View Details ====================--}}

@include('partials.header')
    <x-nav/>
    <div class="content-center p-20 min-h-screen ml-64 bg-[#0D1117] relative max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24">

        <div class="max-w-lg p-8 mx-auto bg-[#161B22] border border-[#30363D] rounded-lg shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">

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
                 {{-- Transaction ID--}}
                <h1 class="pb-2 mb-4 text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Pending ID: {{$pending_details->pending_id}}</h1>
            
                <div class="flex flex-col">
                    @csrf                  
                    <div class="text-[#8D96A0] mb-1 text-center border-y border-[#30363D]">
                        <h1 class="text-[#E6EDF3] text-base mb-2 mt-2">Customer Details</h1>
                    </div>

                    <div class="mt-2">                   
                        {{-- Name--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Name:</p>
                            <p class="text-sm max-sm:text-xs">{{$pending_details->customer_name}}</p>
                        </div>
                        {{-- Address--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Address: </p>
                            <p class="text-sm max-sm:text-xs text-right max-md:text-left">{{$pending_details->customer_address}}</p>
                        </div>
                        {{-- Email--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Email:</p>
                            <p class="text-sm max-sm:text-xs">{{$pending_details->customer_email}}</p>
                        </div>
                        {{-- Contact Number --}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Contact number:</p>
                            <p class="text-sm max-sm:text-xs">{{$pending_details->customer_number}}</p> 
                        </div> 
                    </div>

                    <div class="text-[#8D96A0] text-center text-xl border-y border-[#30363D] mt-5">
                        <h1 class="text-[#E6EDF3] text-center text-base pt-2 pb-2">Item Details</h1>  
                    </div>    
                    <div class="mt-2 mb-4 rounded-lg">
                        {{-- Item--}}
                        <div class="flex justify-between">
                            <p class="text-sm text-[#8D96A0] max-sm:text-xs">Item:</p>
                            <p class="text-sm max-sm:text-xs">{{$pending_details->brw_item_name}}</p>
                        </div> 
                        {{-- Brand --}}
                        <div class="flex justify-between"> 
                            <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Brand:</h1>
                            <p class="text-sm max-sm:text-xs">{{$pending_details->brw_item_brand}}</p>
                        </div> 
                        {{-- Category--}}
                        <div class="flex justify-between"> 
                            <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Category:</h1>
                            <p class="text-sm max-sm:text-xs">{{$pending_details->brw_item_category}}</p>
                        </div>
                        {{-- Quantity--}}
                        @if($item_quantity < $pending_details->brw_quantity)
                            <div class="flex justify-between"> 
                                <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Quantity:</h1>
                                <div class="flex ">
                                    @if($pending_details->borrow_status != 'Ongoing')
                                    <p class="text-xs italic max-sm:text-xs text-[#B42934] pr-2">Insufficient Supply from Inventory</p>
                                    @endif
                                    <p class="text-sm max-sm:text-xs text-right pl-2">{{$pending_details->brw_quantity}}</p>
                                </div>
                            </div> 
                        @else
                            <div class="flex justify-between"> 
                                <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Quantity:</h1>
                                <p class="text-sm max-sm:text-xs">{{$pending_details->brw_quantity}}</p>
                            </div> 
                        @endif
                        {{-- Duration--}}
                        @if($pending_details->brw_duration > 1)
                            <div class="flex justify-between"> 
                                <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Duration:</h1>
                                <p class="text-sm max-sm:text-xs">{{$pending_details->brw_duration}}
                                    @if($pending->brw_duration == 1)
                                        day
                                    @else
                                        days
                                    @endif
                                </p>
                            </div>
                        @else
                            <div class="flex justify-between"> 
                                <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Duration:</h1>
                                <p class="text-sm max-sm:text-xs">{{$pending_details->brw_duration}} day</p>
                            </div>
                        @endif
                        {{-- Date Requested--}}
                        <div class="flex justify-between"> 
                            <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Date requested: </h1>
                            <p class="text-sm max-sm:text-xs">{{$pending_details->date_requested}}</p>
                        </div>
                        {{-- Date to be Returned--}}
                        <div class="flex justify-between"> 
                            <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Date to be returned:</h1>
                            @if($pending_details->borrow_status == "Pending Outbound")
                                <p class="text-sm max-sm:text-xs ">N/A</p>
                            @else
                                <p class="text-sm max-sm:text-xs ">{{$pending_details->date_to_return}}</p>
                            @endif
                        </div>     
                        {{-- Borrow Status--}}
                        <div class="flex justify-between"> 
                        <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Borrow status:</h1>
                            @if($pending_details->borrow_status == 'Ongoing' || $pending_details->borrow_status == 'Pending' || $pending_details->borrow_status == 'Pending Outbound')
                                <p class="text-sm italic max-sm:text-xs text-[#BD9423]">{{$pending_details->borrow_status}}</p>
                            @elseif($pending_details->borrow_status == 'Declined')
                                <p class="text-sm italic max-sm:text-xs text-[#B42934]">{{$pending_details->borrow_status}}</p>
                            @elseif($pending_details->borrow_status == 'Returned')
                                <p class="text-sm italic max-sm:text-xs text-[#238636]">{{$pending_details->borrow_status}}</p>
                            @endif
                        </div>    
                        <div class="flex justify-between"> 
                            <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Note:</h1>
                            <p class="text-sm max-sm:text-xs text-white">{{$pending_details->user_note}}</p>
                        </div>  
                        @if($pending_details->feedback)
                            <div class="flex justify-between"> 
                                <h1 class="text-sm text-[#8D96A0] max-sm:text-xs">Remark:</h1>
                                <p class="text-sm max-sm:text-xs text-white">{{$pending_details->feedback}}</p>
                            </div>
                        @endif
                    </div>
                    {{-- Input field for feedback, will only show for admin and employees --}}
                    @if(auth()->user()->position != 'User')                    
                        {{-- Confirm button --}}
                        @if($pending_details->borrow_status == 'Declined' && $item_quantity)
                            <a href="/pending-request/delete/{{$pending_details->pending_id}}" class="w-full">
                                <div class="w-full py-2 text-center text-white bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2 mt-4">
                                    Delete
                                </div>
                            </a>
                        @else
                        <form method="POST" action="/pending-request/decline/{{$pending_details->pending_id}}">
                            @csrf
                            <div class="border-b border-[#30363D] mb-4 max-sm:text-sm">
                                <div class="w-full py-5 max-sm:py-3">
                                    <textarea type="text" rows="4" name="feedback" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2 no-resize custom-scrollbar" placeholder="Put your note here." value="{{ old('feedback') }}"></textarea>
                                </div>   
                            </div>
                        <div class="flex gap-3">
                            <a class="w-full">
                                <button onclick="checker()" type="submit" class="w-full py-2 text-center text-white bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2 mt-4">
                                    Decline
                                </button>
                            </a>
                        </form>
                        @endif
                        
                        @if($pending_details->borrow_status == 'Declined' && $item_quantity < $pending_details->brw_quantity)
                            <a href="" class="w-full cursor-not-allowed" aria-disabled="true" onclick="checker()">
                                <div class="w-full py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm mt-4">
                                    Declined
                                </div>
                            </a>
                            
                        @elseif($item_quantity < $pending_details->brw_quantity)
                            <a href="" class="w-full cursor-not-allowed" aria-disabled="true">
                                <div class="w-full py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm mt-4">
                                    On Hold
                                </div>
                            </a>
                        @else
                            <a href="/pending-request/accept/{{$pending_details->pending_id}}" class=" w-full">
                                <div class="w-full py-2 text-center text-white bg-[#238636] hover:bg-[#1A6328] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm mt-4">
                                    Accept
                                </div>
                            </a>
                            
                        @endif
                    @else
                            @if($pending_details->borrow_status != 'Ongoing')
                                {{-- Confirm button --}}
                                <a href="/pending-request/delete-request/{{$pending_details->pending_id}}" class="w-full" onclick="checker()">
                                    <div class="w-full py-2 text-center text-white bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2 mt-4">
                                        Delete
                                    </div>
                                </a>
                            @endif
                            {{-- Confirm button --}}
                            <a href="/pending-request/" class="w-full">
                                <div class="w-full py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm mt-4">
                                    Back
                                </div>
                            </a>
                    @endif
                </div>
                @if(auth()->user()->position != 'User')  
                {{-- Confirm button --}}
                <a href="/pending-request/" class="w-full">
                    <div class="w-full py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm mt-4">
                        Back
                    </div>
                </a>
                @endif
             </div>
        </div>
    </div>
    
@include('partials.footer')