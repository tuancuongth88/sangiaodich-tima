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
                        HĐ-{{$data_val['id']}}
                    </li>
                </ul>
            </div>
        </td>
        <td>
            <div class="td-inner media">
                <div class="icon-male-circle wf-38 d-flex align-self-center mr-3 hidden-xs-down"></div>
                <div class="media-body align-self-center text-ellipsis">
                    <div class="tm-table__para fw-6 line-height-heading mb-1">
                        {{ $data_val->user->fullname }}
                    </div>
                    <div class="text-gray-lighter">
                        {{substrPhone($data_val->user->phone)}}
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
                                                {{minusDaycount($data_val['payment_day'],$data_val['created_at'])}}
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
                                                   {{
                                                   convertFeeDiscount($data_val['service_code'])['fee']
                                                   }} đ
                                                </span>
                            <hr class="my-0">
                            <span style="text-decoration:line-through;font-size:12px;color:#9e9e9e">
                                                {{
                                                   convertFeeDiscount($data_val['service_code'])['fee_service']
                                                   }} đ
                                            </span>
                            <span style="font-size:12px;color:black;margin-left:5px;">
                                                -{{
                                                   convertFeeDiscount($data_val['service_code'])['discount_percent']
                                                   }}%
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
                                    onclick="update('','','{{$data_val['id']}}',2)"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Nhận đơn
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-target="#myModal" title="Hủy đơn"
                                    onclick="update('','','{{$data_val['id']}}',5)"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Hủy
                            </button>
                        @elseif($data_val['status']==2)
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-toggle="modal" data-target="#myModal"
                                    title="Đồng ý giải ngân"
                                    onclick="update('','','{{$data_val['id']}}',3)"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Giải ngân
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-target="#myModal" title="Từ chối giải ngân"
                                    onclick="update('','','{{$data_val['id']}}',5)"
                            >
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Hủy
                            </button>
                        @elseif($data_val['status']==3)
                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                    data-toggle="modal" data-target="#myModal"
                                    title="Tất toán"
                                    onclick="update('','','{{$data_val['id']}}',4)"
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