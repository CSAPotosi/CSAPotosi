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
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/font-awesome.css">

	<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/smartadmin-production-plugins.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/smartadmin-production.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/css/smartadmin-skins.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl;?>/resources/js/plugin/iCheck/all.css">
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?php echo Yii::app()->request->baseUrl; ?>/resources/js/plugin/bootstrap-daterangepicker/css/daterangepicker.css">

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
		<span id="logo"> <img style="width: 240px;height: 45px; " src="resources/img/logoSICCSAP.png"> </span>

		<!-- END LOGO PLACEHOLDER -->

		<!-- Note: The activity badge color changes when clicked and resets the number to 0
			 Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
	</div>

	<!-- #PROJECTS: projects dropdown -->
	<div class="project-context hidden-xs">

		<span class="label">Usuario:</span>
		<span class="project-selector dropdown-toggle" data-toggle="dropdown">
            <?php if(Yii::app()->user->isGuest):?>
                Usuario no autenticado
            <?php else:?>
                <?= Yii::app()->user->name;?>
            <?php endif;?>
            <i class="fa fa-angle-down"></i>
        </span>

		<!-- Suggestion: populate this list with fetch and push technique -->
		<ul class="dropdown-menu">
			<li>
				<a href="javascript:void(0);">Mis datos</a>
			</li>
			<li>
				<a href="javascript:void(0);">Password</a>
			</li>
			<li>
				<a href="javascript:void(0);">Reimprimir reportes</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="<?= CHtml::normalizeUrl(['site/logout']) ?>" data-action="userLogout"
                   data-logout-msg="Puede mejorar su seguridad aun mas, cerrando el navegador despues de salir del sistema"><i class="fa fa-power-off"></i> Salir</a>
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
			<span> <a href="<?php echo $this->createAbsoluteUrl('site/logout'); ?>" title="Salir" >
                        <i class="fa fa-sign-out"></i></a> </span>
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
			<button type="button">
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
				<img src="#" alt="me" class="online" />
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
			<?php if (!(Yii::app()->authManager->checkAccess('', Yii::app()->user->id))) { ?>
            <li>
                <a href="<?php echo CHtml::normalizeUrl(['paciente/index']);?>" title="Pacientes"><i class="fa fa-lg fa-fw fa-group"></i> <span class="menu-item-parent">Pacientes</span></a>
            </li>
			<?php } ?>
			<?php if (!(Yii::app()->authManager->checkAccess('', Yii::app()->user->id))) { ?>
			<li>
				<a href="#"><i class="fa fa-lg fa-fw fa-plus-square"></i> <span class="menu-item-parent">Servicios</span></a>
				<ul>
                    <li>
                        <a href="<?php echo CHtml::normalizeUrl(['servicio/index','grupo'=>'sala']);?>" title="Salas"><i class="fa fa-lg fa-fw fa-bed"></i><span class="menu-item-parent">Salas</span></a>
                    </li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['servicio/index', 'grupo' => 'examen', 'tipo' => 1]); ?>"
						   title="Laboratorio"><i class="fa fa-lg fa-fw fa-flask"></i> <span class="menu-item-parent">Ex. Laboratorio</span></a>
					</li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['servicio/index', 'grupo' => 'examen', 'tipo' => 2]) ?>"
						   title="Rayos x"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Rayos X</span></a>
					</li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['servicio/index', 'grupo' => 'clinico', 'tipo' => 3]) ?>"
						   title="Servicios Clinicos"><i class="fa fa-lg fa-fw fa-plus-square"></i> <span
								class="menu-item-parent">Servicios Clinicos</span></a>
					</li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['servicio/index', 'grupo' => 'atencionMedica', 'tipo' => 4]) ?>"
						   title="Atenciones Medicas"><i class="fa fa-lg fa-fw fa-stethoscope"></i> <span
								class="menu-item-parent">Atenciones Medicas</span></a>
					</li>
				</ul>
			</li>
			<?php } ?>
			<li>
				<a href="#"><i class="fa fa-lg fa-fw fa-h-square"></i> <span class="menu-item-parent">R.R H.H</span></a>
				<ul>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['Unidad/index']); ?>" title="Unidades"><i
								class="fa fa-lg fa-fw "></i> <span class="menu-item-parent">Unidades</span></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-group"></i> <span
								class="menu-item-parent">Personal</span></a>
						<ul>
							<li>
								<a href="<?php echo CHtml::normalizeUrl(['Empleado/index']); ?>" title="Empleados"><i
										class="fa fa-lg fa-fw fa-suitcase"></i><span
										class="menu-item-parent">Empleados</span></a>
							</li>
							<li class="">
								<a href="<?php echo CHtml::normalizeUrl(['Medico/index']); ?>" title="Medicos"><i
										class="fa fa-lg fa-fw fa-medkit"></i> <span
										class="menu-item-parent">Medicos</span></a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['horario/index']); ?>" title="Horarios"><i
								class="fa fa-lg fa-fw fa-clock-o"></i> <span
								class="menu-item-parent">Horarios</span></a>
					</li>
					<li class="">
						<a href="<?php echo CHtml::normalizeUrl(['AsignacionEmpleado/index']); ?>" title="Asignaciones"><i
								class="fa fa-lg fa-fw"></i> <span class="menu-item-parent">Asignaciones</span></a>
					</li>
				</ul>
			</li>
            <?php if(Yii::app()->user->checkAccess('Administracion de cirugias')):?>
			<li>
				<a href="<?php echo CHtml::normalizeUrl(['cirugia/index'])?>"><i class="fa fa-lg fa-fw fa-heartbeat"></i> <span class="menu-item-parent">Cirugias</span></a>
			</li>
            <?php endif;?>
            <li>
                <a href="<?php echo CHtml::normalizeUrl(['medicamento/index'])?>"><i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Config</span></a>
            </li>
            <li>
                <a href="<?php echo CHtml::normalizeUrl(['examen/index'])?>"><i class="fa fa-lg fa-fw fa-desktop"></i> <span class="menu-item-parent">Examenes</span></a>
            </li>
			<li>
				<a href="<?php echo CHtml::normalizeUrl(['convenio/indexConvenio']); ?>" title="Seguro Medicos"><i
						class="fa fa-lg fa-fw fa-shield"></i> <span class="menu-item-parent">Seguros Medicos</span></a>
			</li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-file-text-o"></i> <span class="menu-item-parent">Reportes</span></a>
                <ul>
                    <li>
                        <a href="<?php echo CHtml::normalizeUrl(['reporteCirugia/index']);?>" title="Cirugias"><span>Cirugias</span></a>
                    </li>
                    <li>
                        <a href="<?php echo CHtml::normalizeUrl(['reporteInternacion/index']);?>" title="Internaciones"><span>Internaciones</span></a>
                    </li>
                    <li>
                        <a href="<?php echo CHtml::normalizeUrl(['reporteLaboratorio/index']);?>" title="Laboratorio"><span>Examenes de laboratorio</span></a>
                    </li>
					<li>
						<a href="<?php echo CHtml::normalizeUrl(['ReporteEstadistico/index']); ?>" title="Estadisticas"><span
								class="menu-item-parent">Estadisticas</span></a>
					</li>
                </ul>
            </li>
			<li>
				<a href="<?php echo CHtml::normalizeUrl(['Seguridad/indexBackup']); ?>" title="Backups"><i
						class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Backup</span></a>
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
        <?php  if(isset($this->breadcrumb)):?>
        <ol class="breadcrumb">
            <li><a href="#">AS</a></li><li>Miscellaneous</li><li>Blank Page</li>
        </ol>
        <?php endif;?>
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
						<?php echo $content ?>
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
		<div class="col-xs-12 col-sm-12 text-align-center">
			<span class="txt-color-white">SSANA <span class="hidden-xs"> - Sistema</span> © 2016</span>
		</div>
	</div>
</div>
<!-- END PAGE FOOTER -->

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