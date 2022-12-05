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

                        <div class="pt-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                            <h5>Forgot Password</h5>
                        </div>

                        <div class="pt-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl text-xs">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                
                        <!-- Session Status -->
                        <x-auth-session-status class="pt-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl text-xs" :status="session('status')" />
                        
                        <div class="flex-auto p-6">

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                    
                                <!-- Email Address -->
                                <x-form.input :value="old('email')" name="email" label="Email"
                                    required />
                                <x-form.button class="button">Submit</x-form.button>
                            </form>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-theme.auth-layout>
