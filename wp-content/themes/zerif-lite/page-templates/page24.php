<?php
/**
 * Template Name: Page 24h
 */
get_header(); ?>
<?php 
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array (					 
		'post_status'    => 'publish',
		'order'          => 'ASC',
		'meta_key'			=> 'kich_thuoc_trang',
		'orderby'			=> 'meta_value_num',
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
						$nummobile = 6;
						if($number == 1){
							$num = 6;
							$nummobile = 12;
						}
                        $class = '';
                        if($number == '3'){
                            $class = 'magazine-1-2';
                        }
            ?>
            <div class="col-md-<?php echo $num; ?> col-sm-<?php echo $num; ?> col-xs-<?php echo $nummobile; ?> <?php echo $class; ?> show-article">
                <figure>
									<a class="figure-img" href="<?php the_permalink() ?>">
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
