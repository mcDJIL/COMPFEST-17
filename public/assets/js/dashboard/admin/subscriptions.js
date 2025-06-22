(async () => {
    const [ApiRoutes, HelperApi] = await Promise.all([
        import("../../ApiRoutes.js").then((m) => m.default),
        import("../../HelperApi.js").then((m) => m.default),
    ]);

    const ROUTES = ApiRoutes.routes;

    class Subscriptions {
        constructor() {
            this.ROUTES = ApiRoutes.routes;
            this.init();
        }

        init() {
            this.renderFlatpickrSubscriptions();
            this.renderFlatpickrReactivations();
            this.loadSubscriptions();
            this.bindEvents();
        }

        bindEvents() {
            $(document).on("click", '.btn-reactivations', () => {
                this.loadReactivations();
                console.log('Reactivations tab clicked');
            });
        }

        renderFlatpickrSubscriptions() {
            flatpickr(".datepicker-subscriptions", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: (selectedDates) => {
                    let startDate = null;
                    let endDate = null;

                    if (selectedDates.length === 2) {
                        startDate = selectedDates[0].toISOString().split("T")[0];
                        endDate = selectedDates[1].toISOString().split("T")[0];
                    }

                    this.loadSubscriptions(startDate, endDate);
                }
            });
        }

        renderFlatpickrReactivations() {
            flatpickr(".datepicker-reactivations", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: (selectedDates) => {
                    let startDate = null;
                    let endDate = null;

                    if (selectedDates.length === 2) {
                        startDate = selectedDates[0].toISOString().split("T")[0];
                        endDate = selectedDates[1].toISOString().split("T")[0];
                    }

                    this.loadReactivations(startDate, endDate);
                }
            });
        }

        loadSubscriptions(startDate = null, endDate = null) {
            let url = ROUTES.dashboard_subscriptions_index;

            if (startDate && endDate) {
                url += `?start_date=${startDate}&end_date=${endDate}`;
            }

            HelperApi.apiRequest("GET", url, {}, function(res) {
                const $tbody = $("#latest-subscriptions-body");
                $tbody.empty();

                if (res.status && res.data.length > 0) {
                    res.data.forEach((item, index) => {
                        const statusBadgeClass =
                            item.status === "active"
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
                                    <span class="text-sm font-medium text-gray-700">${item.user?.name ?? '-'}</span>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">${item.meal_plan?.name ?? '-'}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">Rp${HelperApi.toIdr(item.total_price)}</p>
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

        loadReactivations(startDate = null, endDate = null) {
            let url = ROUTES.dashboard_subscriptions_reactivations;

            if (startDate && endDate) {
                url += `?start_date=${startDate}&end_date=${endDate}`;
            }

            HelperApi.apiRequest("GET", url, {}, function(res) {
                const $tbody = $("#reactivations-subscriptions-body");
                $tbody.empty();

                if (res.status && res.data.length > 0) {
                    res.data.forEach((item, index) => {
                        const statusBadgeClass =
                            item.status === "active"
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
                                    <span class="text-sm font-medium text-gray-700">${item.user?.name ?? '-'}</span>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">${item.meal_plan?.name ?? '-'}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap sm:px-6">
                                    <p class="text-sm text-gray-700">Rp${HelperApi.toIdr(item.total_price)}</p>
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
                                No reactivations found.
                            </td>
                        </tr>
                    `;
                    $tbody.append(emptyRow);
                }
            });
        }
    }

    $(document).ready(function () {
        new Subscriptions();
    });
})()