@if (Request::has('query'))
    <div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>
            Kết quả!
        </strong>
        Có {{ $data->total() }} kết quả tìm kiếm với từ khóa "{{ Request::input('query') }}"
        <br>
        <small><a href="{{ url()->previous() }}"> Trở về trang trước</a></small>
    </div>
@endif