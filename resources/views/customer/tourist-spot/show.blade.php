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

                         @php
                           $centerPoint = [
                            'lat' => $spot->lat,
                            'long' => $spot->long,
                            ];
                       @endphp

                        <x-maps-google 
                            :zoomLevel="20"
                            :centerPoint="$centerPoint"
                            :markers="[
                                [
                                    'lat' => $spot->lat, 
                                    'long' => $spot->long
                                ]
                            ]"></x-maps-google>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</x-theme.auth-layout>
