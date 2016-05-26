<!DOCTYPE html>
<html lang="es-BO" id="extr-page">
<head>
	<meta charset="utf-8">
	<title> <?php echo Yii::app()->name;?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- #CSS Links -->
	<!-- Basic Styles -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/font-awesome.min.css">

	<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/smartadmin-production-plugins.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/smartadmin-production.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/smartadmin-skins.min.css">

	<!-- We recommend you use "your_style.css" to override SmartAdmin
		 specific styles this will also ensure you retrain your customization with each SmartAdmin update.
	<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->


	<!-- #FAVICONS -->
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

	<!-- #GOOGLE FONT -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

</head>

<body class="animated fadeInDown">

<header id="header">

	<div id="logo-group">
		<span id="logo"> <img src="img/logo.png" alt="SmartAdmin"> </span>
	</div>

</header>

<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
				<h1 class="txt-color-red login-header-big">SmartAdmin</h1>
				<div class="hero">

					<img src="<?php echo Yii::app()->request->baseUrl?>/resources/img/logoCSA.png" class="pull-right display-image" alt="" style="width:210px">

				</div>


			</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
				<div class="well no-padding">
					<form action="index.html" id="login-form" class="smart-form client-form">
						<header>
							Ingresar
						</header>

						<fieldset>

							<section>
								<label class="label">E-mail</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="email" name="email">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
							</section>

							<section>
								<label class="label">Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
								<div class="note">
									<a href="forgotpassword.html">Forgot password?</a>
								</div>
							</section>

						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								Ingresar
							</button>
						</footer>
					</form>

				</div>

			</div>
		</div>
	</div>

</div>

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/libs/jquery-2.1.1.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/libs/jquery-ui-1.10.3.min.js"></script>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/bootstrap/bootstrap.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!--[if IE 8]>

<h1>Necesitas actualizar tu navegador para usar el sistema</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/app.min.js"></script>

<script type="text/javascript">
	runAllForms();

	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				email : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				}
			},

			// Messages for form validation
			messages : {
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				password : {
					required : 'Please enter your password'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});
</script>

</body>
</html>