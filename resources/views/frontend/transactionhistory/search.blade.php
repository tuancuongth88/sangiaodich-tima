@foreach ($data as $key_data=>$data_val)
    <tr style="cursor:pointer" class="">
        <td class="h-100 hidden-xs-down link-hover-undertext" data-toggle="modal"
            href="#modal-ds-nguoi-cho-vay" onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mb-0">
                    <li class="list-h-1__item">
                        {{$key_data +1}}
                    </li>
                </ul>
            </div>
        </td>
        <td class="h-100 hidden-xs-down link-hover-undertext" data-toggle="modal"
            href="#modal-ds-nguoi-cho-vay" onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mb-0">
                    <li class="list-h-1__item">
                        HD-{{$data_val['id']}}
                    </li>
                </ul>
            </div>
        </td>

        <td class="h-100 link-hover-undertext" data-toggle="modal"
            href="#modal-ds-nguoi-cho-vay" onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mb-0">
                    <li class="list-h-1__item">
                        {{$data_val['created_at']}}
                    </li>
                </ul>
            </div>
        </td>
        <td class="hidden-xs-down link-hover-undertext" data-toggle="modal"
            href="#modal-ds-nguoi-cho-vay" onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mb-0">
                    <li class="list-h-1__item">
                        {{$data_val->service->service_name}}
                    </li>
                </ul>
            </div>

        </td>

        <td class="hidden-xs-down link-hover-undertext" data-toggle="modal"
            href="#modal-ds-nguoi-cho-vay" onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mb-0">
                    <li class="list-h-1__item">
                        {{minusDaycount($data_val['payment_day'],$data_val['created_at'])}}
                    </li>
                </ul>
            </div>
        </td>

        <td class="link-hover-undertext" data-toggle="modal" href="#modal-ds-nguoi-cho-vay"
            onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mb-0">
                    <li class="list-h-1__item">
                        {{number_format($data_val['amount'])}} VND
                    </li>
                </ul>
            </div>
        </td>
        <td class="link-hover-undertext" data-toggle="modal" href="#modal-ds-nguoi-cho-vay"
            onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner d-flex justify-content-center h-100">
                <ul class="list-h-1 align-self-start mb-0">
                    <li class="list-h-1__item">
                    </li>
                </ul>
            </div>
        </td>

        <td data-toggle="modal" href="#modal-ds-nguoi-cho-vay"
            onclick="ShowListLender({{$data_val['id']}})">
            <div class="td-inner media d-flex justify-content-center">
                                            <span class="badge badge-danger align-self-center">
                                                {{isset($list_status[$data_val['status']])?
                                                        $list_status[$data_val['status']]:'Đã hủy'
                                                         }}
                                            </span>
            </div>
        </td>

        <td>
            <div class="h-100">
                <div class="td-inner d-flex justify-content-center h-100">
                    <ul class="list-h-1 align-self-start mt-3">
                        <li class="list-h-1__item">
                            @if($data_val['status']==1)
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-toggle="modal" data-target="#myModal"
                                        title="Hủy đơn vay"
                                        onclick="showModal(
                                                4,
                                                '{{$data_val->user->fullname}}',
                                                '{{$data_val['id']}}',
                                                '{{number_format($data_val['amount'])}}'
                                                )">
                                    Hủy
                                </button>
                            @else
                                &nbsp;&nbsp;
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </td>
    </tr>
@endforeach