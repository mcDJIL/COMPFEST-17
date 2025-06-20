<section id="meal-plans" class="w-full pt-20 pb-20 bg-[#f1f1f1]">
    <div class="max-w-screen-xl w-full flex mx-auto px-6 sm:px-10">
        <div class="w-full">
            <div class="">
                <h2 class="text-3xl text-green-800">Meal Plans</h2>
            </div>

            <div class="mt-10 flex justify-center md:justify-between flex-wrap gap-10">
                <div class="w-[350px] rounded-[20px] bg-white p-5">
                    <div class="relative">
                        <img class="plan-image" src="{{ url('assets/images/diet.png') }}" alt="">

                        <div class="absolute -bottom-5 left-2/4 transform -translate-x-2/4 bg-[#81C784] text-white px-10 py-2 rounded-[30px] whitespace-nowrap">
                            <p class="plan-price">Rp 30.000,00</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="text-xl font-semibold text-[#333333] mb-2 plan-name">Diet Plan</h4>
                        <p class="text-gray-500 plan-description">Low-calorie meals tailored for weight management. Perfect for those aiming to eat light and stay healthy.</p>
                    </div>

                    <div class="mt-5">
                        <button data-modal-target="diet-modal" data-modal-toggle="diet-modal" type="button" class="px-10 py-2 cursor-pointer rounded-[30px] bg-[#333333] hover:bg-[#3d3d3d] text-white text-lg duration-300">Detail</button>
                    </div>
                </div>

                <div class="w-[350px] rounded-[20px] bg-white p-5">
                    <div class="relative">
                        <img class="plan-image" src="{{ url('assets/images/royal.png') }}" alt="">

                        <div class="absolute -bottom-5 left-2/4 transform -translate-x-2/4 bg-[#FFCC2B] text-white px-10 py-2 rounded-[30px] whitespace-nowrap">
                            <p class="plan-price">Rp 60.000,00</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="text-xl font-semibold text-[#333333] mb-2 plan-name">Royal Plan</h4>
                        <p class="text-gray-500 plan-description">Premium, balanced meals with exclusive ingredients and full portions. A luxurious choice for your daily nutrition.</p>
                    </div>

                    <div class="mt-5">
                        <button data-modal-target="royal-modal" data-modal-toggle="royal-modal" type="button" class="px-10 py-2 cursor-pointer rounded-[30px] bg-[#333333] hover:bg-[#3d3d3d] text-white text-lg duration-300">Detail</button>
                    </div>
                </div>

                <div class="w-[350px] rounded-[20px] bg-white p-5">
                    <div class="relative">
                        <img class="plan-image" src="{{ url('assets/images/protein.png') }}" alt="">

                        <div class="absolute -bottom-5 left-2/4 transform -translate-x-2/4 bg-[#64B5F6] text-white px-10 py-2 rounded-[30px] whitespace-nowrap">
                            <p class="plan-price">Rp 40.000,00</p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="text-xl font-semibold text-[#333333] mb-2 plan-name">Protein Plan</h4>
                        <p class="text-gray-500 plan-description">High-protein meals to support muscle growth and active lifestyles. Ideal for gym-goers and fitness enthusiasts.</p>
                    </div>

                    <div class="mt-5">
                        <button data-modal-target="protein-modal" data-modal-toggle="protein-modal" type="button" class="px-10 py-2 cursor-pointer rounded-[30px] bg-[#333333] hover:bg-[#3d3d3d] text-white text-lg duration-300">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal --}}
<div id="diet-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-[#333333] dark:text-white">
                    🥗 Diet Plan Details
                </h3>
                <button type="button" class="cursor-pointer text-gray-400 bg-transparent hover:bg-gray-200 hover:text-[#333333] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="diet-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    Our <span class="font-semibold">Diet Plan</span> is specially crafted for individuals looking to manage or lose weight without sacrificing flavor. Each meal is designed to be light yet fulfilling, combining fresh, low-calorie ingredients with balanced nutrition to support a healthy lifestyle.
                </p>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">🍱 Meal Types:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Fresh salads with homemade dressing
                    </li>
                    <li>
                        Clear soups and stir-fried greens
                    </li>
                    <li>
                        Steamed chicken breast, tofu, tempeh, grilled fish
                    </li>
                    <li>
                        Healthy carbs like red rice, quinoa, and boiled potatoes
                    </li>
                </ul>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">🥬 Dietary Options:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Vegetarian & vegan-friendly options available
                    </li>
                    <li>
                        Each meal ranges between <span class="font-semibold">400–600 kcal</span>
                    </li>
                    <li>
                        Low in fat and high in fiber for improved digestion
                    </li>
                </ul>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">⭐ Plan Features:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Carefully portioned meals for weight control
                    </li>
                    <li>
                        Helps maintain a calorie deficit
                    </li>
                    <li>
                        Ideal for those aiming for a healthier daily routine
                    </li>
                    <li>
                        Promotes sustainable, long-term wellness goals
                    </li>
                </ul>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <a data-modal-hide="diet-modal" href="/subscription" class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Subscribe</a>
            </div>
        </div>
    </div>
</div>

<div id="protein-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-[#333333] dark:text-white">
                    💪 Protein Plan Details
                </h3>
                <button type="button" class="cursor-pointer text-gray-400 bg-transparent hover:bg-gray-200 hover:text-[#333333] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="protein-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The <span class="font-semibold">Protein Plan</span> is built to support active lifestyles by providing meals rich in high-quality protein. Whether you're aiming to build muscle, tone your body, or simply stay energized throughout the day, this plan fuels your performance with the right nutrients.
                </p>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">🍱 Meal Types:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Grilled salmon, lean beef, chicken breast
                    </li>
                    <li>
                        Tofu, boiled eggs, edamame, tempeh
                    </li>
                    <li>
                        Complex carbs like oats, sweet potatoes, red rice
                    </li>
                    <li>
                        Balanced with fresh vegetables
                    </li>
                </ul>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">🥩 Dietary Options:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        <span class="font-semibold">25–40g protein per meal</span>
                    </li>
                    <li>
                        Low in sugar and refined carbs
                    </li>
                    <li>
                        Moderate-carb, high-protein formula
                    </li>
                </ul>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">⭐ Plan Features:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Supports muscle growth and post-workout recovery
                    </li>
                    <li>
                        Designed for fitness enthusiasts and athletes
                    </li>
                    <li>
                        Keeps you full and energized longer
                    </li>
                    <li>
                        Perfect for strength training or weight maintenance diets
                    </li>
                </ul>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <a data-modal-hide="protein-modal" href="/subscription" class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Subscribe</a>
            </div>
        </div>
    </div>
</div>

<div id="royal-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-[#333333] dark:text-white">
                    👑 Royal Plan Details
                </h3>
                <button type="button" class="cursor-pointer text-gray-400 bg-transparent hover:bg-gray-200 hover:text-[#333333] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="royal-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The <span class="font-semibold">Royal Plan</span> offers a premium dining experience in every bite. This plan features full-portioned, chef-curated meals made with high-quality ingredients and luxurious flavor combinations. Ideal for those who seek taste, nutrition, and variety—every day.
                </p>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">🍱 Meal Types:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Gourmet selections like chicken steak, teriyaki salmon, healthy rendang
                    </li>
                    <li>
                        Premium sides such as mashed potatoes, basmati rice, artisan salads
                    </li>
                    <li>
                        Optional healthy desserts like fruit parfaits, chia pudding, or low-cal cakes
                    </li>
                </ul>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">🍽️ Dietary Options:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Balanced in protein, carbs, and healthy fats
                    </li>
                    <li>
                        MSG-free and low-oil cooking methods
                    </li>
                    <li>
                        Curated weekly menu for diverse flavor experiences
                    </li>
                </ul>

                <p class="mb-2 text-lg font-semibold text-[#333333] dark:text-white">⭐ Plan Features:</p>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Full, satisfying portions for daily indulgence
                    </li>
                    <li>
                        Premium ingredients for top-quality taste
                    </li>
                    <li>
                        Ideal for busy professionals, food lovers, or gift subscriptions
                    </li>
                    <li>
                        A perfect blend of health, taste, and sophistication
                    </li>
                </ul>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <a data-modal-hide="royal-modal" href="/subscription" class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Subscribe</a>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="{{ url('assets/js/landing-page/meal-plans.js') }}"></script>
@endpush