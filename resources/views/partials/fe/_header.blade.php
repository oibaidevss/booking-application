{{-- Header --}}
<div class="w-full px-6 mx-auto">
    <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl"
        style="background-image: url('{{asset('assets/img/curved-images/curved0.jpg')}}'); background-position-y: 50%">
        <span
            class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-purple-700 to-pink-500 opacity-60"></span>
    </div>
    <div
        class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-auto max-w-full px-3">
                <div
                    class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                    @if(auth()->user()->avatar)
                        <img class="w-full shadow-soft-sm rounded-xl" src="{{asset('/storage/avatars/'.Auth::user()->avatar)}}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
                    @else
                        <img src="{{asset('assets/img/bruce-mars.jpg')}}" alt="profile_image" class="w-full shadow-soft-sm rounded-xl">
                    @endif
                        
                </div>
            </div>
            <div class="flex-none w-auto max-w-full px-3 my-auto">
                <div class="h-full">
                    <h5 class="mb-1">{{ ucwords(auth()->user()->last_name) }}, {{ ucwords(auth()->user()->first_name) }}</h5>
                    <p class="mb-0 font-semibold leading-normal text-sm">Customer</p>
                </div>
            </div>
            <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                <div class="relative right-0">
                    <ul class="relative flex flex-wrap p-1 list-none bg-transparent rounded-xl" nav-pills=""
                        role="tablist">
                        <li class="z-30 flex-auto text-center">
                            <a class="z-30 block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700"
                                nav-link="" active="" href="{{ route('customer.hotels') }}" role="tab" aria-selected="true">
                                <span class="ml-1">Hotels</span>
                            </a>
                        </li>
                        <li class="z-30 flex-auto text-center">
                            <a class="z-30 block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700"
                                nav-link="" href="{{ route('customer.restaurants') }}" role="tab" aria-selected="false">
                                <span class="ml-1">Restaurants</span>
                            </a>
                        </li>
                        <li class="z-30 flex-auto text-center">
                            <a class="z-30 block w-full px-0 py-1 mb-0 transition-colors border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700"
                                nav-link="" href="#" role="tab" aria-selected="false">
                                <span class="ml-1">Tourist Spots</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('error'))
    <div alert class="relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-to-tl from-red-500 to-rose-400 border-fuchsia-300 session-alert">
      {{ Session::get('error') }}
      <button onclick="document.getElementsByClassName('session-alert')[0].style.display = 'none'" alert-close type="button" class=" mr-4 box-content absolute top-0 right-0 p-4 text-sm text-white bg-transparent border-0 rounded w-4 h-4 z-2">
        <span aria-hidden="true" class="text-center cursor-pointer">&#10005;</span>
      </button>
    </div>
    @endif

    @if(Session::has('success'))
    <div alert class="relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-to-tl from-blue-600 to-cyan-400 border-fuchsia-300 session-alert">
      {{ Session::get('success') }}
      <button onclick="document.getElementsByClassName('session-alert')[0].style.display = 'none'" alert-close type="button" class=" mr-4 box-content absolute top-0 right-0 p-4 text-sm text-white bg-transparent border-0 rounded w-4 h-4 z-2">
        <span aria-hidden="true" class="text-center cursor-pointer">&#10005;</span>
      </button>
    </div>
    @endif
</div>
