@extends('layout.dashboard.dashboard')

@section('title', 'Sea Catering - Dashboard Admin')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-3">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 h-full">
                    <h4 id="total-revenue" class="text-3xl font-bold text-gray-800">
                        Rp0
                    </h4>

                    <div class="mt-4 flex items-end justify-between sm:mt-5">
                        <div>
                            <p class="text-sm text-gray-700">
                                Total Revenue
                            </p>
                        </div>

                        <div class="flex items-center gap-1">
                            <span id="total-revenue-growth"
                                class="flex items-center gap-1 rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-600">
                                +0%
                            </span>

                            <span class="text-xs text-gray-500">
                                From last month
                            </span>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 h-full">
                    <h4 id="active-sub-revenue" class="text-3xl font-bold text-gray-800">
                        Rp0
                    </h4>

                    <div class="mt-4 flex items-end justify-between sm:mt-5">
                        <div>
                            <p class="text-sm text-gray-700">
                                Active Subscription Revenue
                            </p>
                        </div>

                        <div class="flex items-center gap-1">
                            <span id="active-sub-growth"
                                class="flex items-center gap-1 rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-600">
                                +0%
                            </span>

                            <span class="text-xs text-gray-500">
                                From last month
                            </span>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 h-full">
                    <h4 id="active-subscriptions" class="text-3xl font-bold text-gray-800">
                        0
                    </h4>

                    <div class="mt-4 flex items-end justify-between sm:mt-5">
                        <div>
                            <p class="text-sm text-gray-700">
                                Active Subscription
                            </p>
                        </div>

                        <div class="flex items-center gap-1">
                            <span id="active-subscriptions-growth"
                                class="flex items-center gap-1 rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-600">
                                +0%
                            </span>

                            <span class="text-xs text-gray-500">
                                From last month
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 xl:col-span-8">
            <div class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 h-full">
                <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
                    <div class="w-full">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Monthly Recurring Revenue
                        </h3>
                        <p class="mt-1 text-gray-500 text-sm">
                            Total revenue from active subscriptions during the selected period.
                        </p>
                    </div>

                    <div class="flex items-start w-full gap-3 sm:justify-end">
                        <div class="relative w-fit">
                            <input
                                class="datepicker h-10 w-full rounded-lg border border-gray-200 bg-white py-2.5 pl-[34px] pr-4 text-sm font-medium text-gray-700 shadow-xs focus:outline-hidden focus:ring-0 focus-visible:outline-hidden xl:max-w-fit xl:pl-11"
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
                <div class="max-w-full overflow-x-auto overflow-y-hidden custom-scrollbar">
                    <div id="chartThree" class="-ml-4 min-w-[700px] pl-2 xl:min-w-full"></div>
                </div>
            </div>
        </div>

        <div class="col-span-12 xl:col-span-4">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 h-full">
                <div class="rounded-2xl bg-white">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Subscriptions Growth
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Overall number of active subscriptions.
                            </p>
                        </div>
                    </div>
                    <div class="relative sm:max-h-[195px]">
                        <div id="chartTwo" class="h-full"></div>
                        <span id="subs-growth-badge" class="absolute left-1/2 top-[95%] -translate-x-1/2 -translate-y-[85%] rounded-full bg-green-50 px-3 py-1 text-xs font-medium text-green-600">+10%</span>
                        <span class="absolute left-1/2 bottom-[-20%] -translate-x-1/2 -translate-y-[85%] text-xs font-medium text-gray-500">From last month</span>
                    </div>
                    <p id="subs-growth-text" class="mx-auto mt-[28px] w-full max-w-[380px] text-center text-sm text-gray-500 sm:text-base">
                        
                    </p>
                </div>

                <div class="flex items-center justify-center gap-5 px-6 py-3.5 sm:gap-8 sm:py-5 mt-3">
                    <div>
                        <p class="mb-1 text-center text-xs text-gray-500 sm:text-sm">
                            Total Subscriptions
                        </p>
                        <p id="subs-total" class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 sm:text-lg">
                            0
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.26816 13.6632C7.4056 13.8192 7.60686 13.9176 7.8311 13.9176C7.83148 13.9176 7.83187 13.9176 7.83226 13.9176C8.02445 13.9178 8.21671 13.8447 8.36339 13.6981L12.3635 9.70076C12.6565 9.40797 12.6567 8.9331 12.3639 8.6401C12.0711 8.34711 11.5962 8.34694 11.3032 8.63973L8.5811 11.36L8.5811 2.5C8.5811 2.08579 8.24531 1.75 7.8311 1.75C7.41688 1.75 7.0811 2.08579 7.0811 2.5L7.0811 11.3556L4.36354 8.63975C4.07055 8.34695 3.59568 8.3471 3.30288 8.64009C3.01008 8.93307 3.01023 9.40794 3.30321 9.70075L7.26816 13.6632Z"
                                    fill="#D92D20" />
                            </svg>
                        </p>
                    </div>

                    <div class="h-7 w-px bg-gray-200"></div>

                    <div>
                        <p class="mb-1 text-center text-xs text-gray-500 sm:text-sm">
                            Last Month
                        </p>
                        <p id="subs-last-month" class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 sm:text-lg">
                            0
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.60141 2.33683C7.73885 2.18084 7.9401 2.08243 8.16435 2.08243C8.16475 2.08243 8.16516 2.08243 8.16556 2.08243C8.35773 2.08219 8.54998 2.15535 8.69664 2.30191L12.6968 6.29924C12.9898 6.59203 12.9899 7.0669 12.6971 7.3599C12.4044 7.6529 11.9295 7.65306 11.6365 7.36027L8.91435 4.64004L8.91435 13.5C8.91435 13.9142 8.57856 14.25 8.16435 14.25C7.75013 14.25 7.41435 13.9142 7.41435 13.5L7.41435 4.64442L4.69679 7.36025C4.4038 7.65305 3.92893 7.6529 3.63613 7.35992C3.34333 7.06693 3.34348 6.59206 3.63646 6.29926L7.60141 2.33683Z"
                                    fill="#039855" />
                            </svg>
                        </p>
                    </div>

                    <div class="h-7 w-px bg-gray-200"></div>

                    <div>
                        <p class="mb-1 text-center text-xs text-gray-500 sm:text-sm">
                            This Month
                        </p>
                        <p class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 sm:text-lg">
                            <span id="subs-this-month-value">0</span>
                            <span id="subs-this-month-trend-icon"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 xl:col-span-6">
            <div class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 h-full">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Subscriptions Status
                    </h3>
                </div>
                <div class="flex flex-col items-center gap-8 xl:flex-row">
                    <div id="chartThirteen" class="chartDarkStyle"></div>
                    <div class="flex flex-col items-start gap-6 sm:flex-row xl:flex-col">
                        <div class="flex items-start gap-2.5" id="subs-status-active">
                            <div class="bg-[#3641f5] mt-1.5 h-2 w-2 rounded-full"></div>
                            <div>
                                <h5 class="mb-1 font-medium text-gray-800 text-sm">
                                    Active
                                </h5>
                                <div class="flex items-center gap-2">
                                    <p class="font-medium text-gray-700 text-sm percentage">
                                        0%
                                    </p>
                                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                    <p class="text-gray-500 text-sm count">
                                        0 Subscriptions
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5" id="subs-status-pause">
                            <div class="bg-[#7592ff] mt-1.5 h-2 w-2 rounded-full"></div>
                            <div>
                                <h5 class="mb-1 font-medium text-gray-800 text-sm">
                                    Pause
                                </h5>
                                <div class="flex items-center gap-2">
                                    <p class="font-medium text-gray-700 text-sm percentage">
                                        0%
                                    </p>
                                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                    <p class="text-gray-400 text-sm count">
                                        0 Subscriptions
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5" id="subs-status-cancel">
                            <div class="bg-[#dde9ff] mt-1.5 h-2 w-2 rounded-full"></div>
                            <div>
                                <h5 class="mb-1 font-medium text-gray-800 text-sm">
                                    Cancel
                                </h5>
                                <div class="flex items-center gap-2">
                                    <p class="font-medium text-gray-700 text-sm percentage">
                                        0%
                                    </p>
                                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                    <p class="text-gray-500 text-sm count">
                                        0 Subscriptions
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 xl:col-span-6">
            <div class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 h-full">
                <div class="flex justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            New Subscriptions
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Total number of new subscriptions
                        </p>
                    </div>

                    <div class="flex items-start gap-3 sm:justify-end">
                        <div class="relative w-fit">
                            <input
                                class="datepicker h-10 w-full rounded-lg border border-gray-200 bg-white py-2.5 pl-[34px] pr-4 text-sm font-medium text-gray-700 shadow-xs focus:outline-hidden focus:ring-0 focus-visible:outline-hidden xl:max-w-fit xl:pl-11"
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

                <div class="relative text-center py-5">
                    <h2 class="text-6xl font-semibold mb-2">100</h2>
                </div>

                <div class="border-gray-200 space-y-2.5 border-t pt-6 dark:border-gray-800">
                    <div>
                        <p class="mb-1 text-sm text-gray-500">
                            Diet Plan
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="text-base font-semibold text-gray-800">
                                        100
                                    </p>
                                </div>
                            </div>

                            <div class="flex w-full max-w-[140px] items-center gap-3">
                                <div class="relative block h-2 w-full max-w-[100px] rounded-sm bg-gray-200">
                                    <div
                                        class="absolute left-0 top-0 flex h-full w-[85%] items-center justify-center rounded-sm bg-[#465fff] text-xs font-medium text-white">
                                    </div>
                                </div>
                                <p class="text-sm font-medium text-gray-700">
                                    85%
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-1 text-sm text-gray-500">Protein Plan</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="text-base font-semibold text-gray-800">
                                        20
                                    </p>
                                </div>
                            </div>

                            <div class="flex w-full max-w-[140px] items-center gap-3">
                                <div
                                    class="relative block h-2 w-full max-w-[100px] rounded-sm bg-gray-200 dark:bg-gray-800">
                                    <div
                                        class="absolute left-0 top-0 flex h-full w-[55%] items-center justify-center rounded-sm bg-[#465fff] text-xs font-medium text-white">
                                    </div>
                                </div>
                                <p class="text-sm font-medium text-gray-700">
                                    55%
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-1 text-sm text-gray-500">Royal Plan</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="text-base font-semibold text-gray-800">
                                        200
                                    </p>
                                </div>
                            </div>

                            <div class="flex w-full max-w-[140px] items-center gap-3">
                                <div
                                    class="relative block h-2 w-full max-w-[100px] rounded-sm bg-gray-200 dark:bg-gray-800">
                                    <div
                                        class="absolute left-0 top-0 flex h-full w-[55%] items-center justify-center rounded-sm bg-[#465fff] text-xs font-medium text-white">
                                    </div>
                                </div>
                                <p class="text-sm font-medium text-gray-700">
                                    55%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 dark:bg-white/[0.03]">
                <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Latest Subscriptions
                        </h3>
                    </div>
                </div>

                <div class="custom-scrollbar max-w-full overflow-x-auto overflow-y-visible px-5 sm:px-6">
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
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                    <div class="col-span-3 flex items-center">
                                        <div>
                                            <span class="text-sm block font-medium text-gray-700">
                                                1
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                    <div class="col-span-3 flex items-center">
                                        <div>
                                            <span class="text-sm block font-medium text-gray-700">
                                                Bought PYPL
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-sm text-gray-700">
                                            Nov 23, 01:00 PM
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-sm text-gray-700">
                                            $2,567.88
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-sm text-gray-700">
                                            Finance
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-sm text-gray-700">
                                            Finance
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <div class="flex items-center">
                                        <p
                                            class="bg-green-50 text-xs text-green-600 rounded-full px-2 py-0.5 font-medium">
                                            Success
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ url('assets/js/dashboard/admin/index.js') }}"></script>
    @endpush
@endsection