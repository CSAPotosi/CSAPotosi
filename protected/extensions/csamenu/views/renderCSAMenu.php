<?php foreach($this->menu as $item):?>
<a href="<?php echo CHtml::normalizeUrl($item['url']);?>"
   rel="tooltip"
   class="btn btn-default shop-btn"
   data-original-title="<b><?php echo $item['title']?></b>"
   data-placement="bottom"
   data-html="true"
>
	<i class="fa <?php echo $item['icon']?>"></i>
	<?php echo $item['title']?>
</a>
<?php endforeach;?>