export default class HelperApi {
    constructor() {
        if (typeof jQuery === 'undefined') {
            alert('Error: jQuery tidak ditemukan! Harap sertakan jQuery sebelum menggunakan HelperApi.');
            throw new Error('jQuery tidak ditemukan!');
        }
    }

    static getAuthorization() {
        const cookieName = $('meta[name="cookies___"]').attr("content");

        if (!cookieName) {
            console.error("Meta cookies___ tidak ditemukan!");
            return "";
        }

        const cookieValue = this.getCookie(cookieName);
        return cookieValue ? `Bearer ${cookieValue}` : "";
    }

    static getCookie(name) {
        const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
        return match ? decodeURIComponent(match[2]) : null;
    }

    static async apiRequest(method, url, data, onSuccess, onError = function() {}, header = null) {
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
        if (method === 'PUT' || method === 'PATCH') {
            formData.append('_method', method);
            method = 'POST'; // Ubah metode ke `POST` agar dapat mengirim FormData
        }

        $.ajax({
            url: url,
            type: method,
            headers: headers,
            data: method === 'GET' ? null : formData,
            processData: false,
            contentType: false
        }).done(function(response) {
            onSuccess(response);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            onError(jqXHR, textStatus, errorThrown);
        });
    }

    static setLoading(element, loading) {
        if (loading) {
            element.attr('data-text-old', this.encodeData(element.html()));
            element.html(`
                <svg class="loading-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g><animateTransform attributeType="XML" attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="2s" repeatCount="indefinite"/></g><path d="M0 0h24v24H0z" stroke="none"/><path d="M18 16v.01M6 16v.01M12 5v.01M12 12v.01M12 1a4 4 0 0 1 2.001 7.464l.001.072a4 4 0 0 1 1.987 3.758l.22.128a4 4 0 0 1 1.591-.417L18 12a4 4 0 1 1-3.994 3.77l-.28-.16c-.522.25-1.108.39-1.726.39-.619 0-1.205-.14-1.728-.391l-.279.16L10 16a4 4 0 1 1-2.212-3.579l.222-.129a4 4 0 0 1 1.988-3.756L10 8.465A4 4 0 0 1 8.005 5.2L8 5a4 4 0 0 1 4-4"/></svg>
                <span class="ms-2">Loading...</span>
            `);
            element.addClass('disabled');
        } else {
            const text = element.attr('data-text-old');
            element.html(this.decodeData(text));
            element.removeClass('disabled');
        }
    }

    static toIdr(number) {
        if (number == null) {
            return '0,00';
        }

        const fixedNumber = Number(number).toFixed(2);
        const parts = fixedNumber.split('.');
        const integerPart = parts[0];
        const decimalPart = parts[1];

        const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
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
                console.error('Error:', error);
                reject(error);
            };
        });
    }

    static encodeData(obj) {
        let jsonStr = JSON.stringify(obj);
        jsonStr = jsonStr
            .replace(/&/g, '&amp;')
            .replace(/'/g, '&#39;')
            .replace(/"/g, '&#34;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
        return btoa(encodeURIComponent(jsonStr));
    }

    static decodeData(encodedStr) {
        let decodedStr = decodeURIComponent(atob(encodedStr));
        decodedStr = decodedStr
            .replace(/&gt;/g, '>')
            .replace(/&lt;/g, '<')
            .replace(/&#34;/g, '"')
            .replace(/&#39;/g, "'")
            .replace(/&amp;/g, '&');
        return JSON.parse(decodedStr);
    }

    static url(endpoint = '')
    {
        let props = endpoint.split('//'),
        protocols = window.location.origin;
        let urls;
        if (props[0] == location.protocol) {
            return endpoint
        } else {
            endpoint = endpoint.replace("\/\/", "/");
            let urlBases = endpoint.split('/')

            if(urlBases[0] == '')
            {
                urls = protocols+endpoint
            }else{
                urls = protocols+'/'+endpoint
            }
            return urls
        }
    }

    static uri_segment(index) {
        let pathSegments = new URL(window.location.href).pathname.split('/').filter(segment => segment !== "");

        return pathSegments[index - 1] || null;
    }

    static formatDate(date, country = 'id-ID') {
        try {
            let tanggal = new Date(date);

            if (isNaN(tanggal)) return "-";

            let options = { day: '2-digit', month: 'long', year: 'numeric' };

            return tanggal.toLocaleDateString(country, options);
        } catch (error) {
            return "-";
        }
    }

    static base64ToBlobUrl(base64) {
        let parts = base64.split(',');
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
                .split(' ')
                .map(word => word.replace(word[0], word[0].toUpperCase()))
                .join(' ');
        } else {
            return text.charAt(0).toUpperCase() + text.slice(1);
        }
    }

    static generateRandId(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let randId = '';

        for (let i = 0; i < length; i++) {
            randId += characters.charAt(Math.floor(Math.random() * characters.length));
        }

        return randId;
    }
}
