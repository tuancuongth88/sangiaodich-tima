@extends('administrator.app')
@section('title','Quản lý danh sách tỉnh thành, quận huyện')

@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
	    <div class="m-content">
	    	<div class="col-xs-12" style="margin-bottom: 20px">
	            <h3>Danh sách tỉnh thành, quận huyện</h3>
	        </div>
	        <div class="m-section">
	        	@include('administrator.errors.messages')
	            <div class="m-section__content">
                    {{ Form::open(['action' => 'Administrators\Systems\DashboardController@postLocation', 'method' => 'POST']) }}
	                    <div class="form-group">
	                    	{{ Form::textarea('location', $data, ['class' => 'form-control', 'rows' => 20]) }}
                    	</div>
                    	<div class="alert">
                    		<i>Mỗi địa danh là 1 dòng. Mỗi dòng có thể bắt đầu với dấu gạch ngang "-" (mỗi dấu gạch ngang tương ứng với lùi 1 cấp). Các địa danh cấp 2 nên được đánh 2 dấu "--" và nằm dưới địa danh cấp 1 "-".<p>Ví dụ:<br>Thành phố<br>-Quận 1<br>--Phường 1<br>--Phường 2<br>Tỉnh<br>-Huyện</p>
                    			<p>Để tìm kiếm địa danh, hay sử dụng công cụ tìm kiếm trên trang của trình duyệt: <b>Ctr+F</b> (google chrome, Cốc cốc, Firefox, Opera)</p></i>
                    	</div>
                    	{{ Form::submit('Lưu lại', ['class' => 'form-control']) }}
	                {{ Form::close() }}
	            </div>
	        </div>
	        <!--end::Section-->
	    </div>
	</div>
@stop