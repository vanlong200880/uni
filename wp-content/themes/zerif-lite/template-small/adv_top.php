<?php 

	$adv_top = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		=> 'advertisement_top_page',
                'value'     => true,
            )
        ),
        'posts_per_page' => 5,
	);
	$adv_top_the_query = new WP_Query( $adv_top ); 
?>
<?php if($adv_top_the_query -> have_posts()): ?>
        <?php while ($adv_top_the_query->have_posts()) {  $adv_top_the_query->the_post();?>
            <?php //$website = get_post_custom_values('website', get_the_ID()); ?>
            <!--<a target="_blank" href="<?php //echo ($website[0] == '' || $website[0] == 'http://')? get_the_permalink() : $website[0] ?>" title="<?php //the_title(); ?>">-->
                <?php
                  the_content();
//                    $attachment_id = get_post_thumbnail_id(get_the_ID());
//                    if (!empty($attachment_id)) {
//                        the_post_thumbnail('full');
                        ?>
                    <?php 
//                    
//                    }else{
//                        echo '<img src="'.get_stylesheet_directory_uri().'/images/no-img-top.jpg" alt="">';
//                    }
                ?>
                <!--</a>-->
        <?php }?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
