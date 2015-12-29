<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); 
global $language;
?>


<section id="wrap-magazine" class="wrap-magazine-related">
    <div class="container">
        <div class="row">
<?php 

// search magazine
$keyword = $_REQUEST['s'];
$type = $_REQUEST['type'];
if(!empty($keyword)):
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $listCategorySlug = '';
    switch ($type){
    case 'vehicle-technology-magazine':
    case 'home-electronics-magazine':
    case 'real-estate-source-magazine':
    case 'taste-event-magazine':
	case 'fashion-health-magazine':
    case '4-seasons-promotion':
        $listCategorySlug .= $type;
        break;
    default :
        $listCategorySlug .= 'vehicle-technology-magazine,home-electronics-magazine,real-estate-source-magazine,taste-event-magazine,fashion-health-magazine,4-seasons-promotion';
    }
    if(!empty($listCategorySlug)){
        $args = array(
            'post_status'    => 'publish',		
            'order'          => 'DESC',
            'orderby'        => 'date',
            'post_type'      => 'post',
            'paged'             => $paged,
            'posts_per_page' => 1,
            'category_name'     => $listCategorySlug,
            's' => $keyword
        );
        $the_query = new WP_Query( $args );	?>
        <?php if($the_query->have_posts()):?>
            <div class="col-md-12">
                <div class="title magazine">
                    <h2><?php echo ($language == 'vi') ? 'Tạp chí': 'Magazine'; ?></h2>
                    <div class="line">
                        <span class="icon-dotted-01"></span>
                    </div>
                </div><!--end title-->
                <div class="show-magazine magazine-search" >
                    <ul id="owl-product-carousel1">
                        <?php
                        while ($the_query->have_posts()){
                            $the_query->the_post(); ?>
                            <li>
                                <figure>
                                    <a target="_blank" href="<?php the_permalink() ?>">
                                        <?php
                                            $attachment_id = get_post_thumbnail_id(get_the_ID());
                                            if (!empty($attachment_id)) { 
                                                the_post_thumbnail(array(480, 701));
                                                ?>
                                            <?php }else{
                                                echo '<img src="'.get_stylesheet_directory_uri().'/images/no-img.jpg" alt="">';
                                            }
                                        ?>
                                    </a>
                                    <figcaption>
                                        <p><a target="_blank" href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
                                    </figcaption>
                                </figure>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!--- end search magazine -->
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                        if(function_exists('wp_pagenavi')){
                        wp_pagenavi(array('query' => $the_query));
                        
                        } ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-md-12"><?php get_template_part( 'content', 'none' ); ?></div>
    <?php    endif; ?>
    <?php } ?>        
<?php else: ?>
<div class="col-md-12"> No result. <?php //get_template_part( 'content', 'none' ); ?></div>
<?php endif; ?>
            
        </div>
    </div>
</section>
<?php get_footer(); ?>