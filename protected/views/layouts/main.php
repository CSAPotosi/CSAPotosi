<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo CHtml::encode(Yii::app()->name); ?></title>

	<!-- Bootstrap -->
	<link href="<?php echo Yii::app()->request->baseUrl;?>/resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo Yii::app()->request->baseUrl;?>/resources/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="<?php echo Yii::app()->request->baseUrl;?>/resources/system/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
	<div class="main_container">
		<div class="col-md-3 left_col">
			<div class="left_col scroll-view">
				<div class="navbar nav_title" style="border: 0;">
					<a href="<?php echo Yii::app()->createUrl('/');?>" class="site_title"><i class="fa fa-pied-piper-alt"></i> <span><?php echo CHtml::encode(Yii::app()->name); ?></span></a>
				</div>

				<div class="clearfix"></div>

				<!-- menu profile quick info -->
				<div class="profile">
					<div class="profile_pic">
						<img src="images/img.jpg" alt="..." class="img-circle profile_img">
					</div>
					<div class="profile_info">
						<span>Bienvenido,</span>
						<h2>Juan Perez</h2>
					</div>
				</div>
				<!-- /menu profile quick info -->

				<br />

				<!-- sidebar menu -->
				<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
					<div class="menu_section">
						<h3>GENERAL</h3>
						<?php $this->widget('zii.widgets.CMenu',array(
							'encodeLabel'=>false,
							'htmlOptions'=>['class'=>'nav side-menu'],
							'submenuHtmlOptions'=>['class'=>'nav child_menu'],
							'items'=>[
								[ 'label'=>'<i class="fa fa-home"></i> Home', 'url'=>['/site/index'] ],
								[	'label'=>'',
									'template'=>'<a href="#"><i class="fa fa-plus"></i> Mas <span class="fa fa-chevron-down"></span></a>',
									'items'=>[
										[ 'label'=>'About', 'url'=>['/site/page', 'view'=>'about'] ],
										[ 'label'=>'Contact', 'url'=>['/site/contact'] ]
									]
								],
								[ 'label'=>'<i class="fa fa-key"></i> Login', 'url'=>['/site/login'], 'visible'=>Yii::app()->user->isGuest],
								[ 'label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>['/site/logout'], 'visible'=>!Yii::app()->user->isGuest]
							],
						)); ?>
						<ul class="nav side-menu">
							<li><a><i class="fa fa-home"></i> Pagina 1 <span class="fa fa-chevron-down"></span></a>
								<ul class="nav child_menu">
									<li><a href="#">ejemplo1</a>
									</li>
									<li><a href="#">ejemplo2</a>
									</li>
								</ul>
							</li>
							<li><a href="#"><i class="fa fa-laptop"></i> Landing Page</a>
							</li>
						</ul>
					</div>
					<div class="menu_section">
						<h3>OTROS</h3>
						<ul class="nav side-menu">
							<li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
								<ul class="nav child_menu">
									<li><a href="#">E-commerce</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<!-- /sidebar menu -->

				<!-- /menu footer buttons -->
				<div class="sidebar-footer hidden-small">
					<a data-toggle="tooltip" data-placement="top" title="Settings">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					</a>
					<a data-toggle="tooltip" data-placement="top" title="FullScreen">
						<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
					</a>
					<a data-toggle="tooltip" data-placement="top" title="Lock">
						<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
					</a>
					<a data-toggle="tooltip" data-placement="top" title="Logout">
						<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
					</a>
				</div>
				<!-- /menu footer buttons -->
			</div>
		</div>

		<!-- top navigation navbar-static-top-->
		<div class="top_nav">

			<div class="nav_menu">
				<nav class="" role="navigation">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<ul class="nav navbar-nav navbar-right">
						<li class="">
							<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<img src="images/img.jpg" alt="">Juan Perez
								<span class=" fa fa-angle-down"></span>
							</a>
							<ul class="dropdown-menu dropdown-usermenu pull-right">
								<li><a href="javascript:;">  Perfil</a>
								</li>
								<li>
									<a href="javascript:;">
										<span>Configuracion</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">Ayuda</a>
								</li>
								<li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</li>
							</ul>
						</li>

						<li role="presentation" class="dropdown">
							<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-envelope-o"></i>
								<span class="badge bg-green">6</span>
							</a>
							<ul class="dropdown-menu list-unstyled msg_list" role="menu">
								<li>
									<a>
                        <span class="image">
                                          <img src="images/img.jpg" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
									</a>
								</li>
								<li>
									<div class="text-center">
										<a href="inbox.html">
											<strong>Ver todo</strong>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</li>
							</ul>
						</li>

					</ul>
				</nav>
			</div>

		</div>
		<!-- /top navigation -->


		<!-- page content -->
		<div class="right_col" role="main">
			<div class="page-title">
				<div class="title_left">
					<h3><?php echo CHtml::encode($this->pageTitle); ?></h3>
				</div>

				<div class="title_right">
					<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Buscar">
							  <span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
							  </span>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>

			<!-- CONTENIDO -->
			<?php echo $content;?>
			<!-- CONTENIDO -->

		</div>
		<!-- /page content -->

		<!-- footer content -->
		<footer>
			<div class="pull-right">
				Sistema clinico
			</div>
			<div class="clearfix"></div>
		</footer>
		<!-- /footer content -->
	</div>
</div>

<!-- jQuery -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/plugins/fastclick/lib/fastclick.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo Yii::app()->request->baseUrl;?>/resources/system/js/custom.js"></script>
</body>
</html>