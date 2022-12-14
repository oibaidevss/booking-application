<x-theme.layout>
    @include('partials.bo.header')
    <div class="w-full px-6 py-6 mx-auto">

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                        <h6>Bookings</h6>

                        <div>
                            <span class="text-xs">Select Date: </span> <input class="text-xs p-1" type="date" name="selectDate">
                            @if (auth()->user()->business_type == 'hotel')
                            
                            <a id="export" data-href="{{ route('hotel.export', '') }}/" class="bg-gradient-to-tl from-green-600 to-lime-400 text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2"> <i class="fa fa-download"></i>  Export </a>
                            
                            @elseif (auth()->user()->business_type == 'restaurant')

                            <a id="#export" data-href="{{ route('restaurant.export', '') }}/" class="bg-gradient-to-tl from-green-600 to-lime-400 text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2"> <i class="fa fa-download"></i>  Export </a>

                            @elseif (auth()->user()->business_type == 'tourist_spot')

                            <a id="#export" data-href="{{ route('spot.export', '') }}/" class="bg-gradient-to-tl from-green-600 to-lime-400 text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2"> <i class="fa fa-download"></i>  Export </a>

                            @endif
                        </div>
                    </div>

                    
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto ps">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Customer Name</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Phone Number</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            ID</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Status</th>
                                        <th
                                            class="pr-6 pl-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            
                                            @if(auth()->user()->business_type == 'hotel')    
                                            Check In/Out Date
                                            @elseif(auth()->user()->business_type == 'restaurant')
                                            Dine In Date & Time
                                            @else
                                            Date
                                            @endif
                                        </th>
                                        @if(auth()->user()->business_type != 'tourist_spot')
                                        <th
                                            class="pr-6 pl-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Total Hours</th>
                                        @endif

                                        @if (auth()->user()->business_type 
                                        != 'hotel')
                                            <th
                                                class="pr-6 pl-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Number of People</th>
                                        @endif
                                        <th
                                            class="pr-6 pl-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Remarks</th>
                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                    @php
                                        if($loop->last):
                                            $last = '';
                                            else:
                                            $last = 'border-b';
                                        endif;

                                        if(auth()->user()->business_type == 'hotel'){

                                            $totalHours = Carbon\Carbon::parse($booking->start_date)->diffInHours(Carbon\Carbon::parse($booking->end_date)); // total hours from start date to end date
                                        

                                            $start_is_past = Carbon\Carbon::parse($booking->start_date)->isPast();
                                            $end_is_past = Carbon\Carbon::parse($booking->end_date)->isPast();

                                            if ( $start_is_past && $end_is_past ){
                                                $booking->remark = "completed";
                                            }else if( $start_is_past && !$end_is_past ){
                                                $booking->remark = "In Progress";
                                            }else if( !$start_is_past && !$end_is_past ){
                                                $booking->remark = "Booked";
                                            }
                                        
                                        }elseif(auth()->user()->business_type == 'restaurant'){
                                            
                                            $totalHours = Carbon\Carbon::parse($booking->dine_in_time)->diffInHours(Carbon\Carbon::parse($booking->dine_out_time));
                                            
                                            $booking_date =  Carbon\Carbon::parse($booking->booking_date)->isPast();

                                            if ( $booking_date ){
                                                $booking->remark = "completed";
                                            }else if( !$booking_date ){
                                                $booking->remark = "";
                                            }

                                        }else{

                                        }

                                         
                                    @endphp     
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent {{ $last }} whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1 w-[200px]">

                                                @php 
                                                $user = \App\Models\User::where('id', $booking->user_id)->first()
                                                @endphp

                                                <div>
                                                    @if (auth()->user()->avatar != '')
                                                    <img src="{{ asset('/storage/avatars/'.auth()->user()->id.'/'.Auth::user()->avatar)}}"
                                                    class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl" alt="{{ auth()->user()->first_name }}">
                                                    @else
                                                    <img src="{{ asset('/assets/img/marie.jpg')}}"
                                                    class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                    alt="{{ auth()->user()->first_name }}">
                                                    @endif
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">{{ $user->first_name }} {{ $user->last_name }}</h6>
                                                    <p class="mb-0 leading-tight text-xs text-slate-400">
                                                        {{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent {{ $last }} whitespace-nowrap shadow-transparent text-center">
                                            <p class="mb-0 font-semibold leading-tight text-xs">{{ $user->number }}</p>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent {{ $last }} text-sm whitespace-nowrap shadow-transparent">
                                            @if ($user->identification != null )
                                            <a target="_blank" href={{ asset('/storage/identifications/'. $user->id . '/' . $user->identification) }}> <i class="fa fa-download"></i> </a>
                                            @else
                                            <p class="mb-0 font-semibold leading-tight text-xs">
                                                <i class="fas fa-exclamation"></i>
                                            </p>
                                            @endif
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent {{ $last }} text-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight text-xs">
                                                @if($booking->status === 'pending')
                                                <span 
                                                class="bg-gradient-to-tl  from-red-600 to-rose-400 text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2">
                                                {{ ucwords($booking->status) }}</p>
                                                </span>
                                                @else
                                                <span 
                                                class="bg-gradient-to-tl  from-green-400 to-blue-500 text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2">
                                                {{ ucwords($booking->status) }}</p>
                                                </span>
                                                @endif
                                        </td>
                                        <td
                                            class="pl-2 py-2 text-left align-middle bg-transparent {{ $last }} whitespace-nowrap shadow-transparent">

                                            @if(auth()->user()->business_type == 'hotel') 
                                            
                                            <span class="block font-semibold leading-tight text-xs text-slate-400">Check In - <strong>{{ $booking->start_date }}</strong></span>
                                            <span class="block font-semibold leading-tight text-xs text-slate-400">Check Out - <strong>{{ $booking->end_date }}</strong></span>
                                            
                                            @elseif(auth()->user()->business_type == 'restaurant')

                                            <span class="block font-semibold leading-tight text-xs text-slate-400">
                                                <strong>{{ $booking->booking_date }}</strong> - ({{ $booking->dine_in_time }} {{ $booking->dine_out_time }})
                                            </span>
                                            
                                            @else
                                            
                                            <span class="block font-semibold leading-tight text-xs text-slate-400">
                                                <strong>{{ $booking->booking_date }}</strong>
                                            </span>

                                            @endif

                                        </td>
                                        @if(auth()->user()->business_type != 'tourist_spot')
                                        <td
                                            class="pl-2 py-2 text-left align-middle bg-transparent {{ $last }} whitespace-nowrap shadow-transparent">
                                              
                                            {{  $totalHours }}
                                        </td>
                                        @endif
                                        @if(auth()->user()->business_type != 'hotel')

                                        <td
                                            class="pl-2 py-2 text-left align-middle bg-transparent {{ $last }} whitespace-nowrap shadow-transparent">
                                            {{  $booking->number_of_persons }}
                                        </td>

                                        @endif

                                        <td
                                            class="pl-2 py-2 text-left align-middle bg-transparent {{ $last }} whitespace-nowrap shadow-transparent text-sm">
                                            {{ ucwords($booking->remark) }}
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent {{ $last }} whitespace-nowrap shadow-transparent">
                                            @if (!in_array($booking->status, ['approved', 'canceled']))
                                            <form action="{{ route('business.bookings.approved', $booking)  }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                
                                                <button type="submit"
                                                class="bg-gradient-to-tl  from-green-400 to-blue-500 text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2">Approve</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-theme.layout>
