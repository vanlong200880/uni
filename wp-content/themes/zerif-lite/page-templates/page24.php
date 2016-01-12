<?php
/**
 * Template Name: Page 24h
 */
get_header(); ?>
<?php 
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array (					 
		'post_status'    => 'publish',
    'orderby'  => array( 'meta_value_num' => 'ASC', 'post_date' => 'DESC' ),
		'meta_key'			=> 'kich_thuoc_trang',
		'post_type'      => 'post',
		'posts_per_page' => 80,
		'category_name'  => 'magazine-online',
		'paged' => $paged
	);
	$the_query = new WP_Query( $args ); 
?>
<?php if($the_query -> have_posts()): ?>
<section id="real-estate" class="article-all show-post-online">
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
						$number = get_field('kich_thuoc_trang');
						$num = 3;
            $class = '';
						$nummobile = 6;
						if($number == 1){
              $class = 'magazine-couple';
							$num = 6;
							$nummobile = 12;
						}
            if($number == 2){
              $class = 'magazine-single';
						}
            
            if($number == '3'){
                $class = 'magazine-1-2 magazine-single-half';
            }
            ?>
            <div class="col-md-<?php echo $num; ?> col-sm-<?php echo $nummobile; ?> col-xs-<?php echo $nummobile; ?> <?php echo $class; ?> show-article">
                <figure>
                        <?php
														$attachment_id = get_post_thumbnail_id(get_the_ID());
														$link = wp_get_attachment_link($attachment_id, 'full');
                            echo $link;
                        ?>
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
