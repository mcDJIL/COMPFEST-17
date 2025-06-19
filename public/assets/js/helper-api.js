function apiRequest(method, url, data, onSuccess, onError = function() {}, header = null) {
    let formData;
    let headers = {};

    try {
        headers = { Authorization: getAuthorization() };
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


function setLoading(e, loading) {
    if (loading) {
        e.attr('data-text-old', e.text());
        e.html('<i class="action-icon ti ti-spin ti-fidget-spinner"></i>&nbsp;Loading...');
        e.addClass('disabled');
    } else {
        const text = e.attr('data-text-old');
        e.text(text);
        e.removeClass('disabled');
    }
}

function showMessage(type, message) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    toastr[type](message);
}

function toIdr(number) {
    if(number == null){
        return 0;
    }
    return (number.toString().replace('.',',')).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function getBase64(file, storageKey) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        sessionStorage.setItem(storageKey, reader.result);
    };
    reader.onerror = function (error) {
        console.log('Error: ', error);
    };
}

function encodeData(obj) {
    let jsonStr = JSON.stringify(obj);
    jsonStr = jsonStr
        .replace(/&/g, '&amp;')
        .replace(/'/g, '&#39;')
        .replace(/"/g, '&#34;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');

    return btoa(encodeURIComponent(jsonStr));
}

function decodeData(encodedStr) {
    let decodedStr = decodeURIComponent(atob(encodedStr));
    decodedStr = decodedStr
        .replace(/&gt;/g, '>')
        .replace(/&lt;/g, '<')
        .replace(/&#34;/g, `"`)
        .replace(/&#39;/g, `'`)
        .replace(/&amp;/g, '&');

    return JSON.parse(decodedStr);
}

function url(endpoint = '')
{
    var props = endpoint.split('//'),
    base = '', protocols = BASE_URL;
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

function api_url(endpoint = '')
{
    return url('api/'+endpoint)
}
