(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then(m => m.default),
        import("../HelperApi.js").then(m => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    const PLAN_NAMES = {
        '1': 'Diet',
        '2': 'Protein',
        '3': 'Royal'
    };

    const PLAN_PRICES = {
        '1': 30000,
        '2': 40000,
        '3': 60000
    };

    const MEAL_TYPES = {
        '1': 'Breakfast',
        '2': 'Lunch',
        '3': 'Dinner'
    };

    const DELIVERY_DAYS = {
        '1': 'Monday',
        '2': 'Tuesday',
        '3': 'Wednesday',
        '4': 'Thursday',
        '5': 'Friday',
        '6': 'Saturday',
        '7': 'Sunday',
    };

    class Subscription {
        constructor() {
            this.dataSubscription = {};
            
            this.init();
        }

        init() {
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

                this.calculatePrice(data);
            });
        }

        calculatePrice(data) {
            console.log(data);

            const price = PLAN_PRICES[data.planSelection];
            const planName = PLAN_NAMES[data.planSelection];
            const mealTypeCount = data.mealTypes.length;
            const deliveryDayCount = data.deliveryDays.length;

            const totalPrice = price * mealTypeCount * deliveryDayCount * 4.3;

            const mealTypeLabels = data.mealTypes.map((id) => MEAL_TYPES[id]);
            const deliveryDayLabels = data.deliveryDays.map((id) => DELIVERY_DAYS[id]);

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
                        <span class="font-semibold">Plan:</span> ${data.planName} Plan (Rp${HelperApi.toIdr(data.planPrice)} per meal)
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
    }

    $(document).ready(function() {
        new Subscription();
    });
})();
