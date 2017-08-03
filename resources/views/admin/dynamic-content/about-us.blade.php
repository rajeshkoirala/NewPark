@extends('admin.admin-layout-master')
@section('title')
About Us
@stop
@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="{{ url('admin/') }}">Home</a></li>
		<li class="active"><a href="{{ url('admin/about-us') }}">about Us</a></li>

	</ol>
@stop
@section('content')
<div class="wrapper wrapper-content animated fadeIn">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>About us</h5>
				</div>
				{!! kmBegin('about-us') !!}
				<div class="ibox-content">
					<div class="form-group">
						<label>Title</label>
						{!! kmText('title') !!}
					</div>

					<div class="form-group">
						<label>Description</label>
						{!! kmEditor('description') !!}
					</div>

					<div class="form-group">
						<label>Button Text</label>
						{!! kmText('btn_link') !!}
					</div>
					<div class="hr-line-dashed"></div>
					@while (kmLoop())
					<div class="km-loop-div">
						{!! kmBtnClose() !!}
						<div class="row">

							<div class="col-md-3">
								<div class="form-group"><label>Image</label> {!! kmImage('image') !!}</div>
							</div>
							<div class="col-md-9">
								<div class="form-group"><label>Title</label> {!! kmText('image_title') !!}</div>
								<div class="form-group"><label>Description</label> {!! kmEditor('image_description') !!}</div>
							</div>
						</div>
					</div>
					@endwhile

					<div class="hr-line-dashed"></div>

					<h2>SEO Details</h2>
					<div class="form-group">
						<label>SEO Title</label>
						{!! kmText('meta_title') !!}
					</div>

					<div class="form-group">
						<label>SEO Meta Description</label>
						{!! kmTextArea('meta_description') !!}
					</div>






					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label>Background Image</label>
			        {!! kmImage('background_image') !!}

				</div>

				<div class="ibox-footer clearfix">
					<div class="pull-right">
						<div class="form-group last-save-btn">
							{!! kmSubmit() !!}
						</div>
					</div>
				</div>
				{!! kmEnd() !!}
			</div>
		</div>
	</div>
</div>
@stop

@section('script')
<script>
	$(".sidebar-nav").find(".contact-about-us").addClass('active');
</script>
@stop