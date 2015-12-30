<?php /**
 * The Template for displaying all single posts.
 */
global $post;
//                var_dump($post);
$category = get_the_category($post->ID);
?>
<?php if(is_user_logged_in() && $category[0]->slug =='unideal' && $_REQUEST['admin'] == 'printer'): ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>


<!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/ie.css" type="text/css">
<![endif]-->

<?php //wp_head(); ?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/print.css" type="text/css">
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.js"></script>
</head>

	<body <?php body_class($language); ?>>
		<div class="print-page">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php while ( have_posts() ) : the_post(); 
							//the_content();
						endwhile; // end of the loop. ?>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			
		</script>
	</body>
</html>
<?php else: ?>


<?php
$parent = get_category($category[0]->category_parent);
if($parent->slug == 'magazine-online'):
	get_header(); ?>
<section id="wrapp-details" class="fix-top">
    <div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="wrapp-breadcrumb">
								<ol class="breadcrumb">
										<?php if(function_exists('bcn_display'))
										{
												bcn_display();
										}?>
								</ol>

						</div>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="show-details">
										<?php while ( have_posts() ) : the_post(); 
												get_template_part( 'content', 'single' );
									 endwhile; // end of the loop. ?>
						</div>
				</div>
				
				<?php 
                $featured = array (
										'order'          => 'ASC',
										'orderby'        => 'id',
										'meta_key'			=> 'kich_thuoc_trang',
										'orderby'			=> 'meta_value_num',
                    'post_status'    => 'publish',		
                    'post_type'      => 'post',
                    'category_name'  => $category[0]->slug,
										'posts_per_page' => 10,
                    'post__not_in'   => array(get_the_ID())
                );
                $featured_the_query = new WP_Query( $featured ); 
                if($featured_the_query){ ?>
				<div id="sidebar" class="col-md-4 col-sm-4 col-xs-12 article-all">
					<div class="page-header">
							<h2><?php echo ($language =='vi')?'Bài liên quan':'Featured'; ?></h2>
					</div>
					<div class="row">
							<div class="top-sub-featured show-post-online">
					<?php
					while ($featured_the_query->have_posts()){
							$featured_the_query->the_post(); 
							$number = get_field('kich_thuoc_trang');
							$num = 6;
							if($number == 1){
								$num = 12;
							}
                            $class = '';
                            if($number == '3'){
                                $class = 'magazine-1-2';
                            }
							?>
							<div class="col-md-<?php echo $num; ?> col-sm-<?php echo $num; ?> col-xs-<?php echo $num; ?> <?php echo $class; ?> mg-20 show-article">
									<figure>
											<a href="<?php the_permalink() ?>">
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
									</figure>
							</div>
					<?php } ?>
									</div><!--end top-sub-featured-->	
							</div>
					</div>
			<?php }?>
			</div>
		</div>
</section>
<?php 	get_footer();
else: ?>

<?php
if(empty($category[0]->category_parent)):
get_header(); ?>
<section id="wrapp-details" class="fix-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wrapp-breadcrumb">
                    <ol class="breadcrumb">
                        <?php if(function_exists('bcn_display'))
                        {
                            bcn_display();
                        }?>
                    </ol>

                </div>
            </div>
        </div>
        <div class="row">
			<?php if($category[0]->slug =='unideal'): ?>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="row">
					<div class="col-md-12">
						<a id="btnPrint"><i class="fa fa-print" title="Print"></i></a>
						<script type="text/javascript">
							jQuery(document).ready(function($){
								$("#btnPrint").on("click", function () {
								var divContents = $("#dvContainer").html();
								var printWindow = window.open('', '');
								printWindow.document.write('<html><head><title><?php the_title(); ?></title>');
								printWindow.document.write('</head><body >');
								printWindow.document.write(divContents);
								printWindow.document.write('</body></html>');
								printWindow.document.close();
								printWindow.print();
								printWindow.close();
							});
							});
						</script>
					</div>
				</div>
                <div class="show-details" id="dvContainer">
                        <?php while ( have_posts() ) : the_post(); 
						the_content();
                       endwhile; // end of the loop. ?>
                </div>
            </div>
				<?php else: ?>
			<div class="col-md-8 col-sm-8 col-xs-12">
                <div class="show-details">
                        <?php while ( have_posts() ) : the_post(); 
                            get_template_part( 'content', 'single' );
                       endwhile; // end of the loop. ?>
                </div>
            </div>
				<?php endif; ?>          
            <?php 
                $featured = array (					 
                    'post_status'    => 'publish',		
                    'order'          => 'DESC',
                    'orderby'        => 'date',
                    'post_type'      => 'post',
                    'category_name'  => $category[0]->slug,
										'posts_per_page' => 10,
                    'post__not_in'   => array(get_the_ID())
                );
                $featured_the_query = new WP_Query( $featured ); 
                if($featured_the_query){ ?>
			<div id="sidebar" class="col-md-4 col-sm-4 col-xs-12 article-all">
                    <div class="page-header">
                        <h2><?php echo ($language =='vi')?'Bài liên quan':'Featured'; ?></h2>
                    </div>
                    <div class="row">
                        <div class="top-sub-featured">
                    <?php
                    while ($featured_the_query->have_posts()){
                        $featured_the_query->the_post(); ?>
                            <div class="col-md-6 col-sm-6 col-xs-6 mg-20 show-article">
                                <figure>
                                    <a href="<?php the_permalink() ?>">
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
                                            <?php echo get_the_title()?>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                    <?php } ?>
                            </div><!--end top-sub-featured-->	
                        </div>
                    </div>
                <?php }?>
            
        </div>
    </div>
</section><!--end wrapp-details-->

<?php get_footer(); ?>
<?php   else: ?>

	<?php while ( have_posts() ) : the_post(); 
        $listGalery = getGaleryFromPost($post);
        if($listGalery[0]){ ?>

		<?php if(wpmd_is_notdevice() == true): ?>
		<!-- is tablet and desktop -->
		
		<!doctype html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
   
    <!-- viewport -->
    <meta content="width=device-width,initial-scale=1" name="viewport">
       
    <!-- title -->
    <title><?php the_title() ?></title>        
        
    <!-- add css and js for flipbook -->
    <link type="text/css" href="<?php echo get_template_directory_uri() ?>/slipbook/css/style.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Play:400,700">
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/jquery.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/turn.js"></script>              
	<script src="<?php echo get_template_directory_uri() ?>/slipbook/js/jquery.fullscreen.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/jquery.address-1.6.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/slipbook/js/wait.js"></script>
	<script src="<?php echo get_template_directory_uri() ?>/slipbook/js/onload.js"></script>


    <!-- style css  -->
	<style>	
	    html,body {
          margin: 0;
          padding: 0;
		  overflow:auto !important;
        }
	</style>
      
	</head>
 
<body>



 
<!-- DIV YOUR WEBSITE --> 
<div style="width:100%;margin:0 auto">
<!-- BEGIN FLIPBOOK STRUCTURE -->  
<div id="fb5-ajax">	
      <!-- BEGIN HTML BOOK -->      
      <div data-current="magazine" class="fb5" id="fb5">     
		  <!-- PRELOADER -->
            <div class="fb5-preloader">
            <div id="wBall_1" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_2" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_3" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_4" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            <div id="wBall_5" class="wBall">
            <div class="wInnerBall">
            </div>
            </div>
            </div>      
      
            <!-- BACK BUTTON -->
            <a href="#" id="fb5-button-back"><?php echo ($language =='vi') ?'Đóng' : 'Close'; ?></a>
			
			
            <!-- BACKGROUND FOR BOOK -->  
            <div class="fb5-bcg-book"></div>                      
            <!-- BEGIN CONTAINER BOOK -->
            <div id="fb5-container-book">
                <!-- BEGIN deep linking -->  
                <section id="fb5-deeplinking">
                     <ul>
                        <?php 
                            foreach ($listGalery[0]['ids'] as $k => $galery) { 
                                $k++;
                                //if($k > 0){
?>
                          <li data-address="page<?php echo $k ?>" data-page="<?php echo $k; ?>"></li>
                                <?php } //} ?>
                          <?php if(count($listGalery[0]['ids'])%2 != 0): ?>
                          <li data-address="page<?php echo count($listGalery[0]['ids'])+1 ?>" data-page="<?php echo count($listGalery[0]['ids'])+1; ?>"></li>
                          <?php endif; ?>
                     </ul>
                 </section>
                <!-- END deep linking -->  
                <!-- BEGIN ABOUT -->
<!--                <section id="fb5-about">
                    <?php 
//                        foreach ($listGalery[0]['ids'] as $k => $galery) {
//                            if($k === 0){
//                                the_post_thumbnail(array(480, 635), array('id'    => 'id_'.$galery, 'alt' => trim(strip_tags(get_post_meta($galery, '_wp_attachment_image_alt', true))),));
//                            }
                            ?>
                   <?php //} ?>
                </section>-->
                <!-- END ABOUT -->
                <!-- BEGIN BOOK -->
                <div id="fb5-book">
                <!-- BEGIN PAGE 1 -->
                <?php 
                        foreach ($listGalery[0]['ids'] as $k => $galery) {
                            //if($k > 0){ ?>
                        <div data-background-image="<?php echo wp_get_attachment_url($galery); ?>" class="">
                             
                        </div>
                            <?php } //} ?>
                
                        <?php if(count($listGalery[0]['ids'])%2 != 0): ?>
                          <div data-background-image="none" class="">
                             
                        </div>
                          <?php endif; ?>
                <!-- END PAGE 1 -->                          
              </div>
              <!-- END BOOK -->
              <!-- arrows -->
              <a class="fb5-nav-arrow prev"></a>
              <a class="fb5-nav-arrow next"></a>
             </div>
             <!-- END CONTAINER BOOK -->
        <!-- BEGIN FOOTER -->
        <div id="fb5-footer">
            <div class="fb5-bcg-tools"></div>
            <a id="fb5-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="100" alt="<?php echo get_bloginfo('title'); ?>">
            </a>
            <div class="fb5-menu" id="fb5-center">
                <ul>                                        
                    <!-- icon_zoom_in -->                              
                    <li>
                        <a title="ZOOM IN" class="fb5-zoom-in"></a>
                    </li>                               
                    <!-- icon_zoom_out -->
                    <li>
                        <a title="ZOOM OUT " class="fb5-zoom-out"></a>
                    </li>                                
                    <!-- icon_zoom_auto -->
<!--                    <li>
                        <a title="ZOOM AUTO " class="fb5-zoom-auto"></a>
                    </li>                                -->
                    <!-- icon_zoom_original -->
<!--                    <li>
                        <a title="ZOOM ORIGINAL (SCALE 1:1)" class="fb5-zoom-original"></a>
                    </li>-->
                    <!-- icon_allpages -->
                    <li>
                        <a title="SHOW ALL PAGES " class="fb5-show-all"></a>
                    </li>
                    <!-- icon_home -->
                    <li>
                        <a title="SHOW HOME PAGE " class="fb5-home"></a>
                    </li>              
                </ul>
            </div>
            <div class="fb5-menu" id="fb5-right">
                <ul> 
                    <!-- icon page manager -->                 
                    <li class="fb5-goto">
                        <label for="fb5-page-number" id="fb5-label-page-number">PAGE</label>
                        <input type="text" id="fb5-page-number">
                        <button type="button">GO</button>
                    </li>        
                    <!-- icon fullscreen -->                 
                    <li>
                        <a title="FULL / NORMAL SCREEN" class="fb5-fullscreen"></a>
                    </li>                                                      
                </ul>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN ALL PAGES -->
          <div id="fb5-all-pages" class="fb5-overlay">
          <section class="fb5-container-pages">
            <div id="fb5-menu-holder">
                <ul id="fb5-slider">
                        <?php 
                        foreach ($listGalery[0]['ids'] as $k => $galery) {
                            //if($k > 0){ ?>
                    
                            <li class="<?php echo $k; ?>">
                                <img alt="" data-src="<?php echo wp_get_attachment_url($galery, array(120,170)); ?>">
                            </li>
                            <?php } //} ?>
                            
                  </ul>
              </div>
          </section>
         </div>
         <!-- END ALL PAGES -->
   </div>
   <!-- END HTML BOOK -->
    <!-- CONFIGURATION FLIPBOOK -->
    <script>    
    jQuery('#fb5').data('config',
    {
    "page_width":"450",
    "page_height":"635",
	"email_form":"vanlong200880@gmail.com",
    "zoom_double_click":"1",
    "zoom_step":"0.3",
    "double_click_enabled":"true",
    "tooltip_visible":"true",
    "toolbar_visible":"true",
    "gotopage_width":"30",
    "deeplinking_enabled":"true",
    "rtl":"false",
    'full_area':'true',
	'lazy_loading_thumbs':'true',
	'lazy_loading_pages':'true'
    })
	
	jQuery(document).ready(function($){
		$("#fb5-button-back").on('click', function(){
			window.close();
		});
	});
    </script>
</div>
<!-- END FLIPBOOK STRUCTURE -->    
</div> 
<!-- END DIV YOUR WEBSITE --> 
</body>
</html>

		
		
		
		<?php else: ?>
		<!-- is mobile -->

<?php	 get_header() ?>

 <?php 
					$arrJson = array();
                        foreach ($listGalery[0]['ids'] as $k => $galery) {
								$uploads = wp_upload_dir();
								$upload_path = $uploads['baseurl'];
								$img = wp_get_attachment_metadata($galery);
								$arrJson[] = array(
								  'src' => $upload_path.'/'.$img['file'],
								  'w' => $img['width'],
								  'h' => $img['height'],
								);
						}
					?>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
     
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button id="photoswipeclose" class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
          </div>
        </div>
</div>
 
<script type="text/javascript">
	var openPhotoSwipe = function() {
    var pswpElement = document.querySelectorAll('.pswp')[0];
	var items = <?php echo json_encode($arrJson); ?>
    
    // define options (if needed)
    var options = {    
        history: false,
        focus: false,
        showAnimationDuration: 0,
        hideAnimationDuration: 0,
		preloaderEl: true
    };
    
    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
	gallery.listen('close', function() {
		window.close();
	});
};
openPhotoSwipe();
</script>
<?php get_footer() ?>
		<?php endif; ?>
		<?php } ?>
		<?php endwhile;?>
<!-- check photo book -->
<?php endif; ?>

<?php endif;?>
<?php endif; ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/jquery-scrolltofixed.js"></script>
<script type="text/javascript">
    var summaries = $('#sidebar');
        summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: 10,
                limit: function() {
                    var limit = 0;
                    if (next) {
                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                    } else {
                        limit = $('footer').offset().top - $(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999,

            });
        });
</script>



















