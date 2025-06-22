@extends('layout.dashboard.dashboard')

@section('title', 'Sea Catering - Subscriptions Management')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 w-full">
                <div class="mb-4 border-b border-gray-200 w-full">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center w-full" id="default-tab"
                        data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="cursor-pointer inline-block p-4 border-b-2 rounded-t-lg" id="subscriptions-tab"
                                data-tabs-target="#subscriptions" type="button" role="tab" aria-controls="subscriptions"
                                aria-selected="false">Subscriptions</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="cursor-pointer inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                id="dashboard-tab" data-tabs-target="#reactivations" type="button" role="tab"
                                aria-controls="reactivations" aria-selected="false">Reactivations</button>
                        </li>
                    </ul>
                </div>
                <div id="default-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-50" id="subscriptions" role="tabpanel"
                        aria-labelledby="subscriptions-tab">
                        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    Subscriptions
                                </h3>
                            </div>
                            <div class="">
                                <div class="relative w-full sm:w-fit">
                                    <input
                                        class="datepicker-subscriptions h-10 w-full rounded-lg border border-gray-200 bg-white py-2.5 pl-[34px] pr-4 text-sm font-medium text-gray-700 shadow-xs focus:outline-hidden focus:ring-0 focus-visible:outline-hidden xl:max-w-fit xl:pl-11"
                                        placeholder="Select dates" data-class="flatpickr-right" readonly="readonly" />
                                    <div class="absolute inset-0 right-auto flex items-center pointer-events-none left-4">
                                        <svg class="fill-gray-700 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66683 1.54199C7.08104 1.54199 7.41683 1.87778 7.41683 2.29199V3.00033H12.5835V2.29199C12.5835 1.87778 12.9193 1.54199 13.3335 1.54199C13.7477 1.54199 14.0835 1.87778 14.0835 2.29199V3.00033L15.4168 3.00033C16.5214 3.00033 17.4168 3.89576 17.4168 5.00033V7.50033V15.8337C17.4168 16.9382 16.5214 17.8337 15.4168 17.8337H4.5835C3.47893 17.8337 2.5835 16.9382 2.5835 15.8337V7.50033V5.00033C2.5835 3.89576 3.47893 3.00033 4.5835 3.00033L5.91683 3.00033V2.29199C5.91683 1.87778 6.25262 1.54199 6.66683 1.54199ZM6.66683 4.50033H4.5835C4.30735 4.50033 4.0835 4.72418 4.0835 5.00033V6.75033H15.9168V5.00033C15.9168 4.72418 15.693 4.50033 15.4168 4.50033H13.3335H6.66683ZM15.9168 8.25033H4.0835V15.8337C4.0835 16.1098 4.30735 16.3337 4.5835 16.3337H15.4168C15.693 16.3337 15.9168 16.1098 15.9168 15.8337V8.25033Z"
                                                fill="" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="custom-scrollbar max-w-full overflow-x-auto overflow-y-visible sm:px-6">
                            <table class="min-w-full">
                                <thead class="border-y border-gray-100 py-3">
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">No</p>
                                        </div>
                                    </th>
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Name</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Plan</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Price</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Start Date</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">End Date</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Status</p>
                                        </div>
                                    </th>
                                </thead>
                                <tbody class="divide-y divide-gray-100" id="latest-subscriptions-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50" id="reactivations" role="tabpanel"
                        aria-labelledby="reactivations-tab">
                        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    Reactivationss
                                </h3>
                            </div>
                            <div class="">
                                <div class="relative w-full sm:w-fit">
                                    <input
                                        class="datepicker-subscriptions h-10 w-full rounded-lg border border-gray-200 bg-white py-2.5 pl-[34px] pr-4 text-sm font-medium text-gray-700 shadow-xs focus:outline-hidden focus:ring-0 focus-visible:outline-hidden xl:max-w-fit xl:pl-11"
                                        placeholder="Select dates" data-class="flatpickr-right" readonly="readonly" />
                                    <div class="absolute inset-0 right-auto flex items-center pointer-events-none left-4">
                                        <svg class="fill-gray-700 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66683 1.54199C7.08104 1.54199 7.41683 1.87778 7.41683 2.29199V3.00033H12.5835V2.29199C12.5835 1.87778 12.9193 1.54199 13.3335 1.54199C13.7477 1.54199 14.0835 1.87778 14.0835 2.29199V3.00033L15.4168 3.00033C16.5214 3.00033 17.4168 3.89576 17.4168 5.00033V7.50033V15.8337C17.4168 16.9382 16.5214 17.8337 15.4168 17.8337H4.5835C3.47893 17.8337 2.5835 16.9382 2.5835 15.8337V7.50033V5.00033C2.5835 3.89576 3.47893 3.00033 4.5835 3.00033L5.91683 3.00033V2.29199C5.91683 1.87778 6.25262 1.54199 6.66683 1.54199ZM6.66683 4.50033H4.5835C4.30735 4.50033 4.0835 4.72418 4.0835 5.00033V6.75033H15.9168V5.00033C15.9168 4.72418 15.693 4.50033 15.4168 4.50033H13.3335H6.66683ZM15.9168 8.25033H4.0835V15.8337C4.0835 16.1098 4.30735 16.3337 4.5835 16.3337H15.4168C15.693 16.3337 15.9168 16.1098 15.9168 15.8337V8.25033Z"
                                                fill="" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="custom-scrollbar max-w-full overflow-x-auto overflow-y-visible sm:px-6">
                            <table class="min-w-full">
                                <thead class="border-y border-gray-100 py-3">
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">No</p>
                                        </div>
                                    </th>
                                    <th class="py-3 pr-5 font-normal whitespace-nowrap sm:pr-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Name</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Plan</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Price</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Start Date</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">End Date</p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 font-normal whitespace-nowrap sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-sm text-gray-500">Status</p>
                                        </div>
                                    </th>
                                </thead>
                                <tbody class="divide-y divide-gray-100" id="latest-subscriptions-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('script')
        <script src="{{ url('assets/js/dashboard/admin/subscriptions.js') }}"></script>
    @endpush
@endsection