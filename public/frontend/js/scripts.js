function ShowStaticsForLoanNew() {
    $.ajax({
        type: "POST",
        // url: "/Home/ShowStaticsForLoanNew",
    }).done(function (data) {
        $('#divStaticsForLoanNew').html(data);
    });
}

function ShowStaticsForInviteLoanNew() {
    $.ajax({
        type: "POST",
        // url: "/Home/ShowStaticsForInviteLoanNew",
    }).done(function (data) {
        $('#divStaticsForInviteLoanNew').html(data);
    });
}


function ShowListNewsInHomePage()
{
    if (isMobile==0) {
        $.ajax({
            type: "POST",
            // url: "/Home/NewsInHomePage",
        }).done(function (data) {
            $('#topnewsinhomepage').html(data);
        });
    }
    
}



function GetTopNewsInListPage() {
    $.ajax({
        type: "POST",
        // url: "/News/TopNewInList",
    }).done(function (data) {
        $('#topnewsinlistpage').html(data);
    });
}


function ShowListLoanLatest() {
	 
		$.ajax({
			type: "POST",
			// url: "/Home/ListLoanLatest",
		}).done(function (data) {
			$('#ListLoanLatest').replaceWith(data);
			// Đơn vay mới nhất
			var tm_table_swiper = new Swiper('.tm-table-swiper', {
				loop: true,
				slidesPerView: 7,
				direction: 'vertical',
				// centeredSlides: true,
				autoplay: 3500,
				autoplayDisableOnInteraction: false
			});
		});
	
}

 

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//Luu cookie UrlSourceTima_V2
var utm_source = getParameterByName('utm_source');
var referrer = document.referrer;
if (referrer.indexOf(".google.") > -1) 
    referrer = "google";
else
 referrer = document.referrer.split("/")[2];
(function () {
    if (getCookie('UrlSourceTima_V2') == '') {
        if (utm_source == "") {
            setCookie('UrlSourceTima_V2', referrer, 30);
        } else {
            setCookie('UrlSourceTima_V2', utm_source, 30);
        }
        
    }
})();



$(document).ready(function () {
    ShowStatics();
    initPrice();
    initProduct();
    initCity();
    initDistrict();
    // $("#cbCity,#cbDistrict,#cbPrice,#cbProduct").on("select2:select", function (b) {
    //     $('#currentPage').val(1);
    //     page_click(0);
    // });
    // page_click(0);
    ShowListNewsInHomePage();


    function ShowStatics() {
        // $.ajax({
        //     type: "POST",
        //     url: "/Lender/ShowStatics",
        //     //data: { DistrictId: k }
        // }).done(function (data) {
        //     $('#divStatics').html(data);
        // });
    }
});
$('#cbStatus').select2({
    theme: "bootstrap",
    placeholder: 'Tất cả trạng thái...',
});
function initPrice() {
    $("#cbPrice").select2({
        theme: "bootstrap",
        placeholder: 'Chọn loại đơn...',
    });


}

$('#slTypeLenderRegister').select2({
    theme: "bootstrap",
    placeholder: 'Bạn là...',
});
$('#slGender').select2({
    theme: "bootstrap",
    placeholder: 'Khác...',
});

function initProduct() {

    $("#cbProduct").select2({
        theme: "bootstrap",
        placeholder: 'Chọn Gói Sản Phẩm...',
        //disabled: isProductTypeSelected() ? void 0 : !0,
        disabled:0,
        // ajax: {
        //     url: '/Home/AutocompleteProduct/',
        //     dataType: "json",
        //     data: function (b) {
        //         return {
        //             product_type_id: 0,
        //             term: $(this).val()
        //         }
        //     },
        //     processResults: function (b, c) {
        //         return {
        //             results: $.map(b.collection, function (b) {
        //                 return {
        //                     text: b.Name,
        //                     id: b.ID,
        //                 }
        //             })
        //         }
        //     }
        // }
    });
}

// var SortType = -1;
// var SortBy = -1;
//
// function page_click(value) {
//     var currentPage = parseInt($('#currentPage').val());
//     //var ProductTypeID = parseInt($('#cbProductType').val());
//     var cbPrice = parseInt($('#cbPrice').val());
//
//     var ProductID = parseInt($('#cbProduct').val());
//     var CityID = parseInt($('#cbCity').val());
//     var DistrictID = parseInt($('#cbDistrict').val());
//     var totalPage = parseInt($("#totalPage").val());
//     var numberItem = $("#numberItem").val();
//
//     currentPage = isNaN(currentPage) ? 1 : currentPage;
//     currentPage = currentPage + value;
//
//     if (currentPage < 1 || currentPage > totalPage) return;
//
//     //ProductTypeID = isNaN(ProductTypeID) ? 0 : ProductTypeID;
//
//
//
//     ProductID = isNaN(ProductID) ? 0 : ProductID;
//     CityID = isNaN(CityID) ? 0 : CityID;
//     DistrictID = isNaN(DistrictID) ? 0 : DistrictID;
//
//     $.ajax({
//         type: "POST",
//         url: "/Lender/ShowAllLoanNew",
//         data: { CurrentPage: currentPage, cbPrice: cbPrice, ProductID: ProductID, CityID: CityID, DistrictID: DistrictID, Top: 20, SortType: SortType, SortBy:SortBy }
//     }).done(function (data) {
//         $('#divLoanAllNew').html(data);
//     });
//
// }