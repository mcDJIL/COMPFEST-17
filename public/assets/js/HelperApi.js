export default class HelperApi {
    constructor() {
        if (typeof jQuery === "undefined") {
            alert(
                "Error: jQuery tidak ditemukan! Harap sertakan jQuery sebelum menggunakan HelperApi."
            );
            throw new Error("jQuery tidak ditemukan!");
        }
    }

    static getAuthorization() {
        const cookieName = $('meta[name="cookies___"]').attr("content");

        if (!cookieName) {
            console.error("Meta cookies___ tidak ditemukan!");
            return "";
        }

        const cookieValue = this.getCookie(cookieName);
        console.log(cookieValue);
        return cookieValue ? `Bearer ${cookieValue}` : "";
    }

    static getCookie(name) {
        const match = document.cookie.match(
            new RegExp("(^| )" + name + "=([^;]+)")
        );
        return match ? decodeURIComponent(match[2]) : null;
    }

    static async apiRequest(
        method,
        url,
        data,
        onSuccess,
        onError = function () {},
        header = null
    ) {
        let formData;
        let headers = {};

        try {
            headers = { Authorization: this.getAuthorization() };
        } catch (error) {
            // Biarkan headers kosong jika ada error saat mengambil authorization
        }

        if (header) {
            headers = header;
        }

        // Cek jika data sudah berupa FormData
        if (data instanceof FormData) {
            formData = data;
        } else {
            formData = new FormData();

            // Proses data untuk dimasukkan ke dalam FormData
            for (let key in data) {
                if (data.hasOwnProperty(key)) {
                    if (Array.isArray(data[key])) {
                        // Jika nilai adalah array
                        for (let i = 0; i < data[key].length; i++) {
                            formData.append(`${key}[${i}]`, data[key][i]);
                        }
                    } else {
                        // Jika nilai bukan array
                        formData.append(key, data[key]);
                    }
                }
            }
        }

        // Tambahkan parameter `_method` jika metode adalah `PUT` atau `PATCH`
        if (method === "PUT" || method === "PATCH") {
            formData.append("_method", method);
            method = "POST"; // Ubah metode ke `POST` agar dapat mengirim FormData
        }

        $.ajax({
            url: url,
            type: method,
            headers: headers,
            data: method === "GET" ? null : formData,
            processData: false,
            contentType: false,
        })
            .done(function (response) {
                onSuccess(response);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                onError(jqXHR, textStatus, errorThrown);
            });
    }

    static setLoading(element, loading) {
        if (loading) {
            element.attr("data-text-old", this.encodeData(element.html()));
            element.html(`
                <svg class="loading-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g><animateTransform attributeType="XML" attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="2s" repeatCount="indefinite"/></g><path d="M0 0h24v24H0z" stroke="none"/><path d="M18 16v.01M6 16v.01M12 5v.01M12 12v.01M12 1a4 4 0 0 1 2.001 7.464l.001.072a4 4 0 0 1 1.987 3.758l.22.128a4 4 0 0 1 1.591-.417L18 12a4 4 0 1 1-3.994 3.77l-.28-.16c-.522.25-1.108.39-1.726.39-.619 0-1.205-.14-1.728-.391l-.279.16L10 16a4 4 0 1 1-2.212-3.579l.222-.129a4 4 0 0 1 1.988-3.756L10 8.465A4 4 0 0 1 8.005 5.2L8 5a4 4 0 0 1 4-4"/></svg>
                <span class="me-2">Loading...</span>
            `);
            element.addClass("disabled");
        } else {
            const text = element.attr("data-text-old");
            element.html(this.decodeData(text));
            element.removeClass("disabled");
        }
    }

    static toIdr(number) {
        if (number == null) {
            return "0,00";
        }

        const fixedNumber = Number(number).toFixed(2);
        const parts = fixedNumber.split(".");
        const integerPart = parts[0];
        const decimalPart = parts[1];

        const formattedInteger = integerPart.replace(
            /\B(?=(\d{3})+(?!\d))/g,
            "."
        );
        return `${formattedInteger},${decimalPart}`;
    }

    static getBase64(file, storageKey) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                sessionStorage.setItem(storageKey, reader.result);
                resolve(reader.result);
            };
            reader.onerror = function (error) {
                console.error("Error:", error);
                reject(error);
            };
        });
    }

    static encodeData(obj) {
        let jsonStr = JSON.stringify(obj);
        jsonStr = jsonStr
            .replace(/&/g, "&amp;")
            .replace(/'/g, "&#39;")
            .replace(/"/g, "&#34;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");
        return btoa(encodeURIComponent(jsonStr));
    }

    static decodeData(encodedStr) {
        let decodedStr = decodeURIComponent(atob(encodedStr));
        decodedStr = decodedStr
            .replace(/&gt;/g, ">")
            .replace(/&lt;/g, "<")
            .replace(/&#34;/g, '"')
            .replace(/&#39;/g, "'")
            .replace(/&amp;/g, "&");
        return JSON.parse(decodedStr);
    }

    static url(endpoint = "") {
        let props = endpoint.split("//"),
            protocols = window.location.origin;
        let urls;
        if (props[0] == location.protocol) {
            return endpoint;
        } else {
            endpoint = endpoint.replace("//", "/");
            let urlBases = endpoint.split("/");

            if (urlBases[0] == "") {
                urls = protocols + endpoint;
            } else {
                urls = protocols + "/" + endpoint;
            }
            return urls;
        }
    }

    static uri_segment(index) {
        let pathSegments = new URL(window.location.href).pathname
            .split("/")
            .filter((segment) => segment !== "");

        return pathSegments[index - 1] || null;
    }

    static formatDate(date, country = "id-ID") {
        try {
            let tanggal = new Date(date);

            if (isNaN(tanggal)) return "-";

            let options = { day: "2-digit", month: "long", year: "numeric" };

            return tanggal.toLocaleDateString(country, options);
        } catch (error) {
            return "-";
        }
    }

    static base64ToBlobUrl(base64) {
        let parts = base64.split(",");
        let mimeType = parts[0].match(/:(.*?);/)[1];
        let byteCharacters = atob(parts[1]);
        let byteNumbers = new Array(byteCharacters.length);

        for (let i = 0; i < byteCharacters.length; i++) {
            byteNumbers[i] = byteCharacters.charCodeAt(i);
        }

        let byteArray = new Uint8Array(byteNumbers);
        let blob = new Blob([byteArray], { type: mimeType });
        return URL.createObjectURL(blob);
    }

    static capitalize(text, eachWord = false) {
        if (eachWord) {
            return text
                .toLowerCase()
                .split(" ")
                .map((word) => word.replace(word[0], word[0].toUpperCase()))
                .join(" ");
        } else {
            return text.charAt(0).toUpperCase() + text.slice(1);
        }
    }

    static generateRandId(length) {
        const characters =
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let randId = "";

        for (let i = 0; i < length; i++) {
            randId += characters.charAt(
                Math.floor(Math.random() * characters.length)
            );
        }

        return randId;
    }

    static showAlert(
        type = "danger",
        message = "",
        target = "body",
        timeout = 4000
    ) {
        const types = {
            success: {
                color: "green",
                icon: `<path d="M16.707 5.293a1 1 0 0 1 0 1.414L9 14.414l-3.707-3.707a1 1 0 1 1 1.414-1.414L9 11.586l6.293-6.293a1 1 0 0 1 1.414 0z"/>`,
            },
            danger: {
                color: "red",
                icon: `<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>`,
            },
            warning: {
                color: "yellow",
                icon: `<path d="M8.257 3.099c.763-1.36 2.683-1.36 3.446 0l6.518 11.634c.75 1.34-.213 3.017-1.723 3.017H3.462c-1.51 0-2.473-1.677-1.723-3.017L8.257 3.1zM11 14a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm-1-2a1 1 0 0 0 1-1V8a1 1 0 1 0-2 0v3a1 1 0 0 0 1 1z"/>`,
            },
            info: {
                color: "blue",
                icon: `<path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM9 9V7h2v2H9zm0 2h2v5H9v-5z"/>`,
            },
        };

        const config = types[type] || types.danger;
        const alertHTML = `
        <div class="helper-alert flex items-center p-4 mb-4 text-sm text-${
            config.color
        }-800 border border-${config.color}-300 rounded-lg bg-${
            config.color
        }-50 dark:bg-gray-800 dark:text-${config.color}-400 dark:border-${
            config.color
        }-800" role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                ${config.icon}
            </svg>
            <div><span class="font-medium">${
                type.charAt(0).toUpperCase() + type.slice(1)
            } alert!</span> ${message}</div>
        </div>
    `;

        const $target = $(target);
        const $alert = $(alertHTML);
        $target.prepend($alert);

        if (timeout > 0) {
            setTimeout(() => {
                $alert.fadeOut(300, () => $alert.remove());
            }, timeout);
        }
    }
}
