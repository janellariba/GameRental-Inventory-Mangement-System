<div class="w-full p-5 min-w-96 rounded-lg bg-[#0D1117] border border-[#30363D]">
    {{-------------------- ITEM TABLE ----------------------- }}
    {{---! This file contains callable item list/table for all user !---}}
    <div class="overflow-x-auto relative">
        <table class=" w-full mx-auto text-sm text-left text-gray-500">
            <thead class="">
                <tr>
                    <th scope="col" class="py-1 px-6 text-sm font-normal">
                        
                    </th>
                    <th scope="col" class="py-1 px-6 text-sm font-normal">
                        Item Name
                    </th>
                    <th scope="col" class="py-1 px-6 text-sm font-normal">
                        Brand
                    </th>
                    <th scope="col" class="py-1 px-6 text-sm font-normal">
                        Category
                    </th>
                    <th scope="col" class="py-1 px-6 text-sm font-normal">
                        Customer Code
                    </th>
                    <th scope="col" class="py-1 px-6 text-sm font-normal">
                        Item Code
                    </th>
                    <th scope="col" class="py-1 text-sm font-normal">
                        Status
                    </th>
                    <th scope="col" class="py-1 text-sm text-center font-normal">
                        Edit
                    </th>
                </tr>
            </thead>

            <tbody>
                {{------------------------Items From Database -----------------------}}
                        {{-- Use this to populate tables --}}
                    @foreach($items as $item)
                        <tr class="text-[#E6EDF3] text-base">  
                            <td class="py-2 px-6 border-b border-[#30363D]">
                            {{-- insert item image here --}}
                            <img src="image sample">
                            </td>
                            <td class="list-none py-2 px-6 border-b border-[#30363D]">
                                        <li>{{$item->item_name}}</li>
                            </td>
                            <td class="list-none py-2 px-6 border-b border-[#30363D]">
                                        <li>{{$item->item_brand}}</li>
                            </td>
                            <td class="list-none py-2 px-6 border-b border-[#30363D]">
                                        <li>{{$item->item_category}}</li>
                            </td>
                            <td class="list-none py-2 px-6 border-b border-[#30363D]">
                                        <li>{{$item->item_quantity}}</li>
                            </td>
                            <td class="list-none py-2 px-6 border-b border-[#30363D]">
                                        <li>{{$item->item_status}}</li>
                            </td>
                            <td class="py-2 px-6 border-b border-[#30363D]">
                                {{-- color of status will depend on no. of stocks --}}
                                <div class="flex">
                                    <div class="w-[8px] h-[8px] rounded bg-[#238636] ml-3">   
                                </div>
                            </td>
                            <td class="py-2 px-6 border-b border-[#30363D]">
                                {{-- /admin/inventory-list/item/{{$item->id}} --}}
                                <div class="flex items-center justify-center w-full h-full">
                                    <a href="/admin/inventory-list/item">
                                        <svg class="w-[28px] h-[28px] transition rounded-lg hover:bg-[#21262D] fill-[#8D96A0] hover:fill-[#C9D1D9]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Glyph" version="1.1" xml:space="preserve"><path d="M16,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S17.654,13,16,13z" id="XMLID_287_"/><path d="M6,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S7.654,13,6,13z" id="XMLID_289_"/><path d="M26,13c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S27.654,13,26,13z" id="XMLID_291_"/></svg>
                                    </a>
                                </div>     
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>   
</div>    