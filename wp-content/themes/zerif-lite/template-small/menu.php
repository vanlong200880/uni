<div class="category-menu-left">
<?php global $language; ?>
<h2><?php echo ($language == 'vi')? 'Danh mục': 'Categories'; ?><span></span></h2>
<ul class="menu-left">
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
  <li><a href="<?php echo get_term_link($value) ?>"><?php echo $value->name; ?></a></li>
<?php 
   }
 }
?>
  
</ul>

</div>