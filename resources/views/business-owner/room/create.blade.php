<x-theme.layout>

    @include('partials.bo.header')
    <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Create a Room</h6>
                            </div>
                            
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <form action="{{ route('room.store') }}" method="POST">
                            @csrf

                            <x-form.input :value="old('room_number')" name="room_number" label="Room Number" required />
                            <x-form.input :value="old('floor')" name="floor" label="Floor" required />


                            <x-form.field>
                                <x-form.label name="Room Type" />
                                <div class="mb-2">
                                    <select class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"  name="room_type" id="room_type">
                                        <option value="single">Single</option>
                                        <option value="double">Double</option>
                                        <option value="family">Family</option>
                                    </select>
                                </div>
                                <x-form.error name="description" />
                            </x-form.field>

                            <x-form.field>
                                <x-form.label name="description" />
                                <div class="mb-2">
                                    <textarea
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        name="description" id="description" class="block mt-1 w-full"></textarea>
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
        </div>
    </div>

</x-theme.layout>
