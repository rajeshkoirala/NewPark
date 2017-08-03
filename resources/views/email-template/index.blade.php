<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Email Template</title>
</head>
<body style="margin:0;padding:0;">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
		 <td>
			<table align="center" cellpadding="0" cellspacing="0" style="border:solid 1px #ccc;max-width:600px;font-family:arial;border-collapse: collapse;">
				 <tr>
					<td  bgcolor='#1b2d5a' style="padding:15px 10px 15px 10px">
						<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="50%">
											<img src= "{{URL::asset('public/email_template/images/Olive_Safety_Logo.png')}}"  alt="" style="max-width:100px;min-width:60px;">
									</td>
									<td width="50%">
										<table align="right" style="font-size:12px;">
											<tr>
												<td align="right" style="color:#979caa;font-size:13px;">
													<img src="{{URL::asset('public/email_template/images/ico_phone.png')}}" alt="" width="20px">Call Us
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td align="right" style="color:#979caa;font-size:13px;">
													<img src="{{URL::asset('public/email_template/images/Email-icon.png')}}" alt="" width="20px"> Mail Us
												</td>
											</tr>
											<tr>
												<td align="right" style="color:#eee;">
													{!! kmGetData('contact-details','phone_number') !!}
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td align="right" >											
													<a href="" style="color:#eee;text-decoration:none;">{!! kmGetData('contact-details','contact_email') !!}</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
						</table>
					
					</td>
				 </tr>
				 <tr>
					<td bgcolor='#eee' align="center" style="padding: 3% 2% 3% 2%;">
					<table width="100%" align="center">
						
						<tr>
							<td>
								 <p style="color:#1b2d5a;font-size:27px; text-align: center">
					 	Thank you for your purchase!!
					 </p>
					 
					 <p style="color:#666;line-height: 1.3;font-size: 16px; text-align: center;
    margin-bottom: 25px;">
					 You have successfully purchased following course(s).Thank you for purchasing our course(s), hope to see you again.	 </p>
							</td>
						</tr>
					</table>
					
					 
					<table width="100%">
						{{--<tr>--}}
							{{--<td  style="width:100%;max-height:200px;min-height:150px;">--}}
								{{--<img src="{{URL::asset('public/email_template/images/asbestos_awareness.jpg')}}" alt="" style="width:100%;height:100%;object-fit:cover;box-shadow:0 0 2px #000;">--}}
							{{--</td>--}}
						{{--</tr>--}}
						<tr>
							<!--<td style="font-size: 0; line-height: 0;" width="50">&nbsp;</td>-->
							<td width="100%" align="center" style="padding:10px 10px 10px 10px;">
								<p style="font-size:18px;margin-bottom: 0;">Course Name: {course name}</p>
								<p style="font-size:18px;margin-bottom: 0;">Purchased By: {buyers name}</p>
								<p style="font-size:18px;margin-bottom: 0;">Purchaser's Email: {buyers email}</p>
								<p style="font-size:18px;margin-bottom: 0;">Paid Amount: {paid amount}</p>
								<p style="font-size:18px;margin-bottom: 0;">Discount: {discount}</p>
								<hr style="width:50px;height:4px;background: #1b2d5a;">
								<p style="font-size:14px;color:#666;margin-bottom: 30px;"> If you have any queries, please contact us on info@olivesafety.ie <br/>

									Thank you, <br/>
									Olive Safety Team <br/></p>

								<a href="{{url('/')}}" style="background:#1b2d5a;color:#fff;padding: 7px 33px 7px 33px;
    font-size: 12px;
    text-decoration:none;">Visit Site</a>
							</td>
						</tr>
					</table>
					
					</td>
				 </tr>
				 <tr>
					<td bgcolor='#1b2d5a' style="padding: 1% 1% 1% 1%; color:#eee;font-size:12px;">
					 <table width="100%">
					 	<tr>
					 	<td width="50%">
					 		<table>
					 			<tr>
					 				<td><a href="{{url('/')}}" style="color:#eee;text-decoration:none;">Home<span style="padding:0 0 0 3px;">|</span></a></td>
									<td><a href="{{url('/aboutus')}}" style="color:#eee;text-decoration:none;">About<span style="padding:0 0 0 3px;">|</span></a></td>
									<td><a href="{{url('course/0/'.slugify('All Courses'))}}" style="color:#eee;text-decoration:none;">Courses<span style="padding:0 0 0 3px;">|</span></a></td>
									<td><a href="{{url('/contact-us')}}" style="color:#eee;text-decoration:none;">Contact</a></td>
					 			</tr>
					 		</table>
					 	</td>
					 	<td width="50%" align="right">
				 			<table>
					 			<tr>
					 		<td><a href="{!! kmGetData('contact-details','facebook_link') !!}"><img src="{{URL::asset('public/email_template/images/fb.png')}}" alt="" width="15px" style="padding:3px 3px 3px 3px;border-radius:50%;border:solid 1px #ccc;"></a></td>
					 		<td style="font-size: 0; line-height: 0;" width="5">&nbsp;</td>			 		
					 		<td><a href="{!! kmGetData('contact-details','instagram_link') !!}"><img src="{{URL::asset('public/email_template/images/insta.png')}}" alt="" width="15px" style="padding:3px 3px 3px 3px;border-radius:50%;border:solid 1px #ccc;"></a></td>
					 		<td style="font-size: 0; line-height: 0;" width="5">&nbsp;</td>
					 		<td><a href="{!! kmGetData('contact-details','twitter_link') !!}"><img src="{{URL::asset('public/email_template/images/twitter.png')}}" alt=""width="15px" style="padding:3px 3px 3px 3px;border-radius:50%;border:solid 1px #ccc;"></a></td>
					 	
					 	</tr>
					 	</table>
					 	</td>
					 		
					 	</tr>
					 </table>
					 <!-- <table width="50%">
					 
					 </table>-->
					</td>
				 </tr>
			</table>
		 </td>
    </tr>
	</table>
</body>
</html>