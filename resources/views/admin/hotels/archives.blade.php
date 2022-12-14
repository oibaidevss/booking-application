<x-theme.layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6>Hotels</h6>

                <a 
                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-green-600 to-lime-400 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
                href="{{ route('hotels.index') }}"> <i class="fa fa-check"></i> Active Accounts </a>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Hotel</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Rooms</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Business Permit</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Created At</th>
                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                </thead>
                <tbody>
    
                    @foreach ($hotels as $hotel)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                <div>
                                    <img src="../assets/img/team-2.jpg" class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl" alt="user1" />
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 leading-normal text-sm">{{ $hotel->name }}</h6>
                                    <p class="mb-0 leading-tight text-xs text-slate-400">{{ $hotel->email }}</p>
                                </div>
                                </div>
                            </td>
                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <p class="mb-0 leading-tight text-xs text-slate-400">{{ count($hotel->rooms) }}</p>
                            </td>
                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <span class="bg-gradient-to-tl {{ $hotel->status ? 'from-green-600 to-lime-400' : 'from-red-500 to-rose-400'  }} text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white px-4 py-2">
                                    {{ $hotel->status ? 'Verified' : 'Unverified'  }}
                                </span>
                            </td>
    
                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                <span class="bg-gradient-to-tl text-xs rounded-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none px-4 py-2">
                                    @if ($hotel->business_permit != null )
                                    <a href="{{ asset('/storage/permits/hotel/' . $hotel->id .'/'. $hotel->business_permit) }}" alt="">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @else
                                    <p class="text-red-600 text-xs"> No Permit Uploaded! </p>
                                    @endif
                                </span>
                            </td>
    
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="font-semibold leading-tight text-xs text-slate-400">{{ \Carbon\Carbon::parse( $hotel->created_at )->diffForHumans() }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="align-center flex items-center">
                                   
    
                                    <form method="POST" action="{{ route('hotels.archives.restore', $hotel) }}">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <button type="submit"
                                        class="font-semibold leading-tight text-green-500 text-xs text-slate-400 px-1">Restore</button>
                                    </form>
                                
                                    <form method="POST" action="/admin/hotels/{{ $hotel->id }}">
                                        @csrf
                                        @method('DELETE')
    
                                        <button class="font-semibold leading-tight text-red-500 text-xs text-slate-400 px-1">Permanent Delete</button>
                                    </form>                              
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
    
                </tbody>
                </table>
                <div class="p-6">
                    {{ $hotels->links() }}
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </x-theme.layout>