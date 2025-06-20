(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then(m => m.default),
        import("../HelperApi.js").then(m => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    // Akan diupdate dari API
    let PLAN_NAMES = {};
    let PLAN_PRICES = {};
    let MEAL_TYPES = {};
    let DELIVERY_DAYS = {};

    class Subscription {
        constructor() {
            this.dataSubscription = {};
            
            this.init();
        }

        init() {
            this.loadInitialData();
            this.bindEvents();
        }

        bindEvents() {
            $(document).on('click', '#btn-subscribe', () => {
                const data = {
                    fullName: $('#full-name').val(),
                    phone: $('#phone').val(),
                    planSelection: $('#plan-selection').val(),
                    mealTypes: $('#meal-type').val(),
                    deliveryDays: $('#delivery-days').val(),
                    allergies: $('#allergies').val(),
                }

                // Validasi form terlebih dahulu
                if (!this.validateForm(data)) {
                    return;
                }

                this.calculatePrice(data);
            });

            // Event untuk tombol Accept di modal
            $(document).on('click', '[data-modal-hide="price-modal"]:contains("Accept")', () => {
                this.submitSubscription();
            });
        }

        // Load semua data yang diperlukan dari API
        async loadInitialData() {
            try {
                await Promise.all([
                    this.loadMealPlans(),
                    this.loadMealTypes(),
                    this.loadDeliveryDays()
                ]);
                
                console.log('All data loaded successfully');
            } catch (error) {
                console.error('Error loading initial data:', error);
            }
        }

        // Load data meal plans dari API
        loadMealPlans() {
            return new Promise((resolve, reject) => {
                const url = '/api/meal-plans'; // Sesuaikan dengan route API Anda
                
                HelperApi.apiRequest('GET', url, {}, (res) => {
                    if (res.status && res.data) {
                        // Clear existing options except the first one
                        $('#plan-selection option:not(:first)').remove();
                        
                        // Reset objects
                        PLAN_NAMES = {};
                        PLAN_PRICES = {};
                        
                        // Populate select options dan update objects
                        res.data.forEach(plan => {
                            // UUID sebagai string key
                            PLAN_NAMES[plan.id.toString()] = plan.name;
                            PLAN_PRICES[plan.id.toString()] = plan.price;
                            
                            $('#plan-selection').append(
                                `<option value="${plan.id}">${plan.name} - Rp${HelperApi.toIdr(plan.price)}</option>`
                            );
                        });
                        
                        console.log('Meal plans loaded:', PLAN_NAMES, PLAN_PRICES);
                        resolve();
                    } else {
                        reject(res.message || 'Failed to load meal plans');
                    }
                }, (xhr, status, err) => {
                    const res = xhr.responseJSON;
                    const errorMessage = res?.message || `Error loading meal plans: ${status}`;
                    console.error(errorMessage);
                    reject(errorMessage);
                });
            });
        }

        // Load data meal types dari API
        loadMealTypes() {
            return new Promise((resolve, reject) => {
                const url = ROUTES.meal_types_index; // Sesuaikan dengan route API Anda
                
                HelperApi.apiRequest('GET', url, {}, (res) => {
                    if (res.status && res.data) {
                        // Clear existing options
                        $('#meal-type').empty();
                        
                        // Reset object
                        MEAL_TYPES = {};
                        
                        // Populate select options dan update object
                        res.data.forEach(mealType => {
                            // UUID sebagai string key
                            MEAL_TYPES[mealType.id.toString()] = mealType.name;
                            
                            $('#meal-type').append(
                                `<option value="${mealType.id}">${mealType.name}</option>`
                            );
                        });
                        
                        // Refresh Select2 untuk meal-type
                        $('#meal-type').trigger('change');
                        
                        console.log('Meal types loaded:', MEAL_TYPES);
                        resolve();
                    } else {
                        reject(res.message || 'Failed to load meal types');
                    }
                }, (xhr, status, err) => {
                    const res = xhr.responseJSON;
                    const errorMessage = res?.message || `Error loading meal types: ${status}`;
                    console.error(errorMessage);
                    reject(errorMessage);
                });
            });
        }

        // Load data delivery days dari API
        loadDeliveryDays() {
            return new Promise((resolve, reject) => {
                const url = ROUTES.delivery_days_index;

                HelperApi.apiRequest('GET', url, {}, (res) => {
                    if (res.status && res.data) {
                        // Clear existing options
                        $('#delivery-days').empty();
                        
                        // Reset object
                        DELIVERY_DAYS = {};
                        
                        // Populate select options dan update object
                        res.data.forEach(day => {
                            // UUID sebagai string key
                            DELIVERY_DAYS[day.id.toString()] = day.name;
                            
                            $('#delivery-days').append(
                                `<option value="${day.id}">${day.name}</option>`
                            );
                        });
                        
                        // Refresh Select2 untuk delivery-days
                        $('#delivery-days').trigger('change');
                        
                        console.log('Delivery days loaded:', DELIVERY_DAYS);
                        resolve();
                    } else {
                        reject(res.message || 'Failed to load delivery days');
                    }
                }, (xhr, status, err) => {
                    const res = xhr.responseJSON;
                    const errorMessage = res?.message || `Error loading delivery days: ${status}`;
                    console.error(errorMessage);
                    reject(errorMessage);
                });
            });
        }

        calculatePrice(data) {
            console.log(data);

            // Validasi bahwa data sudah dimuat
            if (!PLAN_PRICES[data.planSelection.toString()]) {
                console.error('Plan price not found for:', data.planSelection);
                return;
            }

            const price = PLAN_PRICES[data.planSelection.toString()];
            const planName = PLAN_NAMES[data.planSelection.toString()];
            const mealTypeCount = data.mealTypes.length;
            const deliveryDayCount = data.deliveryDays.length;

            const totalPrice = price * mealTypeCount * deliveryDayCount * 4.3;

            // Convert UUID arrays to string arrays untuk mapping
            const mealTypeLabels = data.mealTypes.map((id) => MEAL_TYPES[id.toString()]);
            const deliveryDayLabels = data.deliveryDays.map((id) => DELIVERY_DAYS[id.toString()]);

            const summaryData = {
                totalPrice: totalPrice,
                planPrice: price,
                planName: planName,
                mealTypes: mealTypeLabels,
                mealTypesCount: mealTypeCount,
                deliveryDays: deliveryDayLabels,
                deliveryDaysCount: deliveryDayCount,
            }

            this.loadSummaryPlan(summaryData);
            this.dataSubscription = summaryData;
        }

        loadSummaryPlan(data) {
            console.log(data);

            const summaryPlanWrapper = $('#summary-plan');

            const firstDay = data.deliveryDays[0];
            const lastDay = data.deliveryDays[data.deliveryDays.length - 1];

            const deliveryDaysDisplay = (data.deliveryDaysCount === 1)
                ? firstDay
                : `${firstDay} to ${lastDay}`;

            summaryPlanWrapper.html(
                `
                    <li>
                        <span class="font-semibold">Plan:</span> ${data.planName} (Rp${HelperApi.toIdr(data.planPrice)} per meal)
                    </li>
                    <li>
                        <span class="font-semibold">Meal Types:</span> ${data.mealTypes.join(' + ')} (${data.mealTypesCount} meal types)
                    </li>
                    <li>
                        <span class="font-semibold">Delivery Days:</span> ${deliveryDaysDisplay} (${data.deliveryDaysCount} days)
                    </li>
                `
            );

            $('#total-price').html('Rp' + HelperApi.toIdr(data.totalPrice));
        }

        // Method untuk reload data jika diperlukan
        async reloadData() {
            try {
                await this.loadInitialData();
                console.log('Data reloaded successfully');
            } catch (error) {
                console.error('Error reloading data:', error);
            }
        }

        // Validasi form sebelum submit
        validateForm(data) {
            let isValid = true;
            let errorMessages = [];

            if (!data.fullName.trim()) {
                errorMessages.push('Full name is required');
                isValid = false;
            }

            if (!data.phone.trim()) {
                errorMessages.push('Phone number is required');
                isValid = false;
            }

            if (!data.planSelection) {
                errorMessages.push('Please select a meal plan');
                isValid = false;
            }

            if (!data.mealTypes || data.mealTypes.length === 0) {
                errorMessages.push('Please select at least one meal type');
                isValid = false;
            }

            if (!data.deliveryDays || data.deliveryDays.length === 0) {
                errorMessages.push('Please select at least one delivery day');
                isValid = false;
            }

            if (!isValid) {
                HelperApi.showAlert(
                    "error",
                    errorMessages.join('<br>'),
                    $(".subscription-error-message")
                );
            }

            return isValid;
        }

        // Submit subscription ke API
        submitSubscription() {
            if (!this.dataSubscription || Object.keys(this.dataSubscription).length === 0) {
                HelperApi.showAlert(
                    "error",
                    "Please calculate price first",
                    $(".subscription-error-message")
                );
                return;
            }

            // Prepare data untuk API (menggunakan name, bukan id)
            const formData = {
                name: $('#full-name').val(),
                phone: $('#phone').val().replace(/\s/g, ''), // Remove spaces from phone
                plan_selection: PLAN_NAMES[$('#plan-selection').val()], // Send name, not id
                meal_types: $('#meal-type').val().map(id => MEAL_TYPES[id.toString()]), // Convert to names
                delivery_days: $('#delivery-days').val().map(id => DELIVERY_DAYS[id.toString()]), // Convert to names
                allergies: $('#allergies').val(),
                total_price: this.dataSubscription.totalPrice,
            };

            const url = ROUTES.subscriptions_store; // Sesuaikan dengan route API Anda
            const acceptBtn = $('[data-modal-hide="price-modal"]:contains("Accept")');
            
            // Show loading state
            HelperApi.setLoading(acceptBtn, true);

            HelperApi.apiRequest('POST', url, formData, (res) => {
                HelperApi.setLoading(acceptBtn, false);
                
                if (res.status) {
                    HelperApi.showAlert(
                        "success",
                        res.message || "Subscription created successfully!",
                        $(".subscription-success-message")
                    );
                    
                    this.resetForm();
                    // Close modal
                    $('[data-modal-hide="price-modal"]').first().click();
                } else {
                    HelperApi.showAlert(
                        "error",
                        res.message || "Failed to create subscription",
                        $(".subscription-error-message")
                    );
                }

                setTimeout(() => {
                    window.location.href = '/dashboard/user'
                }, 1000);
            }, (xhr, status, err) => {
                HelperApi.setLoading(acceptBtn, false);
                const res = xhr.responseJSON;
                
                if (res && res.message) {
                    // Handle validation errors
                    if (typeof res.message === 'object') {
                        const errorMessages = [];
                        Object.keys(res.message).forEach(field => {
                            if (Array.isArray(res.message[field])) {
                                errorMessages.push(...res.message[field]);
                            } else {
                                errorMessages.push(res.message[field]);
                            }
                        });
                        HelperApi.showAlert(
                            "error",
                            errorMessages.join('<br>'),
                            $(".subscription-error-message")
                        );
                    } else {
                        HelperApi.showAlert(
                            "error",
                            res.message,
                            $(".subscription-error-message")
                        );
                    }
                } else {
                    HelperApi.showAlert(
                        "error",
                        `Error: ${status} - ${err}`,
                        $(".subscription-error-message")
                    );
                }
            });
        }

        // Reset form after successful submission
        resetForm() {
            $('#full-name').val('');
            $('#phone').val('');
            $('#plan-selection').val('');
            $('#meal-type').val(null).trigger('change');
            $('#delivery-days').val(null).trigger('change');
            $('#allergies').val('');
            
            // Clear summary
            $('#summary-plan').html('');
            $('#total-price').html('.....');
            this.dataSubscription = {};
        }
    }

    $(document).ready(function() {
        new Subscription();
    });
})();