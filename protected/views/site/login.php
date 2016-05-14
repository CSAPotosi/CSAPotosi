<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>CSA Login</title>

	<!-- Bootstrap -->
	<link href="<?php echo Yii::app()->request->baseUrl;?>/resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo Yii::app()->request->baseUrl;?>/resources/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="<?php echo Yii::app()->request->baseUrl;?>/resources/system/css/custom.css" rel="stylesheet">
</head>

<body style="background:#F7F7F7;">
<div id="wrapper">
	<div class="">
		<section class="login_content">
			<img src="<?php echo Yii::app()->request->baseUrl;?>/resources/images/logoCSA.png" alt="">
			<?php echo CHtml::beginForm();?>
				<h1>Iniciar sesion</h1>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group">
							<?php echo CHtml::activeTextField($model,'username',['class'=>'form-control','placeholder'=>'Usuario']);?>
							<?php echo CHtml::error($model,'username',['class'=>'label label-danger']);?>
						</div>
					</div>

					<div class="col-md-10 col-md-offset-1">
						<div class="form-group">
							<?php echo CHtml::activePasswordField($model,'password',['class'=>'form-control','placeholder'=>'Password']);?>
							<?php echo CHtml::error($model,'password',['class'=>'label label-danger']);?>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group pull-right">
							<?php echo CHtml::submitButton('Ingresar',['class'=>'btn btn-default'])?>
						</div>
					</div>

				</div>
				<div class="clearfix"></div>
				<div class="separator">
					<div class="clearfix"></div>
					<br />
					<div>
						<p>©2016 Todos los derechos reservados</p>
					</div>
				</div>
			<?php echo CHtml::endForm();?>
		</section>
	</div>

</div>
</body>
</html>