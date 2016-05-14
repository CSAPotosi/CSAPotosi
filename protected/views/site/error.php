<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle='Error '.$code;
?>

<div class="row">
	<div class="col-md-12">
		<div class="col-middle">
			<div class="text-center text-center">
				<h1 class="error-number"><?php echo $code;?></h1>
				<h2><?php echo CHtml::encode($message); ?></h2>
				<p>Si continua teniendo problemas, <a href="#">Contactese con el administrador</a>
				</p>
			</div>
		</div>
	</div>
</div>
