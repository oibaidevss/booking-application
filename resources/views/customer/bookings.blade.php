<x-theme.auth-layout>

    @include('partials.fe._header')
    {{-- @foreach ($user->bookings as $booking)
        {{ $booking->start_date }}
    @endforeach --}}

    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 lg:w-1/3 lg:flex-none">
                <color:div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                                <h6 class="mb-0">Hotel Bookings</h6>
                            </div>
                            <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                <a href="{{ route('customer.index') }}"
                                    class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-fuchsia-500 hover:opacity-75">Book now</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4 pb-0">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            @if ( count($user->hotelBookings) == 0 )
                                <p class="my-6 font-semibold leading-normal text-sm text-slate-700">No bookings made yet!</p>
                            @endif
                            @foreach ($user->hotelBookings as $booking)
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ $booking->start_date }} <br> {{ $booking ->end_date }}
                                        </h6>
                                        <span class="leading-tight text-xs">{{ App\Models\Hotel::where('id', $booking->hotel_id)->first()->name }}</span>
                                    </div>
                                    <div class="flex items-center leading-normal text-sm">
                                        Room Number {{ App\Models\Room::where('id', $booking->room_id)->first()->room_number }}
                                        <button
                                            class="px-2 py-1 text-white border border-solid rounded-lg bg-gradient-to-tl {{ $booking->status == 'canceled' ? 'from-red-500 to-rose-400' : 'from-blue-600 to-rose-400' }} border-fuchsia-300 ml-2 capitalize pointer-events-none">{{ $booking->status }}</button>
                                        @if($booking->status == 'pending')
                                        <form action="{{ route('customer.hotel.bookings.cancel', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                            class="px-2 py-1 text-white border border-solid rounded-lg bg-gradient-to-tl from-red-500 to-rose-400 border-fuchsia-300 capitalize">cancel</button>
                                        </form>
                                        
                                        @endif
                                    </div>
                                    </li>
                            @endforeach
                           
                        </ul>
                    </div>
                </color:div>
            </div>
            <div class="w-full max-w-full px-3 lg:w-1/3 lg:flex-none">
                <color:div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                                <h6 class="mb-0">Restaurant Bookings</h6>
                            </div>
                            <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                <a href="{{ route('customer.index') }}"
                                    class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-fuchsia-500 hover:opacity-75">Book now</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4 pb-0">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            @if ( count($user->restaurantBookings) == 0 )
                                <p class="my-6 font-semibold leading-normal text-sm text-slate-700">No bookings made yet!</p>
                            @endif
                            @foreach ($user->restaurantBookings as $booking)
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ $booking->booking_date }} - ({{ $booking->dine_in_time }} - {{ $booking->dine_out_time }})
                                        </h6>
                                        <span class="leading-tight text-xs">{{ App\Models\Restaurant::where('id', $booking->restaurant_id)->first()->name }}</span>
                                    </div>
                                    <div class="flex items-center leading-normal text-sm">
                                        Table Number {{ App\Models\Table::where('id', $booking->table_id)->first()->table_number }}
                                        <button
                                            class="px-2 py-1 text-white border border-solid rounded-lg bg-gradient-to-tl {{ $booking->status == 'canceled' ? 'from-red-500 to-rose-400' : 'from-blue-600 to-rose-400' }} border-fuchsia-300 ml-2 capitalize pointer-events-none">{{ $booking->status }}</button>
                                        @if($booking->status == 'pending')
                                        <form action="{{ route('customer.restaurant.bookings.cancel', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                            class="px-2 py-1 text-white border border-solid rounded-lg bg-gradient-to-tl from-red-500 to-rose-400 border-fuchsia-300 capitalize">cancel booking</button>
                                        </form>
                                        
                                        @endif
                                    </div>
                                    </li>
                            @endforeach
                           
                        </ul>
                    </div>
                </color:div>
            </div>
             <div class="w-full max-w-full px-3 lg:w-1/3 lg:flex-none">
                <color:div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                                <h6 class="mb-0">Tourist Spot Bookings</h6>
                            </div>
                            <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                <a href="{{ route('customer.index') }}"
                                    class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs bg-150 active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 border-fuchsia-500 text-fuchsia-500 hover:opacity-75">Book now</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4 pb-0">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            @if ( count($user->touristSpotBookings) == 0 )
                                <p class="my-6 font-semibold leading-normal text-sm text-slate-700">No bookings made yet!</p>
                            @endif
                            @foreach ($user->touristSpotBookings as $booking)
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ $booking->booking_date }}
                                        </h6>
                                        <span class="leading-tight text-xs">{{ App\Models\TouristSpot::where('id', $booking->tourist_spot_id)->first()->name }}</span>
                                    </div>
                                    <div class="flex items-center leading-normal text-sm">
                                        
                                        <button
                                            class="px-2 py-1 text-white border border-solid rounded-lg bg-gradient-to-tl {{ $booking->status == 'canceled' ? 'from-red-500 to-rose-400' : 'from-blue-600 to-rose-400' }} border-fuchsia-300 ml-2 capitalize pointer-events-none">{{ $booking->status }}</button>
                                        @if($booking->status == 'pending')
                                        <form action="{{ route('customer.spot.bookings.cancel', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                            class="px-2 py-1 text-white border border-solid rounded-lg bg-gradient-to-tl from-red-500 to-rose-400 border-fuchsia-300 capitalize">cancel</button>
                                        </form>
                                        
                                        @endif
                                    </div>
                                    </li>
                            @endforeach
                           
                        </ul>
                    </div>
                </color:div>
            </div>
        </div>
    </div>


</x-theme.auth-layout>
