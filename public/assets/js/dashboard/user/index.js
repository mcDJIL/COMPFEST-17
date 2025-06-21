(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../../ApiRoutes.js").then((m) => m.default),
        import("../../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class Index {
        constructor() {
            this.init();
        }

        init() {
            this.createPauseModal();
            this.createCancelModal();
            this.createContinueModal();
            this.loadActiveSubscription();
        }

        // Membuat modal untuk pause subscription
        createPauseModal() {
            const modalHtml = `
                <div id="pause-modal" class="fixed inset-0 bg-black/50 bg-opacity-30 overflow-y-auto h-full w-full hidden z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="mt-2 px-7 py-3">
                                <h3 class="text-lg font-medium text-gray-900 text-center">Pause Subscription</h3>
                                <p class="mt-2 text-sm text-gray-500 text-center">
                                    Select the period you want to pause your subscription
                                </p>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="pause-start" class="block text-sm font-medium text-gray-700">Start Date</label>
                                        <input type="date" id="pause-start" name="pause-start" 
                                               class="cursor-pointer mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="pause-end" class="block text-sm font-medium text-gray-700">End Date</label>
                                        <input type="date" id="pause-end" name="pause-end" 
                                               class="cursor-pointer mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center px-4 py-3 space-x-2">
                                <button id="btn-cancel-pause" 
                                        class="cursor-pointer flex-1 px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    Cancel
                                </button>
                                <button id="btn-confirm-pause" 
                                        class="cursor-pointer flex-1 px-4 py-2 bg-yellow-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                        data-id="">
                                    Confirm Pause
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Tambahkan modal ke body jika belum ada
            if (!document.getElementById('pause-modal')) {
                $('body').append(modalHtml);
            }
        }

        // Membuat modal untuk cancel subscription
        createCancelModal() {
            const modalHtml = `
                <div id="cancel-modal" class="fixed inset-0 bg-black/50 bg-opacity-30 overflow-y-auto h-full w-full hidden z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="mt-2 px-7 py-3">
                                <h3 class="text-lg font-medium text-gray-900 text-center">Cancel Subscription</h3>
                                <p class="mt-2 text-sm text-gray-500 text-center">
                                    Are you sure you want to cancel this subscription? This action cannot be undone and you will lose access to all subscription benefits.
                                </p>
                            </div>
                            <div class="flex items-center px-4 py-3 space-x-2">
                                <button id="btn-cancel-cancel" 
                                        class="cursor-pointer flex-1 px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    No, Back
                                </button>
                                <button id="btn-confirm-cancel" 
                                        class="cursor-pointer flex-1 px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                        data-id="">
                                    Yes, Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Tambahkan modal ke body jika belum ada
            if (!document.getElementById('cancel-modal')) {
                $('body').append(modalHtml);
            }
        }

        createContinueModal() {
            const modalHtml = `
                <div id="continue-modal" class="fixed inset-0 bg-black/50 bg-opacity-30 overflow-y-auto h-full w-full hidden z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="mt-2 px-7 py-3">
                                <h3 class="text-lg font-medium text-gray-900 text-center">Continue Subscription</h3>
                                <p class="mt-2 text-sm text-gray-500 text-center">
                                    Are you sure you want to continue this subscription?
                                </p>
                            </div>
                            <div class="flex items-center px-4 py-3 space-x-2">
                                <button id="btn-cancel-continue" 
                                        class="cursor-pointer flex-1 px-4 py-2 bg-gray-300 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    No, Back
                                </button>
                                <button id="btn-confirm-continue" 
                                        class="cursor-pointer flex-1 px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                                        data-id="">
                                    Yes, Continue
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Tambahkan modal ke body jika belum ada
            if (!document.getElementById('continue-modal')) {
                $('body').append(modalHtml);
            }
        }

        // Fungsi untuk menampilkan modal cancel
        showCancelModal(subscriptionId) {
            $('#btn-confirm-cancel').attr('data-id', subscriptionId);
            $('#cancel-modal').removeClass('hidden');
        }

        // Fungsi untuk menyembunyikan modal cancel
        hideCancelModal() {
            $('#cancel-modal').addClass('hidden');
        }

        showContinueModal(subscriptionId) {
            $('#btn-confirm-continue').attr('data-id', subscriptionId);
            $('#continue-modal').removeClass('hidden');
        }

        // Fungsi untuk menyembunyikan modal cancel
        hideContinueModal() {
            $('#continue-modal').addClass('hidden');
        }

        showPauseModal(subscriptionId) {
            $('#btn-confirm-pause').attr('data-id', subscriptionId);
            
            // Set minimum date untuk start date (besok)
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const tomorrowStr = tomorrow.toISOString().split('T')[0];
            $('#pause-start').attr('min', tomorrowStr);
            
            // Reset form
            $('#pause-start').val('');
            $('#pause-end').val('');
            
            $('#pause-modal').removeClass('hidden');
        }

        // Fungsi untuk menyembunyikan modal
        hidePauseModal() {
            $('#pause-modal').addClass('hidden');
        }

        loadActiveSubscription() {
            const url = ROUTES.subscriptions_active;
            const $container = $("#subscription-card");
            $container.html(`<div class="text-gray-400">Loading subscription data...</div>`);

            HelperApi.apiRequest(
                "GET",
                url,
                {},
                (res) => {
                    $container.empty();

                    const data = res.data;
                    const mealTypes = data.mealTypes
                        .map((mt) => mt.name)
                        .join(", ");
                    const deliveryDays = data.deliveryDays
                        .map((dd) => dd.name)
                        .join(", ");
                    const statusColor = {
                        active: "bg-green-100 text-green-800",
                        pause: "bg-yellow-100 text-yellow-800",
                    };

                    const subscriptionHtml = `
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-gray-500">Plan Name</p>
                                <p class="font-medium text-gray-800 dark:text-white">${data.plan_name}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Meal Types</p>
                                <p class="font-medium text-gray-800 dark:text-white">${mealTypes}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Delivery Days</p>
                                <p class="font-medium text-gray-800 dark:text-white">${deliveryDays}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Total Price</p>
                                ${data.status === 'active' ? (
                                    `<p class="font-medium text-gray-800 dark:text-white">Rp ${HelperApi.toIdr(data.total_price)}</p>`
                                ) : (
                                    `<p class="font-medium text-gray-800 dark:text-white">Rp ${HelperApi.toIdr(0)}</p>`
                                )}
                            </div>
                            <div>
                                <p class="text-gray-500">Status</p>
                                <span class="inline-block text-xs font-semibold px-2 py-1 rounded-full ${statusColor[data.status] ?? "bg-gray-200 text-gray-600"}">
                                    ${data.status.charAt(0).toUpperCase() + data.status.slice(1)}
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-6">
                            ${data.status === 'active' ? `
                                <button data-id="${data.id}" id="btn-pause"
                                    class="cursor-pointer bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Pause
                                </button>
                            ` : ''}
                            ${data.status === 'pause' ? `
                                <button data-id="${data.id}" id="btn-continue"
                                    class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Continue
                                </button>
                            ` : ''}
                            <button data-id="${data.id}" id="btn-cancel"
                                class="cursor-pointer bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Cancel
                            </button>
                        </div>
                    `;

                    $container.html(subscriptionHtml);

                    // Add listeners
                    this.attachListeners(data.id);
                },
                (xhr, status, err) => {
                    const res = xhr.responseJSON;

                    if (res && !res.status) {
                        const noSubscriptionHtml = `
                            <div class="p-6 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 rounded-md shadow-sm">
                                <h3 class="text-lg font-semibold mb-2">No Active Subscriptions Yet</h3>
                                <p class="mb-4">${res.message}</p>
                                <a href="/subscription"
                                    class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium px-4 py-2 rounded-md transition">
                                    Start Subscribe
                                </a>
                            </div>
                        `;
                        $container.html(noSubscriptionHtml);
                        return;
                    }

                    // Show error toast for API errors
                    HelperApi.showToast('danger', 'Failed to load subscription data. Please try again.');
                }
            );
        }

        attachListeners(id) {
            const self = this;

            // Event listener untuk tombol Pause - tampilkan modal
            $(document).off('click', '#btn-pause').on('click', '#btn-pause', function() {
                const subscriptionId = $(this).data('id');
                self.showPauseModal(subscriptionId);
            });

            // Event listener untuk tombol Cancel
            $(document).off('click', '#btn-cancel').on('click', '#btn-cancel', function() {
                const subscriptionId = $(this).data('id');
                self.showCancelModal(subscriptionId);
            });

            $(document).off('click', '#btn-continue').on('click', '#btn-continue', function() {
                const subscriptionId = $(this).data('id');
                self.showContinueModal(subscriptionId);
            });

            // Event listener untuk konfirmasi cancel
            $(document)
                .off("click", "#btn-confirm-cancel")
                .on("click", "#btn-confirm-cancel", function () {
                    const subscriptionId = $(this).attr("data-id");
                    self.cancelSubscription(subscriptionId);
                });

            // Event listener untuk cancel modal cancel
            $(document)
                .off("click", "#btn-cancel-cancel")
                .on("click", "#btn-cancel-cancel", function () {
                    self.hideCancelModal();
                });

            // Event listener untuk close cancel modal dengan klik di luar
            $(document)
                .off("click", "#cancel-modal")
                .on("click", "#cancel-modal", function (e) {
                    if (e.target === this) {
                        self.hideCancelModal();
                    }
            });

            // Event listener untuk konfirmasi pause
            $(document).off('click', '#btn-confirm-pause').on('click', '#btn-confirm-pause', function() {
                const pauseStart = $('#pause-start').val();
                const pauseEnd = $('#pause-end').val();
                const subscriptionId = $(this).attr('data-id');

                if (!pauseStart || !pauseEnd) {
                    HelperApi.showToast('warning', 'Please fill both start and end dates.');
                    return;
                }

                if (pauseEnd <= pauseStart) {
                    HelperApi.showToast('warning', 'End date must be after start date.');
                    return;
                }

                self.pauseSubscription(subscriptionId, pauseStart, pauseEnd);
            });

            // Event listener untuk cancel modal pause
            $(document).off('click', '#btn-cancel-pause').on('click', '#btn-cancel-pause', function() {
                self.hidePauseModal();
            });

            // Event listener untuk close modal dengan klik di luar
            $(document).off('click', '#pause-modal').on('click', '#pause-modal', function(e) {
                if (e.target === this) {
                    self.hidePauseModal();
                }
            });

            $(document)
                .off("click", "#btn-confirm-continue")
                .on("click", "#btn-confirm-continue", function () {
                    const subscriptionId = $(this).attr("data-id");
                    self.continueSubscription(subscriptionId);
                });

            $(document).off('click', '#btn-cancel-continue').on('click', '#btn-cancel-continue', function() {
                self.hideContinueModal();
            });

            $(document).off('click', '#continue-modal').on('click', '#continue-modal', function(e) {
                if (e.target === this) {
                    self.hideContinueModal();
                }
            });

            // Update pause-end minimum date when pause-start changes
            $(document).off('change', '#pause-start').on('change', '#pause-start', function() {
                const startDate = $(this).val();
                if (startDate) {
                    const nextDay = new Date(startDate);
                    nextDay.setDate(nextDay.getDate() + 1);
                    const nextDayStr = nextDay.toISOString().split('T')[0];
                    $('#pause-end').attr('min', nextDayStr);
                    
                    // Clear end date if it's before the new minimum
                    const currentEndDate = $('#pause-end').val();
                    if (currentEndDate && currentEndDate <= startDate) {
                        $('#pause-end').val('');
                    }
                }
            });
        }

        pauseSubscription(id, start, end) {
            const url = ROUTES.subscriptions_pause(id);
            const payload = {
                pause_start: start,
                pause_end: end,
            };

            const $confirmBtn = $('#btn-confirm-pause');
            const originalText = $confirmBtn.text();
            $confirmBtn.prop('disabled', true).text('Processing...');

            HelperApi.apiRequest(
                "PUT", 
                url, 
                payload, 
                (res) => {
                    $confirmBtn.prop('disabled', false).text(originalText);
                    
                    if (res.status) {
                        HelperApi.showToast('success', res.message || 'Subscription paused successfully!');
                        this.hidePauseModal();
                        this.loadActiveSubscription();
                    } else {
                        HelperApi.showToast('danger', res.message || 'Failed to pause subscription.');
                    }
                },
                (xhr, status, err) => {
                    $confirmBtn.prop('disabled', false).text(originalText);
                    
                    const res = xhr.responseJSON;
                    const errorMessage = res?.message || 'Failed to pause subscription. Please try again.';
                    HelperApi.showToast('danger', errorMessage);
                }
            );
        }

        continueSubscription(id) {
            const url = ROUTES.subscriptions_continue ? ROUTES.subscriptions_continue(id) : ROUTES.subscriptions_pause(id);
            
            const $continueBtn = $('#btn-confirm-continue');
            const originalText = $continueBtn.text();
            $continueBtn.prop('disabled', true).text('Processing...');

            HelperApi.apiRequest(
                "PUT", 
                url, 
                {}, 
                (res) => {
                    $continueBtn.prop('disabled', false).text(originalText);
                    
                    if (res.status) {
                        HelperApi.showToast('success', res.message || 'Subscription continued successfully!');
                        this.loadActiveSubscription();
                    } else {
                        HelperApi.showToast('danger', res.message || 'Failed to continue subscription.');
                    }

                    this.hideContinueModal();
                },
                (xhr, status, err) => {
                    $continueBtn.prop('disabled', false).text(originalText);
                    
                    const res = xhr.responseJSON;
                    const errorMessage = res?.message || 'Failed to continue subscription. Please try again.';
                    HelperApi.showToast('danger', errorMessage);

                    this.hideContinueModal();
                }
            );
        }

        cancelSubscription(id) {
            const url = ROUTES.subscriptions_cancel(id);
            
            const $cancelBtn = $('#btn-confirm-cancel');
            const originalText = $cancelBtn.text();
            $cancelBtn.prop('disabled', true).text('Processing...');

            HelperApi.apiRequest(
                "PUT", 
                url, 
                {}, 
                (res) => {
                    $cancelBtn.prop('disabled', false).text(originalText);
                    
                    if (res.status) {
                        HelperApi.showToast('success', res.message || 'Subscription cancelled successfully!');
                        this.loadActiveSubscription();
                    } else {
                        HelperApi.showToast('danger', res.message || 'Failed to cancel subscription.');
                    }

                    this.hideCancelModal();
                },
                (xhr, status, err) => {
                    $cancelBtn.prop('disabled', false).text(originalText);
                    
                    const res = xhr.responseJSON;
                    const errorMessage = res?.message || 'Failed to cancel subscription. Please try again.';
                    HelperApi.showToast('danger', errorMessage);

                    this.hideCancelModal();
                }
            );
        }
    }

    $(document).ready(function () {
        new Index();
    });
})();