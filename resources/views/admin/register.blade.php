{{--==================== Employee Register ====================--}}

@include('partials.header')

{{-- Nav --}}
<x-nav/>

<div class="content-center p-20 min-h-screen ml-64 bg-[#0D1117] relative max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24">
    
    {{-- Back button --}}
    <a href="/admin/employee-profile" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform">
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

    <div class="p-8 mx-auto max-w-lg bg-[#161B22] border border-[#30363D] rounded-lg shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">
        
        <form action="/admin/register/store" method="POST" class="flex flex-col" enctype="multipart/form-data">
            @csrf
            {{-- Success or Failure Message --}}
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-success">{{ Session::get('fail') }}</div>
            @endif
            @csrf                  

            {{-- Form title --}}
            <h1 class="pb-4 mb-4 border-b border-[#30363D] text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">
                {{ $reg_emp_title }}
            </h1>

            {{-- Input field for Name --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="name" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-[#B42934] text-xs p-1">{{ $message }}</p>
                    @enderror
            </div>

            {{-- Input field for Email --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="email" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Email address</label>
                <input type="email" name="email" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-[#B42934] text-xs p-1">{{ $message }}</p>
                    @enderror
            </div>

            {{-- Input field for Password --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="password" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2">
                    @error('password')
                        <p class="text-[#B42934] text-xs p-1">{{ $message }}</p>
                    @enderror
            </div>

            {{-- Input field for Password Confirmation --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="password_confirmation" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Confirm password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2">    
                    @error('password_confirmation')
                        <p class="text-[#B42934] text-xs p-1">{{ $message }}</p>
                    @enderror
            </div>

            <div class="flex gap-3">
                {{-- Employee image --}}
                <div class="mb-8 max-sm:mb-4 w-full">
                    <label for="user_image" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Employee Image</label>
                    <input type="file" name="user_image" id="user_image" class="hidden">
                    <label for="user_image" class="w-full inline-block px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded cursor-pointer max-sm:py-1 max-sm:px-2">
                        Choose File
                    </label>
                        @error('user_image')
                            <p class="text-[#B42934] text-xs p-1">{{ $message }}</p>
                        @enderror
                </div>

                    {{-- Select status --}}
                    @if(auth()->user()->position == 'Admin')
                        <div class="mb-8 max-sm:mb-4 w-full">
                            <label for="position" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Status</label>
                            <select name="position" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2">
                                <option value="User">User</option>
                                <option value="Employee">Employee</option>
                            </select>
                            @error('position')
                                <p class="text-[#B42934] text-xs p-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <div class="mb-8 max-sm:mb-4 w-full">
                            <label for="position" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Status</label>
                            <select name="position" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2">
                                <option value="User">User</option>
                            </select>
                            @error('position')
                                <p class="text-[#B42934] text-xs p-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
            </div>
            
            <div class="flex gap-3">
                {{-- Cancel button --}}
                <a href="/admin/employee-profile" class="w-full">
                    <div class="py-2 text-center bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                        Cancel
                    </div>
                </a>

                {{-- Register button --}}
                <button type="submit" class="w-full py-2 text-center text-white bg-[#238636] hover:bg-[#1A6328] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">Register</button>
            </div>            
        </form>
        
    </div>
</div>

@include('partials.footer')