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
                        Anh Trung
                    </div>
                    <div class="text-gray-lighter">
                        090*****489
                    </div>
                </div>
            </div>
        </td>
        <td class="hidden-xs-down">
            <div class="td-inner d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    {{$data_val['district_id']}}
                    <hr class="my-0">
                    {{$data_val['provice_id']}}
                </div>
            </div>
        </td>
        <td class="hidden-xs-down">
            <div class="td-inner d-flex justify-content-center text-center">
                <div class="text-nowrap">
                                            <span class="text-primary">
                                                {{$data_val['amount']}} Triệu - {{$data_val['amount_day']}} Ngày
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
                        {{$data_val['created_at']}}
                    </li>
                </ul>
            </div>
        </td>
        <td>
            <div class="td-inner media d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    <div class="text-nowrap">
                                                <span class="text-primary">
                                                    11,000 ₫
                                                </span>
                        <hr class="my-0">
                        <span style="text-decoration:line-through;font-size:12px;color:#9e9e9e">
                                                22,000 ₫
                                            </span>
                        <span style="font-size:12px;color:black;margin-left:5px;">
                                                -50%
                                            </span>
                    </div>
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
                                    data-toggle="modal" data-target="#myModal" title="Nhận đơn">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Nhận đơn
                            </button>
                        @endif
                    </li>
                </ul>

            </div>
        </td>
    </tr>
@endforeach