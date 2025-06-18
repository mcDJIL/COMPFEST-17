    <div class="w-full pt-20 pb-20 overflow-hidden">
        <!-- Container untuk konten kiri dengan max-width 1280px -->
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col lg:flex-row lg:items-start gap-8 lg:gap-16">
                <!-- Konten Kiri - Fixed dalam container -->
                <div class="flex-shrink-0 lg:w-80 xl:w-96">
                    <h2 class="text-2xl sm:text-3xl text-green-800 leading-tight">What Our Customers are Saying</h2>
                    <p class="text-lg sm:text-xl text-[#333333] mt-4">These are the reasons our customers keep coming back</p>

                    <div class="flex justify-between rounded-[20px] bg-[#FAFAF5] mt-8 max-w-[320px] py-6 pr-6 pl-5">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 flex items-center justify-center">
                                <img class="object-cover" src="{{ url('assets/images/logo2.png') }}" alt="">
                            </div>
                        </div>

                        <div class="ml-4 flex-1">
                            <h5 class="font-bold text-lg sm:text-xl text-green-800">Sea Catering</h5>
                            <p class="text-gray-500 text-xs">Reviews <span>100</span> • <span>Excellent</span></p>

                            <div class="stars-container flex gap-1.5 items-center mt-1">
                                <div class="stars flex">
                                    <i class="fa-solid fa-star text-yellow-300 text-sm"></i>
                                    <i class="fa-solid fa-star text-yellow-300 text-sm"></i>
                                    <i class="fa-solid fa-star text-yellow-300 text-sm"></i>
                                    <i class="fa-solid fa-star text-yellow-300 text-sm"></i>
                                    <i class="fa-solid fa-star text-yellow-300 text-sm"></i>
                                </div>
                                <div class="rating">
                                    <p class="text-gray-500 text-xs">5</p>
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

                <!-- Swiper Container - Melebar ke kanan -->
                <div class="flex-1 lg:ml-8">
                    <!-- Slider main container -->
                    <div class="swiper testimonial-swiper mt-6 lg:mt-10 relative">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper !h-[260px] sm:!h-[280px]">
                            <!-- Slides -->
                            <div class="swiper-slide bg-[#FAFAF5] rounded-[20px] p-4 sm:p-6 w-72 sm:w-80 lg:w-96 h-52 sm:h-60 relative mr-4 sm:mr-6">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col sm:flex-row sm:gap-6 lg:gap-8 items-start sm:items-center">
                                        <div class="stars-testimoni flex">
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                        </div>
                                        <div class="mt-1 sm:mt-0">
                                            <p class="text-xs text-[#333333]">June 17, 2025</p>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden sm:block">
                                        <i class="fa-solid fa-star text-3xl lg:text-4xl text-yellow-300"></i>
                                    </div>
                                </div>

                                <div class="mt-3 sm:mt-4">
                                    <p class="text-sm sm:text-base text-[#333333]">I've been using the Diet Plan for 3 weeks and already feel lighter and more energized. The delivery is always on time too!</p>
                                </div>

                                <div class="absolute bottom-4 sm:bottom-5">
                                    <p class="font-semibold text-lg sm:text-xl">Nadia</p>
                                </div>
                            </div>

                            <div class="swiper-slide bg-[#FAFAF5] rounded-[20px] p-4 sm:p-6 w-72 sm:w-80 lg:w-96 h-52 sm:h-60 relative mr-4 sm:mr-6">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col sm:flex-row sm:gap-6 lg:gap-8 items-start sm:items-center">
                                        <div class="stars-testimoni flex">
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                        </div>
                                        <div class="mt-1 sm:mt-0">
                                            <p class="text-xs text-[#333333]">June 15, 2025</p>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden sm:block">
                                        <i class="fa-solid fa-star text-3xl lg:text-4xl text-yellow-300"></i>
                                    </div>
                                </div>

                                <div class="mt-3 sm:mt-4">
                                    <p class="text-sm sm:text-base text-[#333333] leading-relaxed">The quality of food is amazing! Fresh ingredients and perfectly balanced meals. My family loves it and we've been loyal customers for months.</p>
                                </div>

                                <div class="absolute bottom-4 sm:bottom-5">
                                    <p class="font-semibold text-lg sm:text-xl">Ahmad</p>
                                </div>
                            </div>

                            <div class="swiper-slide bg-[#FAFAF5] rounded-[20px] p-4 sm:p-6 w-72 sm:w-80 lg:w-96 h-52 sm:h-60 relative mr-4 sm:mr-6">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col sm:flex-row sm:gap-6 lg:gap-8 items-start sm:items-center">
                                        <div class="stars-testimoni flex">
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                            <i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>
                                        </div>
                                        <div class="mt-1 sm:mt-0">
                                            <p class="text-xs text-[#333333]">June 12, 2025</p>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden sm:block">
                                        <i class="fa-solid fa-star text-3xl lg:text-4xl text-yellow-300"></i>
                                    </div>
                                </div>

                                <div class="mt-3 sm:mt-4">
                                    <p class="text-sm sm:text-base text-[#333333] leading-relaxed">Perfect for busy professionals like me. The variety of meals keeps it interesting and the portion sizes are just right.</p>
                                </div>

                                <div class="absolute bottom-4 sm:bottom-5">
                                    <p class="font-semibold text-lg sm:text-xl">Sarah</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="swiper-pagination absolute !w-20 !-bottom-[5px] !-left-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            const swiper = new Swiper('.testimonial-swiper', {
                // Optional parameters
                direction: 'horizontal',
                loop: true,
                slidesPerView: 1.2,
                spaceBetween: 16,
                centeredSlides: false,
                mousewheel: {
                    forceToAxis: true,
                    invert: true,
                },
                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                breakpoints: {
                    // 300px ke atas
                    300: {
                        slidesPerView: 1.1,
                        spaceBetween: 12,
                    },
                    // 480px ke atas (mobile)
                    480: {
                        slidesPerView: 1.3,
                        spaceBetween: 16,
                    },
                    // 640px ke atas (tablet kecil)
                    640: {
                        slidesPerView: 1.5,
                        spaceBetween: 20,
                    },
                    // 768px ke atas (tablet)
                    768: {
                        slidesPerView: 1.8,
                        spaceBetween: 24,
                    },
                    // 1024px ke atas (desktop kecil)
                    1024: {
                        slidesPerView: 2.2,
                        spaceBetween: 24,
                    },
                    // 1280px ke atas (desktop)
                    1280: {
                        slidesPerView: 2.5,
                        spaceBetween: 32,
                    }
                }
            });
        </script>
    @endpush