(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then((m) => m.default),
        import("../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class MealPlans {
        constructor() {
            this.init();
        }

        init() {
            this.getMealPlans();
        }

        getMealPlans() {
            const url = '/api/meal-plans';

            HelperApi.apiRequest('GET', url, {}, (res) => {
                const data = res.data;

                this.loadMealPlans(data);
            }, (xhr, status, err) => {
                const res = xhr.responseJSON;

                if (res && !res.status) {
                    console.error(res.message);
                } else {
                    console.error("Error: ", status);
                }
            });
        }

        loadMealPlans(data) {
            const images = document.querySelectorAll('.plan-image');
            const prices = document.querySelectorAll('.plan-price');
            const names = document.querySelectorAll('.plan-name');
            const descriptions = document.querySelectorAll('.plan-description');

            images.forEach((item, index) => {
                item.src = data[index].image;
            });

            prices.forEach((item, index) => {
                item.textContent = 'Rp ' + HelperApi.toIdr(data[index].price);
            });

            names.forEach((item, index) => {
                item.textContent = data[index].name;
            });

            descriptions.forEach((item, index) => {
                item.textContent = data[index].description;
            });
        }

        renderBgColor(plan) {
            let color = '';

            if (plan === 'Diet Plan') {
                color = '#81C784'
            } else if (plan === 'Royal Plan') {
                color = '#FFCC2B'
            } else {
                color = '#64B5F6'
            }

            return color;
        }
    }

    $(document).ready(function () {
        new MealPlans();
    });
})();
