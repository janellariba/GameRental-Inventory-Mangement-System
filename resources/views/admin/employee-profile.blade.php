{{--==================== Employee Profile ====================--}}

@include('partials.header')

{{-- Nav --}}
<x-nav/>

<div class="min-h-screen flex flex-col ml-60 p-20 pl-24 text-[#E6EDF3] bg-[#0D1117] max-lg:ml-0 max-lg:p-4 max-xl:p-10 max-xl:pl-14 max-lg:pt-20">
        
    {{-- Header --}}
    <div class="w-full">
        <div class="flex flex-wrap justify-between mb-4 max-sm:justify-center">
            {{-- Section title --}}
            <h1 class="text-4xl max-sm:pb-4 max-sm:text-3xl">
                Employee Profile
            </h1>
            <div class="flex max-sm:w-full">

                {{-- Register button --}}
                @if(auth()->user()->position == 'Admin' || auth()->user()->position == 'Employee')
                    <div class="flex items-center mr-4 bg-[#21262D] border border-[#30363D] text-[#C9D1D9] rounded-lg max-h-11">
                        {{-- Link to employee register page --}}
                        <a href="/register">
                            <div class="py-2 px-4 rounded-lg text-[#C9D1D9] transition hover:bg-[#238636]">
                                Register
                            </div>
                        </a>
                    </div>
                @else
                    <div class="items-center mr-4 bg-[#21262D] border border-[#30363D] text-[#C9D1D9] rounded-lg max-h-11 hidden">
                        {{-- Link to employee register page --}}
                        <a href="/register">
                            <div class="py-2 px-8 rounded-lg text-[#C9D1D9] transition hover:bg-[#238636]">
                                Register
                            </div>
                        </a>
                    </div>
                @endif

                {{-- Search bar --}}
                @include('components.search-bar')
            </div>
        </div>
    </div>

    {{-- Employee table show here --}}
    <div class="p-5 pr-3 flex flex-grow rounded-lg border border-[#30363D] bg-[#0D1117] h-full max-sm:p-3 min-h-96">
        <div class="relative w-full p-5 pr-3 flex-grow overflow-hidden max-sm:p-3">
            <div class="absolute top-0 left-0 w-full custom-max-h pr-3 overflow-y-auto custom-scrollbar h-full">
                <table class="w-full mx-auto text-sm text-left text-gray-500 table-fixed">
                    <thead class="sticky-header">
                        <tr>
                            <th scope="col" style="width: 75px;">
                            </th>
                            {{-- Name --}}
                            <th scope="col" style="width: 200px;">
                                <a href="/admin/employee-profile/sort_name" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded flex items-center w-max">
                                    Name
                                    <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                            width="10px" height="10px" viewBox="0 0 562.392 562.391"
                                            xml:space="preserve" class="ml-1">
                                        <g>
                                            <g>
                                                <path d="M123.89,262.141h314.604c19.027,0,17.467-31.347,15.496-47.039c-0.605-4.841-3.636-11.971-6.438-15.967L303.965,16.533
                                                    c-12.577-22.044-32.968-22.044-45.551,0L114.845,199.111c-2.803,3.996-5.832,11.126-6.438,15.967
                                                    C106.43,230.776,104.863,262.141,123.89,262.141z"/>
                                                <path d="M114.845,363.274l143.569,182.584c12.577,22.044,32.968,22.044,45.551,0l143.587-182.609
                                                    c2.804-3.996,5.826-11.119,6.438-15.967c1.971-15.691,3.531-47.038-15.496-47.038H123.89c-19.027,0-17.46,31.365-15.483,47.062
                                                    C109.019,352.147,112.042,359.277,114.845,363.274z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </th>
                            {{-- Email --}}
                            <th scope="col" style="width: 150px;" class="py-1 text-sm font-normal">
                                Email
                            </th>
                            {{-- Position --}}
                            <th scope="col" style="width: 100px;">
                                <a href="/admin/employee-profile/sort_position" onclick="" class="py-1 px-1 text-sm font-normal hover:bg-[#21262D] transition rounded w-max flex items-center">
                                    Position
                                    <svg fill="#8d96a0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        width="10px" height="10px" viewBox="0 0 562.392 562.391"
                                        xml:space="preserve" class="ml-1">
                                    <g>
                                        <g>
                                            <path d="M123.89,262.141h314.604c19.027,0,17.467-31.347,15.496-47.039c-0.605-4.841-3.636-11.971-6.438-15.967L303.965,16.533
                                                c-12.577-22.044-32.968-22.044-45.551,0L114.845,199.111c-2.803,3.996-5.832,11.126-6.438,15.967
                                                C106.43,230.776,104.863,262.141,123.89,262.141z"/>
                                            <path d="M114.845,363.274l143.569,182.584c12.577,22.044,32.968,22.044,45.551,0l143.587-182.609
                                                c2.804-3.996,5.826-11.119,6.438-15.967c1.971-15.691,3.531-47.038-15.496-47.038H123.89c-19.027,0-17.46,31.365-15.483,47.062
                                                C109.019,352.147,112.042,359.277,114.845,363.274z"/>
                                        </g>
                                    </g>
                                    </svg>
                                </a>
                            </th>
                            {{-- Edit --}}
                            @if(auth()->user()->position == 'Admin')
                                <th scope="col" style="width: 100px;" class="py-1 text-sm font-normal text-center">
                                    <div class="flex justify-center items-center h-full">
                                        Edit
                                    </div>
                                </th>
                            @else
                                <th scope="col" style="width: 100px;" class="py-1 text-sm text-center font-normal hidden">
                                    Edit
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Employee table values --}}
                        {{-- Use this to populate tables --}}
                        @foreach ($users as $user)
                            
                            @php $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$user->name.".svg" @endphp
                            <tr class="text-base text-[#E6EDF3]">  
                                <td class="px-3 py-1 border-b border-[#30363D]" style="width: 75px;">
                                    <div class="flex justify-center items-center h-[50px] w-[50px]">
                                        @if($user->user_image)
                                            <img class="rounded-full p-1 object-contain" style="max-height: 100%; max-width: 100%; width: 100%; height: 100%; object-fit: cover;" src="{{ $user->user_image ? asset($user->user_image) : $default_profile }}">
                                        @else
                                            <svg class="w-[75px] h-[75px] mx-auto" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4" d="M12 22.01C17.5228 22.01 22 17.5329 22 12.01C22 6.48716 17.5228 2.01001 12 2.01001C6.47715 2.01001 2 6.48716 2 12.01C2 17.5329 6.47715 22.01 12 22.01Z" fill="#292D32"/>
                                                <path d="M12 6.93994C9.93 6.93994 8.25 8.61994 8.25 10.6899C8.25 12.7199 9.84 14.3699 11.95 14.4299C11.98 14.4299 12.02 14.4299 12.04 14.4299C12.06 14.4299 12.09 14.4299 12.11 14.4299C12.12 14.4299 12.13 14.4299 12.13 14.4299C14.15 14.3599 15.74 12.7199 15.75 10.6899C15.75 8.61994 14.07 6.93994 12 6.93994Z" fill="#292D32"/>
                                                <path d="M18.7807 19.36C17.0007 21 14.6207 22.01 12.0007 22.01C9.3807 22.01 7.0007 21 5.2207 19.36C5.4607 18.45 6.1107 17.62 7.0607 16.98C9.7907 15.16 14.2307 15.16 16.9407 16.98C17.9007 17.62 18.5407 18.45 18.7807 19.36Z" fill="#292D32"/>
                                            </svg>
                                        @endif
                                    </div>
                                </td>
                                <td class="border-b border-[#30363D] px-5" style="width: 200px;">
                                    {{-- Insert employee name here --}}
                                    <div class="!truncate" title="{{$user->name}}">
                                        {{$user->name}}
                                    </div>
                                </td>
                                <td class="px-4 border-b border-[#30363D]" style="width: 150px;">
                                    {{-- Insert employee email here --}}
                                    <div class="!truncate" title="{{$user->email}}">
                                        {{$user->email}}
                                    </div>
                                </td>
                                <td class="px-5 border-b border-[#30363D]" style="width: 100px;">
                                    {{-- Insert employee email here --}}
                                    {{$user->position}}
                                </td>
                                @if(auth()->user()->position == 'Admin')
                                    <td class="px-3 text-center border-b border-[#30363D]">
                                        {{-- /admin/employee-profile/employee/{{$employee->id}} --}}
                                        <div class="flex items-center justify-center w-full h-full">
                                            <a href="/admin/employee-profile/employee/{{$user->id}}">
                                                <svg class="w-[28px] h-[28px] transition rounded-lg hover:bg-[#21262D] fill-[#8D96A0] hover:fill-[#C9D1D9]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Glyph" version="1.1" xml:space="preserve"><path d="M16,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S17.654,13,16,13z" id="XMLID_287_"/><path d="M6,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S7.654,13,6,13z" id="XMLID_289_"/><path d="M26,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S27.654,13,26,13z" id="XMLID_291_"/></svg>
                                            </a>
                                        </div>
                                    </td>
                                @else
                                    <td class="px-3 text-center border-b border-[#30363D] hidden">
                                        {{-- /admin/employee-profile/employee/{{$employee->id}} --}}
                                        <div class="flex items-center justify-center w-full h-full">
                                            <a href="/admin/employee-profile/employee/{{$user->id}}">
                                                <svg class="w-[28px] h-[28px] transition rounded-lg hover:bg-[#21262D] fill-[#8D96A0] hover:fill-[#C9D1D9]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Glyph" version="1.1" xml:space="preserve"><path d="M16,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S17.654,13,16,13z" id="XMLID_287_"/><path d="M6,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S7.654,13,6,13z" id="XMLID_289_"/><path d="M26,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S27.654,13,26,13z" id="XMLID_291_"/></svg>
                                            </a>
                                        </div>
                                    </td>
                                @endif 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>           
        </div>
    </div>
    
</div>

@include('partials.footer')