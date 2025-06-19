(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then((m) => m.default),
        import("../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class Logout {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            $(document).on('click', '.btn-logout-confirm', function (e) {
                e.preventDefault();

                const url = ROUTES.logout

                HelperApi.apiRequest("POST", url, {}, function (req) {
                    console.log(req.message);
                    
                    Cookies.remove('_sea_catering_token')
                    window.location.href = "/auth/login"
                }, function (xhr, status, err) {
                    window.location.href = "/auth/login"
                })
            });
        }
    }

    $(document).ready(function () {
        new Logout();
    });
})();
