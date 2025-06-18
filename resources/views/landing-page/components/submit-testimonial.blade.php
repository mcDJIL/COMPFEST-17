<div class="w-full pt-20 pb-20 overflow-hidden">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-10 flex justify-center">
        <div class="w-full">
            <div class="text-center mb-8">
                <h2 class="text-3xl text-green-800">Submit New Testimonial</h2>
            </div>

            <div class="w-full md:px-32 lg:px-52">
                <div class="">
                    <label for="input-group-1" class="block mb-2 font-medium text-[#333333]">Customer Name</label>
                    <div class="relative mb-4">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <input type="text" id="input-group-1" class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Enter your full name">
                    </div>
                </div>
                <div class="">
                    <label for="input-group-2" class="block mb-2 font-medium text-[#333333]">Review Message</label>
                    <div class="relative mb-4">
                        <div class="absolute top-3 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-message"></i>
                        </div>
                        <textarea id="input-group-2" rows="4" class="block p-2.5 w-full text-sm text-[#333333] bg-gray-50 rounded-lg border border-[#333333] focus:ring-blue-500 focus:border-blue-500 ps-10" placeholder="Enter your review message"></textarea>
                    </div>
                </div>
                <div class="">
                    <label for="input-group-3" class="block mb-2 font-medium text-[#333333]">Customer Name</label>
                    <div class="relative mb-4">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </div>
                        <select id="input-group-3" class="bg-gray-50 border border-[#333333] text-[#333333] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5">
                            <option selected>Select your rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="mt-10">
                    <button type="button" class="cursor-pointer px-12 py-2 rounded-[20px] bg-green-800 text-white text-lg duration-300 hover:bg-green-700">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>