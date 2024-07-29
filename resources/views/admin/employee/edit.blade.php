{{--==================== Edit Employee ====================--}}

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
        <form action="/admin/employee-profile/employee/update/{{$user->id}}" method="POST" class="flex flex-col" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            {{-- Title --}}
            
            @if($user->position == 'Admin')
                <h1 class="pb-4 mb-4 border-b border-[#30363D] text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Edit Admin</h1>
            @elseif($user->position == 'Employee')
                <h1 class="pb-4 mb-4 border-b border-[#30363D] text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Edit Employee</h1>
            @else
                <h1 class="pb-4 mb-4 border-b border-[#30363D] text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Edit User</h1>
            @endif

            {{-- Employee Image --}}
            <div class="flex justify-center items-center mx-auto w-[150px] h-[150px] rounded-full bg-[#292F36] mb-4">
                @php 
                    $random_seed = uniqid();
                    $default_image = "https://api.dicebear.com/9.x/pixel-art/svg?seed=" . $random_seed; 
                @endphp

                <img class="rounded-full object-contain h-[150px] w-[150px]" src="{{$user->user_image ? asset($user->user_image) : $default_image}}">
            </div>

            {{-- Input field for name="first_name" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="name" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{$user->name}}">
                @error('name')
                    <p class="text-red-500 text-xs p-1">{{$message}}</p>
                @enderror
            </div>

            {{-- Input field for name="email" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="email" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{$user->email}}">
                @error('email')
                    <p class="text-red-500 text-xs p-1">{{$message}}</p>
                @enderror
            </div>

            {{-- Input field for name="employee_image" --}}
            <div class="mb-8 max-sm:mb-4">
                <label for="user_image" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">User Image</label>
                <input type="file" name="user_image" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{$user->user_image}}">
                @error('user_image')
                    <p class="text-red-500 text-xs p-1">{{$message}}</p>
                @enderror
            </div>
           
            <div class="flex flex-row-reverse gap-3">
          
            {{-- Update button --}}
            <button type="submit" class="w-full mb-4 py-2 text-center text-white bg-[#1F6FEB] hover:bg-[#1A5FC9] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2">Update</button>
        </form>

            {{-- Delete Button --}}
            <form action="/admin/employee-profile/employee/{{$user->id}}" onclick="checker()" method="POST" class="w-full">
                @method('delete')
                @csrf
                <button type="submit" class="w-full mb-4 py-2 text-center text-white bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2">Delete</button>
            </form>

        </div>

        {{-- Cancel button and Resubmission /admin/employee-profile --}}
        <a href="/admin/employee-profile">
            <div class="w-full py-2 text-center text-white bg-[#21262D] hover:bg-[#292F36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">Back</div>
        </a>
    </div>
</div>

@include('partials.footer')