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

<div id="wrapper">
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
  <section id="wrap-new-adv" class="animate-bounce-up">
    <div class="container subject">
        <div class="row">
          <div class="col-md-3">
            <?php get_template_part('template-small/menu'); ?>
          </div>
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