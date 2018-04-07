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
                <div class="media-body align-self-center text-ellipsis">
                    <div class="tm-table__para fw-6 line-height-heading mb-1">
                        HD-{{$data_val['id']}}
                    </div>
                </div>
            </div>
        </td>
        <td class="hidden-xs-down">
            <div class="td-inner d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    {{$data_val['created_at']}}
                </div>
            </div>
        </td>
        <td class="hidden-xs-down">
            <div class="td-inner d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    {{$data_val->service->service_name}}
                </div>
            </div>
        </td>
        <td class="h-100 hidden-xs-down">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mt-3">
                    <li class="list-h-1__item text-primary">
                        {{$data_val['created_at']}}
                    </li>
                </ul>
            </div>
        </td>
        <td>
            <div class="td-inner media d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    <div class="text-nowrap">
                        {{number_format($data_val['amount'])}} VND
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="td-inner media d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    <div class="text-nowrap">
                        {{$data_val['fee']}}
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="td-inner media d-flex justify-content-center text-center">
                <div class="text-nowrap">
                    <div class="text-nowrap">
                        <span class="badge badge-danger align-self-center">
                            {{isset($list_status[$data_val['status']])?
                            $list_status[$data_val['status']]:'Đã hủy'
                            }}
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
                            <button type="button"
                                    class="btn btn-outline-danger btn-sm updatestatus"
                                    data-toggle="modal" data-target="#myModal"
                                    title="Hủy đơn vay"
                                    onclick="showModal(4, '', '{{$data_val['id']}}', '5,000,000' )">
                                Hủy
                            </button>
                        @else
                            &nbsp;&nbsp;
                        @endif
                    </li>
                </ul>
            </div>
        </td>
    </tr>
@endforeach