<x-theme.auth-layout>
    @include('partials.fe._header')
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
                <div
                    class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                                <h6 class="mb-0">Tourist Spot Information</h6>
                            </div>
                            <div class="flex items-center justify-end max-w-full px-3 md:w-1/2 md:flex-none">
                                <i class="mr-2 far fa-calendar-alt" aria-hidden="true"></i>
                                <small></small>
                            </div>
                        </div>
                    </div>

                    <div class="my-4 px-4 w-100">

                        <a href="{{ route('customer.spot.booking', $spot) }}"
                        class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">Book this now</a>

                    </div>
                        
                    <div class="flex-auto p-4 pt-6 relative">


                        <div
                            class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                            <div class="flex items-center">
                                <div
                                    class="bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                                    <i class="fa fa-map text-white"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h6 class="mb-1 leading-normal text-sm text-slate-700">{{ $spot->name }}</h6>
                                    <span class="leading-tight text-xs">{{ $spot->location }}</span>
                                </div>

                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <p
                                    class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                    {{ $spot->email }}</p>
                            </div>
                        </div>

                        <img class="w-full my-4 rounded-2xl" src="{{ ($spot->picture) ? asset("/storage/pictures/spot/$spot->id/" . $spot->picture):asset('/assets/img/home-decor-1.jpg') }}" alt="img-blur-shadow" />

                        <p class="mt-4">{!! $spot->description !!}</p>

                        
                        @if ($spot->lat != '' && $spot->long != '')
                        <x-maps-leaflet 
                            :zoomLevel="20"
                            :centerPoint="[
                            'lat' => $spot->lat,
                            'long' => $spot->long,
                            ]"
                            :markers="[
                                [
                                    'lat' => $spot->lat, 
                                    'long' => $spot->long
                                ]
                            ]"></x-maps-leaflet>
                            @endif
                    </div>

                    <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                                <h6 class="mb-0">Feedbacks</h6>
                            </div>
                          
                        </div>
                    </div>

                    <div class="flex-auto p-4 pt-2 relative">

                        <form action="{{ route('customer.spot.feedback.store') }}" method="POST" >
                            @csrf

                            <input type="hidden" name="tourist_spot_id" value="{{$spot->id}}">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">


                            <div class=" ">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700" for="feedback">Leave a Feedbacks</label>
                                <div class="mb-2 block">

                                    <textarea class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    name="feedback" id="feedback" cols="30" rows="10"></textarea>
                                </div>


                                 <div class="mt-4 px-2">
                                    <x-form.button class="button">Submit</x-form.button>
                                </div>
                            </div>
                        </form>


                        <div class="mt-6">                            
                            @foreach ($feedbacks as $feedback)
                                <div class="">
                                    <p class="mb-2 leading-tight text-xs font-bold">{{ $feedback->feedback }}</p>
                                    <p class="text-sm text-rose-600">{{ $feedback->user->email }}</p>
                                </div>
                            @endforeach

                            {{ $feedbacks->links() }}
                        </div>

                    </div>
                </div>
            </div>
            

        </div>
    </div>
</x-theme.auth-layout>
