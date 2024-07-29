@if(session()->has('delete-message') && session()->has('title'))
<div x-data="{show : true}" x-show="show" x-init="setTimeout(() => show = false,
  5000)" class="bg-[#161B22] fixed bottom-0 z-50 right-0 mr-5 mb-5 border-t-4 border-[#B42934] rounded-b text-[#8D96A0] px-4 py-3 shadow-md" role="alert">
  <div class="flex">
    <div class="py-1">
      <svg class="fill-current h-6 w-6 text-transparent mr-4" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 11V17" stroke="#B42934" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M14 11V17" stroke="#B42934" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M4 7H20" stroke="#B42934" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#B42934" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#B42934" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div>
      <p class="font-bold">{{session('title')}}</p>
      <p class="text-sm">{{session('delete-message')}}</p>
    </div>
  </div>
</div>
@endif