<div id="divLoanAllNew">
    <style>
        .addtocart:hover {
            border-bottom: 2px solid #ccc;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            margin-top: 5px;
        }

        .addtocart:hover {
            cursor: pointer;
        }

        .sort {
            cursor: pointer;
        }
    </style>

    <div class="table-responsive">
        <table class="tm-table-1 table text-gray-light" style="min-width:unset">
            <tbody>
            <tr>
                <th class="text-center hidden-xs-down">
                    <div class="border-right">
                        STT
                    </div>
                </th>
                <th class="text-center ">
                    <div class="border-right">
                        Khách hàng
                    </div>
                </th>
                <th class="text-center hidden-xs-down">
                    <div class="border-right">
                        Khu vực
                    </div>
                </th>
                <th class="text-center hidden-xs-down">
                    <div rel="-1" field="1" class="sort border-right">
                        Số tiền
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </div>
                </th>
                <th class="text-center hidden-xs-down">
                    <div rel="-1" field="2" class="sort border-right">
                        Thời gian tạo
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </div>
                </th>
                <th class="text-center hidden-xs-down">
                    <div rel="-1" field="2" class="sort border-right">
                        Trạng thái
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </div>
                </th>
            </tr>
            @foreach ($data as $key_data=>$data_val)
                <tr>
                    <td class="h-100 hidden-xs-down">
                        <div class="td-inner d-flex justify-content-center h-100">
                            <ul class="list-h-1 align-self-start mt-3">
                                <li class="list-h-1__item">
                                    {{$key_data +1}}
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <div class="td-inner media">
                            <div class="icon-male-circle wf-38 d-flex align-self-center mr-3 hidden-xs-down"></div>
                            <div class="media-body align-self-center text-ellipsis">
                                <div class="tm-table__para fw-6 line-height-heading mb-1">
                                    {{$key_data['customer_name']}}
                                </div>
                                <div class="text-gray-lighter">
                                    {{$data_val['customer_mobile']}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="hidden-xs-down">
                        <div class="td-inner d-flex justify-content-center text-center">
                            <div class="text-nowrap">
                                {{$data_val['provice_id']}}
                                <hr class="my-0">
                                {{$data_val['district_id']}}
                            </div>
                        </div>
                    </td>
                    <td class="hidden-xs-down">
                        <div class="td-inner d-flex justify-content-center text-center">
                            <div class="text-nowrap">
                                <span class="text-primary">
                                    {{$data_val['fee']}}Triệu - {{$data_val['amount_day']}} Ngày
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
                                    21:23
                                </li>
                                <li class="list-h-1__item">
                                    {{$data_val['created_time']}}
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td class="">
                        <div id="277548"
                             class="td-inner d-flex flex-column align-items-center text-center btnbuy">
                            <ul class="list-h-1 align-self-start mt-3">
                                <li class="list-h-1__item">
                                    <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                            data-toggle="modal" data-target="#myModal" title="Nhận đơn">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        {{isset($list_status[$data_val['status']])?
                                        $list_status[$data_val['status']]:'Đã hủy'
                                        }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="d-flex">
        <nav class="d-flex justify-content-between ml-lg-2 navigation-tran" aria-label="Page navigation">
            {{ $data->links() }}
        </nav>
    </div>
</div>