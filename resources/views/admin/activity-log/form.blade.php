@extends('admin.admin-layout-master')

@section('title')
	Log Management
@stop
@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
@endif

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="{{ url('admin/') }}">Home</a></li>
		<li class="active"><a href="{{ url('admin/activity-log') }}">Activity Log</a></li>
		<li class="active"><a href="{{ url('admin/activity-log/'.$activitylog->id.'/view') }}">Log View</a></li>
	</ol>
@stop

@section('content')
	<div class="wrapper wrapper-content animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>New Log</h5>
					</div>
					{!! Form::open(['url' => 'admin/categories/save-or-update', 'id'=>'categoriesform']) !!}
					<input type="hidden" name="id" value="{{ $activitylog->id }}">
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Action</label>
									<input type="text" name="category_name" class="form-control validate[required]" value="{{ $activitylog->action }}"/>
								</div>
								<div class="form-group">
									<label>Task Description</label>
									<textarea name="category_short_desc" class="form-control editor">{{ $activitylog->description }}</textarea>
								</div>
								<div class="form-group">
									<label>User Agent</label>
									<textarea name="category_desc" class="form-control editor">{{ $activitylog->user_agent}}</textarea>
								</div>
								<div class="form-group">
									<label>Commited at</label>
									<input type="text" name="category_name" class="form-control validate[required]" value="{{ $activitylog->created_at }}"/>
								</div>
								<div class="form-group">
									<label>Recorded IP</label>
									<input type="text" name="category_name" class="form-control validate[required]" value="{{ $activitylog->ip_address }}"/>
								</div>

							</div>
						</div>
					</div>
					<div class="ibox-footer clearfix">
						{{--<div class="pull-right">--}}
							    {{--<button type="submit" name="submit" value="Save" class="btn btn-primary"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Save </button>--}}
						{{--</div>--}}
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>



@stop
@section('script')

	<script type="text/javascript">

        $(".sidebar-nav").find(".activity-log").addClass('active');


	$("#categoriesform").validationEngine();
//    var ck_id;
//    $('.editor').each(function () {
//        var id = "ts_" + ck_id;
//        ck_id++;
//        $(this).attr('id', id);
//        CKEDITOR.replace(id);
//    });
</script>
@stop
