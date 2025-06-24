    <div class="w-full pt-20 pb-20 overflow-hidden">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col lg:flex-row lg:items-start gap-8 lg:gap-16">
                <div class="flex-shrink-0 lg:w-80 xl:w-96">
                    <h2 class="text-3xl text-green-800 leading-tight">What Our Customers are Saying</h2>
                    <p class="text-lg sm:text-xl text-[#333333] mt-4">These are the reasons our customers keep coming back</p>

                    <div class="flex justify-between rounded-[20px] bg-[#FAFAF5] mt-8 max-w-[320px] py-6 pr-6 pl-5">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 flex items-center justify-center">
                                <img class="object-cover" src="{{ url('assets/images/logo2.png') }}" alt="">
                            </div>
                        </div>

                        <div class="ml-4 flex-1">
                            <h5 class="font-bold text-lg sm:text-xl text-green-800">Sea Catering</h5>
                            <p class="text-gray-500 text-xs">Reviews <span class="total-review-badge">...</span> • <span class="summary-review-badge">......</span></p>

                            <div class="stars-container flex gap-1.5 items-center mt-1">
                                <div class="stars flex stars-badge">
                                    ....
                                </div>
                                <div class="">
                                    <p class="text-gray-500 text-xs rating-badge">..</p>
                                </div>
                            </div>

                            <div class="mt-2 bg-green-800 text-white text-xs font-medium w-32 py-1 rounded-sm flex items-center justify-center gap-2">
                                <div class="w-4 h-4 bg-white rounded-full flex items-center justify-center">
                                    <img src="{{ url('assets/images/halal.png') }}" alt="" class="object-cover">
                                </div>
                                <p>Halal Certified</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1 lg:ml-8">
                    <div class="swiper testimonial-swiper mt-6 lg:mt-10 relative">
                        <div class="swiper-wrapper !h-[260px] sm:!h-[280px] testimonials-wrapper">
                            
                        </div>
                        
                        <div class="swiper-nav-buttons flex justify-between items-center mt-4 md:hidden">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <div class="swiper-pagination absolute w-full lg:!w-20 !-bottom-[5px]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ url('assets/js/landing-page/testimonials.js') }}"></script>
    @endpush