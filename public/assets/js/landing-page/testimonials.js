(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../ApiRoutes.js").then((m) => m.default),
        import("../HelperApi.js").then((m) => m.default),
    ]);


    const ROUTES = ApiRoutes.routes;

    class Testimonials {
        constructor() {
            this.swiperInstance = null;
            this.init();
        }

        init() {
            this.getTestimonials();
            this.getSummaryReview();
        }

        getTestimonials() {
            const url = "/api/testimonials";

            HelperApi.apiRequest(
                "GET",
                url,
                {},
                (res) => {
                    const data = res.data;

                    this.loadTestimonials(data);
                },
                (xhr, status, err) => {
                    const res = xhr.responseJSON;

                    if (res && !res.status) {
                        console.error(res.message);
                    } else {
                        console.error("Error: ", status);
                    }
                }
            );
        }

        getSummaryReview() {
            const url = "/api/testimonials/summary";

            HelperApi.apiRequest(
                "GET",
                url,
                {},
                (res) => {
                    const data = res.data;

                    this.loadSeaCateringBadge(data);
                },
                (xhr, status, err) => {
                    const res = xhr.responseJSON;

                    if (res && !res.status) {
                        console.error(res.message);
                    } else {
                        console.error("Error: ", status);
                    }
                }
            );
        }

        loadTestimonials(data) {
            const testimonialsWrapper = $(".testimonials-wrapper");
            let testimonialItem = "";

            data.forEach((item) => {
                testimonialItem += `
                    <div class="swiper-slide bg-[#FAFAF5] rounded-[20px] p-4 sm:p-6 w-full sm:w-80 lg:w-96 h-52 sm:h-60">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col sm:flex-row sm:gap-6 lg:gap-8 items-start sm:items-center">
                                        <div class="stars-testimoni flex">
                                            ${this.renderStars(item.rating)}
                                        </div>
                                        <div class="mt-1 sm:mt-0">
                                            <p class="text-xs text-[#333333]">${HelperApi.formatDate(
                                                item.created_at
                                            )}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden sm:block">
                                        <i class="fa-solid fa-star text-3xl lg:text-4xl text-yellow-300"></i>
                                    </div>
                                </div>

                                <div class="mt-3 sm:mt-4">
                                    <p class="text-sm sm:text-base text-[#333333]">${
                                        item.review
                                    }</p>
                                </div>

                                <div class="absolute bottom-4 sm:bottom-5">
                                    <p class="font-semibold text-lg sm:text-xl">${
                                        item.name
                                    }</p>
                                </div>
                            </div>
                `;
            });

            testimonialsWrapper.append(testimonialItem);

            setTimeout(() => {
                this.renderSwiper();
            }, 500);
        }

        loadSeaCateringBadge(data) {
            $(".total-review-badge").text(data.total_review);
            $(".summary-review-badge").text(data.summary_review);
            $(".rating-badge").text(data.rating_average);
            $(".stars-badge").html(this.renderStars(data.rating_average));
        }

        renderSwiper() {
            if (this.swiperInstance) {
                this.swiperInstance.destroy(true, true);
            }

            this.swiperInstance = new Swiper('.testimonial-swiper', {
                direction: 'horizontal',
                loop: true, 
                slidesPerView: 2,
                spaceBetween: 10,
                autoplay: {
                    delay: 3000,
                    reverseDirection: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    1080: {
                        slidesPerView: 3.3,
                        spaceBetween: 20,
                    },
                }
            });
        }

        renderStars(amount) {
            let stars = "";
            let fullStars = Math.floor(amount);
            let decimal = amount - fullStars;
            let hasHalfStar = false;

            if (decimal >= 0.75) {
                fullStars += 1;
            } else if (decimal >= 0.25) {
                hasHalfStar = true;
            }

            const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);

            for (let i = 0; i < fullStars; i++) {
                stars += `<i class="fa-solid fa-star text-lg sm:text-xl text-yellow-300"></i>`;
            }

            if (hasHalfStar) {
                stars += `<i class="fa-solid fa-star-half-stroke text-lg sm:text-xl text-yellow-300"></i>`;
            }

            for (let i = 0; i < emptyStars; i++) {
                stars += `<i class="fa-regular fa-star text-lg sm:text-xl text-yellow-300"></i>`;
            }

            return stars;
        }
    }

    $(document).ready(function () {
        new Testimonials();
    });
})();
