(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../../ApiRoutes.js").then((m) => m.default),
        import("../../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class Index {
        constructor() {
            this.chartRevenueInstance = null;
            this.init();
        }

        init() {
            this.loadCardData();
            this.loadMonthlyRecurringData();
            this.loadSubscriptionsGrowth();
            this.loadSubscriptionsStatus();
            this.loadNewSubscriptions();
            this.loadLatestSubscriptions();

            this.renderChartSubscriptions();
            this.renderPieChart();

            this.renderFlatpickr();
            this.renderFlatpickrNewSubs();
        }

        loadCardData() {
            const totalRevenueUrl =
                ROUTES.dashboard_subscriptions_total_revenue;
            const activeRevenueUrl =
                ROUTES.dashboard_subscriptions_active_subs_revenue;
            const activeSubsUrl =
                ROUTES.dashboard_subscriptions_active_subscriptions;

            // Total Revenue
            HelperApi.apiRequest("GET", totalRevenueUrl, {}, (res) => {
                const revenue = res.data.total_revenue || 0;
                const growth = res.data.growth || 0;

                $("#total-revenue").text(`Rp${HelperApi.toIdr(revenue)}`);
                $("#total-revenue-growth")
                    .text(`${growth > 0 ? "+" : ""}${growth.toFixed(2)}%`)
                    .toggleClass("text-green-600 bg-green-50", growth >= 0)
                    .toggleClass("text-red-600 bg-red-50", growth < 0);
            });

            // Active Subscriptions Revenue
            HelperApi.apiRequest("GET", activeRevenueUrl, {}, (res) => {
                const revenue = res.data.total_revenue || 0;
                const growth = res.data.growth || 0;

                $("#active-sub-revenue").text(`Rp${HelperApi.toIdr(revenue)}`);
                $("#active-sub-growth")
                    .text(`${growth > 0 ? "+" : ""}${growth.toFixed(2)}%`)
                    .toggleClass("text-green-600 bg-green-50", growth >= 0)
                    .toggleClass("text-red-600 bg-red-50", growth < 0);
            });

            // Active Subscriptions Count
            HelperApi.apiRequest("GET", activeSubsUrl, {}, (res) => {
                const count = res.data.total_active_subscriptions || 0;
                const growth = res.data.growth || 0;

                $("#active-subscriptions").text(count);
                $("#active-subscriptions-growth")
                    .text(`${growth > 0 ? "+" : ""}${growth.toFixed(2)}%`)
                    .toggleClass("text-green-600 bg-green-50", growth >= 0)
                    .toggleClass("text-red-600 bg-red-50", growth < 0);
            });
        }

        loadMonthlyRecurringData(startDate = null, endDate = null) {
            const url = ROUTES.dashboard_subscriptions_monthly_recurring;
            const params = {};

            if (startDate && endDate) {
                params.start_date = startDate;
                params.end_date = endDate;
            }

            HelperApi.apiRequest("GET", url, params, (res) => {
                const rawData = res.data || [];
                const chartData = this.formatChartRevenueData(rawData);
                this.renderRevenueChart(chartData);
            });
        }

        loadSubscriptionsGrowth() {
            const url = ROUTES.dashboard_subscriptions_subscriptions_growth;

            HelperApi.apiRequest("GET", url, {}, (res) => {
                if (res.status) {
                    const data = res.data;

                    const percentage = data.monthly_growth_percentage.toFixed(2);
                    const trend = data.monthly_trend;

                    // Update radial chart
                    if (this.subsRadialChart) {
                        this.subsRadialChart.updateSeries([Number(percentage)]);
                    }

                    // Badge growth
                    const $badge = $("#subs-growth-badge");
                    $badge
                        .text((trend === "down" ? "-" : "+") + percentage + "%")
                        .attr(
                            "class",
                            `absolute left-1/2 top-[95%] -translate-x-1/2 -translate-y-[85%] rounded-full px-3 py-1 text-xs font-medium ${trend === "down"
                                ? "bg-red-50 text-red-600"
                                : "bg-green-50 text-green-600"}`
                        );

                    // Deskripsi bawah chart
                    const daily = data.daily_growth_percentage.toFixed(2);
                    $("#subs-growth-text").text(
                        `You gain ${data.active_subscriptions_today} active subscriptions today. ${daily > 0 ? "Nice!" : "Keep pushing!"}`
                    );

                    // Ringkasan info
                    $("#subs-total").text(data.total_subscriptions);
                    $("#subs-last-month").text(data.total_subscriptions_last_month);
                    $("#subs-this-month-value").text(data.total_subscriptions_this_month);

                    // Update trend icon pakai Font Awesome
                    const $icon = $("#subs-this-month-trend-icon");
                    let iconClass = "";

                    if (trend === "up") {
                        iconClass = "fa-solid fa-arrow-up text-green-500";
                    } else if (trend === "down") {
                        iconClass = "fa-solid fa-arrow-down text-red-500";
                    }

                    $icon.html(iconClass ? `<i class="${iconClass}"></i>` : "");
                }
            });
        }

        loadSubscriptionsStatus() {
            const url = ROUTES.dashboard_subscriptions_subscriptions_status;

            HelperApi.apiRequest("GET", url, {}, (res) => {
                if (!res.status) return;

                const chartData = res.data.chart;
                const total = res.data.total;

                // Render pie chart
                this.renderPieChart(chartData);

                // Render detail ke UI
                chartData.forEach(item => {
                    const label = item.status.toLowerCase(); // e.g. "active"
                    const percent = item.percentage.toFixed(0);
                    const count = item.count.toLocaleString();

                    const $section = $(`#subs-status-${label}`);
                    $section.find(".percentage").text(`${percent}%`);
                    $section.find(".count").text(`${count} Subscriptions`);
                });
            });
        }

        loadNewSubscriptions(startDate = null, endDate = null) {
            const url = ROUTES.dashboard_subscriptions_new_subscriptions;
            const params = {};

            if (startDate && endDate) {
                params.start_date = startDate;
                params.end_date = endDate;
            }

            HelperApi.apiRequest("GET", url, params, (res) => {
                if (res.status) {
                    const data = res.data;

                    $(".new-subscription-total").text(data.total_first_time_users);
                    $(".new-subscription-list").empty();

                    data.plans.forEach(plan => {
                        const html = `
                            <div>
                                <p class="mb-1 text-sm text-gray-500">${plan.plan}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <p class="text-base font-semibold text-gray-800">${plan.count}</p>
                                    </div>
                                    <div class="flex w-full max-w-[140px] items-center gap-3">
                                        <div class="relative block h-2 w-full max-w-[100px] rounded-sm bg-gray-200">
                                            <div class="absolute left-0 top-0 h-full rounded-sm bg-[#465fff]" style="width: ${plan.percentage}%"></div>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700">${plan.percentage}%</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        $(".new-subscription-list").append(html);
                    });
                }
            });
        }

        loadLatestSubscriptions() {
            const url = ROUTES.dashboard_subscriptions_latest_subscriptions;

            HelperApi.apiRequest("GET", url, {}, function(res) {
                const $tbody = $("#latest-subscriptions-body");
                $tbody.empty();

                if (res.status && res.data.length > 0) {
                    res.data.forEach((item, index) => {
                        const statusBadgeClass = item.status === "active"
                            ? "bg-green-50 text-green-600"
                            : item.status === "cancel"
                            ? "bg-red-50 text-red-600"
                            : "bg-yellow-50 text-yellow-600";

                        const row = `
                            <tr>
                                <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                    <span class="text-sm font-medium text-gray-700">${index + 1}</span>
                                </td>
                                <td class="py-3 pr-5 whitespace-nowrap sm:pr-5">
                                    <span class="text-sm font-medium text-gray-700">${item.user_name ?? '-'}</span>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">${item.meal_plan_name ?? '-'}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">Rp ${Number(item.price).toLocaleString("id-ID")}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">${HelperApi.formatDate(item.start_date)}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">${HelperApi.formatDate(item.end_date)}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-xs w-fit font-medium px-2 py-0.5 rounded-full ${statusBadgeClass}">
                                        ${HelperApi.capitalize(item.status)}
                                    </p>
                                </td>
                            </tr>
                        `;
                        $tbody.append(row);
                    });
                } else {
                    const emptyRow = `
                        <tr>
                            <td colspan="7" class="text-center py-6 text-sm text-gray-500">
                                No subscriptions found.
                            </td>
                        </tr>
                    `;
                    $tbody.append(emptyRow);
                }
            });
        }

        formatChartRevenueData(data) {
            const labels = data.map((item) => {
                const [year, month] = item.month.split("-");
                return new Date(year, month - 1).toLocaleString("default", {
                    month: "short",
                });
            });

            const revenues = data.map((item) => item.revenue);

            return { labels, revenues };
        }

        renderRevenueChart({ labels, revenues }) {
            const chartOptions = {
                series: [
                    {
                        name: "Revenue",
                        data: revenues,
                    },
                ],
                colors: ["#465FFF"],
                chart: {
                    fontFamily: "Outfit, sans-serif",
                    height: 310,
                    type: "area",
                    toolbar: { show: false },
                },
                fill: {
                    gradient: {
                        enabled: true,
                        opacityFrom: 0.55,
                        opacityTo: 0,
                    },
                },
                stroke: {
                    curve: "smooth",
                    width: 2,
                },
                markers: {
                    size: 4,
                    colors: ["#465FFF"],
                },
                grid: {
                    xaxis: {
                        lines: { show: false },
                    },
                    yaxis: {
                        lines: { show: true },
                    },
                },
                dataLabels: { enabled: false },
                tooltip: {
                    y: {
                        formatter: (val) => `Rp${HelperApi.toIdr(val)}`,
                    },
                },
                xaxis: {
                    type: "category",
                    categories: labels,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                },
                yaxis: {
                    labels: {
                        formatter: (val) => `Rp${HelperApi.toIdr(val)}`,
                    },
                },
            };

            const chartSelector = document.querySelector("#chartThree");

            if (this.chartRevenueInstance) {
                this.chartRevenueInstance.destroy();
            }

            this.chartRevenueInstance = new ApexCharts(chartSelector, chartOptions);
            this.chartRevenueInstance.render();
        }

        renderChartSubscriptions() {
            const chartTwoOptions = {
                series: [0], // default sementara, akan diupdate dari API
                colors: ["#465FFF"],
                chart: {
                    fontFamily: "Outfit, sans-serif",
                    type: "radialBar",
                    height: 330,
                    sparkline: {
                        enabled: true,
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        hollow: {
                            size: "80%",
                        },
                        track: {
                            background: "#E4E7EC",
                            strokeWidth: "100%",
                            margin: 5,
                        },
                        dataLabels: {
                            name: {
                                show: false,
                            },
                            value: {
                                fontSize: "36px",
                                fontWeight: "600",
                                offsetY: -50,
                                color: "#1D2939",
                                formatter: (val) => `${val.toFixed(2)}%`,
                            },
                        },
                    },
                },
                fill: {
                    type: "solid",
                    colors: ["#465FFF"],
                },
                stroke: {
                    lineCap: "round",
                },
                labels: ["Progress"],
                responsive: [
                    {
                        breakpoint: 640,
                        options: {
                            chart: {
                                height: 280,
                            },
                            plotOptions: {
                                radialBar: {
                                    dataLabels: {
                                        value: {
                                            fontSize: "28px",
                                        },
                                    },
                                },
                            },
                        },
                    },
                ],
            };

            const chartSelector = document.querySelectorAll("#chartTwo");

            if (chartSelector.length) {
                this.subsRadialChart = new ApexCharts(
                    document.querySelector("#chartTwo"),
                    chartTwoOptions
                );
                this.subsRadialChart.render();
            }
        }

        renderPieChart(data = []) {
            if (!Array.isArray(data) || data.length === 0) {
                console.warn("Pie chart data is invalid or empty.");
                return;
            }

            const series = data.map(item => item.count);
            const labels = data.map(item =>
                item.status.charAt(0).toUpperCase() + item.status.slice(1)
            );
            const total = series.reduce((sum, val) => sum + val, 0).toLocaleString();

            const options = {
                series,
                labels,
                colors: ["#3641f5", "#7592ff", "#dde9ff"],
                chart: {
                    fontFamily: "Outfit, sans-serif",
                    type: "donut",
                    width: 280,
                    height: 280,
                },
                stroke: {
                    show: false,
                    width: 4,
                    colors: "transparent",
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "65%",
                            background: "transparent",
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    offsetY: 0,
                                    color: "#1D2939",
                                    fontSize: "12px",
                                    fontWeight: "normal",
                                },
                                value: {
                                    show: true,
                                    offsetY: 10,
                                    color: "#667085",
                                    fontSize: "14px",
                                },
                                total: {
                                    show: true,
                                    label: "Total",
                                    formatter: () => `${total}`,
                                    color: "#000000",
                                    fontSize: "20px",
                                    fontWeight: "bold",
                                },
                            },
                        },
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                responsive: [
                    {
                        breakpoint: 640,
                        options: {
                            chart: { width: 280, height: 280 },
                        },
                    },
                    {
                        breakpoint: 2600,
                        options: {
                            chart: { width: 240, height: 240 },
                        },
                    },
                ],
            };

            const chartSelector = document.querySelector("#chartThirteen");

            if (chartSelector) {
                // Destroy chart instance if it already exists (optional but safer for hot-reload)
                if (chartSelector._chartInstance) {
                    chartSelector._chartInstance.destroy();
                }

                chartSelector.innerHTML = "";
                const chart = new ApexCharts(chartSelector, options);
                chart.render();

                // Optional: save chart instance to destroy later
                chartSelector._chartInstance = chart;
            }
        }

        renderFlatpickr() {
            flatpickr(".datepicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: (selectedDates) => {
                    if (selectedDates.length === 2) {
                        const formatDate = (date) => {
                            const year = date.getFullYear();
                            const month = String(date.getMonth() + 1).padStart(2, "0");
                            const day = String(date.getDate()).padStart(2, "0");
                            return `${year}-${month}-${day}`;
                        };

                        const startDate = formatDate(selectedDates[0]);
                        const endDate = formatDate(selectedDates[1]);

                        this.loadMonthlyRecurringData(startDate, endDate);
                    }
                },
            });
        }

        renderFlatpickrNewSubs() {
            flatpickr(".datepicker-new-subs", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: (selectedDates) => {
                    let startDate = null;
                    let endDate = null;

                    if (selectedDates.length === 2) {
                        startDate = selectedDates[0].toISOString().split("T")[0];
                        endDate = selectedDates[1].toISOString().split("T")[0];
                    }

                    this.loadNewSubscriptions(startDate, endDate);
                }
            });
        }
    }

    $(document).ready(function () {
        new Index();
    });
})();
