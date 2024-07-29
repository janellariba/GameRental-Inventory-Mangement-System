{{--==================== Add Item ====================--}}

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
        <!-- Title -->
        <h1 class="text-3xl text-center text-[#E6EDF3] max-sm:text-2xl">Category</h1>
    
        <div class="pt-2 mt-4 border-t border-[#30363D]">
            <!-- Options -->
            <fieldset class="flex gap-3 items-center mb-4 max-sm:mb-2">
                <!-- All -->
                <div class="flex items-center">
                    <input id="option-1" type="radio" name="option" value="all" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none" checked>
                    <label for="option-1" class="block ms-2 text-[#E6EDF3]">Add</label>
                </div>
    
                <!-- Selected -->
                <div class="flex items-center">
                    <input id="option-2" type="radio" name="option" value="selected" class="custom-radio w-4 h-4 dark:focus:bg-[#1F6FEB] focus:outline-none">
                    <label for="option-2" class="block ms-2 text-[#E6EDF3]">Modify</label>
                </div>
            </fieldset>
    
            <!-- Add form -->
            <form action="/admin/inventory-list/modify-category/add_category" method="POST" id="add-form">
                @method('PUT')
                @csrf
                <div id="add-section" class="mb-4 max-sm:mb-2">
                    <label for="category_name" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Add</label>
                    <input placeholder="Type item name here" type="text" name="category_name" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2" value="{{ old('category_name') }}">
                    <span class="text-[#B42934] text-xs">@error('category_name') {{$message}}@enderror</span>
                </div>
    
                <!-- Buttons for Add -->
                <div id="add-buttons" class="flex gap-3 w-full">
                    <!-- Cancel button -->
                    <a href="/admin/inventory-list" class="w-full">
                        <div class="py-2 text-white rounded shadow-lg bg-[#21262D] hover:bg-[#292f36] hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm text-center">Back</div>
                    </a>
                    <!-- Add button -->
                    <button type="submit" class="w-full py-2 text-white rounded shadow-lg bg-[#238636] hover:bg-[#1A6328] hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm text-center">Add</button>
                </div>
            </form>
    
            <!-- Modify form -->
            <form action="/admin/inventory-list/modify-category/edit_category" method="POST" id="modify-form">
                @method('PUT')
                @csrf
                <div id="modify-section" class="mb-4 max-sm:mb-2 hidden">
                    <label for="item_category" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Modify</label>
                    <select name="item_category" id="item_category" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none">
                        <option value="" disabled selected hidden>Choose item to modify</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_name }}" {{ old('item_category') == $category->category_name ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-[#B42934] text-xs">@error('item_category') {{$message}}@enderror</span>
                </div>
    
                <div id="rename-section" class="mb-4 max-sm:mb-2 hidden">
                    <label for="rename_category" class="mb-2 text-base text-[#8D96A0] max-sm:text-sm max-sm:mb-1">Rename Category</label>
                    <input type="text" name="rename_category" class="w-full px-4 py-2 text-[#E6EDF3] bg-[#0D1117] border border-[#30363D] rounded focus:outline-none max-sm:py-1 max-sm:px-2" value="{{ old('rename_category') }}">
                    <span class="text-[#B42934] text-xs">@error('rename_category') {{$message}}@enderror</span>
                </div>
    
                <!-- Buttons for Modify -->
                <div id="modify-buttons" class="flex flex-col w-full">
                    <div class="flex gap-3">
                        <!-- Delete button -->
                        <button type="submit" formaction="/admin/inventory-list/modify-category/drop_category" class="mb-4 max-sm:mb-2 w-full py-2 text-white rounded shadow-lg bg-[#B42934] hover:bg-[#91212A] hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm text-center">Delete</button>
                        <!-- Update button -->
                        <button type="submit" class="mb-4 max-sm:mb-2 w-full py-2 text-white rounded shadow-lg bg-[#1F6FEB] hover:bg-[#1A5FC9] hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm text-center">Update</button>
                    </div>
    
                    <a href="/admin/inventory-list" class="w-full">
                        <div class="py-2 text-white rounded shadow-lg bg-[#21262D] hover:bg-[#292f36] hover:shadow-xl transition duration-200 max-sm:py-1 max-sm:text-sm text-center">Back</div>
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    
</div>



@include('partials.footer')
