<!DOCTYPE html>
<html lang="es-BO">
<head>
	<meta charset="utf-8">
	<title> <?php echo Yii::app()->name;?> </title>
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
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/iCheck/all.css">

	<!-- Estilos propios -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/style.css">

	<!-- #FAVICONS -->
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

	<!-- #GOOGLE FONT -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

</head>
<!-- Possible Classes

	* 'smart-style-{SKIN#}'
	* 'smart-rtl'         - Switch theme mode to RTL
	* 'menu-on-top'       - Switch to top navigation (no DOM change required)
	* 'no-menu'			  - Hides the menu completely
	* 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
	* 'fixed-header'      - Fixes the header
	* 'fixed-navigation'  - Fixes the main menu
	* 'fixed-ribbon'      - Fixes breadcrumb
	* 'fixed-page-footer' - Fixes footer
	* 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
-->
<body class="menu-on-top fixed-page-footer smart-style-2">

<!-- #HEADER -->
<header id="header">
	<div id="logo-group">

		<!-- PLACE YOUR LOGO HERE -->
		<span id="logo"> <img src="img/logo.png" alt="CSA Potosi"> </span>
		<!-- END LOGO PLACEHOLDER -->

		<!-- Note: The activity badge color changes when clicked and resets the number to 0
			 Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
		<span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

		<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
		<div class="ajax-dropdown">

			<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
			<div class="btn-group btn-group-justified" data-toggle="buttons">
				<label class="btn btn-default">
					<input type="radio" name="activity" id="ajax/notify/mail.html">
					Msgs (14) </label>
				<label class="btn btn-default">
					<input type="radio" name="activity" id="ajax/notify/notifications.html">
					notify (3) </label>
				<label class="btn btn-default">
					<input type="radio" name="activity" id="ajax/notify/tasks.html">
					Tasks (4) </label>
			</div>

			<!-- notification content -->
			<div class="ajax-notifications custom-scroll">

				<div class="alert alert-transparent">
					<h4>Haga click en un boton para ver los mensajes</h4>
					Esta pagina en blanco ayuda a proteger su privacidad.
				</div>

				<i class="fa fa-lock fa-4x fa-border"></i>

			</div>
			<!-- end notification content -->

			<!-- footer: refresh area -->
			<span> Ultim actualizacion: 13/05/2016 12:12 AM
			<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Cargando..." class="btn btn-xs btn-default pull-right">
				<i class="fa fa-refresh"></i>
			</button> </span>
			<!-- end footer -->

		</div>
		<!-- END AJAX-DROPDOWN -->
	</div>

	<!-- #PROJECTS: projects dropdown -->
	<div class="project-context hidden-xs">

		<span class="label">Projects:</span>
		<span class="project-selector dropdown-toggle" data-toggle="dropdown">Recent projects <i class="fa fa-angle-down"></i></span>

		<!-- Suggestion: populate this list with fetch and push technique -->
		<ul class="dropdown-menu">
			<li>
				<a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
			</li>
			<li>
				<a href="javascript:void(0);">Notes on pipeline upgradee</a>
			</li>
			<li>
				<a href="javascript:void(0);">Assesment Report for merchant account</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
			</li>
		</ul>
		<!-- end dropdown-menu-->

	</div>
	<!-- end projects dropdown -->

	<!-- #TOGGLE LAYOUT BUTTONS -->
	<!-- pulled right: nav area -->
	<div class="pull-right">

		<!-- collapse menu button -->
		<div id="hide-menu" class="btn-header pull-right">
			<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Esconder menu izquierdo"><i class="fa fa-reorder"></i></a> </span>
		</div>
		<!-- end collapse menu -->

		<!-- logout button -->
		<div id="logout" class="btn-header transparent pull-right">
			<span> <a href="<?php echo $this->createAbsoluteUrl('site/logout'); ?>" title="Salir"
					  data-action="userLogout"
					  data-logout-msg="Puede mejorar su seguridad aun mas, cerrando el navegador despues de salir del sistema"><i
						class="fa fa-sign-out"></i></a> </span>
		</div>
		<!-- end logout button -->

		<!-- search mobile button (this is hidden till mobile view port) -->
		<div id="search-mobile" class="btn-header transparent pull-right">
			<span> <a href="javascript:void(0)" title="Buscar"><i class="fa fa-search"></i></a> </span>
		</div>
		<!-- end search mobile button -->

		<!-- #SEARCH -->
		<!-- input: search field -->
		<form action="#" class="header-search pull-right">
			<input id="search-fld" type="text" name="param" placeholder="Buscar">
			<button type="submit">
				<i class="fa fa-search"></i>
			</button>
			<a href="javascript:void(0);" id="cancel-search-js" title="Cancelar busqueda"><i class="fa fa-times"></i></a>
		</form>
		<!-- end input: search field -->

		<!-- fullscreen button -->
		<div id="fullscreen" class="btn-header transparent pull-right">
			<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Pantalla completa"><i class="fa fa-arrows-alt"></i></a> </span>
		</div>
		<!-- end fullscreen button -->

	</div>
	<!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->

<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">
	<!-- User info -->
	<div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as it -->
			<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
				<img src="img/avatars/sunny.png" alt="me" class="online" />
				<span>
					<?php echo Yii::app()->user->getState("nombre"); ?>
				</span>
				<i class="fa fa-angle-down"></i>
			</a>
		</span>
	</div>
	<!-- end user info -->

	<nav>
		<!--
		NOTE: Notice the gaps after each icon usage <i></i>..
		Please note that these links work a bit different than
		traditional href="" links. See documentation for details.
		-->

		<ul>
            <li>
                <a href="<?php echo CHtml::normalizeUrl(['paciente/index']);?>" title="Pacientes"><i class="fa fa-lg fa-fw fa-group"></i> <span class="menu-item-parent">Pacientes</span></a>
            </li>
			<li>
				<a href="#"><i class="fa fa-lg fa-fw fa-plus-square"></i> <span class="menu-item-parent">Servicios</span></a>
				<ul>
                    <li>
                        <a href="<?php echo CHtml::normalizeUrl(['servicio/index','grupo'=>'sala']);?>" title="Salas"><i class="fa fa-lg fa-fw fa-bed"></i><span class="menu-item-parent">Salas</span></a>
                    </li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['servicio/index','grupo'=>'examen','tipo'=>1]);?>" title="Laboratorio"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Ex. Laboratorio</span></a>
					</li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['servicio/index','grupo'=>'examen','tipo'=>2])?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Rayos X</span></a>
					</li>
				</ul>
			</li>
			<li class="active">
				<a href="#"><i class="fa fa-lg fa-fw fa-inbox"></i> <span class="menu-item-parent">Outlook</span> <span class="badge pull-right inbox-badge margin-right-13">14</span></a>
			</li>
		</ul>
	</nav>


			<span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">

	<!-- RIBBON -->
	<div id="ribbon">
		<!-- breadcrumb -->
		<ol class="breadcrumb">
			<li><a href="#">AS</a></li><li>Miscellaneous</li><li>Blank Page</li>
		</ol>
		<!-- end breadcrumb -->
	</div>
	<!-- END RIBBON -->



	<!-- MAIN CONTENT -->
	<div id="content">
		<!-- contenido -->
		<div class="row">
			<div class="col-md-2">
                <?php
                $this->widget('application.extensions.csamenu.CSAMenu',['menu'=>$this->menu]);
                ?>
			</div>
			<div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4 no-padding">
                            <h1 class="txt-color-blueDark">
                                <i class="fa-fw fa fa-home"></i>
                                <?php echo $this->pageTitle; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $content; ?>
                    </div>
                </div>
			</div>
		</div>
		<!-- fin contenido -->

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- PAGE FOOTER -->
<div class="page-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<span class="txt-color-white">CSA Potosi <span class="hidden-xs"> - Sistema</span> © 2016</span>
		</div>

		<div class="col-xs-6 col-sm-6 text-right hidden-xs">
			<div class="txt-color-white inline-block">
				<i class="txt-color-blueLight hidden-mobile">Ultima actividad <i class="fa fa-clock-o"></i> <strong>52 min. atras</strong> </i>
				<div class="btn-group dropup">
					<button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
						<i class="fa fa-link"></i> <span class="caret"></span>
					</button>
					<ul class="dropdown-menu pull-right text-left">
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin">Download Progress</p>
								<div class="progress progress-micro no-margin">
									<div class="progress-bar progress-bar-success" style="width: 50%;"></div>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin"><a href="#">ASD</a></p>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
								<div class="progress progress-micro no-margin">
									<div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<button class="btn btn-block btn-default">Actualizar</button>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE FOOTER -->

<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut">
	<ul>
		<li>
			<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
		</li>
		<li>
			<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
		</li>
		<li>
			<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
		</li>
		<li>
			<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
		</li>
		<li>
			<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
		</li>
		<li>
			<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
		</li>
	</ul>
</div>
<!-- END SHORTCUT AREA -->

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/smartwidgets/jarvis.widget.min.js"></script>

<!-- browser msie issue fix -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/fastclick/fastclick.min.js"></script>




<!--[if IE 8]>

<h1>Es necesario actualizar este navegador para utilizar el sistema</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/js/app.min.js"></script>

<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->

<script type="text/javascript">
	$(document).ready(function() {
		pageSetUp();
	});
</script>

</body>
</html>