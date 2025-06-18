(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then(m => m.default),
        import("../HelperApi.js").then(m => m.default),
    ]);


    const ROUTES = ApiRoutes.routes;

    class Subscription {
        constructor() {
            this.init();
        }

        init() {
            
        }
    }

    $(document).ready(function() {
        new Subscription();
    });
})();
