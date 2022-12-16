<x-theme.auth-layout>
    
    @include('partials.fe._header')

        <div class="flex-none w-full max-w-full px-3 mt-6">
        <div
            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6 class="mb-1">Restaurants</h6>

                <div class="flex pt-2">

                    <p>
                        Sort by Price: 
                    </p>

                    <select class="pl-2" name="sort" id="sort">

                        <option value="default" {{ !isset($_GET['sort']) ? 'selected':'' }}>Default</option>
                        <option value="min" {{ isset($_GET['sort']) && $_GET['sort'] == 'min' ? 'selected':'' }}>Minimum</option>
                        <option value="max" {{ isset($_GET['sort']) && $_GET['sort'] == 'max'? 'selected':'' }}>Maximum</option>

                    </select>

                    <a href="{{ route('customer.restaurants') }}" class="hidden" id="navigate"></a>

                    <script>

                        jQuery('#sort').on('change', function(){
                            
                            navigate = jQuery('#navigate');

                            url = navigate.attr('href');

                            if(this.value === "default"){
                                document.location.href = url
                            }else{
                                document.location.href = url + "?sort=" + this.value
                            }

                        });

                    </script>

                </div>
            </div>
            <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                    {{-- @dd($restaurants) --}}
                    @foreach ($restaurants as $restaurant)
                    <div class="w-full max-w-full px-3 mt-6 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                            <div class="relative">
                                <a class="block shadow-xl rounded-2xl">
                                    <img src="{{ ($restaurant->picture != '') ? asset("/storage/pictures/restaurant/$restaurant->id/" . $restaurant->picture):asset('/assets/img/home-decor-1.jpg') }}" alt="img-blur-shadow"
                                        class="max-w-full shadow-soft-2xl rounded-2xl">
                                </a>
                            </div>
                            <div class="flex-auto px-1 pt-6">
                                <p
                                    class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">
                                   </p>
                                <div class="flex justify-between">
                                    <a href="javascript:;"> 
                                        <h5>{{ $restaurant->name }}</h5> 
                                    </a>

                                    <p class="text-sm text-lime-500">Price Range: ₱{{ $restaurant->min_price }} - ₱{{ $restaurant->max_price }}</p>
                                </div>
                                    

                                <p class="mb-6 leading-normal text-sm">{{ $restaurant->description }}</p>
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('customer.restaurant.show', $restaurant) }}"
                                        class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">View
                                        Tables</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div
                class="flex mt-6 justify-center p-4">
                {{ (!isset($_GET['sort'])) ? $restaurants->links() : '' }}
                </div>
            </div>
        </div>
    </div>
</x-theme.auth-layout>
