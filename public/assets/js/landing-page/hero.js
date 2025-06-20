(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then((m) => m.default),
        import("../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class Hero {
        constructor() {
            this.init();
        }

        init() {
            this.getTotalHappyCustomers();
            this.getTotalSubscriptions();
        }

        getTotalHappyCustomers() {
            const url = '/api/testimonials/happy-customers';

            HelperApi.apiRequest('GET', url, {}, (res) => {
                const data = res.data;

                this.loadTotalHappyCustomers(data);
            }, (xhr, status, err) => {
                const res = xhr.responseJSON;

                if (res && !res.status) {
                    console.error(res.message);
                } else {
                    console.error("Error: ", status);
                }
            });
        }
        
        getTotalSubscriptions() {
            const url = '/api/subscriptions/total';
    
            HelperApi.apiRequest('GET', url, {}, (res) => {
                const data = res.data;
    
                this.loadTotalSubscriptions(data);
            }, (xhr, status, err) => {
                const res = xhr.responseJSON;
    
                if (res && !res.status) {
                    console.error(res.message);
                } else {
                    console.error("Error: ", status);
                }
            });
        }

        loadTotalHappyCustomers(data) {
            const el = document.querySelector('.total-happy-customers');
            this.animateCountUp(el, data);
        }

        loadTotalSubscriptions(data) {
            const el = document.querySelector('.total-subscriptions');
            this.animateCountUp(el, data);
        }

        animateCountUp(element, target, duration = 1000) {
            let start = 0;
            const startTime = performance.now();

            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1); // 0 to 1
                const current = Math.floor(progress * target);

                element.textContent = current.toLocaleString(); // Format angka
                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    element.textContent = target.toLocaleString() + '+'; // Final fix
                }
            }

            requestAnimationFrame(update);
        }
    }

    $(document).ready(function () {
        new Hero();
    });
})();
