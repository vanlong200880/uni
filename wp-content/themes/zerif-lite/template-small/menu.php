<div class="category-menu-left">
<?php global $language; ?>
<h2><?php echo ($language == 'vi')? 'Danh mục': 'Categories'; ?><span></span></h2>
<ul class="menu-left">
	<li class="page-24h"><a href="<?php echo get_site_url() ?>/<?php echo $language ?>">24h</a></li>
<?php
 $categories = get_terms( 'category', array(
// 	'orderby'    => 'count',
 	'hide_empty' => 0,
  'parent'                 => 0,
  'orderby'                => 'order',
  'order'                  => 'DESC',
 ) );
 $arr = array('magazine', 'advertisement', 'uncategorised');
 
 foreach ($categories as $value){
   if(!in_array($value->slug, $arr))
   { ?>
  <li class="color-item-<?php echo $value->term_id ?> <?php echo $value->slug ?> "><span class="icon-<?php echo $value->term_id ?>"></span><a href="<?php echo get_term_link($value) ?>"><?php echo $value->name; ?></a></li>
<?php 
   }
 }
?>
  
</ul>

</div>