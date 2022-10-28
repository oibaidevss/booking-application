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
                    <div class="relative right-0">

                    </div>
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
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Business Information</h6>
                            </div>
                           
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        
                        <form action="{{ route('info.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <x-form.input :value="old('name')" name="name" label="Business Name" required />
                            <x-form.input :value="old('email')" name="email" label="Email" required />
                            <x-form.input :value="old('number')" name="number" label="Number" required />
                            <x-form.input :value="old('location')" name="location" label="Location" required />

                            <x-form.input :value="old('business_permit')" type="file" name="business_permit" label="Business Permit" required />

                            <x-form.field>
                                <x-form.label name="description" />
                                <div class="mb-2">
                                <textarea class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="description" id="description"
                                    class="block mt-1 w-full">{{ old('description') }}</textarea>
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
