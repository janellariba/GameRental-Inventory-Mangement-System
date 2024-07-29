{{--==================== NAVIGATION ====================--}}
{{--========== Availables URLs for Users ==========
    Format: /{{ $user }}/destination
        ========== Admin ==========

                    - /admin/home
                    - /admin/inventory-list
                        > /admin/inventory-list/add?
                    - /admin/borrow-request
                    - /admin/employee-profile
                    - /admin/history-logs

                    Condition:
                    '/' == /admin/home

        ========== Employee ==========

                    - /employee/home
                    - /employee/inventory-list
                    - /employee/borrow-request
                    - /employee/history-logs
                    
                    Condition:
                    '/' == /employee/home

        ========== Customer ==========

                    No navigation
                    - /inventory-list

                    Condition:
                    '/' == /inventory-list
        --}}
        {{-- @dd(auth()->user()) --}}

{{-- Large Screen Nav --}}

@php
    if(auth()->check() == false){
    }
@endphp
<nav x-data="{open : false}" role="navigation">

    {{--========== Large Screen Nav ==========--}}
    <div class="fixed z-20 max-lg:hidden w-64 h-full flex flex-col justify-between rounded-r-lg border-r bg-[#161B22] text-[#E6EDF3] border-[#30363D]">
        
        {{-- Upper part of Navigation --}}
        <div class="container mt-5 p-4">
            @auth
                @if(auth()->user()->position)
                    @if(auth()->user()->position != 'User')
                        <a href="/admin/home" class="flex justify-center border-b mb-2 p-2 border-[#30363D] focus:outline-none">
                            <x-logo/>
                        </a>
                    @else
                        <a href="/admin/inventory-list" class="flex justify-center border-b mb-2 p-2 border-[#30363D] focus:outline-none">
                            <x-logo/>
                        </a>
                    @endif
                @else
                    <!-- Handle case where user has no position defined -->
                    <a href="{{ route('home') }}" class="flex justify-center border-b mb-2 p-2 border-[#30363D] focus:outline-none">
                        <x-logo/>
                    </a>
                @endif
            @endauth

            @auth
                {{-- Home --}}
                @if(auth()->user()->position != "User")
                    <a href="/admin/home" id="home">
                        <div @class([
                            'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                            'text-[#1F6FEB]' => request()->is('admin/home'),
                        ])>
                            Home
                        </div>
                    </a>
                @endif
            @else
                <a href="" class="flex justify-center border-b mb-2 p-2 border-[#30363D] focus:outline-none">
                    <x-logo/>
                </a> 
            @endauth

            {{--  Inventory List  --}}
            <a href="/admin/inventory-list" id="inventory-list">
                <div @class([
                    'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                    'text-[#1F6FEB]' => request()->is('admin/inventory-list*'),
                ])>
                    Inventory List
                </div>
            </a>                      

            @auth
                @if(auth()->user()->position != "User")
                    {{--  Employee Profile  --}}
                    <a href="/admin/employee-profile" id="employee-profile">
                        <div @class([
                            'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                            'text-[#1F6FEB]' => request()->is('admin/employee-profile*') || request()->is('register'),
                        ])>
                            Employee Profile
                        </div>
                    </a>
                @endif
            @endauth         
            
            @auth
                {{--  Pending Request  --}}
                <a href="/pending-request" id="borrow-request">
                    @if(auth()->user()->position != "User")
                        <div @class([
                                'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                                'text-[#1F6FEB]' => request()->is('pending-request*'),
                            ])>
                            Pending Request
                        </div>
                    @else
                        <div @class([
                            'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                            'text-[#1F6FEB]' => request()->is('pending-request*') ||
                                                request()->is('borrow-request*'),
                            ])>
                            Pending Request
                        </div>
                    @endif
                </a>
            @endauth

            @auth
                @if(auth()->user()->position != "User")
                    {{--  Borrow Request  --}}
                    <a href="/admin/borrow-request" id="borrow-request">
                        <div @class([
                            'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                            'text-[#1F6FEB]' => request()->is('admin/borrow-request*') || 
                                                request()->is('borrow-request*'),
                        ])>
                            Item Request
                        </div>
                    </a>                   
                @endif
            @endauth

            @auth
                @if(auth()->user()->position != "User")
                    {{--  History Logs  --}}
                    <a href="/admin/history-logs" id="history-logs">
                        <div @class([
                            'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                            'text-[#1F6FEB]' => request()->is('admin/history-logs'),
                        ])>
                            History Logs
                        </div>
                    </a>
                @endif
            @endauth

            <p class="text-xs text-[#8D96A0] p-2 border-t border-[#30363D] mt-2">
                © 2024 GameRental, Inc.
                <a href="/our-team" class="ml-2 hover:text-[#1F6FEB] hover:underline">
                    About us
                </a>
            </p>
        </div>

        {{-- Lower part of Navigation --}}
        <div class="container p-4 user-info">
            <div class="flex py-2 max-h-14">
                <div class="flex justify-center items-center my-4 px-1">
                    @if(auth()->check())
                        @if(auth()->user()->user_image)
                            <img class="w-[45px] h-[45px] rounded-full"  width="800px" height="800px" viewBox="0 0 24 24" src="{{ Auth::user()->user_image ? asset(Auth::user()->user_image) : $default_image }}">
                        @else
                            <img class="w-[50px] h-[50px] rounded-full" src="https://api.dicebear.com/9.x/pixel-art/svg" alt="">
                        @endif
                    @else
                        @php 
                            $random_seed = uniqid();
                            $default_image = "https://api.dicebear.com/9.x/pixel-art/svg?seed=" . $random_seed; 
                        @endphp

                    <img class="rounded-full object-contain h-[50px] w-[50px] bg-[#292F36]" src="{{$default_image}}">
                    @endif                    
                </div>
                
                <div class="pl-1">
                    {{-- User's name here--}}
                    <p>
                        @auth
                            @if(Auth::user()->name == null)
                                Guest
                            @else
                                {{ Auth::user()->name }}
                            @endif
                        @else
                            {{-- Display "Wandering Goat" for unauthenticated users --}}
                            Wandering Goat
                        @endauth
                    </p>
                    {{-- User's status here--}}
                    <p class="text-xs text-[#8D96A0] italic">
                        @if(auth()->check())
                            {{auth()->user()->position}}
                        @else
                            Guest
                        @endif
                    </p>
                </div> 
            </div>

            
                {{-- Logout button here --}}
                <form action="/logout" method="POST">
                    @csrf
                    @if(auth()->check())
                    <div class="text-[#8D96A0] text-xs text-right italic p-2 border-t border-[#30363D]">
                        <button class="transition hover:text-[#1F6FEB]">
                            Logout
                        </button>
                    </div>
                    @else
                    <div class="text-[#8D96A0] text-xs text-right italic p-2 border-t border-[#30363D] hidden">
                        <button class="transition hover:text-[#1F6FEB]">
                            Logout
                        </button>
                    </div>
                    @endif
                </form>
            
            @if(auth()->check())
            @else
            <div class="text-[#8D96A0] text-xs text-right italic p-2 border-t border-[#30363D]">
                <a href="/login" class="">
                    <div class="transition hover:text-[#1F6FEB]">
                        Login
                    </div>
                </a>
            </div>
            @endif
        </div>
        
    </div>

    
    {{--========== Small Screen Nav ==========--}}
    <div class="hidden fixed max-lg:block  z-20 w-full h-16 bg-[#161B22] shadow-xl">
        <div class="flex justify-between py-2 px-6 items-center h-full">

            {{-- @auth
                @if(auth()->user()->position)
                    @if(auth()->user()->position != 'User')
                        <a href="/admin/home" class="flex justify-center border-b mb-2 p-2 border-[#30363D] focus:outline-none">
                            <x-logo/>
                        </a>
                    @else
                        <a href="/admin/inventory-list" class="flex justify-center border-b mb-2 p-2 border-[#30363D] focus:outline-none">
                            <x-logo/>
                        </a>
                    @endif
                @else
                    <!-- Handle case where user has no position defined -->
                    <a href="{{ route('home') }}" class="flex justify-center border-b mb-2 p-2 border-[#30363D] focus:outline-none">
                        <x-logo/>
                    </a>
                @endif
            @endauth --}}
            @auth
                @if(auth()->user()->position)
                    @if(auth()->user()->position != 'User')
                        <a href="/admin/home">
                            <x-logo-small/>
                        </a>
                    @else
                        <a href="/admin/inventory-list">
                            <x-logo-small/>
                        </a>
                    @endif
                @else
                    <a href="">
                        <x-logo-small/>
                    </a>
                @endif
            @else
                <a href="">
                    <x-logo-small/>
                </a> 
            @endauth

            <button @click="open = !open" data-collapse-toggle="navBar">
                <svg class="w-[40px] h-[40px] text-[#E6EDF3]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                </svg> 
            </button>
        </div>
        <div x-show="open" class="w-full lg:block" id="navBar">
            <div class="w-64 bg-[#161B22] absolute z-30 top-16 p-6 pt-2 right-0 text-[#E6EDF3] shadow-xl border border-t-0.5 border-[#30363D] nav-pop-up-custom-max-h custom-scrollbar">
                {{-- User's image here --}}
                @if(auth()->check())
                    @if(auth()->user()->user_image)
                        <img class="w-[75px] h-[75px] mx-auto rounded-full"  width="800px" height="800px" viewBox="0 0 24 24" src="{{ Auth::user()->user_image ? asset(Auth::user()->user_image) : $default_image }}">
                    @else
                       <svg class="w-[75px] h-[75px] mx-auto" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M12 22.01C17.5228 22.01 22 17.5329 22 12.01C22 6.48716 17.5228 2.01001 12 2.01001C6.47715 2.01001 2 6.48716 2 12.01C2 17.5329 6.47715 22.01 12 22.01Z" fill="#292D32"/>
                            <path d="M12 6.93994C9.93 6.93994 8.25 8.61994 8.25 10.6899C8.25 12.7199 9.84 14.3699 11.95 14.4299C11.98 14.4299 12.02 14.4299 12.04 14.4299C12.06 14.4299 12.09 14.4299 12.11 14.4299C12.12 14.4299 12.13 14.4299 12.13 14.4299C14.15 14.3599 15.74 12.7199 15.75 10.6899C15.75 8.61994 14.07 6.93994 12 6.93994Z" fill="#292D32"/>
                            <path d="M18.7807 19.36C17.0007 21 14.6207 22.01 12.0007 22.01C9.3807 22.01 7.0007 21 5.2207 19.36C5.4607 18.45 6.1107 17.62 7.0607 16.98C9.7907 15.16 14.2307 15.16 16.9407 16.98C17.9007 17.62 18.5407 18.45 18.7807 19.36Z" fill="#292D32"/>
                        </svg>
                    @endif
                @else
                    <svg class="w-[75px] h-[75px] mx-auto" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M12 22.01C17.5228 22.01 22 17.5329 22 12.01C22 6.48716 17.5228 2.01001 12 2.01001C6.47715 2.01001 2 6.48716 2 12.01C2 17.5329 6.47715 22.01 12 22.01Z" fill="#292D32"/>
                        <path d="M12 6.93994C9.93 6.93994 8.25 8.61994 8.25 10.6899C8.25 12.7199 9.84 14.3699 11.95 14.4299C11.98 14.4299 12.02 14.4299 12.04 14.4299C12.06 14.4299 12.09 14.4299 12.11 14.4299C12.12 14.4299 12.13 14.4299 12.13 14.4299C14.15 14.3599 15.74 12.7199 15.75 10.6899C15.75 8.61994 14.07 6.93994 12 6.93994Z" fill="#292D32"/>
                        <path d="M18.7807 19.36C17.0007 21 14.6207 22.01 12.0007 22.01C9.3807 22.01 7.0007 21 5.2207 19.36C5.4607 18.45 6.1107 17.62 7.0607 16.98C9.7907 15.16 14.2307 15.16 16.9407 16.98C17.9007 17.62 18.5407 18.45 18.7807 19.36Z" fill="#292D32"/>
                    </svg>
                @endif 
                
                {{-- User's name here--}}   
                <h3 class="mb-2 text-center font-bold text-lg">
                    @auth
                        @if(Auth::user()->name == null)
                            Guest
                        @else
                            {{ Auth::user()->name }}
                        @endif
                    @endauth
                </h3>
                <div class="flex  text-center gap-1 text-sm">
                        @if(auth()->check())
                            <div class="w-6/12 bg-[#21262D] p-2 rounded-s-lg">{{auth()->user()->position}}</div>
                            <form action="/logout" method="POST" class="w-6/12 rounded-e-lg bg-[#21262D] transition center-text hover:bg-[#292f36]">
                                @csrf
                                <button class="transition hover:text-[#1F6FEB] text-center pt-2">
                                    Logout
                                </button>
                            </form>
                        @else
                            <div class="w-6/12 bg-[#21262D] p-2 rounded-s-lg">Guest</div>
                            <div class="w-6/12 bg-[#21262D] p-2 rounded-r-lg">
                                <a href="/login" class="transition hover:text-[#1F6FEB]">
                                    <button class="text-center">Login</button>
                                </a>
                            </div>
                        @endif
                               
                </div>
                {{-- Home --}}
                <div class="py-2 border-b border-[#30363D] mb-4">
                @auth
                    @if(auth()->user()->position != "User")
                        <a href="/admin/home" id="home">
                            <div @class([
                                'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                                'text-[#1F6FEB]' => request()->is('admin/home'),
                            ])>
                                Home
                            </div>
                        </a>
                    @endif
                @endauth
        
                {{--  Inventory List  --}}
                <a href="/admin/inventory-list" id="inventory-list">
                    <div @class([
                        'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                        'text-[#1F6FEB]' => request()->is('admin/inventory-list*'),
                    ])>
                        Inventory List
                    </div>
                </a>      

                @auth
                    @if(auth()->user()->position != "User")
                    {{--  Employee Profile  --}}
                    <a href="/admin/employee-profile" id="employee-profile">
                        <div @class([
                            'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                            'text-[#1F6FEB]' => request()->is('admin/employee-profile*') || request()->is('register'),
                        ])>
                            Employee Profile
                        </div>
                    </a>
                    @endif       
                @endauth    

                
                @auth
                    @if(auth()->user()->position != "User")
                        {{--  Borrow Request  --}}
                        <a href="/admin/borrow-request" id="borrow-request">
                            <div @class([
                                'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                                'text-[#1F6FEB]' => request()->is('admin/borrow-request*') || 
                                                    request()->is('borrow-request*'),
                            ])>
                                Borrow Request
                            </div>
                        </a>
                    @endif
                @endauth

                {{--  Pending Request  --}}
                @auth
                    <a href="/pending-request" id="borrow-request">
                        @if(auth()->user()->position != "User")
                            <div @class([
                                    'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                                    'text-[#1F6FEB]' => request()->is('pending-request*'),
                                ])>
                                Pending Request
                            </div>
                        @else
                            <div @class([
                                'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                                'text-[#1F6FEB]' => request()->is('pending-request*') ||
                                                    request()->is('borrow-request*'),
                                ])>
                                Pending Request
                            </div>
                        @endif
                    </a>
                @endauth
        
                @auth
                    @if(auth()->user()->position != "User")
                        {{--  History Logs  --}}
                        <a href="/admin/history-logs" id="history-logs">
                            <div @class([
                                'bg-[#161B22] p-2 rounded-lg transition hover:bg-[#292F36] hover:text-[#1F6FEB]',
                                'text-[#1F6FEB]' => request()->is('admin/history-logs'),
                            ])>
                                History Logs
                            </div>
                        </a>
                    @endif
                @endauth
                </div>
                
                <p class="text-xs text-[#8D96A0]">
                    © 2024 GameRental, Inc.
                    <a href="/our-team" class="ml-2 hover:text-[#1F6FEB] hover:underline">
                        About us
                    </a>
                </p>
            </div>           
        </div>
    </div>
</nav>

