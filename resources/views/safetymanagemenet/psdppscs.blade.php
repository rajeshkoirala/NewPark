@extends("layout-master")
@section('title')
     {!!kmGetData('psdp-pscs','meta_title')  !!}
@stop
@section('seo_detail')
    {{--<meta name="title" content="{!!kmGetData('psdp-pscs','meta_title')  !!}">--}}
    <meta name="description" content="{!!kmGetData('psdp-pscs','meta_description')  !!}">
    <meta name="keywords" content="{!!kmGetData('psdp-pscs','meta_keyword')  !!}">
    <meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
    <meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
    <meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section("content")
    <main class="om-main-content">
        <div class="main courses-main">
            <div class="slider">
                <div class="top-banner height"
                     style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('psdp-pscs','background_image') )!!})">

                    <div class="container">
                        <div class="inner-wrapper">
                            <ol class="breadcrumb">
                                <li><a href="{{ URL::to('/') }}">Home</a></li>
                                <li><a href="{{ URL::to('/safetymanagemenet/psdppscs') }}">Safety Management</a></li>
                                <li><a href="{{ URL::to('/safetymanagemenet/psdppscs') }}">PSDP+PSCS</a></li>
                            </ol>
                            <h2>PSDP + PSCS</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="psdp-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="global-heading">
                                <h2>{!! kmGetData('psdp-pscs','psdp_head') !!}</h2>
                                <hr>
                            </div>
                            {!! kmGetData('psdp-pscs','psdp_description') !!}
                        </div>
                        @php($data = kmGetLoopData('psdp-pscs', array('psdp_image','psdp_title', 'psdp_description')))
                        @foreach($data as $item)
                            <div class="col-md-4">
                                <div class="description matchHeight">
                                    <img src="{{URL::asset('km_lib/uploads/'.$item['psdp_image']) }}" alt="...">
                                    <h3>{!! $item['psdp_title'] !!}</h3>
                                    {!! $item['psdp_description'] !!}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="psdp-section pscs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="global-heading">
                                <h2>{!! kmGetData('psdp-pscs','pscs_head') !!}</h2>
                                <hr>
                            </div>

                            {!! kmGetData('psdp-pscs','pscs_description') !!}
                        </div>
                        @php($data = kmGetLoopData('psdp-pscs', array('pscs_image','pscs_title', 'pscs_description')))
                        @foreach($data as $item)

                            <div class="col-md-4">
                                <div class="description matchHeight">
                                    <img src="{{URL::asset('km_lib/uploads/'.$item['pscs_image']) }}" alt="...">
                                    <h3>{!! $item['pscs_title'] !!}</h3>
                                    {!! $item['pscs_description'] !!}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </main>
@stop
@section("script")
    <script type="text/javascript">
        $(function () {
            $('.matchHeight').matchHeight();
        });
    </script>
@stop
