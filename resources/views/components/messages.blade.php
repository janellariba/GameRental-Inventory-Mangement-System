<!-- galing sa request from documentation, i chcheck kung existing ba ung session na message, pag existing sya, pwede tayo mag display ng session -->
@if(session()->has('message'))
<div x-data="{show : true}" x-show="show" x-init="setTimeout(() => show = false,
  5000)" class="bg-[#161B22] fixed bottom-0 z-50 right-0 mr-5 mb-5 border-t-4 border-[#1F6FEB] rounded-b text-[#8D96A0] px-4 py-3 shadow-md" role="alert">
  <div class="flex">
    <div class="py-1">
      <svg class="fill-current h-6 w-6 text-[#1F6FEB] mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
      </svg>
    </div>
    <div>
      <p class="font-bold">Alert Message</p>
      <p class="text-sm">{{session('message')}}</p>
    </div>
  </div>
</div>
@endif