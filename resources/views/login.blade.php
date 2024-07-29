{{--================= Login ====================--}}

@include('partials.header')

<div class="min-h-screen content-center bg-[#0D1117] p-10">

    {{-- Back button of login --}}
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

    <div class="max-w-lg bg-[#161B22] p-8 rounded-lg mx-auto border border-[#30363D] transition-shadow shadow-[1px_1px_50px_rgba(31,111,235,0.5)] hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">
        {{-- Form title --}}
        <div class="pb-2 mb-4 border-b border-[#30363D]">
            <h1 class="text-[#E6EDF3] text-center text-3xl max-sm:text-2xl flex justify-center">Welcome to <span class="mt-1 text-center pl-2"><x-logo-small-login/><span></h1>
        </div>
        <form action="/login/process" method="POST" class="flex flex-col">
            @csrf
            
            {{-- Input field for Email --}}
            <div class="rounded">
                <label for="email" class="block text-[#8D96A0] text-base mb-2 max-sm:text-sm max-sm:mb-1" >Email address</label>
                <input type="email" name="email" id="email" tabindex="1" class="bg-[#0D1117] rounded w-full text-[#E6EDF3] placeholder-[#8D96A0] border border-[#30363D] py-2 px-4 focus:bg-[#0D1117]">
                    @error('email')
                        <p class="text-[#B42934] text-xs p-1">
                            {{ $message }}
                        </p>
                    @enderror
            </div>
            <div class="w-full mb-4"></div>
                
            {{-- Input field for Password --}}
            <div class="rounded">
                <div class="flex justify-between">
                    <label for="password" class="block text-[#8D96A0] text-base mb-2 max-sm:text-sm max-sm:mb-1">Password</label>
                    {{-- Forgot password link here --}}
                    <a href="/forgot_password" tabindex="3" class="text-sm text-[#1F6FEB] max-sm:text-xs max-sm:mb-1 hover:underline transition">Forgot password?</a>
                </div>
                <input type="password" name="password" id="password" tabindex="2" class="bg-[#0D1117] rounded w-full text-[#E6EDF3] placeholder-[#8D96A0] border border-[#30363D] py-2 px-4 focus:bg-[#0D1117]">
                    @error('password')
                        <p class="text-[#B42934] text-xs p-1">
                            {{ $message }}
                        </p>
                    @enderror
            </div>
            <div class="w-full mb-8"></div>

            {{-- Login button --}}
            <button type="submit" tabindex="4" class="rounded bg-[#1F6FEB] hover:bg-[#1f71eb79] text-white font-bold py-2 rouded shadow-lg hover:shadow-xl transition duration-200">Login</button>
        </form>
    </div>
</main>
@include('partials.footer')
