@extends("layout-master")
@section('title')
Course Snippets  - Olive Safety
@stop
@section('seo_detail')
	<meta name="geo.region" content="{!!kmGetData('site-config','meta_geo_region')  !!}">
	<meta name="geo.position" content="{!!kmGetData('site-config','meta_geo_position')  !!}">
	<meta name="ICBM" content="{!!kmGetData('site-config','meta_icbm')  !!}">
@stop
@section("content")
    <main class="om-main-content">
        <div class="main courses-main">
            <div class="slider">   
				<div class="top-banner height" style="background-image:url({!!  URL::asset('km_lib/uploads/'. kmGetData('site-config','course_snippets_background_image') )!!})">

				<div class="container">
                        <div class="inner-wrapper">
                            <ol class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Course Snippets</a></li>
                            </ol>
                            <h2>Course Snippets</h2>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
         <div class="course-snippets">
             <div class="container">
             <div class="snippets-search">
             	<form action="">
             		<input type="text" placeholder="Search...">
             		<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
             	</form>
             </div>
				 <div class="row courses-row" id="courses">
             		<div class="col-md-4 col-sm-6 col-xs-12">
             			<div class="course-video">            				
             						     
             							<a class="swipebox-video snippet-video" rel="vimeo" href="{{ URL::asset('{video_link}')}}">
             							
             						<img src="{{URL::asset('public/frontend/dist/images/courses/abrasive_wheels.jpg')}}"
                                           alt="">
             						<div class="play-btn">
            							
             								<i class="fa fa-play-circle" aria-hidden="true"></i> 
             								 
             						</div>    
             						</a>
             						<h3>
             							<a  class="swipebox-video" rel="vimeo" href="{{ URL::asset('{video_link}')}}"><i class="fa fa-play-circle" aria-hidden="true"></i> {snippets_title}
             						    </a>
             						</h3>    					
             				</div>
             		</div>


             	</div>

				 <div>
					 <div class="row" id="shorting-cat"></div>
				 </div>
             </div>
            </div>

		<div>
			<div class="km-image-wrapper-section">
				<input type="hidden" name="image[]" value="">
				<div class="km_image_preview_wrapper">
					<span class="km_image_preview">
					</span>
				</div>
			</div>
		</div>
    </main>
@stop @section("script")

	<script>
		$('#courses').ajaxGrid({
//			"destination": "#shorting-cat",
			"limit": 9,
			"url": "{{url('course-snippets/list-all')}}",
			"columns": [
				{"data": "id"},
				{"data": "snippets_title"},
				{
					mRender: function (row) {
						var a = {};
							a['video_link'] = row.video_link+row.video_code;
						return a;

					}
				}



			],
			"loadingClass": ".load-container",

		});
//		function filter_course_details() {
//
//			var search_text = $("#searchTxt").val();
//			$('#courses').trigger('refreshGrid', {search_text: search_text});
//
//			if ($(window).width() > 992) {
//				$('html, body').animate({
//					scrollTop: 1800
//				}, 800);
//			}
//
//			return false;
//		}
	</script>

    <script type="text/javascript">
			$( document ).ready(function() {	
						/* Video */
			$( '.swipebox-video' ).swipebox();		

      });
			
    </script>
@stop