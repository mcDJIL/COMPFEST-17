@extends('layout.auth')
@section('title', 'Register Sea Catering')

@section('content')
    <div class="w-full px-3 sm:px-10 flex justify-center items-center h-screen">
        <div class="w-full flex flex-col items-center">
            <div class="flex flex-col items-center mb-10">
                <div class="mb-3">
                    <img class="w-20 sm:w-28" src="{{ url('assets/images/logo2.png') }}" alt="">
                </div>
                <div class="">
                    <h1 class="text-3xl sm:text-4xl font-bold text-green-800">Sea Catering</h1>
                </div>
            </div>

            <div class="w-full sm:w-[540px] p-4 bg-white border border-gray-200 rounded-lg shadow-xl sm:p-6 md:p-8">
                <div class="space-y-6">
                    <h5 class="text-3xl font-semibold text-[#333333]">Register</h5>

                    <div class="success-message">

                    </div>

                    <div class="error-message">

                    </div>

                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-[#333333]">Your full name</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="John doe" required />
                        <small class="name-error text-red-600"></small>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-[#333333]">Your email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="name@company.com" required />
                        <small class="email-error text-red-600"></small>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password" class="block text-sm font-medium text-[#333333]">Your password</label>

                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                                required />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer" id="togglePassword">
                                <i class="fa-solid fa-eye text-gray-500" id="icon"></i>
                            </span>
                        </div>

                        <small class="password-error text-red-600"></small>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-start">
                            <button
                                class="btn-register flex items-center gap-2 w-full text-white bg-green-800 hover:bg-green-700 duration-300 font-semibold text-lg rounded-lg px-8 py-2 cursor-pointer text-center">Register</button>
                        </div>
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        Have account? <a href="{{ route('auth.login') }}" class="text-blue-700 hover:underline">Login
                            account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ url('assets/js/auth/register.js') }}"></script>
    @endpush
@endsection