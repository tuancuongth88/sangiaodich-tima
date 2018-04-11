function initCity() {
    $("#cbCity").select2({
        theme: "bootstrap",
        placeholder: 'Chọn Thành Phố...',
    });

    $("#cbCity").on("change", function (b) {
        isCitySelected() ? $("#cbDistrict").prop("disabled", !1) : $("#cbDistrict").prop("disabled", !0);
        $("#cbDistrict").val(null).trigger("change");
        if ($('#cbDistrict').data('select2')) {
            $("#cbDistrict").select2("destroy");
        }
        initDistrict();
    });
}

function initDistrict() {
    $("#cbDistrict").select2({
        theme: "bootstrap",
        placeholder: 'Chọn Quận/Huyện...',
        disabled: isCitySelected() ? void 0 : !0,
        ajax: {
            url: '/ajax/get-district-by-city',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // dataType: "json",
            data: function (b) {
                return {
                    city_id: $("#cbCity").val(),
                };
            },
            error: function (error) {
                console.log(error);
            },
            processResults: function (data) {
                var results = {results: []};
                $.each(data, function (key, value) {
                    results.results.push({id: key, text: value});
                });
                return results;
            }
        }
    });

    $("#cbDistrict").on("change", function (b) {
        IsDistrictSelected() ? $("#cbWard").prop("disabled", !1) : $("#cbWard").prop("disabled", !0);
        $("#cbWard").val(null).trigger("change");
        if ($('#cbWard').data('select2')) {
            $("#cbWard").select2("destroy");
        }
        initWard();
    });
}

function initWard() {
    $("#cbWard").select2({
        theme: "bootstrap",
        placeholder: 'Chọn Phường/Xã...',
        disabled: IsDistrictSelected() ? void 0 : !0,
        ajax: {
            url: '/ajax/get-ward-by-district',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // dataType: "json",
            data: function (b) {
                return {
                    district_id: $("#cbDistrict").val(),
                };
            },
            error: function (error) {
                console.log(error);
            },
            processResults: function (data) {
                var results = {results: []};
                $.each(data, function (key, value) {
                    results.results.push({id: key, text: value});
                });
                return results;
            }
        }
    });
}


function isCitySelected() {
    return null != $("#cbCity").val() && 0 < $("#cbCity").val().length;
}

function IsDistrictSelected() {
    return null != $("#cbDistrict").val() && 0 < $("#cbDistrict").val().length;
}

function isProductTypeSelected() {
    return null != $("#cbProductType").val() && 0 < $("#cbProductType").val().length;
}

function addDays(days) {
    var today = new Date();
    return today.setDate(today.getDate() + days);
}

function initSlider(producttype) {
    if (producttype === 1) // lương
    {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 5E6,
            max: 50E6,
            step: 5E6,
            value: 10E6,
            ticks: [5E6, 10E6, 15E6, 20E6, 25E6, 30E6, 35E6, 40E6, 45E6, 50E6],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["5tr", "10tr", "15tr", "20tr", "25tr", "30tr", "35tr", "40tr", "45tr", "50tr"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                //_countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(1);
        $('#spanTextDay').text('Ngày');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 10,
            max: 100,
            step: 10,
            value: 30,
            ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90],
            ticks_positions: [0, 12, 25, 37, 50, 62, 75, 87, 100],
            ticks_labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90"],
            tooltip: "always",
            formatter: function (b) {
                $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                //_countCalcValues(producttype);
            }
        });

    }

    else if (producttype === 4) // sổ hộ khẩu
    {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 5E6,
            max: 50E6,
            step: 5E6,
            value: 10E6,
            ticks: [5E6, 10E6, 15E6, 20E6, 25E6, 30E6, 35E6, 40E6, 45E6, 50E6],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["5tr", "10tr", "15tr", "20tr", "25tr", "30tr", "35tr", "40tr", "45tr", "50tr"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                //_countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(1);
        $('#spanTextDay').text('Ngày');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 10,
            max: 100,
            step: 10,
            value: 30,
            ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90],
            ticks_positions: [0, 12, 25, 37, 50, 62, 75, 87, 100],
            ticks_labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90"],
            tooltip: "always",
            formatter: function (b) {
                $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                //_countCalcValues(producttype);
            }
        });

    }

    else if (producttype === 7) // đăng ký ô tô
    {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 50E6,
            max: 500E6,
            step: 50E6,
            value: 100E6,
            ticks: [50E6, 100E6, 150E6, 200E6, 250E6, 300E6, 350E6, 400E6, 450E6, 500E6],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["50tr", "100tr", "150tr", "200tr", "250tr", "300tr", "350tr", "400tr", "450tr", "500tr"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                _countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(1);
        $('#spanTextDay').text('Ngày');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 10,
            max: 100,
            step: 10,
            value: 30,
            ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90],
            ticks_positions: [0, 12, 25, 37, 50, 62, 75, 87, 100],
            ticks_labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90"],
            tooltip: "always",
            formatter: function (b) {
                $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                _countCalcValues(producttype);
            }
        });
    }

    else if (producttype === 14) // cầm cố tài sản
    {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 5E6,
            max: 100E6,
            step: 5E6,
            value: 10E6,
            ticks: [5E6, 10E6, 15E6, 20E6, 25E6, 30E6, 40E6, 50E6, 60E6, 80E6, 100E6],
            ticks_positions: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
            ticks_labels: ["5tr", "10tr", "15tr", "20tr", "25tr", "30tr", "40tr", "50tr", "60tr", "80tr", "100tr"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                _countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(1);
        $('#spanTextDay').text('Ngày');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 10,
            max: 100,
            step: 10,
            value: 30,
            ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90],
            ticks_positions: [0, 12, 25, 37, 50, 62, 75, 87, 100],
            ticks_labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90"],
            tooltip: "always",
            formatter: function (b) {
                $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                _countCalcValues(producttype);
            }
        });
    }

    else if (producttype === 12) // hóa đơn điện nước
    {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 5E6,
            max: 50E6,
            step: 5E6,
            value: 10E6,
            ticks: [5E6, 10E6, 15E6, 20E6, 25E6, 30E6, 35E6, 40E6, 45E6, 50E6],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["5tr", "10tr", "15tr", "20tr", "25tr", "30tr", "35tr", "40tr", "45tr", "50tr"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                //_countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(2);
        $('#spanTextDay').text('Tháng');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 6,
            max: 84,
            step: 3,
            value: 12,
            ticks: [6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36],
            ticks_positions: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
            ticks_labels: ["6", "9", "12", "15", "18", "21", "24", "27", "30", "33", "36"],
            tooltip: "always",
            formatter: function (b) {
                //alert(addDays(b))
                $('#payDate').text(moment().add(b, "month").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                //_countCalcValues(producttype);
            }
        });
    }

    else if (producttype === 15) // mua nhà trả góp
    {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 100E6,
            max: 1000E6,
            step: 100E6,
            value: 500E6,
            ticks: [100E6, 200E6, 300E6, 400E6, 500E6, 600E6, 700E6, 800E6, 900E6, 1000E6],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["100tr", "200tr", "300tr", "400tr", "500tr", "600tr", "700tr", "800tr", "900tr", "1tỷ"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                //_countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(2);
        $('#spanTextDay').text('Tháng');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 6,
            max: 84,
            step: 6,
            value: 36,
            ticks: [6, 12, 18, 24, 30, 36, 42, 48, 54, 60],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["6", "12", "18", "24", "30", "36", "42", "48", "54", "60"],
            tooltip: "always",
            formatter: function (b) {
                $('#payDate').text(moment().add(b, "month").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
            }
        });
    }

    else if (producttype === 18) // vay theo sim
    {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 1E6,
            max: 3E6,
            step: 1E6,
            value: 3E6,
            ticks: [1E6, 2E6, 3E6],
            ticks_positions: [0, 50, 100],
            ticks_labels: ["1tr", "2tr", "3tr"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                _countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(1);
        $('#spanTextDay').text('ngày');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 10,
            max: 30,
            step: 10,
            value: 30,
            ticks: [10, 20, 30],
            ticks_positions: [0, 50, 100],
            ticks_labels: ["10", "20", "30"],
            tooltip: "always",
            formatter: function (b) {
                //alert(addDays(b))
                $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                _countCalcValues(producttype);
            }
        });

    }

    else {
        $("#application_amount").slider('destroy');
        $('#application_amount').slider({
            min: 100E6,
            max: 1000E6,
            step: 100E6,
            value: 500E6,
            ticks: [100E6, 200E6, 300E6, 400E6, 500E6, 600E6, 700E6, 800E6, 900E6, 1000E6],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["100tr", "200tr", "300tr", "400tr", "500tr", "600tr", "700tr", "800tr", "900tr", "1tỷ"],
            tooltip: "always",
            formatter: function (b) {
                $('.spanAmount').text(b.toLocaleString("en"));
                _countCalcValues(producttype);
            }
        });

        $('#hddTypeTime').val(2);
        $('#spanTextDay').text('Tháng');
        $("#application_term").slider('destroy');
        $('#application_term').slider({
            min: 6,
            max: 84,
            step: 6,
            value: 36,
            ticks: [6, 12, 18, 24, 30, 36, 42, 48, 54, 60],
            ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
            ticks_labels: ["6", "12", "18", "24", "30", "36", "42", "48", "54", "60"],
            tooltip: "always",
            formatter: function (b) {
                //alert(addDays(b))
                $('#payDate').text(moment().add(b, "month").format("DD.MM.YYYY"));
                $('#spanTerm').text(b);
                _countCalcValues(producttype);
            }
        });

    }
}

function initSlider1() {
    $("#application_amount").slider('destroy');
    $('#application_amount').slider({
        min: 5E6,
        max: 50E6,
        step: 5E6,
        value: 10E6,
        ticks: [5E6, 10E6, 15E6, 20E6, 25E6, 30E6, 35E6, 40E6, 45E6, 50E6],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["5tr", "10tr", "15tr", "20tr", "25tr", "30tr", "35tr", "40tr", "45tr", "50tr"],
        tooltip: "always",
        formatter: function (b) {
            $('.spanAmount').text(b.toLocaleString("en"));
            //_countCalcValues(producttype);
        }
    });

    $('#hddTypeTime').val(1);
    $('#spanTextDay').text('Ngày');
    $("#application_term").slider('destroy');
    $('#application_term').slider({
        min: 10,
        max: 100,
        step: 10,
        value: 30,
        ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90", "100"],
        tooltip: "always",
        formatter: function (b) {
            $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
            $('#spanTerm').text(b);
            //_countCalcValues(producttype);
        }
    });
}

function initSlider2() {
    $("#application_amount").slider('destroy');
    $('#application_amount').slider({
        min: 50E6,
        max: 500E6,
        step: 50E6,
        value: 100E6,
        ticks: [50E6, 100E6, 150E6, 200E6, 250E6, 300E6, 350E6, 400E6, 450E6, 500E6],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["50tr", "100tr", "150tr", "200tr", "250tr", "300tr", "350tr", "400tr", "450tr", "500tr"],
        tooltip: "always",
        formatter: function (b) {
            $('.spanAmount').text(b.toLocaleString("en"));
            //_countCalcValues(producttype);
        }
    });

    $('#hddTypeTime').val(1);
    $('#spanTextDay').text('Ngày');
    $("#application_term").slider('destroy');
    $('#application_term').slider({
        min: 10,
        max: 100,
        step: 10,
        value: 30,
        ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90", "100"],
        tooltip: "always",
        formatter: function (b) {
            $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
            $('#spanTerm').text(b);
            //_countCalcValues(producttype);
        }
    });
}

function initSlider3() {
    $("#application_amount").slider('destroy');
    $('#application_amount').slider({
        min: 100E6,
        max: 1000E6,
        step: 100E6,
        value: 500E6,
        ticks: [100E6, 200E6, 300E6, 400E6, 500E6, 600E6, 700E6, 800E6, 900E6, 1000E6],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["100tr", "200tr", "300tr", "400tr", "500tr", "600tr", "700tr", "800tr", "900tr", "1tỷ"],
        tooltip: "always",
        formatter: function (b) {
            $('.spanAmount').text(b.toLocaleString("en"));
            //_countCalcValues(producttype);
        }
    });

    $('#hddTypeTime').val(1);
    $('#spanTextDay').text('Ngày');
    $("#application_term").slider('destroy');
    $('#application_term').slider({
        min: 10,
        max: 100,
        step: 10,
        value: 30,
        ticks: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["10", "20", "30", "40", "50", "60", "70", "80", "90", "100"],
        tooltip: "always",
        formatter: function (b) {
            $('#payDate').text(moment().add(b, "days").format("DD.MM.YYYY"));
            $('#spanTerm').text(b);
            //_countCalcValues(producttype);
        }
    });
}

function initSlider4() {
    $("#application_amount").slider('destroy');
    $('#application_amount').slider({
        min: 100E6,
        max: 1000E6,
        step: 100E6,
        value: 500E6,
        ticks: [100E6, 200E6, 300E6, 400E6, 500E6, 600E6, 700E6, 800E6, 900E6, 1000E6],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["100tr", "200tr", "300tr", "400tr", "500tr", "600tr", "700tr", "800tr", "900tr", "1tỷ"],
        tooltip: "always",
        formatter: function (b) {
            $('.spanAmount').text(b.toLocaleString("en"));
            //_countCalcValues(producttype);
        }
    });

    $('#hddTypeTime').val(2);
    $('#spanTextDay').text('Tháng');
    $("#application_term").slider('destroy');
    $('#application_term').slider({
        min: 6,
        max: 84,
        step: 6,
        value: 36,
        ticks: [6, 12, 18, 24, 30, 36, 42, 48, 54, 60],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["6", "12", "18", "24", "30", "36", "42", "48", "54", "60"],
        tooltip: "always",
        formatter: function (b) {
            //alert(addDays(b))
            $('#payDate').text(moment().add(b, "month").format("DD.MM.YYYY"));
            $('#spanTerm').text(b);
            //_countCalcValues(producttype);
        }
    });
}

function initSlider5() {
    $("#application_amount").slider('destroy');
    $('#application_amount').slider({
        min: 10E6,
        max: 100E6,
        step: 10E6,
        value: 50E6,
        ticks: [10E6, 20E6, 30E6, 40E6, 50E6, 60E6, 70E6, 80E6, 90E6, 100E6],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["10tr", "20tr", "30tr", "40tr", "50tr", "60tr", "70tr", "80tr", "90tr", "100tr"],
        tooltip: "always",
        formatter: function (b) {
            $('.spanAmount').text(b.toLocaleString("en"));
            //_countCalcValues(producttype);
        }
    });

    $('#hddTypeTime').val(2);
    $('#spanTextDay').text('Tháng');
    $("#application_term").slider('destroy');
    $('#application_term').slider({
        min: 6,
        max: 84,
        step: 6,
        value: 36,
        ticks: [6, 12, 18, 24, 30, 36, 42, 48, 54, 60],
        ticks_positions: [0, 11, 22, 33, 44, 55, 66, 77, 88, 100],
        ticks_labels: ["6", "12", "18", "24", "30", "36", "42", "48", "54", "60"],
        tooltip: "always",
        formatter: function (b) {
            //alert(addDays(b))
            $('#payDate').text(moment().add(b, "month").format("DD.MM.YYYY"));
            $('#spanTerm').text(b);
            //_countCalcValues(producttype);
        }
    });
}

function _countCalcValues(producttype) {
    var sliderAmount = $('#application_amount').val();
    var sliderTerm = $('#application_term').val();
    sliderAmount = parseInt(sliderAmount);
    //sliderTerm = parseInt(sliderTerm)*30;

    if (producttype == 1) {
        var n = parseFloat(.002 * sliderAmount * sliderTerm);
        n = n + sliderAmount;
        $('.spanFee').text(n.toLocaleString("en"));
    }
    else {
        var n = parseFloat((0.01 * sliderAmount * sliderTerm));
        n = n + sliderAmount;
        $('.spanFee').text(n.toLocaleString("en"));
    }
}

function initProductBorrower() {
    $("#product_id").select2({
        theme: "bootstrap",
        placeholder: 'Chọn Gói Sản Phẩm...',
    });

    initSlider(1);

    $("#product_id").on("change", function (b) {
        var product_id = $("#product_id").val();
        var $option = $(this).find('option:selected');
        var producttype = $option.attr("producttype");
        initSlider(producttype);
    });
}

function initProductLender() {
    $("#product_id").select2({
        theme: "bootstrap",
        placeholder: 'Chọn Gói Sản Phẩm...',
    });

    $("#product_id").on("change", function (b) {
        var product_id = $("#product_id").val();
        var $option = $(this).find('option:selected');
        var producttype = $option.attr("producttype");
        if (producttype == 1) {
            $('#lblRate').text('k/ 1triệu');
            $('#hddRateType').val(1);
        } else {
            $('#lblRate').text('%/ tháng');
            $('#hddRateType').val(2);
        }
        //initSlider(producttype);
    });
}

function NotyA(sText, typeMes, iTime) {
    iTime = typeof iTime !== 'undefined' ? iTime : 2000;
    noty({
        text: sText,
        type: typeMes, //'success',// error
        layout: 'top',
        timeout: iTime,
        modal: false
    });
}

function DisplayError(sText) {
    NotyA(sText, 'error', 2500);
}

function DisplaySuccess(sText) {
    NotyA(sText, 'success');
}

function Confirm(strText, callback) {
    noty({
        text: strText,
        type: 'confirm',
        layout: 'top',
        timeout: 2000,
        modal: true,
        buttons: [
            {
                addClass: 'btn btn-primary', text: 'Đồng ý', onClick: function ($noty) {
                    $noty.close();
                    if (callback && typeof callback == 'function') {
                        callback();
                    }
                }
            }, {
                addClass: 'btn btn-danger', text: 'Thoát', onClick: function ($noty) {
                    $noty.close();
                }
            }
        ]
    });

    return false;
}


function CallUploadFile() {
    $("#uploadAvatar").click();
}


function UploadImg(typeId) {
    $("#hddTypeImg").val(typeId);
    $("#uploadImg").click();
}

$("#uploadImg").change(function () {
    var typeImg = parseInt($("#hddTypeImg").val());
    var formData = new FormData();
    var totalFiles = document.getElementById("uploadImg").files.length;
    for (var i = 0; i < totalFiles; i++) {
        var file = document.getElementById("uploadImg").files[i];
        formData.append("uploadImg", file);
        formData.append("typeImg", typeImg);
    }
    $.ajax({
        type: "POST",
        url: '/user/uploadimg',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
    }).done(function (data) {
        if (data.Error === 0) {
            if (data.lstData.Files.length > 0) {
                $.each(data.lstData.Files, function (index, value) {
                    DisplayPhotoitem(typeImg, data.lstData.Files[index].UrlImage);
                });
            }
        }
    });
});

function DisplayPhotoitem(typeImg, pathImg) {

    if (typeImg === 1) {
        $("#divImgCardNumber").append(
            '<div class="uploadct-item__img mr-5"> ' +
            '<img class="img-fluid" src="' + pathImg + '" alt="">' +
            ' </div>'
        );

    } else if (typeImg === 2) {
        $("#divImgLocation").append(
            '<div class="uploadct-item__img mr-5">' +
            ' <img class="img-fluid" src="' + pathImg + '" alt="">' +
            ' </div>'
        );

    } else if (typeImg === 3) {
        $("#divImgContractAndSalary").append(
            '<div class="uploadct-item__img mr-5">' +
            ' <img class="img-fluid" src="' + pathImg + '" alt="">' +
            ' </div>'
        );
    }
}

$("#uploadAvatar").change(function () {
    var formData = new FormData();
    var totalFiles = document.getElementById("uploadAvatar").files.length;
    for (var i = 0; i < totalFiles; i++) {
        var file = document.getElementById("uploadAvatar").files[i];
        formData.append("uploadAvatar", file);
    }
    $.ajax({
        type: "POST",
        url: '/user/uploadavatar',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data);
            if (data) {
                $("#imgAvatar").attr("src", data.Result);
                //DisplaySuccess('Ảnh đại diện của bạn đã cập nhật xong');
            } else {
                DisplayError('Ảnh đại diện của bạn chưa cập nhật được lên hệ thống');
            }
        },
        error: function (data) {
            DisplayError('Ảnh đại diện của bạn chưa cập nhật được lên hệ thống');
        }
    });
});