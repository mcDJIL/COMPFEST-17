const BASE_URL = window.location.origin;

const ApiRoutes = {
    routes: {},

    async fetchRoutes() {
        try {
            const response = await fetch(`${BASE_URL}/api/routes`, {
                headers: { Authorization: getAuthorization() }
            });
            const data = await response.json();
            let formattedRoutes = {};

            Object.keys(data).forEach((key) => {
                if (data[key].params.length > 0) {
                    formattedRoutes[key] = (...args) => {
                        let url = data[key].url;
                        data[key].params.forEach((param, index) => {
                            url = url.replace(`{${param}}`, args[index]);
                        });
                        return url;
                    };
                } else {
                    formattedRoutes[key] = data[key].url;
                }
            });

            this.routes = formattedRoutes;
            return this.routes;
        } catch (error) {
            console.error("Gagal mengambil API Routes:", error);
            return {};
        }
    }
};

await ApiRoutes.fetchRoutes();

export default ApiRoutes;
