{{--==================== Custumer Details ====================--}}
{{-- @dd('$borrow_data') --}}
{{-- @dd(Session::get('customer_data')) --}}
@include('partials.header')
    <x-nav/>
    <div class="content-center p-20 min-h-screen ml-64 bg-[#0D1117] max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24 relative">
        
        {{-- Back button --}}
        <a href="/borrow-request/add" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
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

        <div class="flex place-content-center rounded-lg max-lg:flex-col max-lg:items-center">   
            
            {{-- Customer details --}}
            <div class="p-8 max-w-3xl w-full max-sm:p-5 rounded-lg bg-[#161B22] border border-[#30363D] shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)]">
                
                {{-- Form title --}}
                <h1 class="pb-4 max-sm:mb-2 text-3xl text-center text-[#E6EDF3] max-sm:text-2xl">Customer Details</h1>
                @php
                session()->put('borrow_data', $borrow_data);
                @endphp
                <form action="/borrow-request/customer-details/receipt/" method="POST" class="flex flex-col">
                    @csrf
                    <div class="flex border-y border-[#30363D] mb-4">
                        <div class="w-7/12 p-5 pl-0">

                            {{-- Input field for Name --}}
                            @if(auth()->user()->position == 'User')
                                <div class="mb-4 max-sm:mb-2">
                                    <label for="name" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Name</label>
                                    <input type="text" name="name" value='{{auth()->user()->name}}' class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                    <span class="text-danger text-xs text-[#B42934]">@error('name') {{$message}}@enderror</span>
                                </div>
                            @else
                                <div class="mb-4 max-sm:mb-2">
                                    <label for="name" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Name</label>
                                    <input type="text" name="name" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                    <span class="text-danger text-xs text-[#B42934]">@error('name') {{$message}}@enderror</span>
                                </div>
                            @endif
                        
                            @if(auth()->user()->position == 'User')
                                {{-- Input field for Email --}}
                                <div class="mb-4 max-sm:mb-2">
                                    <label for="email" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Email address</label>
                                    <input type="email" name="email" value="{{auth()->user()->email}}" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                    <span class="text-danger text-xs text-[#B42934]">@error('email') {{$message}}@enderror</span>
                                </div>
                            @else
                                {{-- Input field for Email --}}
                                <div class="mb-4 max-sm:mb-2">
                                    <label for="email" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Email address</label>
                                    <input type="email" name="email" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                    <span class="text-danger text-xs text-[#B42934]">@error('email') {{$message}}@enderror</span>
                                </div>
                            @endif

                            {{-- Input field for Address --}}
                            <div class="mb-4 max-sm:mb-2">
                                <label for="address" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Address</label>
                                <input type="text" name="address" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                <span class="text-danger text-xs text-[#B42934]">@error('address') {{$message}}@enderror</span>
                            </div>

                            {{-- Input field for Contact Number --}}
                            <div class="mb-4 max-sm:mb-2">
                                <label for="contact_number" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Contact Number</label>
                                <input type="text" name="contact_number" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                                <span class="text-danger text-xs text-[#B42934]">@error('contact_number') {{$message}}@enderror</span>
                            </div>
                        @if(auth()->user()->position == 'User')
                            {{-- Input field for User note --}}
                            <div class="max-sm:text-sm">
                                <div class="w-full py-5 max-sm:py-3">
                                    <textarea type="text" rows="4" name="user_note" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2 no-resize custom-scrollbar" placeholder="Put your note here." value="{{ old('user_note') }}"></textarea>
                                </div>   
                            </div>
                        @endif
                        </div>


                        <div class="border-dashed border-l border-[#30363D] w-5/12 flex relative">
                            <div class="p-5">
                                 {{-- Item details --}}
                                <h3 class="text-2xl mb-2 max-sm:text-base max-sm:mb-2">Item details</h3>
                                {{-- Name --}}
                                <p class="text-sm text-[#8D96A0] max-sm:text-xs">Name: {{$borrow_data['item_name']}}</p>
                                 {{-- Quantity --}}
                                <p class="text-sm text-[#8D96A0] max-sm:text-xs">Quantity: {{$borrow_data['item_quantity']}}</p>
                                {{-- Brand --}}
                                <p class="text-sm text-[#8D96A0] max-sm:text-xs">Brand: {{$borrow_data['item_brand']}}</p>
                                {{-- Category --}}
                                <p class="text-sm text-[#8D96A0] max-sm:text-xs">Category: {{$borrow_data['item_category']}}</p>
                                {{-- Date Requested --}}
                                @if(Session::get('customer_data')['type'] != 'outbound')
                                    <p class="text-sm text-[#8D96A0] max-sm:text-xs">Date requested: {{$borrow_data['item_requested_at']}}</p>
                                    {{-- Date to be returned --}}
                                    <p class="text-sm text-[#8D96A0] max-sm:text-xs">Date to be returned: {{$borrow_data['item_returned']}}</p>
                                @endif
                                {{-- Edit --}}
                                <a href="/borrow-request/add" class="absolute right-0 bottom-0 mr-5 text-[#8D96A0] mb-5 hover:text-[#1F6FEB]  max-sm:text-sm">
                                    <div class="flex">
                                        <h1 class="ml-0.5 text-base flex group hover:text-[#1F6FEB] group-hover:text-[#1F6FEB]">Edit
                                            <svg class="group-hover:fill-[#1F6FEB] mt-0.5" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="20px" fill="#5f6368"><path d="M120-120v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm584-528 56-56-56-56-56 56 56 56Z"/></svg> 
                                        </h1>
                                    </div>
                                </a>
                               
                            </div>
                        </div>
                    </div>

                    {{-- Cancel --}}
                    <div class="grid grid-cols-2 gap-4">
                        @if(auth()->user()->position != 'User')
                        <a href="/borrow-request">
                        @else
                        <a href="/pending-request">
                        @endif
                            <div class="py-2 text-center text-white bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                                Cancel
                            </div>
                        </a>
                        @if(Session::get('customer_data')['type'] != 'outbound')
                            {{-- Confirm Button --}}
                            <button type="submit" class="py-2 text-center text-white bg-[#1F6FEB] hover:bg-[#1A5FC9] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                                    Confirm
                            </button>
                        @else
                            {{-- Confirm Button --}}
                            <button type="submit" class="py-2 text-center text-white bg-[#1F6FEB] hover:bg-[#1A5FC9] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                                Outbound
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@include('partials.footer')
