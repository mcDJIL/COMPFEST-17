@extends('layout.auth')
@section('title', 'Login Sea Catering')

@section('content')
    <div class="w-full px-3 sm:px-10 flex justify-center items-center h-screen">
        <div class="w-full flex flex-col items-center">
            <div class="flex flex-col items-center mb-10">
                <div class="mb-3">
                    <img class="w-28" src="{{ url('assets/images/logo2.png') }}" alt="">
                </div>
                <div class="">
                    <h1 class="text-4xl font-bold text-green-800">Sea Catering</h1>
                </div>
            </div>

            <div class="w-full sm:w-[540px] p-4 bg-white border border-gray-200 rounded-lg shadow-xl sm:p-6 md:p-8">
                <div class="space-y-6">
                    <h5 class="text-3xl font-semibold text-[#333333]">Login</h5>

                    <div class="error-message">

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
                                class="btn-login flex items-center gap-2 w-full text-white bg-green-800 hover:bg-green-700 duration-300 font-semibold text-lg rounded-lg px-8 py-2 cursor-pointer text-center">Login</button>
                        </div>
                        <a data-modal-target="forgot-password-modal" data-modal-toggle="forgot-password-modal"
                            class="cursor-pointer ms-auto text-sm text-blue-700 hover:underline">Forgot Password?</a>
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        Not registered? <a href="{{ route('auth.register') }}" class="text-blue-700 hover:underline">Create
                            account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal forgot password --}}
    <div id="forgot-password-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-[#333333] dark:text-white">
                        Forgot Password
                    </h3>
                    <button type="button"
                        class="cursor-pointer text-gray-400 bg-transparent hover:bg-gray-200 hover:text-[#333333] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="forgot-password-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="space-y-6">
                        <div class="forgot-error-message hidden"></div>
                        <div class="forgot-success-message hidden"></div>

                        <div>
                            <label for="forgot-email" class="block mb-2 text-sm font-medium text-[#333333]">Your
                                email</label>
                            <input type="email" name="forgot-email" id="forgot-email"
                                class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="name@company.com" required />
                            <small class="forgot-email-error text-red-600"></small>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="forgot-password" class="block text-sm font-medium text-[#333333]">Your
                                password</label>

                            <div class="relative">
                                <input type="password" name="forgot-password" id="forgot-password" placeholder="••••••••"
                                    class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                                    required />
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer"
                                    id="forgotTogglePassword">
                                    <i class="fa-solid fa-eye text-gray-500" id="forgot-icon"></i>
                                </span>
                            </div>

                            <small class="forgot-password-error text-red-600"></small>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-start">
                                <button
                                    class="btn-forgot-password flex items-center gap-2 w-full text-white bg-green-800 hover:bg-green-700 duration-300 font-semibold text-lg rounded-lg px-8 py-2 cursor-pointer text-center">Update
                                    Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ url('assets/js/auth/login.js') }}"></script>
    @endpush
@endsection