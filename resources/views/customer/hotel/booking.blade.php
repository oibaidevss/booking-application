<x-theme.auth-layout>
    @include('partials.fe._header')


    <div class="w-full max-w-full px-3 mt-6 lg:w-1/2 md:w-full md:flex-none">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 px-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <h6 class="mb-0">Book {{ App\Models\Hotel::where('id', $_GET['hotel'])->first()->name }} - Room Number {{ App\Models\Room::where('id', $_GET['room'])->first()->room_number }}</h6>
            </div>
            <div class="flex-auto p-4 pt-6">

                <form action="{{ route('customer.hotel.booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="room_id" value={{ isset($_GET['room']) ? $_GET['room']:0 }}>
                    <input type="hidden" name="hotel_id" value={{ isset($_GET['hotel']) ? $_GET['hotel']:0 }}>
                    <input type="hidden" name="user_id" value={{ auth()->user()->id }}>

                    <div class="flex w-full hidden">
                        <div class="w-1/2 px-2">
                            <x-form.input class="w-50" :value="old('start_date')" type="text" name="start_date" label="Check In" required />
                        </div>
                        <div class="w-1/2 px-2">
                            <x-form.input class="w-50" :value="old('end_date')" type="text" name="end_date" label="Check Out" required />
                        </div>
                    </div>
                    <div class="px-2">
                        <x-form.input type="text" name="daterange" label="Date Range (Check in and check out date.)" required />
                    </div>

                    <script>
                        $(function() {
                            $('input[name="daterange"]').daterangepicker({
                                timePicker: true,
                                minDate: new Date()
                            }, function(start, end, label) {
                                $('input[name="start_date"]').val(start)
                                $('input[name="end_date"]').val(end)
                            });
                        });
                    </script>

                    <div class="mt-4 px-2">
                        <x-form.button class="button">Submit</x-form.button>
                    </div>


                </form>


                <svg id="gantt"></svg>

            </div>
        </div>
    </div>
</x-theme.auth-layout>
