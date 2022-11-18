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
                                <h6 class="mb-0">Hotel Information</h6>
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
                                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>shop</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(0.000000, 148.000000)">
                                                        <path class="opacity-60"
                                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                        </path>
                                                        <path class=""
                                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <h6 class="mb-1 leading-normal text-sm text-slate-700">{{ $hotel->name }}</h6>
                                    <span class="leading-tight text-xs">{{ $hotel->location }}</span>
                                </div>

                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <p
                                    class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                    {{ $hotel->email }}</p>
                            </div>
                        </div>

                        <img class="w-full my-4 rounded-2xl" src="{{ ($hotel->picture) ? asset("/storage/pictures/hotel/$hotel->id/" . $hotel->picture):asset('/assets/img/home-decor-1.jpg') }}" alt="img-blur-shadow" />

                        <p class="mt-4">{!! $hotel->description !!}</p>
                        


                        <x-maps-google 
                            :zoomLevel="20"
                            :centerPoint="[
                            'lat' => $hotel->lat,
                            'long' => $hotel->long,
                            ]"
                            :markers="[
                                [
                                    'lat' => $hotel->lat, 
                                    'long' => $hotel->long
                                ]
                            ]"></x-maps-google>



                    </div>
                </div>
            </div>
            <div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="mb-0">Room Information</h6>
                    </div>
                    <div class="flex-auto p-4 pt-6">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            @foreach ($hotel->rooms as $room)
                            
                            <li class="">
                                <div class=" p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50">
                                    <div class="relative flex">
                                    <div class="flex flex-col">
                                        <span class="mb-2 leading-tight text-xs">Room Type: <span
                                                class="font-semibold text-slate-700 sm:ml-2">{{ ucwords($room->room_type) }}</span></span>

                                        <span class="mb-2 leading-tight text-xs">Room: <span
                                                class="font-semibold text-slate-700 sm:ml-2">{{ $room->room_number }}</span></span>
                                        <span class="mb-2 leading-tight text-xs">Floor: <span
                                                class="font-semibold text-slate-700 sm:ml-2">{{ $room->floor }}</span></span>
                                    </div>
                                    <div class="ml-auto text-right">

                                        <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
                                            href="{{ route('customer.hotel.booking') }}?hotel={{ $hotel->id }}&room={{ $room->id }}">
                                            <i class="mr-2 fas fa-plus text-white-700" aria-hidden="true"></i>Book this
                                            room</a>
                                    </div>
                                    </div>
                                    <p class="mb-2 leading-tight text-xs">{!! $room->description !!}</p>
                                </div>

                            </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-theme.auth-layout>
