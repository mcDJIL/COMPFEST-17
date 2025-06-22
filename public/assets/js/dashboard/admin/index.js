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
            this.loadMonthlyRecurringData();
            this.renderChartSubscriptions();
            this.renderPieChart();
            this.renderFlatpickr();

            this.loadCardData();
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
                series: [75.55],
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
                            margin: 5, // margin is in pixels
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
                                formatter: function (val) {
                                    return val + "%";
                                },
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
                const chartFour = new ApexCharts(
                    document.querySelector("#chartTwo"),
                    chartTwoOptions
                );
                chartFour.render();
            }
        }

        renderPieChart() {
            const chartThirteenOptions = {
                series: [900, 700, 850],
                colors: ["#3641f5", "#7592ff", "#dde9ff"],
                labels: ["Affiliate", "Direct", "Adsense"],
                chart: {
                    fontFamily: "Outfit, sans-serif",
                    type: "donut",
                    width: 280,
                    height: 280,
                },
                stroke: {
                    show: false,
                    width: 4,
                    // Creates a gap between the series
                    colors: "transparent", // Gap color (use background color to make it seamless)
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
                                    text: "Total 3.5K",
                                },
                                value: {
                                    show: true,
                                    offsetY: 10,
                                    color: "#667085",
                                    fontSize: "14px",
                                    formatter: () => "Used of 1.1K",
                                },
                                total: {
                                    show: true,
                                    label: "Total",
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
                            chart: {
                                width: 280,
                                height: 280,
                            },
                        },
                    },
                    {
                        breakpoint: 2600,
                        options: {
                            chart: {
                                width: 240,
                                width: 240,
                            },
                        },
                    },
                ],
            };
            const chartSelector = document.querySelectorAll("#chartThirteen");
            if (chartSelector.length) {
                const chartThirteen = new ApexCharts(
                    document.querySelector("#chartThirteen"),
                    chartThirteenOptions
                );
                chartThirteen.render();
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
    }

    $(document).ready(function () {
        new Index();
    });
})();
