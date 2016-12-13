<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="row">
	<div class="col-md-12">
		<div class="well">
			<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

			asfffjhdsafggfjhjgdgsfadsgjhgk
			<ul>
				<li>View file: <code><?php echo __FILE__; ?></code></li>
				<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
			</ul>

			<p>For more details on how to further develop this application, please read
				the <a href="http://www.yiiframework.com/doc/">documentation</a>.
				Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
				should you have any questions.</p>
		</div>

	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- row -->
	<div class="row">
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-0">
				<header>
					<span class="widget-icon"> <i class="fa fa-comments"></i> </span>
					<h2>Titulo </h2>
				</header>
				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						<input class="form-control" type="text">
					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body">
						<!-- this is what the user will see -->
					</div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->
			</div>
			<!-- end widget -->
		</article>
		<!-- WIDGET END -->
	</div>
	<!-- end row -->
</section>
<!-- end widget grid -->