<?php /*foreach($this->menu as $item):*/?><!--
<a href="<?php /*echo CHtml::normalizeUrl($item['url']);*/?>"
   rel="tooltip"
   class="btn btn-default shop-btn"
   data-original-title="<b><?php /*echo $item['title']*/?></b>"
   data-placement="bottom"
   data-html="true"
>
	<i class="fa <?php /*echo $item['icon']*/?>"></i>
	<?php /*echo $item['title']*/?>
</a>
--><?php /*endforeach;*/?>
<?php $con=1;?>

<div class="dd" id="menu">
	<ol class="dd-list">
		<?php foreach($this->menu as $item):?>
		<li class="dd-item" data-id="<?php $con++; ?>">
			<div class="dd-handle">
				<?php echo  CHtml::link($item['title'],$item['url']); ?>
			</div>
		</li>
		<?php endforeach;?>
	</ol>
</div>