@foreach ($data as $key_data=>$data_val)
    <tr>
        <td class="h-100 hidden-xs-down">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mt-3">
                    <li class="list-h-1__item">
                        {{$key_data+1}}
                    </li>
                </ul>
            </div>
        </td>
        <td class="h-100 hidden-xs-down">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mt-3">
                    <li class="list-h-1__item">
                        HĐ-{{$data_val['transaction_id']}}
                    </li>
                </ul>
            </div>
        </td>
        <td>
            <div class="td-inner media">
                <div class="icon-male-circle wf-38 d-flex align-self-center mr-3 hidden-xs-down"></div>
                <div class="media-body align-self-center text-ellipsis">
                    <div class="tm-table__para fw-6 line-height-heading mb-1">
                        {{ $data_val->userCreated->fullname }}
                    </div>
                    <div class="text-gray-lighter">
                        {{ substrPhone($data_val->userCreated->phone,$data_val['status'])}}
                    </div>
                </div>
            </div>
        </td>
        <td class="hidden-xs-down">
            <div class="td-inner d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    {{ getLocation($data_val['district_id'])['name'] }}
                    <hr class="my-0">
                    {{getLocation($data_val['city_id'])['name']}}
                </div>
            </div>
        </td>
        <td class="hidden-xs-down">
            <div class="td-inner d-flex justify-content-center text-center">
                <div class="text-nowrap">
                                            <span class="text-primary">
                                                {{convertAmount($data_val['amount'])}}
                                                {{$data_val['amount_day'] }}
                                                - Ngày
                                            </span>
                    <hr class="my-0">
                    {{$data_val->service->service_name}}
                </div>
            </div>
        </td>
        <td class="h-100 hidden-xs-down">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mt-3">
                    <li class="list-h-1__item text-primary">
                        {{convertDate('H:i',$data_val['created_at'])}}
                    </li>
                    <li class="list-h-1__item">
                        {{convertDate('Y-m-d',$data_val['created_at'])}}
                    </li>
                </ul>
            </div>
        </td>
        <td>
            <div class="td-inner media d-flex justify-content-center text-center">
                <div class="text-nowrap">

                    @if($data_val['status']==1)
                        <div class="text-nowrap">
                                                <span class="text-primary">
                                                    {{number_format($data_val['fee'])}} đ
                                                </span>
                            <hr class="my-0">
                            <span style="text-decoration:line-through;font-size:12px;color:#9e9e9e">

                                            </span>
                            <span style="font-size:12px;color:black;margin-left:5px;">
                                                    {{$data_val['percent_discount']}} %
                                            </span>
                        </div>
                    @else
                        <span class="badge badge-danger align-self-center">
                                                {{isset($list_status[$data_val['status']])?
                                                $list_status[$data_val['status']]:'Đã hủy'
                                                }}
                                                </span>
                    @endif
                </div>
            </div>
        </td>
        <td class="">
            <div id="277548"
                 class="td-inner d-flex flex-column align-items-center text-center btnbuy">
                <ul class="list-h-1 align-self-start mt-3">
                    <li class="list-h-1__item">
                        @if($data_val['status']==1)
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-toggle="modal" data-target="#myModal" title="Nhận đơn"
                                    onclick="showModal(
                                            1,
                                            '{{$data_val->userCreated->fullname}}'
                                            ,'{{$data_val['id']}}'
                                            ,{{TRAN_STATUS_RECEIVED}})"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Nhận đơn
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-toggle="modal"
                                    data-target="#myModalCancelLoanCredit" title="Hủy đơn"
                                    onclick="showModal(
                                            2,
                                            '{{$data_val->userCreated->fullname}}'
                                            ,'{{$data_val['id']}}'
                                            ,{{TRAN_STATUS_CANCEL}})"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Hủy
                            </button>
                        @elseif($data_val['status']==2)
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-toggle="modal" data-target="#myModal"
                                    title="Đồng ý giải ngân"
                                    onclick="showModal(
                                            3,
                                            '{{$data_val->userCreated->fullname}}'
                                            ,'{{$data_val['id']}}'
                                            ,{{TRAN_STATUS_BORROWING}})"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Giải ngân
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-toggle="modal"
                                    data-target="#myModalCancelLoanCredit"
                                    title="Từ chối giải ngân"
                                    onclick="showModal(
                                            4,
                                            '{{$data_val->userCreated->fullname}}'
                                            ,'{{$data_val['id']}}'
                                            ,{{TRAN_STATUS_CANCEL}})"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Hủy
                            </button>
                        @elseif($data_val['status']==3)
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-toggle="modal" data-target="#myModal"
                                    title="Tất toán"
                                    onclick="showModal(
                                            5,
                                            '{{$data_val->userCreated->fullname}}'
                                            ,'{{$data_val['id']}}'
                                            ,{{TRAN_STATUS_APPROVE}})"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Tất toán
                            </button>
                        @endif
                    </li>
                </ul>

            </div>
        </td>
    </tr>
@endforeach