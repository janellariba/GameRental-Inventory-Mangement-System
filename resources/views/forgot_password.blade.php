{{--================= Forgot Password ====================--}}

@include('partials.header')

<div class="min-h-screen content-center bg-[#0D1117] p-10">

    {{-- Back button for forgot password--}}
    <a href="/admin/inventory-list" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
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
        <h1 class="text-[#E6EDF3] text-center text-3xl pb-2 mb-4 border-b border-[#30363D] max-sm:text-2xl">Forgot Password? </h1>
        
        <form action="{{route('forget.password.post')}}" method="POST" class="flex flex-col">
            @csrf
            {{-- Input field for Email --}}
            <div class="rounded mb-4">
                <label for="email" class="block text-[#8D96A0] text-base mb-2 max-sm:text-sm max-sm:mb-1" >Enter your email address</label>
                <input type="email" name="email" id="email" tabindex="1" class="bg-[#0D1117] rounded w-full text-[#E6EDF3] placeholder-[#8D96A0] border border-[#30363D] py-2 px-4 focus:bg-[#0D1117]">
            @error('email')
                <p class=" text-[#B42934] text-xs p-1">
                    {{ $message }}
                </p>
            @enderror
            </div>
            {{-- Login button --}}
            <button type="submit" tabindex="4" class="rounded bg-[#1F6FEB] hover:bg-[#1f71eb79] text-white font-bold py-2 rouded shadow-lg hover:shadow-xl transition duration-200">Verify</button>
        </form>
    </div>
    
</main>
@include('partials.footer')

