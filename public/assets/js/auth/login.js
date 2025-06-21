(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then((m) => m.default),
        import("../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class Login {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            $(document).on("click", ".btn-login", (e) => {
                const data = {
                    email: $("[name=email]").val(),
                    password: $("[name=password]").val(),
                };
                HelperApi.setLoading($(".btn-login"), true);

                const url = "/api/auth/login";

                HelperApi.apiRequest(
                    "POST",
                    url,
                    data,
                    (res) => {
                        if (res.status) {
                            Cookies.set(
                                '_sea_catering_token',
                                res.data.token,
                                {
                                    expires: 1/24, // 1 jam
                                    path: '/',
                                    secure: false,
                                    sameSite: 'Lax',
                                }
                            );
                            const autoRedirect = Cookies.get(
                                "sc-automatic-redirect"
                            );

                            if (res.data.user.role === 'admin') {
                                window.location.href = autoRedirect
                                    ? autoRedirect
                                    : "/dashboard/admin";
                            } else {
                                window.location.href = autoRedirect
                                    ? autoRedirect
                                    : "/";
                            }

                            Cookies.remove("sc-automatic-redirect");
                        }
                        HelperApi.setLoading($(".btn-login"), false);
                    },
                    (xhr, status, err) => {
                        const res = xhr.responseJSON;
                        if (res && !res.status) {

                            if (
                                res?.message?.email?.[0] ||
                                res?.message?.password?.[0]
                            ) {
                                $(".email-error").text(
                                    res.message?.email?.[0] ?? ""
                                );
                                $(".password-error").text(
                                    res.message?.password?.[0] ?? ""
                                );
                            } else {
                                HelperApi.showAlert(
                                    "error",
                                    res.message,
                                    $(".error-message"),
                                    3000
                                );
                            }
                        } else {
                            console.error("Error:", status);
                        }
                        HelperApi.setLoading($(".btn-login"), false);
                    }
                );
            });

            $(document).on('click', '.btn-forgot-password', () => {
                const data = {
                    email: $("[name=forgot-email]").val(),
                    password: $("[name=forgot-password]").val(),
                };
                HelperApi.setLoading($(".btn-forgot-password"), true);

                const url = "/api/auth/forgot-password";

                HelperApi.apiRequest(
                    "POST",
                    url,
                    data,
                    (res) => {
                        HelperApi.showAlert(
                                    "success",
                                    res.message,
                                    $(".forgot-success-message"),
                                    3000
                                );

                        setTimeout(() => {
                            window.location.reload();
                        }, 800);

                        HelperApi.setLoading($(".btn-forgot-password"), false);
                    },
                    (xhr, status, err) => {
                        const res = xhr.responseJSON;
                        if (res && !res.status) {

                            if (
                                res?.message?.email?.[0] ||
                                res?.message?.password?.[0]
                            ) {
                                $(".forgot-email-error").text(
                                    res.message?.email?.[0] ?? ""
                                );
                                $(".forgot-password-error").text(
                                    res.message?.password?.[0] ?? ""
                                );
                            } else {
                                HelperApi.showAlert(
                                    "error",
                                    res.message,
                                    $(".forgot-error-message"),
                                    3000
                                );
                            }
                        } else {
                            console.error("Error:", status);
                        }
                        HelperApi.setLoading($(".btn-forgot-password"), false);
                    }
                );
            })

            $(document).on('click', '#togglePassword', () => {
                this.togglePassword('password', 'icon');
            });

            $(document).on('click', '#forgotTogglePassword', () => {
                this.togglePassword('forgot-password', 'forgot-icon');
            });
        }

        togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    }

    $(document).ready(function () {
        new Login();
    });
})();
