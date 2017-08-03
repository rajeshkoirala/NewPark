@extends('admin.admin-layout-master')
@section('title')
    Voucher Code
@stop
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/') }}">Home</a></li>
        <li class="active"><a href="{{ url('admin/voucher') }}">Voucher</a></li>
        @if( $voucher->id>0)
            <li class="active"><a href="{{ url('admin/voucher/'.$voucher->id.'/edit') }}">Edit</a></li>
        @else
            <li class="active"><a href="{{ url('admin/voucher/create') }}">Add</a></li>
        @endif
    </ol>
@stop
@if( $voucher->id > 0)

@section('action_button')
    <a href="{{url('admin/voucher/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> Add More</a>
@stop
@endif
@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>New Voucher Code</h5>
                    </div>
                    {!! Form::open(['url' => 'admin/voucher/save-or-update', 'id'=>'voucherform']) !!}
                    <input type="hidden" name="id" value="{{ $voucher->id }}">
                    <div class="ibox-content">
                        <div class="form-group">
                            <label>Code*</label>
                            <div class="input-group">
                                <input type="text" name="code" class="form-control voucher-code required" value="{{ $voucher->code }}"/>

                                <span class="input-group-btn">
                                    <button type="button" onclick="VoucherCodeGenerate()" class="btn btn-primary generate">Generate <i class="fa fa-key" aria-hidden="true"></i>
                                 </button>
                            </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Voucher Type</label>
                            <select name="type" class="form-control">
                                <option value="AMOUNT" @if ($voucher->type=="AMOUNT") selected="selected" @endif>
                                    Amount
                                </option>
                                <option value="PERCENTAGE"
                                        @if ($voucher->type=="PERCENTAGE") selected="selected" @endif>Percentage
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" class="form-control validate[required,custom[number]]"
                                   value="{{ $voucher->amount }}"/>
                        </div>

                        <div class="form-group">
                            <label>Usage Limit</label>
                            <input type="text" name="usage_limit" class="form-control validate[required]"
                                   value="{{ $voucher->usage_limit }}"/>
                        </div>


                    </div>
                    <div class="ibox-footer clearfix">
                        <div class="pull-right">
                            <button type="submit" name="submit" value="Save" id="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                            </button>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    {{--<div class="wrapper wrapper-content animated fadeInRight">--}}
    {{--<div class="ibox-content m-b-sm border-bottom">--}}
    {{--<div class="row">--}}
    {{--<div class="col-lg-12">--}}
    {{--{!! Form::open(['url' => 'admin/voucher/save-or-update', 'id'=>'voucherform']) !!}--}}
    {{--<input type="hidden" name="id" value="{{ $voucher->id }}">--}}
    {{--<div>--}}
    {{--<div class="form-group">--}}
    {{--<label>Code</label>--}}
    {{--<div class="input-group">--}}
    {{--<input type="text" name="code" class="form-control voucher-code validate[required] "--}}
    {{--value="{{ $voucher->code }}"/>--}}

    {{--<span class="input-group-btn">--}}
    {{--<button type="button" onclick="VoucherCodeGenerate()" class="btn btn-primary generate">Generate <i--}}
    {{--class="fa fa-arrow-circle-o-down " aria-hidden="true"></i>--}}
    {{--</button>--}}

    {{--</span>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label>Voucher Type</label>--}}
    {{--<select name="type" class="form-control">--}}
    {{--<option value="AMOUNT" @if ($voucher->type=="AMOUNT") selected="selected" @endif>--}}
    {{--Amount--}}
    {{--</option>--}}
    {{--<option value="PERCENTAGE"--}}
    {{--@if ($voucher->type=="PERCENTAGE") selected="selected" @endif>Percentage--}}
    {{--</option>--}}
    {{--</select>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label>Amount</label>--}}
    {{--<input type="text" name="amount" class="form-control validate[required,custom[number]]"--}}
    {{--value="{{ $voucher->amount }}"/>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label>Usage Limit</label>--}}
    {{--<input type="text" name="usage_limit" class="form-control validate[required]"--}}
    {{--value="{{ $voucher->usage_limit }}"/>--}}
    {{--</div>--}}


    {{--<button type="submit" name="submit" value="Save" class="btn btn-primary">Save <i--}}
    {{--class="fa fa-floppy-o"--}}
    {{--aria-hidden="true"></i>--}}
    {{--</button>--}}
    {{--</div>--}}

    {{--{!! Form::close() !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@stop

@section('script')
    <script src="{{url('public/js/plugins/validate/jquery.validate.min.js')}}"></script>

    <script>
        $(".sidebar-nav").find(".menu-voucher").addClass('active');

        function VoucherCodeGenerate() {

            $.ajax({
                url: "{{url('admin/voucher/voucher-code')}}",
                type: 'get',
                success: function (response) {
                    $('.voucher-code').val(response);
                }
            })
        }

        $("#voucherform").validate({
            rules: {
                code: {
                    required: true,
                    minlength: 3
                }
            }
        });

    </script>
@stop