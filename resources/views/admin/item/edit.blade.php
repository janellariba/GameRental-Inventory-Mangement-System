{{--==================== Edit Item ====================--}}
@include('partials.header')

{{-- Nav --}}
<x-nav/>

<div class="content-center p-20 min-h-screen ml-64 bg-[#0D1117] relative max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24">

    {{-- Back button --}}
    <a href="/admin/employee-profile" class="absolute top-5 left-5 max-sm:invisible hover:scale-105 transition-transform flex p-2 items-center">
        <svg class="transition fill-[#8D96A0] w-[28px] h-[28px]" fill="#000000" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g data-name="Layer 2">
                <g data-name="arrow-ios-back">
                    <rect width="24" height="24" transform="rotate(90 12 12)" opacity="0"/>
                    <path d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64z"/>
                </g>
            </g>
        </svg>
        <span class="text-[#8D96A0] text-lg">Back</span>
    </a>
    
    <div class="p-8 mx-auto max-w-lg bg-[#161B22] border border-[#30363D] rounded-lg shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">

        <form action="/admin/inventory-list/edit/{{$items->item_id}}" method="POST" class="flex flex-col" enctype="multipart/form-data" autocomplete="off">
            @method('PUT')
            @csrf

            {{-- Title --}}
            <h1 class="pb-4 mb-4 border-b border-[#30363D] text-3xl text-center text-[#E6EDF3] max-sm:text-2xl max-sm:mb-2">Edit Item "{{$items->item_name}}"</h1>

            {{-- Item Image --}}
            <div class="flex justify-center items-center mx-auto w-[100px] h-[100px] mb-4">
                @if($items->item_image)
                    <img src="{{ asset($items->item_image) }}" class="rounded-full p-1 object-contain" style="max-height: 100%; max-width: 100%; object-fit: cover; width: 100px; height: 100px;">
                @else
                    <svg class="w-[100px] h-[100px] rounded-full p-2 fill-[#8D96A0] bg-[#292f36]" fill="#000000" width="50px" height="50px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: none;
                                }
                            </style>
                        </defs>
                        <title>no-image</title>
                        <path d="M30,3.4141,28.5859,2,2,28.5859,3.4141,30l2-2H26a2.0027,2.0027,0,0,0,2-2V5.4141ZM26,26H7.4141l7.7929-7.793,2.3788,2.3787a2,2,0,0,0,2.8284,0L22,19l4,3.9973Zm0-5.8318-2.5858-2.5859a2,2,0,0,0-2.8284,0L19,19.1682l-2.377-2.3771L26,7.4141Z" />
                        <path d="M6,22V19l5-4.9966,1.3733,1.3733,1.4159-1.416-1.375-1.375a2,2,0,0,0-2.8284,0L6,16.1716V6H22V4H6A2.002,2.002,0,0,0,4,6V22Z" />
                        <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32" />
                    </svg>
                @endif
            </div>

            {{-- Input field for name="item_name" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_name" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Item name</label>
                <input type="text" name="item_name" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{$items->item_name}}">
            </div>

            {{-- Input field for name="item_brand" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_brand" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Brand</label>
                <input type="text" name="item_brand" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{$items->item_brand}}">
            </div>

            {{-- Input field for name="item_category" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_category" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Category</label>
                <select name="item_category" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2">
                @foreach($categories as $category)
                    <option value="{{ $category->category_name }}" {{ $items->item_category == $category->category_name ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
                
                </select>
            </div>

            {{-- Input field for name="item_quantity" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_quantity" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Quantity</label>
                <input type="number" min="0" name="item_quantity" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2" value="{{$items->item_quantity}}">
            </div>

            {{-- Input field for name="item_status" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_status" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Status</label>
                <select name="item_status" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2">
                    <option value="Available" {{$items->item_status == 'Available' ? 'selected' : ''}}>Available</option>
                    <option value="Not Available" {{$items->item_status == 'Not Available' ? 'selected' : ''}}>Not Available</option>
                </select>
            </div>

            {{-- Input field for name="item_image" --}}
            <div class="mb-8 max-sm:mb-4">
                <label for="item_image" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Item Image</label>
                <input type="file" name="item_image" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded max-sm:py-1 max-sm:px-2">
            </div>
            
            <div class="flex gap-3 flex-row-reverse">
                
            {{-- Update button --}}
            <button type="submit" class="w-full mb-4 py-2 text-center text-white bg-[#1F6FEB] hover:bg-[#1A5FC9] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2">
                Update
            </button>
        </form>

            {{-- Delete button --}}
            <form action="/admin/inventory-list/edit/{{$items->item_id}}" method="POST" class="w-full">
                @method('delete')
                @csrf
                <button onclick="checker()" type="submit" class="w-full mb-4 py-2 text-center text-white bg-[#B42934] hover:bg-[#91212A] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm max-sm:mb-2">
                    Delete
                </button>
            </form>
        </div>

        {{-- Cancel button --}}
        <a href="/admin/inventory-list">
            <div class="py-2 text-center text-white bg-[#21262D] hover:bg-[#292f36] rounded shadow-lg hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm">
                Cancel
            </div>
        </a>
    </div>
</div>

@include('partials.footer')