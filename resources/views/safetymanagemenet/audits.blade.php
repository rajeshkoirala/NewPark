@extends("layout-master")
@section('title')
    {!!kmGetData('health_safety','meta_title')  !!}
@stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('health_safety','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('health_safety','meta_description')  !!}">
    <meta name="keywords" content="{!!kmGetData('health_safety','meta_keyword')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section("content")
    <main class="om-main-content">
        <div class="main courses-main">
            <div class="slider">
                <div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('health_safety','background_image') )!!})">

                <div class="container">
                        <div class="inner-wrapper">
                            <ol class="breadcrumb">
                                <li><a href="{{ URL::to('/') }}">Home</a></li>
                                <li><a href="{{ URL::to('/safetymanagemenet/audits') }}">Safety Management</a></li>
                                <li><a href="{{ URL::to('/safetymanagemenet/audits') }}">Health and Safety Audits</a></li>

                            </ol>
                            <h2>Health and Safety Audits</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="common-section-one">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="global-heading">
                                <h2>{!! kmGetData('health_safety','title') !!}</h2>
                                <hr>
                            </div>

                            <div class="description">
                                {!! kmGetData('health_safety','description') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="audits-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="global-heading">
                                <h2>{!! kmGetData('health_safety','moretitle') !!}</h2>
                                <hr>
                            </div>
                        </div>
                        @php($data = kmGetLoopData('health_safety', array('image','more_title', 'after_icon','more_description')))
                           @php $i=1; @endphp
                            @foreach($data as $item)
                                <div class="col-md-5 @php if($i==1) echo "col-md-offset-1"; @endphp ">
                                    <div class="description matchHeight">
                                        <img class="img-wrap" src="{{URL::asset('km_lib/uploads/'.$item['image']) }}"
                                             alt="...">
                                        <h3>{!! $item['more_title'] !!}</h3>
                                        <i class="{!! $item['after_icon'] !!}" aria-hidden="true"></i>
                                        {!! $item['more_description'] !!}
                                    </div>
                                </div>
                                @php $i++; @endphp
                            @endforeach



                    </div>
                </div>

            </div>
    </main>
@stop @section("script")
    <script type="text/javascript">
        $(function () {
            $('.matchHeight').matchHeight();
        });
    </script>
@stop