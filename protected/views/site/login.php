<!DOCTYPE html>
<html lang="es-BO" id="extr-page">
<head>
    <meta charset="utf-8">
    <title> <?php echo Yii::app()->name; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo Yii::app()->request->baseUrl; ?>/resources/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo Yii::app()->request->baseUrl; ?>/resources/css/font-awesome.css">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->

    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo Yii::app()->request->baseUrl; ?>/resources/css/style.css">

    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->


    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/resources/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/resources/img/favicon.ico" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

</head>

<body class="animated fadeInDown login-page">

<div class="login-box">
    <div class="login-logo">
        <a href=""><b>SSANA</b> 1.0</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <center><img src="<?php echo Yii::app()->request->baseUrl; ?>/resources/img/logoCSA.png" class="img-responsive">
        </center>
        <p class="login-box-msg text-center">Ingrese sus datos para iniciar sesion.</p>

        <?php echo CHtml::beginForm(); ?>
        <div class="form-group has-feedback">
            <?php echo CHtml::activeTextField($model, 'username', ['class' => 'form-control', 'placeholder' => 'Usuario']); ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <?php echo CHtml::error($model, 'username', ['class' => 'label label-danger']); ?>
        </div>
        <div class="form-group has-feedback">
            <?php echo CHtml::activePasswordField($model, 'password', ['class' => 'form-control', 'placeholder' => 'Contraseña']); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <?php echo CHtml::error($model, 'password', ['class' => 'label label-danger']); ?>
        </div>
        <div class="row">
            <div class="col-xs-offset-7 col-xs-5">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar sesion</button>
            </div><!-- /.col -->
        </div>
        <?php echo CHtml::endForm(); ?>


    </div><!-- /.login-box-body -->
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

</body>
</html>