<?php
/* @var $this PacienteController */
	$this->pageTitle = "Paciente <span> > Lista </span>";
	$this->breadcrumbs = array(
		'Paciente',
	);
?>

<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget" id="widget1">
				<header></header>
				<div>
					<div class="widget-body">

						<div class="widget-body-toolbar">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-search"></i></span>
										<input class="form-control" id="input-search-pacients" placeholder="Buscar..." type="text">
									</div>
								</div>
								<div class="col-md-6 text-right">
									<div class="btn-group">
										<button class="btn dropdown-toggle btn-primary btn-xs" data-toggle="dropdown">
											Todos
											<i class="fa fa-caret-down"></i>
										</button>
										<ul class="dropdown-menu pull-right" id="pick-status-pacient">
											<li class="active">
												<a href="javascript:void(0);" status="1">Todos</a>
											</li>
											<li>
												<a href="javascript:void(0);" status="2">Internados</a>
											</li>
											<li>
												<a href="javascript:void(0);" status="0">
													Inactivos
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="row" id="pacient-list">
							<!-- Lista de pacientes (_pacientListView)-->
						</div>

						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-default" id="btn-load-pacients" page="0" limit="<?php echo Yii::app()->params['itemListLimit'];?>" url="<?php echo CHtml::normalizeUrl(['paciente/getPacientListAjax'])?>">
									Ver mas
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

<?php 	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/paciente/index.js',CClientScript::POS_END);
?>