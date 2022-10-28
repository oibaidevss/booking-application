<x-theme.layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Business') }}
        </h2>
    </x-slot>

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
                        <img src="{{ asset('assets/img/bruce-mars.jpg') }}" alt="profile_image"
                            class="w-full shadow-soft-sm rounded-xl">
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1">{{ ucwords(auth()->user()->last_name) }}, {{ ucwords(auth()->user()->first_name) }}</h5>
                        <p class="mb-0 font-semibold leading-normal text-sm">Business Owner</p>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap justify-between -mx-3">
                            <div class="px-3">
                                <h6 class="mb-0">Business Information</h6>
                            </div>
                            <div class="px-3"> 
                                @if( $business->status == 0 )
                                <h6 class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-red-600 to-rose-400 text-sm bg-clip-text">Not yet verified <i class="far fa-times-circle"></i></h6>
                                @else
                                <h6 class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">Verified <i class="far fa-check-circle"></i></h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        
                        <form action="{{ route('info.update', $business->id) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')

                            <x-form.input :value="$business->name" name="name" label="Business Name" required />
                            <x-form.input :value="$business->email" name="email" label="Email" required />
                            <x-form.input :value="$business->number" name="number" label="Number" required />
                            <x-form.input :value="$business->location" name="location" label="Location" required />

                            <x-form.field>
                                <x-form.label name="description" />
                                <div class="mb-2">
                                <textarea class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="description" id="description"
                                    class="block mt-1 w-full">{{ $business->description }}</textarea>
                                </div>
                                <x-form.error name="description" />
                            </x-form.field>
                                

                            <div class="mt-4">
                                <x-form.button class="button">Submit</x-form.button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            @if (auth()->user()->business_type == "hotel")      
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Rooms</h6>
                            </div>
                            <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                                <a href="{{ route('room.create') }}" data-target="tooltip_trigger" data-placement="top">
                                    <i class="leading-normal fas fa-plus text-sm text-slate-400"
                                        aria-hidden="true"></i>
                                </a>
                                <div data-target="tooltip"
                                    class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm"
                                    role="tooltip"
                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(1063.2px, -19.2px, 0px);"
                                    data-popper-placement="top">
                                    Add New Room
                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                        data-popper-arrow=""
                                        style="position: absolute; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 ps">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Room Number</th>
                                        <th
                                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Floor</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Status</th>

                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($business->rooms as $room)
                                        <tr>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">

                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 leading-normal text-sm">Room
                                                            {{ $room->room_number }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-xs">Floor
                                                    {{ $room->floor }} </p>
                                            </td>
                                            <td
                                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                                <span
                                                    class="bg-gradient-to-tl from-green-600 to-lime-400 text-xs rounded-1.8 p-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Available</span>
                                            </td>

                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex flex-wrap -mx-3">
                                                
                                                <a href="{{ route('room.edit', $room) }}"
                                                    class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500"> Edit
                                                </a>

                                              
                                                
                                                <form method="POST" action="{{ route('room.destroy', $room) }}">
                                                    @csrf
                                                    @method('DELETE')
                                        
                                                    <a class="block ml-2 px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500" href="" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <span class="hidden sm:inline">{{ __('Delete') }}</span>
                                                        </a>
                                        
                                                    </form>
                                                
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ps__rail-x" style="left: 0px; top: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; left: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endif
        
            
            @if (auth()->user()->business_type == "restaurant")
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Tables</h6>
                            </div>
                            <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                                <a href="{{ route('table.create') }}" data-target="tooltip_trigger" data-placement="top">
                                    <i class="leading-normal fas fa-plus text-sm text-slate-400"
                                        aria-hidden="true"></i>
                                </a>
                                <div data-target="tooltip"
                                    class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm"
                                    role="tooltip"
                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(1063.2px, -19.2px, 0px);"
                                    data-popper-placement="top">
                                    Add New Table
                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                        data-popper-arrow=""
                                        style="position: absolute; left: 0px; transform: translate3d(0px, 0px, 0px);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 ps">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Table Number</th>
                                        
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Status</th>

                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($business->tables as $table)
                                        <tr>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">

                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 leading-normal text-sm">Table
                                                            {{ $table->table_number }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td
                                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                                <span
                                                    class="bg-gradient-to-tl from-green-600 to-lime-400 px-3.6 text-xs rounded-1.8 py-2.2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Available</span>
                                            </td>

                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex flex-wrap -mx-3">
                                                
                                                <a href="{{ route('table.edit', $table) }}"
                                                    class="font-semibold leading-tight text-xs text-slate-400"> Edit
                                                </a>

                                                <form method="POST" action="{{ route('table.destroy', $table) }}">
                                                    @csrf
                                                    @method('DELETE')
                
                                                    <button class="font-semibold leading-tight text-xs text-slate-400 px-1">Delete</button>

                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ps__rail-x" style="left: 0px; top: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; left: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endif
            
        </div>
    </div>




</x-theme.layout>
