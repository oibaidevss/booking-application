<x-theme.auth-layout>
    @include('partials.fe._header')


    <div class="w-full max-w-full px-3 mt-6 lg:w-1/2 md:w-full md:flex-none">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 px-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <h6 class="mb-0">Book {{ App\Models\Restaurant::where('id', $_GET['restaurant'])->first()->name }} - Table Number {{ App\Models\Table::where('id', $_GET['table'])->first()->table_number }}</h6>
            </div>
            <div class="flex-auto p-4 pt-6">

                <form action="{{ route('customer.restaurant.booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="table_id" value={{ isset($_GET['table']) ? $_GET['table']:0 }}>
                    <input type="hidden" name="restaurant_id" value={{ isset($_GET['restaurant']) ? $_GET['restaurant']:0 }}>
                    <input type="hidden" name="user_id" value={{ auth()->user()->id }}>

                    <div class="px-2">
                        <x-form.input type="text" value="{{old('booking_date')}}" name="booking_date" label="How many persons are coming? " required />
                    </div>

                    
                    <div class="flex w-full">

                        <div class="w-1/2 px-2">
                            <x-form.input type="time" value="09:00" min="09:00" max="20:00" name="dine_in_time" label="Dine In Time" required />
                        </div>

                        <div class="w-1/2 px-2">
                            <x-form.input type="time" value="10:00" min="09:00" max="20:00" name="dine_out_time" label="Dine Out Time" required />
                        </div>

                    </div>

                    <div class="w-1/5 px-2">
                         <x-form.input type="text" value="{{old('number_of_persons')}}" name="number_of_persons" label="How many persons are coming? " required />
                    </div>
                        
                    <div class="mt-4 px-2">
                        <x-form.button class="button">Submit</x-form.button>
                    </div>


                </form>

                 <script>
                    $(function() {
                        $('input[name="booking_date"]').daterangepicker({
                            singleDatePicker: true,
                            minDate: new Date()
                        }, function(date) {
                            $('input[name="booking_date"]').val(date);
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</x-theme.auth-layout>
