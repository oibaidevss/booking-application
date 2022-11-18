<x-theme.auth-layout>
    @include('partials.fe._header')


    <div class="w-full max-w-full px-3 mt-6 lg:w-1/2 md:w-full md:flex-none">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 px-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <h6 class="mb-0">Book {{ $spot->name }}</h6>
            </div>
            <div class="flex-auto p-4 pt-6">

                <form action="{{ route('customer.spot.booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="tourist_spot_id" value="{{ $spot->id }}">

                    <div class="px-2">
                        <x-form.input type="text" value="{{old('booking_date')}}" name="booking_date" label="Booking Date" required />
                    </div>

                    <div class="w-1/2 px-2">
                         <x-form.input type="text" value="{{old('number_of_persons')}}" name="number_of_persons" label="How many persons are coming? " required />
                    </div>
                        
                    <div class="mt-4 px-2">
                        <x-form.button class="button">Submit</x-form.button>
                    </div>


                </form>

                 <script>
                    $(function() {
                        var date = new Date();
                        var tomorrow = new Date(date.getTime() + 24 * 60 * 60 * 1000);
                        
                        $('input[name="booking_date"]').daterangepicker({
                            singleDatePicker: true,
                            minDate: tomorrow
                        }, function(date) {
                            $('input[name="booking_date"]').val(date);
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</x-theme.auth-layout>
