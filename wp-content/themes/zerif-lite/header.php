<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 */
global $language;
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicon-unimedia.png" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!--[if lt IE 9]>
<script src="<?php //echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
<link rel="stylesheet" href="<?php //echo esc_url( get_template_directory_uri() ); ?>/css/ie.css" type="text/css">
<![endif]-->

<?php wp_head(); ?>
<?php if(is_front_page()): ?>
<!--<link href="<?php //echo esc_url( get_template_directory_uri() ); ?>/css/animate.css" rel="stylesheet">-->
<!--<link href="<?php //echo esc_url( get_template_directory_uri() ); ?>/css/animate-customize.css" rel="stylesheet">-->
<?php endif; ?>

<?php
if(!is_search()){
$category = get_the_category($post->ID);
if(!empty($category)):
    if(!empty($category[0]->category_parent )){
$taxonomy = get_term($category[0]->category_parent, 'category');
if(is_single() == true && $taxonomy->slug ==='magazine'){ ?>

<?php if(!wpmd_is_notdevice()): ?>
<link type="text/css" href="<?php echo get_template_directory_uri() ?>/photoswipe/css/photoswipe.css" rel="stylesheet">
<link type="text/css" href="<?php echo get_template_directory_uri() ?>/photoswipe/css/default-skin/default-skin.css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri() ?>/photoswipe/js/photoswipe.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/photoswipe/js/photoswipe-ui-default.min.js"></script>
<?php endif; ?>
<?php     
}     }
endif;
}
?>
</head>

<body <?php body_class($language); ?>>
	<div class="menu-mobile">
		<?php get_template_part('template-small/menu'); ?>
		<span class="close"><i class="fa fa-times"></i></span>
	</div>
	<div id="wrapper" class="menu-showing">
		<div id="side-menu-overlay"></div>
		<?php if(wpmd_is_phone()): ?>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<?php
							echo '<a href="'.esc_url( home_url( '/' ) ).'">';
									echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'">';
							echo '</a>';
					?>
				</div>
				<div class="col-xs-6">
					<span class="menu-top">
						<i class="fa fa-bars"></i>
					</span>
				</div>
			</div>
		</div>
		
		<div class="menu-top-mobile navigation">
			<nav class="navbar navbar-default">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
						<?php
								wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu'=> 'menu_top_private',
										'menu_class' => 'nav navbar-nav',
										'container_class' => '',
								) );
						?>
						</div>
					</div>
				</div>
			</nav>
	</div>
		
		<div class="menu-sp-2">
			<div class="container">
				<div class="row">
				<div class="col-xs-4">
					<i class="fa fa-list"></i><?php echo ($language == 'vi')?'Danh mục': 'Category'; ?>
				</div>
				<div class="col-xs-4">
					<div class="form-search">
						<i class="fa fa-search"></i>
						<?php echo ($language == 'vi')?'Tìm kiếm': 'Search'; ?>
					</div>
					
				</div>
				<div class="col-xs-4">
					<div class="language">
            <a href="<?php echo get_site_url(); ?>/vi" title="Tiếng Việt" class="vi"></a>
            <a href="<?php echo get_site_url(); ?>/en" title="English" class="en"></a>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="menu-sp-2-search">
			<div class="container">
				<?php get_search_form(); ?>
			</div>
		</div>
	</header>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$(".menu-left").css('height',$(window).height() - 40);
				$("#header .fa-list").on('click', function(){
					$(".menu-mobile").addClass('site-page-frame');
					$(".menu-showing").addClass('page-frame');
					$("#side-menu-overlay").addClass('on');
					$('body').css('position', 'fixed');
				});
				$("#side-menu-overlay").on('click', function(){
					$(this).removeClass('on');
					$(".menu-mobile").removeClass('site-page-frame');
					$(".menu-showing").removeClass('page-frame');
					$('body').removeAttr('style');
				});
				
				// form search
				$(".form-search").on('click', function(){
					$(".menu-sp-2-search").slideToggle();
				});
				// close form 
				$(".close").on('click', function(){
					$("#side-menu-overlay").trigger('click');
				});
				
				// menu top
				$(".menu-top").on('click', function(){
					$(".menu-top-mobile").slideToggle();
				});
			});
		</script>
	<?php else: ?>
    <header id="header">
        <div class="top-header">
                <div class="menu-top navigation">
                    <nav class="navbar navbar-default">
											<div class="container">
												<div class="row">
													<div class="col-md-12">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu'=> 'menu_top_private',
                                'menu_class' => 'nav navbar-nav',
                                'container_class' => '',
                            ) );
                        ?>

                        <?php get_search_form(); ?>
												</div>
												</div>
											</div>
                    </nav><!-- /.navbar-collapse -->
            
            
										<div class="container">
											<div class="row">
													<div class="col-md-2 col-sm-2">
															<?php
																	echo '<a href="'.esc_url( home_url( '/' ) ).'">';
																			echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'">';
																	echo '</a>';
															?>
													</div>
													<div class="col-md-10 col-sm-10 col-xs-12">
														<div class="adv-top">
															<?php get_template_part('template-small/adv_top'); ?>
														</div>
													</div>
											</div>
										</div>
          </div>
        </div>
    </header>
	<?php endif; ?>
  <section id="wrap-new-adv" class="animate-bounce-up">
    <div class="container subject">
        <div class="row">
					<?php if(!wpmd_is_phone()): ?>
          <div class="col-md-3">
            <?php get_template_part('template-small/menu'); ?>
          </div>
					<?php endif; ?>
          <div class="col-md-6">
            <?php get_template_part('template-small/advertisement'); ?>
          </div>
          <div class="col-md-3">
            <?php get_template_part('template-small/advertisement_four'); ?>
          </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php //get_template_part('template-small/advertisement'); ?>
            </div><!-- /col-md-6 -->

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="row">
                    <?php //get_template_part('template-small/advertisement_four'); ?>
                    <!--end top-sub-adv-->								
                </div>
            </div><!-- /col-md-6 -->
        </div>
    </div>
</section><!--end wrap-new-adv-->