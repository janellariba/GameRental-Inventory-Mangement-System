@if(session()->has('add-message') && session()->has('title'))
<div x-data="{show : true}" x-show="show" x-init="setTimeout(() => show = false,
  5000)" class="bg-[#161B22] fixed bottom-0 z-50 right-0 mr-5 mb-5 border-t-4 border-[#238636] rounded-b text-[#8D96A0] px-4 py-3 shadow-md" role="alert">
  <div class="flex">
    <div class="py-1">
      <svg class="h-6 w-6 mr-4 text-transparent" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#238636" stroke-width="2"/>
        <path d="M9 12L10.6828 13.6828V13.6828C10.858 13.858 11.142 13.858 11.3172 13.6828V13.6828L15 10" stroke="#238636" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg> 
    </div>
    <div>
      <p class="font-bold">{{session('title')}}</p>
      <p class="text-sm">{{session('add-message')}}</p>
    </div>
  </div>
</div>
@endif