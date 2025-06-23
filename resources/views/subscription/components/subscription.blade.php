<div class="w-full mb-20 relative top-[180px]">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-10 flex justify-center pb-52">
        <div class="w-full">
            <h2 class="text-green-800 text-3xl text-center mb-10">Subscription Form</h2>

            @php
                $hasActiveSubscription = $subscriptions->pluck('status')->intersect(['active', 'pause'])->isNotEmpty();
            @endphp
            @if ($hasActiveSubscription)
                <div class="relative col-span-2 p-6 rounded-xl border-l-4 border-green-600 bg-green-50 shadow-md animate-fade-in">
                    <div class="flex items-start gap-4">
                        <div class="text-green-600 text-3xl">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-green-800">You're Already Subscribed</h3>
                            <p class="text-sm text-green-700 mt-1">
                                You have an active or paused subscription. Please wait for it to end or cancel it before subscribing again.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid gap-6 mb-6 md:grid-cols-2 w-full">
                    <div class="subscription-error-message hidden col-span-2"></div>
                    <div class="subscription-success-message hidden col-span-2"></div>

                    <div>
                        <label for="full-name" class="block mb-2 font-medium text-gray-900">Full Name</label>
                        <input value="{{ $user->name ?? null }}" type="text" id="full-name"
                            class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter your full name" required />
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 font-medium text-gray-900">Phone
                            Number</label>
                        <input type="text" id="phone"
                            class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter your phone number" required />
                    </div>
                    <div>
                        <label for="plan-selection" class="block mb-2 font-medium text-gray-900">Plan Selection</label>
                        <select id="plan-selection"
                            class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Doe" required>
                            <option selected>Choose your plan</option>
                            <option value="1">Diet Plan</option>
                            <option value="2">Protein Plan</option>
                            <option value="3">Royal Plan</option>
                        </select>
                    </div>
                    <div>
                        <label for="meal-type" class="block mb-2 font-medium text-gray-900">Meal Type</label>
                        <select id="meal-type" required name="meal-types[]" multiple="multiple">
                            <option value="1">Breakfast</option>
                            <option value="2">Lunch</option>
                            <option value="3">Dinner</option>
                        </select>
                        <small class="text-[#333333]">You can choose more than one option</small>
                    </div>
                    <div class="col-span-2">
                        <label for="delivery-days" class="block mb-2 font-medium text-gray-900">Delivery Days</label>
                        <select id="delivery-days" required name="delivery-days[]" multiple="multiple">
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                        </select>
                        <small class="text-[#333333]">You can choose more than one option</small>
                    </div>
                    <div class="col-span-2">
                        <label for="allergies" class="block mb-2 font-medium text-gray-900">Allergies</label>
                        <textarea rows="8" id="allergies"
                        class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Enter when you have allergies with some ingredients"></textarea>
                        <small class="text-[#333333]">Separate with comma ','</small>
                    </div>
                </div>

                <div class="mt-12">
                    <button data-modal-target="price-modal" data-modal-toggle="price-modal" id="btn-subscribe"
                        class="bg-green-800 text-white text-lg rounded-[25px] px-10 py-2 cursor-pointer hover:bg-green-700 duration-300">Subscribe</button>
                </div>
            @endif

        </div>
    </div>
</div>

{{-- Modal --}}
<div id="price-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Summary Plan
                </h3>
                <button type="button" class="btn-close-price cursor-pointer text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="price-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <ul id="summary-plan" class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    
                </ul>

                <p class="font-semibold text-[#333333]">Total Price :</p>
                <p id="total-price" class="font-bold text-[#333333] text-2xl">.....</p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="price-modal" type="button" class="btn-accept cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Accept</button>
                <button data-modal-hide="price-modal" type="button" class="btn-decline cursor-pointer py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
            </div>
        </div>
    </div>
</div>

@push('vendor-script')
    <script src="{{ url('assets/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ url('assets/libs/select2/select2.js') }}"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            new Cleave('#phone', {
                blocks: [4, 4, 5,],
                delimiter: ' ',
                numericOnly: true
            })

            $('#meal-type').select2({ placeholder: "Choose your meal type", width: '100%' });
            $('#delivery-days').select2({ placeholder: "Choose your delivery days", width: '100%' });
            $('.select2-container--default .select2-selection--multiple').addClass('!bg-gray-50 !border !border-[#333333] !text-sm !rounded-lg !p-2 !focus:ring-blue-500 !focus:border-blue-500');
            $('.select2-container--default .select2-selection--multiple .select2-search__field').addClass('!ml-0 !mt-0 !align-baseline');
        })
    </script>

    <script src="{{ url('assets/js/subscription/subscription.js') }}"></script>
@endpush