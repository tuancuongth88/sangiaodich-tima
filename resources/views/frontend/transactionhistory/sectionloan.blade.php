<div id="modal-acc-detail-view1" class="modal fade modal-acc-detail ">
    <div class="modal-dialog" role="document">
        <div class="modal-content of-hidden rounded-10 border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-center w-100 fw-4 fs-14">Thông tin chi tiết khách hàng</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">


            </div>

        </div>
    </div>
</div>

<div id="modal-acc-detail-view" class="modal modal-acc-detail fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content of-hidden flex-sm-row rounded-10 border-0">
            <div class="modal-header justify-content-center align-items-start pt-lg-5 pt-4">
                <i class="icon-person"></i>
                <button type="button" class="close text-gray-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-5" id="divResultDetailsLoan">


            </div>
        </div>
    </div>
</div>


<div id="modal-acc-detail" class="modal fade modal-acc-detail ">
    <div class="modal-dialog" role="document">
        <div class="modal-content of-hidden rounded-10 border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-center w-100 fw-4 fs-14">Thông tin chi tiết khách hàng</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body px-5">
                <div class="form-group">
                    <label class="text-gray-light" for="acc-detail-fc-01">Tên khách hàng</label>
                    <input type="text" class="form-control text-center fw-7" id="acc-detail-fc-01"
                           placeholder="Tên khách hàng" value="Linh Phạm">
                </div>

                <div class="row">
                    <div class="col-7">
                        <div class="form-group">
                            <label class="text-gray-light" for="acc-detail-fc-02">Số tiền vay</label>
                            <input type="text" class="form-control text-center fw-7" id="acc-detail-fc-02"
                                   placeholder="Số tiền vay" value="60.000.000">
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <label class="text-gray-light" for="acc-detail-fc-03">Thời gian vay</label>
                            <input type="text" class="form-control text-center fw-7" id="acc-detail-fc-03"
                                   placeholder="Thời gian vay" value="60 ngày">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-gray-light" for="acc-detail-fc-04">Khu vực:</label>
                    <input type="text" class="form-control text-center" id="acc-detail-fc-04" placeholder="Khu vực"
                           value="Quận Ba Đình - Hà Nội">
                </div>

                <div class="form-group">
                    <label class="text-gray-light" for="acc-detail-fc-05">Loại hình:</label>
                    <input type="text" class="form-control text-center" id="acc-detail-fc-05"
                           placeholder="Loại hình:" value="Vay tín chấp theo lương">
                </div>
            </div>

            <div class="modal-footer text-center flex-column">
                Bạn vui lòng liên hệ qua số điện thoại:
                <span class="fw-7 fs-18 text-primary mt-1" id="acc-detail-fc-06">0967.835.078</span>
            </div>


        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="width: 110%">
            <div class="modal-header">

                <h6 class="modal-title" id="title">Bạn đồng ý mua hồ sơ của Nguyễn Văn Hưng ?</h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="btnAccept"
                        onclick="BuyLoanCredit(298669,&#39;Vay tín chấp theo lương&#39;,&#39;Sóc Sơn&#39;,&#39;40,000,000&#39;,30,&#39;Ngày&#39;,734405,0);">
                    Đồng ý
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Hủy</button>

            </div>
        </div>

    </div>
</div>

<div id="myModalCancelLoanCredit" class="modal fade" role="dialog" style="width: 110%; display: none;"
     aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="width:110%">
            <div class="modal-header">
                <h6 class="modal-title" id="titleLenderCancelLoanCredit">Bạn từ chối nhận hồ sơ của Nguyễn Văn Hưng
                    ?</h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body" id="modal-body-CancelLoanCredit">
                <div class="form-group row col-md-12">
                    <label for="cbReasonCancel" class="col-md-3 col-form-label text-sm-right mr-5">Lý do hủy</label>
                    <select class="col-md-8 select optional form-control input-lg valDropdownlist fs-14"
                            id="cbReasonCancel" name="cbReasonCancel">
                        <option value="0">Chọn lý do hủy</option>
                        <option value="1"> Đối tác không duyệt ngoại tỉnh</option>
                        <option value="2"> Đối tác không duyệt gia đình nhân thân phức tạp</option>
                        <option value="3"> Đối tác không duyệt vì xa quá</option>
                        <option value="4"> Đối tác không duyệt vì ở thuê</option>
                        <option value="5"> Đối tác không duyệt vì nhà chung cư</option>
                        <option value="7"> Hồ sơ không đạt chuẩn</option>
                        <option value="8"> Khách hàng không cư trú tại địa chỉ khai báo</option>
                        <option value="9"> Không thẩm định được nhà</option>
                        <option value="10"> Không thẩm định được công ty</option>
                        <option value="11"> Không hợp khẩu vị đại lý</option>
                        <option value="12"> Nhận thấy khách hàng không đủ khả năng chi trả khoản vay</option>
                        <option value="6"> Lý do khác</option>
                    </select>
                </div>

                <div class="form-group row col-md-12">
                    <label for="txtDetailsReason" class="col-md-3 col-form-label text-sm-right mr-5">Chi tiết hủy
                        (nếu có)</label>
                    <textarea id="txtDetailsReason" rows="4" class="col-md-8 form-control fs-14"
                              placeholder="ghi nội dung chi tiết hủy nếu có"></textarea>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"
                        id="btnLenderCancelLoanCredit" onclick="CancelLoanCredit(298669);">Đồng ý hủy
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Thoát</button>
            </div>
        </div>

    </div>
</div>

<div id="ResultModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="TitleResult"></h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <p id="ContentModal"></p>
            </div>
        </div>

    </div>
</div>


<script>

    function showModal(typeId, name, loanCreditId, productName, districtName, totalMoney, loanTime, nameTime, CustomerCreditId, SellUserId) {
        switch (typeId) {
            case 1:
                $("#title").text('Bạn đồng ý mua hồ sơ của ' + name + ' ?');
                $("#btnAccept").attr("onclick", "BuyLoanCredit(" + loanCreditId + ",'" + productName + "','" + districtName + "','" + totalMoney + "'," + loanTime + ",'" + nameTime + "'," + CustomerCreditId + "," + SellUserId + ");");
                break;
            case 2:
                $("#titleLenderCancelLoanCredit").text('Bạn từ chối nhận hồ sơ của ' + name + ' ?');
                $("#btnLenderCancelLoanCredit").attr("onclick", "CancelLoanCredit(" + loanCreditId + ");");
                $("#txtDetailsReason").val('');
                break;
            case 3:
                $("#title").text('Bạn có đồng ý giải ngân hồ sơ của ' + name + ' ?');
                $("#btnAccept").attr("onclick", "ConfirmDisbursementLoanCredit(" + loanCreditId + ",'" + name + "');");
                break;
            case 4:
                $("#titleLenderCancelLoanCredit").text('Bạn đồng ý hủy hồ sơ của ' + name + ' ?');
                $("#btnLenderCancelLoanCredit").attr("onclick", "CancelLoanCreditAfterGet(" + loanCreditId + ");");
                $("#txtDetailsReason").val('');
                break;
            case 5:
                $("#title").text('Bạn đồng ý hợp đồng của ' + name + ' đã tất toán xong ?');
                $("#btnAccept").attr("onclick", "FinishLoanCredit(" + loanCreditId + ",'" + name + "');");
                break;
            default:
        }
    }


    function acceptLoanCredit(loanCreditId, productName, districtName, totalMoney, loanTime, nameTime, money) {
        $.ajax({
            url: "/Lender/AccpetGetLoanCredit",
            type: "POST",
            data: {loanCreditId: loanCreditId, money: money},
            success: function (data) {
                if (data.Error === 0) {
                    $("#acc-detail-fc-01").val(data.FullName);
                    $("#acc-detail-fc-02").val(totalMoney);
                    $("#acc-detail-fc-03").val(loanTime);
                    $("#acc-detail-fc-04").val(districtName);
                    $("#acc-detail-fc-05").val(productName);
                    $("#acc-detail-fc-06").text(data.Phone);
                    $("#modal-acc-detail").modal().show();
                } else {
                    DisplayError(data.Message);
                }
            }
        });
    }


    function BuyLoanCredit(loanCreditId, productName, districtName, totalMoney, loanTime, nameTime, CustomerCreditId, SellUserId) {
        $.ajax({
            url: "quan-ly-don-vay/updatestatus" + "?loanCreditId=" + loanCreditId + "&status=" + "{{TRAN_STATUS_RECEIVED}}",
            type: "GET",
            success: function (data) {
                location.reload();
            }
        });
    }


    function CancelLoanCredit(loanCreditId) {

        $.ajax({
            url: "quan-ly-don-vay/updatestatus" + "?loanCreditId=" + loanCreditId + "&status=" + "{{TRAN_STATUS_CANCEL}}",
            type: "GET",
        }).done(function (data) {
            location.reload();
        });
    }

    function ConfirmDisbursementLoanCredit(loanCreditId, name) {
        $.ajax({
            url: "quan-ly-don-vay/updatestatus" + "?loanCreditId=" + loanCreditId + "&status=" + "{{TRAN_STATUS_BORROWING}}",
            type: "GET",
        }).done(function (data) {
            location.reload();
        });
    }

    function CancelLoanCreditAfterGet(loanCreditId) {

        $.ajax({
            url: "quan-ly-don-vay/updatestatus" + "?loanCreditId=" + loanCreditId + "&status=" + "{{TRAN_STATUS_CANCEL}}",
            type: "GET",
        }).done(function (data) {
            location.reload();
        });
    }

    function FinishLoanCredit(loanCreditId, name) {
        $.ajax({
            url: "quan-ly-don-vay/updatestatus" + "?loanCreditId=" + loanCreditId + "&status=" + "{{TRAN_STATUS_APPROVE}}",
            type: "GET",
        }).done(function (data) {
            location.reload();
        });
    }

    function ShowDetailsLoanCredit(loanCreditId) {
        $("#divResultDetailsLoan").html('');
        $.ajax({
            url: "/Lender/GetDetailsLoan",
            type: "POST",
            data: {loanCreditId: loanCreditId},
            success: function (data) {
                $("#divResultDetailsLoan").html(data);
            }
        });
    }

    // $('.modal-backdrop.fade.show').css('display', 'none');


</script>