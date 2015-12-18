<?php
/**
 * Template Name: Page 24h
 */
get_header(); ?>
<?php 
$arg = array(
	'child_of'    => 0,
	'parent'  => 0);
$category = get_categories($arg);
$list_category = array();
if($category){
	$arr = array('advertisement', 'magazine', 'uncategorised');
	foreach ($category as $val){
		if(!in_array($val->slug, $arr)){
			array_push($list_category, $val->slug);
		}
	}
}
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array (					 
		'post_status'    => 'publish',
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_type'      => 'post',
		'posts_per_page' => 40,
		'category_name'  => implode(',', $list_category),
		'paged' => $paged
	);
	$the_query = new WP_Query( $args ); 
?>
<?php if($the_query -> have_posts()): ?>
<section id="real-estate" class="article-all">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="title real">
                    <h2><?php the_title(); ?></h2>
                    <div class="line">
                        <span class="icon-dotted-01"></span>
                    </div>
                </div>
            </div>

    <?php 
        while ($the_query->have_posts()){
            $the_query->the_post(); 
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
                            <span class="left"></span>
                            <a href="<?php the_permalink() ?>"><?php echo ($language == 'vi')? 'Đọc thêm':'read more' ?> <span class="arrow">&rsaquo;&rsaquo;</span></a>
                        </div>
                    </figcaption>
                </figure>
            </div>
        <?php } ?>
        </div>
			
				<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="paging">


						<nav>
							<?php wp_pagenavi(array( 'query' => $the_query )) ;  ?>
						</nav>
					</div><!--end pagination-->
				</div>
			</div>
			
    </div>
</section><!--end real-estate-->
<?php endif; ?>

<?php get_footer(); ?>
