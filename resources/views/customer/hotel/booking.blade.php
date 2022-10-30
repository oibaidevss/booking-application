<x-theme.auth-layout>
    @include('partials.fe._header')


    <div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <h6 class="mb-0">Book {{ App\Models\Hotel::where('id', $_GET['hotel'])->first()->name }} - Room Number {{ App\Models\Room::where('id', $_GET['room'])->first()->room_number }}</h6>
            </div>
            <div class="flex-auto p-4 pt-6">

                <form action="{{ route('customer.hotel.booking.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="room_id" value={{ isset($_GET['room']) ? $_GET['room']:'' }}>
                    <input type="hidden" name="hotel_id" value={{ isset($_GET['hotel']) ? $_GET['hotel']:'' }}>

                    <input type="hidden" name="user_id" value={{ auth()->user()->id }}>

                    <x-form.input :value="old('start_date')" type="date" name="start_date" label="Check In" required />

                    <x-form.input :value="old('end_date')" type="date" name="end_date" label="Check Out" required />

                    <div class="mt-4">
                        <x-form.button class="button">Submit</x-form.button>
                    </div>


                </form>

            </div>
        </div>
    </div>
</x-theme.auth-layout>
