<x-theme.layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                    <h6>Users</h6>
                    <div class="flex items-center">

                        <a href="{{ route('users.create') }}"
                            class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            <i class="fas fa-plus" aria-hidden="true"> </i> Create a user</a>

                        <a href="{{ route('rooms.create') }}"
                            class="inline-block px-6 py-3 l-1 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 ml-2">
                            <i class="fas fa-plus" aria-hidden="true"> </i> Create a room </a>

                    </div>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Phonenumber</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Verified</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Role</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">

                                        Identification

                                        </th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">

                                        Actions

                                        </th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)

                                @php
                                    $business = \App\Models\Hotel::where('user_id', $user->id)->first();
                                @endphp

                                <tr>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div>
                                                <img src="{{ $user->avatar != '' ? asset("storage/avatars/$user->id/$user->avatar") : asset("/assets/img/team-2.jpg") }}"
                                                    class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                    alt="user1" />
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">{{ $user->first_name }} {{ $user->last_name }}</h6>
                                                <p class="mb-0 leading-tight text-xs text-slate-400">{{ $user->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 leading-tight text-xs text-slate-400">
                                            {{ $user->number }}
                                        </p>
                                    </td>
                                    <td
                                        class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 leading-tight text-xs text-slate-400">
                                            {{ $user->email_verified_at }}
                                        </p>
                                    </td>
                                    <td
                                        class="p-2 leading-normal text-center align-middle bg-transparent border-b text-xs whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 leading-tight text-xs text-slate-400 text-left">
                                            
                                            @if($user->business_type === 'hotel')
                                                <i class="fa fa-hotel"></i> Hotel
                                            @elseif($user->business_type === 'restaurant')
                                                <i class='fa fa-utensils'></i> restaurant
                                            @elseif($user->business_type === 'none')
                                                <i class='fa fa-user'></i> Customer
                                            @endif

                                        </p>
                                    </td>
                                    <td
                                        class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span
                                            class="font-semibold leading-tight text-xs text-slate-400">
                                            @if ($user->identification != '')
                                                
                                            <a target="_blank"  href="{{URL::to('/')}}/storage/identifications/{{$user->id}}/{{ $user->identification }}" target="_blank">
                                                <button class="btn"><i class="fa fa-download"></i> Download File</button>
                                            </a>
                                            @endif

                                            @if ($user->business_type === 'hotel')
                                               
                                                
                                                @if($business->business_permit != '')
                                                    <a target="_blank" href="{{URL::to('/')}}/storage/permits/hotel/{{$business->id}}/{{ $business->business_permit }}" target="_blank">
                                                        <button class="btn"><i class="fa fa-download"></i> Download File</button>
                                                    </a>
                                                @endif

                                            @endif
                                        </span>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent text-center border-b whitespace-nowrap shadow-transparent">
                                        <div class="align-center flex items-center ">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="font-semibold leading-tight text-xs text-slate-400 px-1"> Edit
                                            </a>


                                            <form method="POST" action="{{ route('users.destroy', $user) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="font-semibold leading-tight text-xs text-slate-400 px-1">Delete</button>
                                            </form>
                                            
                                            @if ($user->business_type != 'none')
                                                @if ($user->business_type == 'hotel')
                                                    @if ( $business->status == false )
                                                        
                                                        <form method="POST" action="{{ route('hotels.verify', $business) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            
                                                            <button type="submit"
                                                            class="font-semibold leading-tight text-xs text-slate-400 px-1">Verify</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                        <div class="p-6">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-theme.layout>
