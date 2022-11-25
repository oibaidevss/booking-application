<x-theme.layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6>Hotels</h6>
                <p>Total Bookings {{ count( $bookings ) }}</p>
                {{-- <div class="flex items-center">
    
                    <a href="{{ route('hotels.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"> <i class="fas fa-plus" aria-hidden="true"> </i> Create a hotel</a>
    
                    <a href="{{ route('rooms.create') }}" class="inline-block px-6 py-3 l-1 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 ml-2"> <i class="fas fa-plus" aria-hidden="true"> </i> Create a room </a>
                    
                </div> --}}
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>

                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Room</th>

                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Start Date</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">End Date</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>

                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Created at</th>


                   
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ App\Models\Room::where('id', $booking->room_id)->first()->room_number }}
                                </p>
                            </td>

                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ App\Models\User::where('id', $booking->user_id)->first()->email }}
                                </p>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ $booking->start_date }}
                                </p>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ $booking->end_date }}
                                </p>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">
                                    {{ $booking->status }}
                                </p>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
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