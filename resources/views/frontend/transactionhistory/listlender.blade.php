<div class="table-responsive">
    <table class="tm-table-1 no-line-h table text-gray-light">
        <tbody>
        <tr>
            <th class="text-center fw-4">
                <div class="td-inner">
                    Khách hàng
                </div>
            </th>
            <th class="text-center fw-4">
                <div class="td-inner">
                    Điện thoại
                </div>
            </th>
            <th class="text-center fw-4">
                <div class="td-inner">
                    Địa chỉ
                </div>
            </th>
            <th class="text-center fw-4">
                <div class="td-inner">
                    Đánh giá
                </div>
            </th>
            <th class="text-center fw-4">
                <div class="td-inner">
                    Trạng thái
                </div>
            </th>
        </tr>
        @foreach($data as $key=>$data_val)
            <tr>
                <td>
                    <div class="td-inner media">
                        <div class="icon-male-circle wf-38 d-flex align-self-center mr-3"></div>
                        <div class="media-body align-self-center text-ellipsis">
                            <a class="tm-table__para fw-6 line-height-heading text-gray-light mb-1">
                                {{ $data_val->userReceiver->fullname }}
                            </a>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="td-inner d-flex justify-content-center align-items-center">
                        <div class="text-nowrap text-gray-lighter">
                            {{ $data_val->userReceiver->phone }}

                        </div>
                    </div>
                </td>
                <td>
                    <div class="td-inner d-flex justify-content-center align-items-center">
                        <div class="text-gray-lighter">
                            {{ getLocation($data_val->userReceiver->district_id)['name']}}
                            , {{ getLocation($data_val->userReceiver->city_id)['name']}}
                        </div>
                    </div>
                </td>
                <td>
                    <div class="td-inner d-flex justify-content-center align-items-center">
                        <div class="d-flex">
                            <i class="icon-star-gray"></i>
                            <i class="icon-star-gray"></i>
                            <i class="icon-star-gray"></i>
                            <i class="icon-star-gray"></i>
                            <i class="icon-star-gray"></i>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="td-inner d-flex justify-content-center align-items-center">
                        <span class="btn btn-sm btn-secondary border-0 text-gray-dark bg-gray-lighter fw-6">
                            {{ $list_status[$data_val->status] }}
                        </span>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>