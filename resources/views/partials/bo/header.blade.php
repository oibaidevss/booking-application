    <div class="w-full px-6 mx-auto">
        <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl"
            style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%">
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
                            <img class="w-full shadow-soft-sm rounded-xl" src="{{ asset('/storage/avatars/'.auth()->user()->id.'/'.Auth::user()->avatar)}}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
                        @else
                            <img src="{{asset('assets/img/bruce-mars.jpg')}}" alt="profile_image" class="w-full shadow-soft-sm rounded-xl">
                        @endif
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1">{{ ucwords(auth()->user()->first_name) }} {{ ucwords(auth()->user()->last_name) }}</h5>
                        @role('admin')
                        <p class="mb-0 font-semibold leading-normal text-sm">Administrator</p>
                        @else
                        <p class="mb-0 font-semibold leading-normal text-sm">Business Owner</p>
                        @endrole
                    </div>
                </div>
                <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                    
                </div>
            </div>
        </div>
    </div>


