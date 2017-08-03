@extends('layout-master')
@section('title')
     {!!kmGetData('faq','meta_title')  !!}
@stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('faq','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('faq','meta_description')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section('content')
   <main class="om-main-content">
        <div class="main courses-main">
        <div class="slider">
            <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('faq','background_image') )!!})">
                <div class="container">
                    <div class="inner-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li><a href="{{ URL::to('/frequently-asked-questions') }}">Frequently Asked Questions</a></li>
                        </ol>
                        <h2>Frequently Asked Questions</h2> </div>
                </div>
            </div>
        </div>

    <div class="container demo">
        <div class="faqs-content">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @php($data = kmGetLoopData('faq', array('faq_question','faq_answer')))
                @php
                     $i=1;
                     $j=2;
                @endphp
                @foreach($data as $item)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="{{$i}}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$j}}" aria-expanded="true" aria-controls="{{$j}}">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    {!! $item['faq_question'] !!}
                                </a>
                            </h4>
                        </div>
                        <div id="{{$j}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$i}}">
                            <div class="panel-body">
                                {!! $item['faq_answer'] !!}
                            </div>
                        </div>
                    </div>
                    @php $i++;
                    $j++;
                    @endphp
                @endforeach



    </div><!-- panel-group -->
        </div>
</div>
       </div>
</main>
@stop