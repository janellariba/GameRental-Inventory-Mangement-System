<!-- galing sa request from documentation, i chcheck kung existing ba ung session na message, pag existing sya, pwede tayo mag display ng session -->
@if(session()->has('error'))
<div x-data="{show : true}" x-show="show" x-init="setTimeout(() => show = false,
  5000)" class="bg-[#161B22] fixed bottom-0 z-50 right-0 mr-5 mb-5 border-t-4 border-[#B42934] rounded-b text-[#8D96A0] px-4 py-3 shadow-md" role="alert">
  <div class="flex">
    <div class="py-1">
        <svg class="fill-current h-6 w-6 text-transparent mr-2" width="800px" height="800px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>error</title>
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="add" fill="#B42934" transform="translate(42.666667, 42.666667)">
                  <path d="M213.333333,3.55271368e-14 C331.136,3.55271368e-14 426.666667,95.5306667 426.666667,213.333333 C426.666667,331.136 331.136,426.666667 213.333333,426.666667 C95.5306667,426.666667 3.55271368e-14,331.136 3.55271368e-14,213.333333 C3.55271368e-14,95.5306667 95.5306667,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C119.232,42.6666667 42.6666667,119.232 42.6666667,213.333333 C42.6666667,307.434667 119.232,384 213.333333,384 C307.434667,384 384,307.434667 384,213.333333 C384,119.232 307.434667,42.6666667 213.333333,42.6666667 Z M262.250667,134.250667 L292.416,164.416 L243.498667,213.333333 L292.416,262.250667 L262.250667,292.416 L213.333333,243.498667 L164.416,292.416 L134.250667,262.250667 L183.168,213.333333 L134.250667,164.416 L164.416,134.250667 L213.333333,183.168 L262.250667,134.250667 Z" id="error"></path>
              </g>
          </g>
      </svg>
    </div>
 
    <div>
      <p class="font-bold">Error</p>
      <p class="text-sm">{{session('error')}}</p>
    </div>
  </div>
</div>
@endif