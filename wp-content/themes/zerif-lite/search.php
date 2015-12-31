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
//$type = $_REQUEST['type'];
if(!empty($keyword)):
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
//    $listCategorySlug = '';
//    switch ($type){
//    case 'vehicle-technology-magazine':
//    case 'home-electronics-magazine':
//    case 'real-estate-source-magazine':
//    case 'taste-event-magazine':
//	case 'fashion-health-magazine':
//    case '4-seasons-promotion':
//        $listCategorySlug .= $type;
//        break;
//    default :
//        $listCategorySlug .= 'vehicle-technology-magazine,home-electronics-magazine,real-estate-source-magazine,taste-event-magazine,fashion-health-magazine,4-seasons-promotion';
//    }
//    if(!empty($listCategorySlug)){
        $args = array(
            'post_status'    => 'publish',		
            'order'          => 'ASC',
//            'orderby'        => 'date',
						'meta_key'			=> 'kich_thuoc_trang',
						'orderby'			=> 'meta_value_num',
            'post_type'      => 'post',
            'category_name'     => 'magazine-online,seasons-promotion,taste-event,home-electronics,real-estate-source,advertisement,fashion-health',
            's' => $keyword,
						'posts_per_page' => 100,
						'paged'             => $paged
        );
        $the_query = new WP_Query( $args );	?>
        <?php if($the_query->have_posts()):?>
            <div class="col-md-12">
                <div class="title magazine">
                    <h2><?php echo ($language == 'vi') ? 'Kết quả': 'Result'; ?></h2>
                    <div class="line">
                        <span class="icon-dotted-01"></span>
                    </div>
                </div><!--end title-->
                <div class="show-magazine-search magazine-search">
									<ul class="row">
									<?php
										$html1 = $html2  = $html3 = $html4 = '';
										while ($the_query->have_posts()){
												$the_query->the_post(); 
												$field = get_field('kich_thuoc_trang');
												$attachment_id = get_post_thumbnail_id(get_the_ID());
												$img = '';
												if (!empty($attachment_id)) {
														$img .= get_the_post_thumbnail(get_the_ID(),'full');
														?>
												<?php }else{
														$img .= '<img src="'.get_stylesheet_directory_uri().'/images/no-img.jpg" alt="">';
												}
												$link = wp_get_attachment_link($attachment_id, 'full');
//												var_dump($link);
												if($field == 1){
													$html1 .= '<li class="col-md-6 col-sx ma-gazine-1">'.$link.'</li>';
												}
												elseif($field == 2){
													$html2 .= '<li class="col-md-3 ma-gazine-2">'.$link.'</li>';
												}
												elseif($field == 3){
													$html3 .= '<li class="col-md-3 ma-gazine-3">'.$link.'</li>';
												}else{
													$html4 .= '<li class="col-md-3 none">';
															$html4 .= '<figure>';
																	$html4 .= '<a target="_blank" href="'.get_the_permalink().'">';
																					if (!empty($attachment_id)) { 
																							$html4 .= get_the_post_thumbnail(get_the_ID(), array(480, 320));
																					}else{
																							$html4 .= '<img src="'.get_stylesheet_directory_uri().'/images/no-img.jpg" alt="">';
																					}
																	$html4 .= '</a>';
																	$html4 .= '<figcaption>';
																			$html4 .= '<p><a target="_blank" href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
																	$html4 .= '</figcaption>';
															$html4 .= '</figure>';
													$html4 .= '</li>';
												}
										}
										echo $html1 . $html2 . $html3 .'<li class="col-md-12 line"></li>'. $html4;
												?>
										
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
    <?php //} ?>        
<?php else: ?>
<div class="col-md-12"> No result. <?php //get_template_part( 'content', 'none' ); ?></div>
<?php endif; ?>
            
        </div>
    </div>
</section>
<?php get_footer(); ?>