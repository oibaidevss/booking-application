<x-theme.auth-layout>
    <section class="min-h-screen mb-32">
        <div class="relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl"
            style="background-image: url('../assets/img/curved-images/curved14.jpg')">
            <span
                class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-60"></span>
            <div class="container z-10">
                <div class="flex flex-wrap justify-center -mx-3">
                    <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                        <h1 class="mt-12 mb-2 text-white">Welcome!</h1>
                        <p class="text-white"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
                <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                    <div
                        class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                            <h5>Register</h5>
                        </div>
                        
                        <div class="flex-auto p-6">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <x-form.input :value="old('first_name')" name="first_name" label="First Name"
                                    required />
                                <x-form.input :value="old('last_name')" name="last_name" label="Last Name" required />
                                <x-form.input type="file" :value="old('avatar')" name="avatar" label="avatar" />
                               

                                <div class="my-4">

                                    <a id="trigger" href="#" class="mb-1 ml-1 font-normal cursor-pointer select-none text-sm text-slate-700" onclick="
                                        event.preventDefault();
    
                                        let el = document.getElementById('business');
                                        el.classList.toggle('hidden')
                                    
                                        let id = document.getElementById('identification');
                                        id.classList.toggle('hidden')
    
                                        let element = document.getElementById('business_type');
                                        element.value = 0;
                                        var x = document.getElementById('trigger');

                                        x.innerHTML === 'Register as Business?' ? x.innerHTML = 'Register as Customer?': x.innerHTML = 'Register as Business?'
                                        
    
                                    ">Register as Business?</a>
    
                                    <div class="hidden" id="business">
                                        <x-form.field>
                                                <x-form.label name="Business Type" />
                                                <div class="mb-2">
                                                    <select 
                                                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                    name="business_type" id="business_type">
                                                    <option value="none">None</option>
                                                    <option value="hotel">Hotel</option>
                                                    <option value="restaurant">Restaurant</option>
                                                    <option value="tourist_spot">Tourist Spot</option>
                                                </select>
                                            </div>
                                        </x-form.field>
                                    </div>
                                    
                                    <div class="" id="identification">
                                        <x-form.input type="file" :value="old('identification')" name="identification" label="Identification (Valid ID)" />
                                    </div>
                                </div>
                                
                                <x-form.input :value="old('email')" name="email" label="Email" required />
                                <x-form.input type="password" name="password" label="Password" required />
                                <x-form.input type="password" name="password_confirmation" label="Confirm Password" required />

                                <div class="min-h-6 pl-6.92 mb-0.5 block">
                                    <input id="terms"
                                        class="w-4.92 h-4.92 ease-soft -ml-6.92 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100"
                                        type="checkbox" value="" checked />
                                    <label
                                        class="mb-2 ml-1 font-normal cursor-pointer select-none text-sm text-slate-700"
                                        for="terms"> I agree the <a href="javascript:;"
                                            class="font-bold text-slate-700">Terms and Conditions</a> </label>
                                </div>

                                <x-form.button class="button">Submit</x-form.button>
                                <p class="mt-4 mb-0 leading-normal text-sm">Already have an account? <a
                                        href="../pages/sign-in.html" class="font-bold text-slate-700">Sign in</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-theme.auth-layout>
