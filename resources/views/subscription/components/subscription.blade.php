<div class="w-full mb-20 relative top-[180px]">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-10 flex justify-center pb-52">
        <div class="w-full">
            <h2 class="text-green-800 text-3xl text-center mb-10">Subscription Form</h2>

            <div class="grid gap-6 mb-6 md:grid-cols-2 w-full">
                <div>
                    <label for="full-name" class="block mb-2 font-medium text-gray-900">Full Name</label>
                    <input type="text" id="full-name"
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
                    <label for="meal-type"
                    class="block mb-2 font-medium text-gray-900">Meal Type</label>
                    <select id="meal-type"
                        required name="meal-types[]" multiple="multiple">
                        <option value="1">Breakfast</option>
                        <option value="2">Lunch</option>
                        <option value="3">Dinner</option>
                    </select>
                    <small class="text-[#333333]">You can choose more than one option</small>
                </div>
                <div class="col-span-2">
                    <label for="delivery-days"
                    class="block mb-2 font-medium text-gray-900">Delivery Days</label>
                    <select id="delivery-days"
                    required name="delivery-days[]" multiple="multiple">
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
                        placeholder="Enter when you have allergies with some ingredients" required></textarea>
                </div>
            </div>

            <div class="mt-14">
                <button class="bg-green-800 text-white text-lg rounded-[25px] px-10 py-2 cursor-pointer hover:bg-green-700 duration-300">Subscribe</button>
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
        $(document).ready(function() {
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