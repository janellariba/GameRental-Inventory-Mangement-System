{{--==================== Our team ====================--}}

@include('partials.header')

{{-- Nav --}}

<div class="content-center items-center p-20 min-h-screen min-w-screen min-full bg-[#0D1117] max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24 relative">
    
    @auth
        @if(auth()->user()->position)
            @if(auth()->user()->position == 'Admin' || auth()->user()->position == 'Employee')
                {{-- Back button --}}
                <a href="/" class="absolute top-5 left-5 hover:scale-105 transition-transform">
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
            @else(auth()->user()->position == 'User')
                <a href="/admin/inventory-list" class="absolute top-5 left-5 hover:scale-105 transition-transform">
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
        @endif
    @else
        <a href="/" class="absolute top-5 left-5 hover:scale-105 transition-transform">
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
    @endauth

    <style>
        .card {
            transition: all 0.3s ease-in-out;
            overflow: hidden;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    
        .description {
            display: block;
            max-height: 5em;
            transition: max-height 0.3s ease-in-out;
            overflow: hidden;
        }
    
        .card:hover .description {
            max-height: 20em;
        }
    </style>

    {{-- Header --}}
    <div class="header text-center text-xl border-b border-[#30363D] text-[#E6EDF3] px-8 max-sm:px-4 mb-6 max-sm:mb-5">
        <h1 class="mb-6 text-6xl max-sm:text-4xl max-sm:mb-3">Meet the team</h1>    
        <p class="mb-6 font-light text-xl max-sm:text-sm max-sm:mb-5">The team comprises Computer Engineering Interns who have been assigned the task of developing various websites and systems to enhance their skills for future endeavors. For this project, their objective was to create an inventory system, which they have accomplished according to their respective expertise.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-10 mx-auto w-full items-center text-[#8D96A0] max-sm:gap-5">
    
        {{-- Edward --}}
        <div class="card p-8 w-full text-center max-w-96 border border-[#30363D] rounded-lg hover:shadow-[1px_1px_50px_rgba(31,111,235,0.5)] hover:text-[#E6EDF3] hover:scale-105 max-sm:p-4">
            <img src="{{ asset('storage\teams-images\edward.png') }}" alt="Team Member Edward" class="w-[150px] h-[150px] rounded-full object-cover transition hover:shadow-[1px_1px_25px_rgba(31,111,235,0.5)] hover:scale-105 mx-auto max-sm:h-[100px] max-sm:w-[100px]">
            <div class="py-4 mt-8 mb-4 border-y border-[#30363D] max-sm:mt-4">
                <h1 class="text-3xl max-sm:text-2xl text-[#E6EDF3]">Edward Joseph Padua</h1>
                <h2 class="text-base text-[#8D96A0] max-sm:text-sm mb-4">Backend Developer</h2>
                <p class="description mx-2 text-sm line-clamp-4 hover:line-clamp-none hover:text-[#E6EDF3] max-sm:text-xs">He primarily focuses on the functionality of the system, overseeing the implementation of various features that enhance the user experience when exploring the inventory system. These includes various functions such as navigation functions, security and accessibility, and many more.</p>
            </div>

            <div class="flex justify-center items-center mr-1 gap-1">
                {{-- Github --}}
                <a href="https://github.com/EdwardJosephPadua" target="_blank">
                    <x-github-svg/>
                </a>                

                {{-- Linked In --}}
                <a href="https://www.linkedin.com/in/padua-edward-joseph-a7b3472ab/" target="_blank">
                    <x-linkedin-svg/>
                </a>                
            </div>            
        </div>

        {{-- Adrianne --}}
        <div class="card p-8 w-full text-center max-w-96 border border-[#30363D] rounded-lg hover:shadow-[1px_1px_50px_rgba(31,111,235,0.5)] hover:text-[#E6EDF3] hover:scale-105 max-sm:p-4">
            <img src="{{ asset('storage\teams-images\adrianne.png') }}" alt="Team Member Adrianne" class="w-[150px] h-[150px] rounded-full object-cover transition hover:shadow-[1px_1px_25px_rgba(31,111,235,0.5)] hover:scale-105 mx-auto max-sm:h-[100px] max-sm:w-[100px]">
            <div class="py-4 mt-8 mb-4 border-y border-[#30363D] max-sm:mt-4">
                <h1 class="text-3xl max-sm:text-2xl text-[#E6EDF3]">Adrianne Bagadiong</h1>
                <h2 class="text-base text-[#8D96A0] max-sm:text-sm mb-4">Backend Developer</h2>
                <p class="description mx-2 text-sm line-clamp-4 hover:line-clamp-none hover:text-[#E6EDF3] max-sm:text-xs">He primarily focuses on the functionality of the system, overseeing the implementation of various features that enhance the user experience when exploring the inventory system. These includes various functions such as navigation functions, security and accessibility, and many more.</p>
            </div>

            <div class="flex justify-center items-center mr-1 gap-1">
                {{-- Github --}}
                <a href="https://github.com/AddyLng" target="_blank">
                    <x-github-svg/>
                </a>                

                {{-- Linked In --}}
                <a href="https://www.linkedin.com/in/adriannebagadiong/" target="_blank">
                    <x-linkedin-svg/>
                </a>                
            </div>            
        </div>

        {{-- Aaron --}}
        <div class="card p-8 w-full text-center max-w-96 border border-[#30363D] rounded-lg hover:shadow-[1px_1px_50px_rgba(31,111,235,0.5)] hover:text-[#E6EDF3] hover:scale-105 max-sm:p-4">
            <img src="{{ asset('storage\teams-images\aaron.png') }}" alt="Team Member Aaron" class="w-[150px] h-[150px] rounded-full object-cover transition hover:shadow-[1px_1px_25px_rgba(31,111,235,0.5)] hover:scale-105 mx-auto max-sm:h-[100px] max-sm:w-[100px]">
            <div class="py-4 mt-8 mb-4 border-y border-[#30363D] max-sm:mt-4">
                <h1 class="text-3xl max-sm:text-2xl text-[#E6EDF3]">Aaron Alcuizar</h1>
                <h2 class="text-base text-[#8D96A0] max-sm:text-sm mb-4">Frontend Developer</h2>
                <p class="description mx-2 text-sm line-clamp-4 hover:line-clamp-none hover:text-[#E6EDF3] max-sm:text-xs">One of the individuals in charge of the front-end of the system meticulously oversees the creation of its aesthetic appeal to ensure optimal viewing comfort for users. Additionally, he implements various functionalities aimed at enhancing navigation and overall user experience.</p>
            </div>

            <div class="flex justify-center items-center mr-1 gap-1">
                {{-- Github --}}
                <a href="https://github.com/aaronpogi2003" target="_blank">
                    <x-github-svg/>
                </a>                

                {{-- Linked In --}}
                <a href="https://www.linkedin.com/in/aaron-alcuizar" target="blank">
                    <x-linkedin-svg/>
                </a>                
            </div>            
        </div>

    {{-- Janel --}}
    <div class="card p-8 w-full text-center max-w-96 border border-[#30363D] rounded-lg hover:shadow-[1px_1px_50px_rgba(31,111,235,0.5)] hover:text-[#E6EDF3] hover:scale-105 max-sm:p-4">
        <img src="{{ asset('storage\teams-images\janel.png') }}" alt="Team Member Janel" class="w-[150px] h-[150px] rounded-full object-cover transition hover:shadow-[1px_1px_25px_rgba(31,111,235,0.5)] hover:scale-105 mx-auto max-sm:h-[100px] max-sm:w-[100px]">
        <div class="py-4 mt-8 mb-4 border-y border-[#30363D] max-sm:mt-4">
            <h1 class="text-3xl max-sm:text-2xl text-[#E6EDF3]">Janel Lariba</h1>
            <h2 class="text-base text-[#8D96A0] max-sm:text-sm mb-4">Frontend Developer</h2>
            <p class="description mx-2 text-sm line-clamp-4 hover:line-clamp-none hover:text-[#E6EDF3] max-sm:text-xs">She oversees ensuring that the interface of the system fits its intended theme and purpose. She designs and creates various interfaces within the system that attract user attention during usage. Additionally, she is responsible for making the site more responsive for the sake of user enjoyment and usability.</p>
        </div>

        <div class="flex justify-center items-center mr-1 gap-1">
            {{-- Github --}}
            <a href="https://github.com/janellariba" target="blank">
                <x-github-svg/>
            </a>                

            {{-- Linked In --}}
            <a href="https://www.linkedin.com/in/janel-lariba-bb667530b" target="blank">
                <x-linkedin-svg/>
            </a>                
        </div>            
    </div>

@include('partials.footer')