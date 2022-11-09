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
            <x-form.input :value="old('number')" name="number" label="number" required />
            <div class="mt-4">
                <x-form.button class="button">Submit</x-form.button>
            </div>

        </form>
    </div>
</x-theme.layout>
