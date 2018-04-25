<div id="modal-ds-nguoi-cho-vay" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content of-hidden rounded-10 border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-center w-100 fw-4 fs-14">Danh sách người cho vay</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body px-5" id="divLenders">

            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width:110%">
            <div class="modal-header">

                <h6 class="modal-title" id="title"></h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="btnLoanerAccept"
                        onclick="LoanerCancelLoanCredit(300619);">Đồng ý
                </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Hủy</button>

            </div>
        </div>

    </div>
</div>

<script>
    function showModal(typeId, name, loanCreditId, totalMoney) {
        switch (typeId) {
            case 4:
                $("#title").text('Bạn đồng ý hủy hồ sơ hd-' + loanCreditId + ' với số tiền ' + totalMoney + ' vnđ');
                $("#btnLoanerAccept").attr("onclick", "LoanerCancelLoanCredit(" + loanCreditId + ");");
                break;
        }
    }

    function LoanerCancelLoanCredit(loanCreditId) {
        $.ajax({
            url: "lich-su-don-vay/updatestatus" + "?loanCreditId=" + loanCreditId + "&status=" + 5,
            type: "GET",
            success: function (data) {
                if (data.Error === 0) {
                    $("#myModal .close").click();
                    location.reload();
                } else {
                    DisplayError(data.Message);
                }
            }
        });
    }

    function ShowListLender(LoanCreditId) {
        $.ajax({
            type: "GET",
            url: "/lich-su-don-vay/getlistlenderbyloanid" + "?loanCreditId=" + LoanCreditId,
        }).done(function(data) {
            $('#divLenders').html(data.html);
        });
    }

</script>