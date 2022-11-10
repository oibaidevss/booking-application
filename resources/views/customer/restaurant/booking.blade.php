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

                    <div class="flex w-full">
                        <div class="w-1/2 px-2">
                            <x-form.input class="w-50" :value="old('start_date')" type="datetime-local" name="start_date" label="Dine In" required />
                        </div>
                        <div class="w-1/2 px-2">
                            <x-form.input class="w-50" :value="old('end_date')" type="datetime-local" name="end_date" label="Dine Out" required />
                        </div>
                    </div>
                        
                    <div class="mt-4 px-2">
                        <x-form.button class="button">Submit</x-form.button>
                    </div>


                </form>


                <svg id="gantt"></svg>

            </div>
        </div>
    </div>
</x-theme.auth-layout>
