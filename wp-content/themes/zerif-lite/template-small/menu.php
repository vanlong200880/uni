<div class="category-menu-left">
<?php global $language; ?>
<h2><?php echo ($language == 'vi')? 'Danh mục': 'Categories'; ?><span></span></h2>
<ul class="menu-left mCustomScrollbar">
<?php
	$parentId = get_category_by_slug('unideal');
	$data = getListCategory('magazine-online');
 ?>
	<li class="high color-item-<?php echo $parentId->term_id ?> <?php echo $parentId->slug ?> "><span class="icon-<?php echo $parentId->term_id ?>"></span><a href="<?php echo get_term_link($parentId) ?>"><var><?php echo $parentId->name; ?></var></a></li>
	<li class="page-24h high">
		<a href="<?php echo get_site_url() ?>/<?php echo $language ?>/24h">
			<span>24h</span>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hot-fn.gif" alt="">
		</a>
	</li>
	<?php
 foreach ($data as $value){ ?>
  <li class="high color-item-<?php echo $value->term_id ?> <?php echo $value->slug ?> "><span class="icon-<?php echo $value->term_id ?>"></span><a href="<?php echo get_term_link($value) ?>"><var><?php echo $value->name; ?></var></a></li>
<?php 
 }
?>
</ul>
</div>