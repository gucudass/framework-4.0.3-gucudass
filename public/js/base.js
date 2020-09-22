$(document).ready(function () {
    // 캘린더
    $('.inputCalendar').datepicker({
        dateFormat: 'yy-mm-dd'
    });
});

var BS = BS || {};

BS.ajax = function (options) {
    $options = $.extend({
        type: 'post',
        async: true,
        dataType: 'json',
        beforeSend: function (res) {
            if (options.loading !== false) {
                BS.showSpinner();
            }
        },
        success: function () {
        },
        error: function (xhr) {
            if (xhr.responseText != undefined && xhr.responseText != '' && xhr.status != 500) {
                alert(xhr.responseText);

            } else {
                if (xhr.responseJSON != undefined && xhr.responseJSON.message != undefined) {
                    alert(xhr.responseJSON.message.replace(/\\n/g, '\n'));
                }
            }

            if (options.reloading === true) {
                location.reload();
            }
        },
        complete: function (res) {
            if (options.loading !== false) {
                BS.closeSpinner();

                delete options.loading;
            }
        }
    }, options);

    return $.ajax($options);
};

BS.showSpinner = function () {
    $('#modelCommSpinner').modal({backdrop: 'static', keyboard: false})
};

BS.closeSpinner = function () {
    $('#modelCommSpinner').modal('hide');
};

BS.setThumbnail = function (event) {
    $('#image_preview').empty();

    var reader = new FileReader();
    reader.onload = function (event) {
        var img = document.createElement("img");
        img.setAttribute("src", event.target.result);
        img.setAttribute('style', 'max-width:600px');
        img.setAttribute('class', 'img-thumbnail');
        document.querySelector("div#image_preview").appendChild(img);
    };
    reader.readAsDataURL(event.target.files[0]);
};

// 검색
$('#formSearch input[type="text"]').keydown(function () {
    if (event.keyCode === 13) {
        event.preventDefault();
        $('#formSearch').submit();
    }
});
$('.btnSearch').on('click', function () {
    event.preventDefault();
    $('#formSearch').submit();
});

function maxLengthCheck(object) {
    if (object.value.length > object.maxLength) {
        object.value = object.value.slice(0, object.maxLength);
    }
}

function isEmpty(str) {
    if (typeof str == "undefined" || str == null || str == "")
        return true;
    else
        return false;
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
