<?php
/**
 * The template for displaying Archive pages.
 */
global $language;
get_header(); ?>
<?php 
$category = get_the_category();
$slug = $category[0]->slug;
$parent = get_category($category[0]->category_parent); 
?>
<?php if(!empty($category[0]->category_parent)):
    if($parent->slug == 'magazine'): ?>
    <section id="wrap-magazine">
        <div class="container">
            <div class="row">
                <div class="col-md-12">            
                    <div class="title magazine">
                        <h2><?php echo $parent->name; ?> / <?php echo $category[0]->name; ?></h2>
                        <div class="line">
                            <span class="icon-dotted-01"></span>
                        </div>
                    </div><!--end title-->
                    <div class="show-magazine show-magazine-list">
                        <ul id="owl-product-carousel-first" class="owl-carousel">
                            <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                            <li>
                                <figure>
                                    <a href="<?php the_permalink() ?>" target="_blank" title="<?php echo get_the_title(); ?>">
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
                                        <p><a target="_blank" href="<?php the_permalink()?>"><?php the_title() ?></a></p>
                                    </figcaption>
                                </figure>
                            </li>
                            <?php endwhile;  ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!--end wrap-magazine-->




<?php
switch ($slug) {
    case 'vehicle-technology-magazine':
        $vihicle_technology = 'vehicle-technology';
        break;
    case 'home-electronics-magazine':
        $vihicle_technology = 'home-electronics';
        break;
    case 'taste-event-magazine':
        $vihicle_technology = 'taste-event';
        break;
    case 'real-estate-source-magazine':
        $vihicle_technology = 'real-estate-source';
        break;
    case 'fashion-health-magazine':
        $vihicle_technology = 'fashion-health';
        break;
    case '4-seasons-promotion':
        $vihicle_technology = 'seasons-promotion';
        break;
    default:
        $vihicle_technology = 'seasons-promotion,vehicle-technology,fashion-health,real-estate-source,taste-event,home-electronics';
        break;
}

$vihicle_technology_args = array (                   
        'post_status'    => 'publish',      
        'order'          => 'DESC',
        'orderby'        => 'date',
        'post_type'      => 'post',
        'category_name'  => $vihicle_technology,
        'posts_per_page' => 20,
    );
    $vihicle_technology_the_query = new WP_Query( $vihicle_technology_args ); 
    if($vihicle_technology_the_query->have_posts()){ 
        $idObj = get_category_by_slug( $vihicle_technology ); 
?>
<section id="real-estate" class="article-all animate-bounce-up">
    <div class="container subject">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="title real">
                    <h2><a href="<?php echo get_category_link( $idObj->term_id ); ?>"><?php echo $idObj->name; ?></a></h2>
                    <div class="line">
                        <span class="icon-dotted-01"></span>
                    </div>
                </div>
            </div>

    <?php 
        while ($vihicle_technology_the_query->have_posts()){
            $vihicle_technology_the_query->the_post(); 
            ?>
            <div class="col-md-3 col-sm-3 col-xs-6 show-article">
                <figure>
                    <a class="figure-img" href="<?php the_permalink() ?>">
                        <?php
                            $attachment_id = get_post_thumbnail_id(get_the_ID());
                            if (!empty($attachment_id)) { 
                                the_post_thumbnail(array(480, 320));
                                ?>
                            <?php }else{
                                echo '<img src="'.get_stylesheet_directory_uri().'/images/no-img.jpg" alt="">';
                            }
                        ?>
                    </a>
                    <figcaption>
                        <a href="<?php the_permalink() ?>">
                            <?php the_title() ?>
                        </a>
                        <p>
                            <?php
                            $excerpt = get_post_custom_values('excerpt', get_the_ID());
                            if(!empty($excerpt)){
                                //echo filter_character($excerpt[0], 16);
                                $excerpt = $excerpt[0];
                            }else{
                                $excerpt = get_the_excerpt();
                            }
                            echo filter_character($excerpt, 16);
                            ?>
                        </p>
                        <div class="readmore">
                            <a href="<?php the_permalink() ?>"><?php echo ($language == 'vi')? 'Đọc thêm':'read more' ?> <span class="arrow">&rsaquo;&rsaquo;</span></a>
                        </div>
                    </figcaption>
                </figure>
            </div>
        <?php } ?>
        </div>
    </div>
</section><!--end real-estate-->
<?php }?>
<?php wp_reset_postdata(); ?>






    <?php //get_template_part('template-small/magazine_related'); ?>
    <?php endif; ?>
	
<?php else: ?>
 <?php if ( have_posts() ) : ?>
	
	<section id="four-seasons" class="article-all fix-top">
		<div class="container">
			<div class="row">
				<div class="wrapp-categories">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="title seasions">
							<h2>
								<?php
							if ( is_category() ){
								single_cat_title();
							}
							?>

							</h2>
							<div class="line">
								<span class="icon-dotted-01"></span>
							</div>
						</div><!--end title-->
					</div>
					<?php while ( have_posts() ) : the_post(); ?>
					<div class="col-md-3 col-sm-3 col-xs-12 show-article">
						<figure>
							<a class="figure-img" href="<?php the_permalink() ?>" title="<?php echo get_the_title(); ?>">
								 <?php
                                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                                    if (!empty($attachment_id)) { 
                                        the_post_thumbnail(array(570, 380));
                                        ?>
                                    <?php }else{
                                        echo '<img src="'.get_stylesheet_directory_uri().'/images/no-img.jpg" alt="">';
                                    }
                                ?>
                                
							</a>
							<figcaption>
								<a href="<?php the_permalink() ?>" title="<?php echo get_the_title(); ?>">
									<?php echo filter_character(get_the_title(), 8); ?>
								</a>
								<?php if($category[0]->slug =='unideal'): ?>
								<p>
									<?php
										
                                        $str = get_post_custom_values('copon', get_the_ID());
										echo $str[0];
									?>
								</p>
								<?php else: ?>
								<p>
									<?php
										
                                        $str = get_post_custom_values('excerpt', get_the_ID());
										$str = (empty($str))? get_the_excerpt() : $str[0];
										echo filter_character($str, 16);
									?>
								</p>
								<?php endif; ?>
								
								<div class="readmore">
									<a href="<?php the_permalink() ?>"><?php echo ($language == 'vi')? 'Đọc thêm':'read more' ?> <span class="arrow">&rsaquo;&rsaquo;</span></a>
								</div>
							</figcaption>
						</figure>
					</div>

					<?php endwhile;  ?>


				</div><!--end wrapp-categories-->

			</div><!--end row-->

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="paging">


						<nav>
							<?php wp_pagenavi() ;  ?>
						</nav>
					</div><!--end pagination-->
				</div>
			</div>

		</div>
	</section><!--end 4-seasons-->

	<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>