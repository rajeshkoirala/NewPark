@extends('admin.admin-layout-master')

@section('title')
Enquiry Lists
@stop
@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="{{ url('admin/') }}">Home</a></li>
		<li class="active"><a href="{{ url('admin/enquiry') }}">Enquiry</a></li>

			<li class="active"><a href="{{ url('admin/enquiry/'.$enquiry->id.'/view') }}">View</a></li>

	</ol>
@stop
@section('styles')
<link rel="stylesheet" href="{{URL::asset('public/css/plugins/jasny/jasny-bootstrap.min.css')}}"/>
@stop

@section('content')

<div class="wrapper wrapper-content animated fadeIn">
	<div class="row">
		<div class="col-lg-12">
			<div class="float-e-margins clearfix">
				<div class="ibox-title">
					<h5>Enquiry Detail</h5>
				</div>
				<div class="ibox-content enquery-detail">
					<div class="row">
						<div class="col-md-12">
							<fieldset>
								<label>Name: </label>
								<p>{{$enquiry->name}}</p>

							</fieldset>
						</div>

						<div class="col-md-12">
							<fieldset>
								<label>Email: </label>
								<p><a href="mailto:{{$enquiry->email}}"> {{$enquiry->email}} </a></p>
							</fieldset>
						</div>

						<div class="col-md-12">
							<fieldset>
								<label>Phone: </label>
								<p>{{$enquiry->phone}}</p>
							</fieldset>
						</div>

						<div class="col-md-12">
							<fieldset>
								<label>Company Name: </label>
								<p>{{$enquiry->company_name}}</p>
							</fieldset>
						</div>

						<div class="col-md-12">
							<fieldset>
								<label>Course Interested In: </label>
								<p>{{$enquiry->course_interested}}</p>
							</fieldset>
						</div>

						<div class="col-md-12">
							<fieldset>
								<label>Heard From</label>
								<p>{{$enquiry->heard_from}}</p>
							</fieldset>
						</div>

						<div class="col-md-12">
							<fieldset>
								<label>Message</label>
								<p>{{$enquiry->message}}</p>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="ibox-footer clearfix">
				<div class="pull-left">
					<a href="{{ url('/admin/enquiry') }}">
						<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
					</a>
				</div>
			</div>
		</div>
	</div>


</div>
@stop


@section('script')
<script src="{{URL::asset('public/js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>
<script>
	$(".sidebar-nav").find(".menu-enquiry-management").addClass('active');

</script>
@stop