(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then((m) => m.default),
        import("../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class SubmitTestimonial {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            $(document).on("click", ".btn-testimonial", () => {
                const data = {
                    name: $("[name=name]").val(),
                    review: $("[name=review]").val(),
                    rating: $("[name=rating]").val(),
                };

                HelperApi.setLoading($(".btn-testimonial"), true);

                this.storeTestimonial(data);
            });
        }

        storeTestimonial(data) {
            const url = ROUTES.testimonials_store;

            HelperApi.apiRequest(
                "POST",
                url,
                data,
                (res) => {
                    HelperApi.showAlert(
                        "success",
                        res.message,
                        $(".testimonial-success-message")
                    );

                    HelperApi.setLoading($(".btn-testimonial"), false);
                },
                (xhr, status, err) => {
                    const res = xhr.responseJSON;

                    if (res && !res.status) {
                        if (
                            res?.message?.name?.[0] ||
                            res?.message?.rating?.[0] ||
                            res?.message?.review?.[0]
                        ) {
                            $(".testimonial-name-error").text(
                                res.message?.name?.[0] ?? ""
                            );
                            $(".testimonial-review-error").text(
                                res.message?.review?.[0] ?? ""
                            );
                            $(".testimonial-rating-error").text(
                                res.message?.rating?.[0] ?? ""
                            );
                        } else {
                            HelperApi.showAlert(
                                "error",
                                res.message,
                                $(".testimonial-error-message"),
                            );

                            setTimeout(() => {
                                window.location.href = '/auth/login';
                            }, 800);
                        }
                    } else {
                        console.error("Error: ", status);
                    }

                    HelperApi.setLoading($(".btn-testimonial"), false);
                }
            );
        }
    }

    $(document).ready(function () {
        new SubmitTestimonial();
    });
})();
