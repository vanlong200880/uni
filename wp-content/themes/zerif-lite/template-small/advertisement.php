<?php
$category_adv = get_the_category();
$slug = $category_adv[0]->slug;
$list_id = array();
if(is_archive()){
  $taget = '';
  switch ($slug) {
    case 'seasons-promotion':
        $taget = 'seasons_promotion';
        break;
    case 'taste-event':
        $taget = 'taste_event';
        break;
    case 'home-electronics':
        $taget = 'home_electronics';
        break;
    case 'real-estate-source':
        $taget = 'real_estate_source';
        break;
    case 'vehicle-technology':
        $taget = 'vehicle_technology';
        break;
    case 'fashion-health':
        $taget = 'fashion_health';
        break;
    default:
        break;
  }
  
	// get list id heath_care 
    $heath_care_args = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		 => 'active',
                'value'      => true,
            ),
            array(
                'key'		 => 'group_advertisement',
                'value'      => $taget
            ),
        ),
        'posts_per_page' => 5,
	);
    $heath_care_the_query = new WP_Query( $heath_care_args ); 
    if($heath_care_the_query->have_posts()){
        while ($heath_care_the_query->have_posts()){
            $heath_care_the_query->the_post();
            array_push($list_id, get_the_ID());
        }
    }
    
}else{
  	// get list id heath_care 
    $heath_care_args = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		 => 'active',
                'value'      => true,
            ),
            array(
                'key'		 => 'group_advertisement',
                'value'      => 'fashion_health'
            ),
        ),
        'posts_per_page' => 5,
	);
    $heath_care_the_query = new WP_Query( $heath_care_args ); 
    if($heath_care_the_query->have_posts()){
        while ($heath_care_the_query->have_posts()){
            $heath_care_the_query->the_post();
            array_push($list_id, get_the_ID());
        }
    }
    wp_reset_postdata();
    
    // get list id taste_event 
    $taste_event_args = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		 => 'active',
                'value'      => true,
            ),
            array(
                'key'		 => 'group_advertisement',
                'value'      => 'taste_event'
            ),
        ),
        'posts_per_page' => 5,
	);
    $taste_event_the_query = new WP_Query( $taste_event_args ); 
    if($taste_event_the_query->have_posts()){
        while ($taste_event_the_query->have_posts()){
            $taste_event_the_query->the_post();
            array_push($list_id, get_the_ID());
        }
    }
    wp_reset_postdata();
    
    // get list id real_estate_source
    $real_estate_source_args = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		 => 'active',
                'value'      => true,
            ),
            array(
                'key'		 => 'group_advertisement',
                'value'      => 'real_estate_source'
            ),
        ),
        'posts_per_page' => 5,
	);
    $real_estate_source_the_query = new WP_Query( $real_estate_source_args ); 
    if($real_estate_source_the_query->have_posts()){
        while ($real_estate_source_the_query->have_posts()){
            $real_estate_source_the_query->the_post();
            array_push($list_id, get_the_ID());
        }
    }
    wp_reset_postdata();
    
    //get list id trevel_education
    $trevel_education_args = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		=> 'active',
                'value'     => true,
            ),
            array(
                'key'		=> 'group_advertisement',
                'value'     => 'home_electronics'
            ),
        ),
        'posts_per_page' => 5,
	);
    $trevel_education_the_query = new WP_Query( $trevel_education_args ); 
    if($trevel_education_the_query->have_posts()){
        while ($trevel_education_the_query->have_posts()){
            $trevel_education_the_query->the_post();
            array_push($list_id, get_the_ID());
        }
    }
    wp_reset_postdata();
	
	
	//get list id vihicle_technology
    $trevel_education_args = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		=> 'active',
                'value'     => true,
            ),
            array(
                'key'		=> 'group_advertisement',
                'value'     => 'vehicle_technology'
            ),
        ),
        'posts_per_page' => 5,
	);
    $trevel_education_the_query = new WP_Query( $trevel_education_args ); 
    if($trevel_education_the_query->have_posts()){
        while ($trevel_education_the_query->have_posts()){
            $trevel_education_the_query->the_post();
            array_push($list_id, get_the_ID());
        }
    }
    wp_reset_postdata();
    
    // get list id seasion_promotion
    $seasion_promotion_args = array (					 
		'post_status'    => 'publish',		
		'order'          => 'DESC',
		'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'meta_query'     => array(
            array(
                'key'		 => 'active',
                'value'      => true,
            ),
            array(
                'key'		 => 'group_advertisement',
                'value'      => 'seasons_promotion'
            ),
        ),
        'posts_per_page' => 5,
	);
    $seasion_promotion_the_query = new WP_Query( $seasion_promotion_args ); 
    if($seasion_promotion_the_query->have_posts()){
        while ($seasion_promotion_the_query->have_posts()){
            $seasion_promotion_the_query->the_post();
            array_push($list_id, get_the_ID());
        }
    }
    wp_reset_postdata();
}
    $args = array (					 
		'post_status'    => 'publish',
		'order'          => 'DESC',
		'orderby'        => 'rand',
        'post_type'      => 'post',
        'category_name'  => 'advertisement',
        'posts_per_page' => 5,
        'post__in' => $list_id,
	);
    $the_query = new WP_Query( $args ); 
    ?>	  
<?php if($the_query -> have_posts()): ?>
<div class="big-new-adv">
    <div class="advertisement">
        <?php while ($the_query->have_posts()) {  $the_query->the_post();?>
        <div class="show-adv">
            <figure>
            <?php $website = get_post_custom_values('website', get_the_ID()); ?>
            <a target="_blank" href="<?php echo ($website[0] == '' || $website[0] == 'http://')? get_the_permalink() : $website[0] ?>" title="<?php the_title(); ?>">
                <?php
                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                    if (!empty($attachment_id)) { 
                        the_post_thumbnail('full');
                        ?>
                    <?php }else{
                        echo '<img src="'.get_stylesheet_directory_uri().'/images/no-img.jpg" alt="">';
                    }
                ?>
                </a>
            </figure>
        </div>
        <?php }?>
    </div>

</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
