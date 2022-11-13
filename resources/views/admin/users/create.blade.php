<x-theme.layout>
    <div
        class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 w-1/2">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="flex gap-2">
                <div class="mb-6 w-full mr-2">
                    <x-form.input :value="old('first_name')" name="first_name" label="First Name" required />
                </div>

                <div class="mb-6 w-full">
                    <x-form.input :value="old('last_name')" name="last_name" label="Last Name" required />
                </div>
            </div>
            <x-form.input :value="old('email')" name="email" type="email" label="Email" required />
            <x-form.input :value="old('number')" name="number" label="Contact Number" required />
           
            <x-form.input name="password" label="password" type="Password" required />
            <x-form.input name="password_confirmation" label="Confirm Password" type="password" required />

            <div class="mb-6 w-1/4">
                <label for="business_type" class="mb-2 ml-1 font-bold text-xs text-slate-700">Business Type</label>
                
                <select 
                        name="business_type" 
                        id="business_type" 
                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                    >
                    <option value="none">None</option>
                    <option value="hotel">Hotel</option>
                    <option value="restaurant">Restaurant</option>
                    <option value="tourist_spot">Tourist Spot</option>
                </select>

            </div>

            <div class="mt-4">
                <x-form.button class="button">Submit</x-form.button>
            </div>

        </form>
    </div>
</x-theme.layout>
