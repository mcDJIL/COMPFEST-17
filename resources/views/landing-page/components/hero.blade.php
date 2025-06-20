<section id="home" class="bg-[#FAFAF5] w-full relative top-[93.97px] mb-20">
    <div class="max-w-screen-xl w-full flex justify-center mx-auto px-6 sm:px-10 pb-20">
        <div class="flex w-full flex-wrap flex-col-reverse md:flex-row md:justify-between">
            <div class="mt-10 md:mt-7 lg:mt-10 xl:mt-16">
                <h1 class="text-5xl sm:text-6xl md:text-4xl lg:text-5xl xl:text-6xl font-semibold text-green-800 mb-5 md:mb-3 lg:mb-5">Healthy Meals,</h1>
                <h1 class="text-5xl sm:text-6xl md:text-4xl lg:text-5xl xl:text-6xl font-semibold text-[#333333] mb-5 md:mb-3 lg:mb-5">Anytime,</h1>
                <h1 class="text-5xl sm:text-6xl md:text-4xl lg:text-5xl xl:text-6xl font-semibold text-[#333333] mb-5 md:mb-3 lg:mb-5">Anywhere.</h1>

                <p class="text-gray-500 sm:w-96 md:w-64 lg:w-80 xl:w-96 mt-10 md:mt-6 lg:mt-8 xl:mt-10 text base md:text-xs lg:text-sm xl:text-base">SEA Catering as a customizable healthy meal service with delivery all across Indonesia.</p>

                <div class="mt-10 md:mt-6 lg:mt-8 xl:mt-10 flex flex-wrap gap-5">
                    <button data-target="meal-plans" id="btn-get-meal" type="button" class="cursor-pointer text-white bg-green-800 hover:bg-green-700 transition-colors duration-300 font-medium rounded-3xl px-9 md:px-4 text-sm lg:text-base lg:px-6 xl:px-9 py-3 md:py-2 xl:py-3 text-center">
                        Get your meal
                    </button>

                    <a href="/subscription" class="cursor-pointer text-green-800 border border-green-800 bg-white hover:text-white hover:bg-green-700 transition-colors duration-300 font-medium rounded-3xl px-9 md:px-4 text-sm lg:text-base lg:px-6 xl:px-9 py-3 md:py-2 xl:py-3 text-center">
                        Subscribe us
                    </a>
                </div>

                <div class="mt-10 md:mt-6 lg:mt-8 xl:mt-10 flex flex-wrap gap-10 sm:gap-16">
                    <div class="">
                        <h2 class="text-green-800 font-bold text-5xl md:text-3xl lg:text-4xl xl:text-5xl mb-1 total-happy-customers">...</h2>
                        <p class="text-gray-500 text-base md:text-xs lg:text-base">Happy Customers</p>
                    </div>

                    <div class="">
                        <h2 class="text-green-800 font-bold text-5xl md:text-3xl lg:text-4xl xl:text-5xl mb-1 total-subscriptions">...</h2>
                        <p class="text-gray-500 text-base md:text-xs lg:text-base">Subscription</p>
                    </div>
                </div>
            </div>
    
            <div class="">
                <div class="w-full h-[308px] sm:h-[448px] md:w-[404px] md:h-[408px] lg:w-[544px] lg:h-[548px] xl:w-[644px] xl:h-[648px]">
                    <img class="w-full h-full object-cover rounded-t-[20px] rounded-br-[20px] rounded-bl-[90px] lg:rounded-bl-[150px]" src="{{ url('assets/images/hero.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        document.querySelectorAll('#btn-get-meal').forEach(item => {
        item.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });
    </script>

    <script src="{{ url('assets/js/landing-page/hero.js') }}"></script>
@endpush