(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then((m) => m.default),
        import("../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class Register {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            $(document).on("click", ".btn-register", (e) => {
                const data = {
                    email: $("[name=email]").val(),
                    name: $("[name=name]").val(),
                    password: $("[name=password]").val(),
                };
                HelperApi.setLoading($(".btn-register"), true);

                const url = "/api/auth/register";

                HelperApi.apiRequest(
                    "POST",
                    url,
                    data,
                    (res) => {
                        HelperApi.showAlert(
                            "success",
                            res.message,
                            $(".success-message"),
                            3000
                        );

                        setTimeout(() => {
                            window.location.href = '/auth/login';
                        }, 800);

                        HelperApi.setLoading($(".btn-register"), false);
                    },
                    (xhr, status, err) => {
                        const res = xhr.responseJSON;
                        if (res && !res.status) {

                            if (
                                res?.message?.name?.[0] ||
                                res?.message?.email?.[0] ||
                                res?.message?.password?.[0] 
                            ) {
                                $(".name-error").text(
                                    res.message?.name?.[0] ?? ""
                                );
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
                        HelperApi.setLoading($(".btn-register"), false);
                    }
                );
            });

            $(document).on("click", "#togglePassword", () => {
                this.togglePassword("password", "icon");
            });
        }

        togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    }

    $(document).ready(function () {
        new Register();
    });
})();
