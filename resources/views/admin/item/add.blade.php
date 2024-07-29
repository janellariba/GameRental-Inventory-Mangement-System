{{--==================== ADD ITEM ====================--}}

@include('partials.header')

{{-- Nav --}}
<x-nav/>

<div class="relative min-h-screen ml-64 p-20 bg-[#0D1117] max-lg:ml-0 max-lg:p-10 max-lg:pt-28 max-sm:pt-24 content-center">
    
    {{-- Back button --}}
    <a href="/admin/inventory-list" class="absolute top-5 left-5 max-sm:invisible transition-transform hover:scale-105">
        <div class="flex items-center p-2">
            <svg class="w-[28px] h-[28px] fill-[#8D96A0] transition" fill="#000000" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <g data-name="Layer 2">
                    <g data-name="arrow-ios-back">
                        <rect width="24" height="24" transform="rotate(90 12 12)" opacity="0"/>
                        <path d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64z"/>
                    </g>
                </g>
            </svg>
            <span class="text-lg text-[#8D96A0]">Back</span>
        </div>                   
    </a>

    <div class="p-8 mx-auto max-w-lg bg-[#161B22] border border-[#30363D] rounded-lg shadow-[1px_1px_50px_rgba(31,111,235,0.5)] transition-shadow hover:shadow-[1px_1px_75px_rgba(31,111,235,0.75)] max-sm:p-5">
        <form action="/admin/inventory-list/add" method="POST" class="flex flex-col" enctype="multipart/form-data" autocomplete="off">
            @method("PUT")
            @csrf

            {{-- Title --}}
            <h1 class="pb-4 mb-4 text-3xl text-center text-[#E6EDF3] border-b border-[#30363D] max-sm:mb-2 max-sm:text-2xl">
                Add an item
            </h1>
            
            {{-- Input field for name="item_name" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_name" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Item name</label>
                <input type="text" name="item_name" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2" value="{{old('item_name')}}">
                <span class="text-[#B42934] text-xs">@error('item_name') {{$message}}@enderror</span>
            </div>

            {{-- Input field for name="brand" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_brand" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Brand</label>
                <input type="text" name="item_brand" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2" value="{{old('item_brand')}}">
                <span class="text-[#B42934] text-xs">@error('item_brand') {{$message}}@enderror</span>
            </div>

            {{-- Input field for name="category" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_category" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Category</label>
                <select name="item_category" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                {{-- filling up drop down values --}}
                @foreach($categories as $category)
                    <option value="{{ $category->category_name }}" {{ old('item_category') == $category->category_name ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
                </select>
                <span class="text-[#B42934] text-xs">@error('item_category') {{$message}}@enderror</span>
            </div>

            {{-- Input field for name="quantity" --}}
            <div class="mb-4 max-sm:mb-2">
                <label for="item_quantity" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Quantity</label>
                <input type="number" min="0" name="item_quantity" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2" value="{{old('item_quantity')}}">
                <span class="text-[#B42934] text-xs">@error('item_quantity') {{$message}}@enderror</span>
            </div>

            {{-- Input field for name="item_image" --}}
            <div class="mb-8 max-sm:mb-4">
                <label for="item_image" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Item Image</label>
                <input type="file" name="item_image" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2">
                @error('student_image')
                    <p class="text-xs text-red-500 p-1">{{$message}}</p>
                @enderror
                <span class="text-[#B42934] text-xs">@error('name') {{$message}}@enderror</span>
            </div>

            <div class="flex gap-3 w-full">
                {{-- Cancel button and Resubmission --}}
                <a href="/admin/inventory-list" class="w-full ">
                    <div class="py-2 text-white bg-[#B42934] rounded shadow-lg hover:bg-[#91212A] hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm text-center">
                        Cancel
                    </div>
                </a>
                    {{-- Add item button --}}
                <button type="submit" class="w-full py-2 text-white bg-[#238636] rounded shadow-lg hover:bg-[#1A6328] hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm text-center">
                    Add
                </button>            
            </div>
           
        </form>
    </div>
</div>

@include('partials.footer')