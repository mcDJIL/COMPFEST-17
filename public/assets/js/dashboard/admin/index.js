(async () => {
    class Index {
        constructor() {
            this.init();
        }

        init() {
            this.renderChartRevenue();
            this.renderChartSubscriptions();
            this.renderPieChart();
            this.renderFlatpickr();
        }

        renderChartRevenue() {
            const chartThreeOptions = {
                series: [
                    {
                        name: "Sales",
                        data: [
                            180, 190, 170, 160, 175, 165, 170, 205, 230, 210,
                            240, 235,
                        ],
                    },
                    {
                        name: "Revenue",
                        data: [
                            40, 30, 50, 40, 55, 40, 70, 100, 110, 120, 150, 140,
                        ],
                    },
                ],
                legend: {
                    show: false,
                    position: "top",
                    horizontalAlign: "left",
                },
                colors: ["#465FFF", "#9CB9FF"],
                chart: {
                    fontFamily: "Outfit, sans-serif",
                    height: 310,
                    type: "area",
                    toolbar: {
                        show: false,
                    },
                },
                fill: {
                    gradient: {
                        enabled: true,
                        opacityFrom: 0.55,
                        opacityTo: 0,
                    },
                },
                stroke: {
                    curve: "straight",
                    width: ["2", "2"],
                },

                markers: {
                    size: 0,
                },
                labels: {
                    show: false,
                    position: "top",
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    x: {
                        format: "dd MMM yyyy",
                    },
                },
                xaxis: {
                    type: "category",
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    tooltip: false,
                },
                yaxis: {
                    title: {
                        style: {
                            fontSize: "0px",
                        },
                    },
                },
            };

            const chartSelector = document.querySelectorAll("#chartThree");

            if (chartSelector.length) {
                const chartThree = new ApexCharts(
                    document.querySelector("#chartThree"),
                    chartThreeOptions
                );
                chartThree.render();
            }
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
            const datePicker = $(".datepicker");

            flatpickr(datePicker, {
                mode: "range",
                dateFormat: "M d, Y",
            });
        }
    }

    $(document).ready(function () {
        new Index();
    });
})();
