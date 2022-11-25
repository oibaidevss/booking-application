<x-theme.layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6>Tourist Spot Bookings <strong>{{ count( $bookings ) }}</strong></h6>
                
                <div>
                    <a href="{{ route('spot.booking.export') }}" class="bg-gradient-to-tl from-green-600 to-lime-400 text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2"> <i class="fa fa-download"></i>  Export as pdf</a>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>


                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Booking Date</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Number of People</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Created at</th>


                   
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        
                        <tr>
                        
                            <td class="px-6 py-3 leading-normal text-left align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ App\Models\User::where('id', $booking->user_id)->first()->email }}
                                </p>
                            </td>
                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ $booking->booking_date }}
                                </p>
                            </td>
                            

                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ $booking->number_of_persons }}
                                </p>
                            </td>

                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ $booking->status }}
                                </p>
                            </td>
                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ $booking->created_at }}
                                </p>
                            </td>
                        </tr>
                    @endforeach
    
                </tbody>
                </table>
                <div class="p-6">
                    {{ $bookings->links() }}
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</x-theme.layout>