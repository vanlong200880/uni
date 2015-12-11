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
                        <ul class="unimedia-services pull-right">
                            <li>
                                <div class="services health">
                                    <span class="icon-icon-health-01"></span>
                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/fashion-health/">THỜI TRANG & SỨC KHỎE</a></p>
                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/fashion-health/">FASHION & HEALTH</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="services taste">
                                    <span class="icon-icon-taste-01"></span>
                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/taste-event/">ẨM THỰC & TIỆC</a></p>
                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/taste-event/">TASTE & EVENT</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="services real">
                                    <span class="icon-icon-real-01"></span>
                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/real-estate-source/">NGUỒN ĐỊA ỐC</a></p>
                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/real-estate-source/">REAL ESTATE SOURCE</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="services four-seasons">
                                    <span class="icon-icon-promotion-01"></span>
                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/seasons-promotion/">4 MÙA & KHUYẾN MÃI</a></p>
                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/seasons-promotion/">4 SEASONS & PROMOTION</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="services home-elect">
                                    <span class="icon-icon-elect-01"></span>
                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/home-electronics/">ĐIỆN MÁY & GIA DỤNG</a></p>
                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/home-electronics/">HOME & ELECTRONICS</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="services car-tech">
                                    <span class="icon-icon-car-01"></span>
                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/vehicle-technology/">XE & CÔNG NGHỆ</a></p>
                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/vehicle-technology/">VEHICLE & TECHNOLOGY</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--end top-header-->

        <div class="top-header-tablet">
            <ul class="unimedia-services">
                <li>
                    <div class="services health">
                        <span class="icon-icon-health-01"></span>
                        <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/fashion-health/">THỜI TRANG & SỨC KHỎE</a></p>
                        <p><a class="en" href="<?php echo get_site_url() ?>/en/category/fashion-health/">FASHION & HEALTH</a></p>
                    </div>
                </li>
                <li>
                    <div class="services taste">
                        <span class="icon-icon-taste-01"></span>
                        <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/taste-event/">ẨM THỰC & TIỆC</a></p>
                        <p><a class="en" href="<?php echo get_site_url() ?>/en/category/taste-event/">TASTE & EVENT</a></p>
                    </div>
                </li>
                <li>
                    <div class="services real">
                        <span class="icon-icon-real-01"></span>
                        <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/real-estate-source/">NGUỒN ĐỊA ỐC</a></p>
                        <p><a class="en" href="<?php echo get_site_url() ?>/en/category/real-estate-source/">REAL ESTATE SOURCE</a></p>
                    </div>
                </li>
                <li>
                    <div class="services four-seasons">
                        <span class="icon-icon-promotion-01"></span>
                        <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/seasons-promotion/">4 MÙA & KHUYẾN MÃI</a></p>
                        <p><a class="en" href="<?php echo get_site_url() ?>/en/category/seasons-promotion/">4 SEASONS & PROMOTION</a></p>
                    </div>
                </li>
                <li>
                    <div class="services home-elect">
                        <span class="icon-icon-elect-01"></span>
                        <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/home-electronics/">ĐIỆN MÁY & GIA DỤNG</a></p>
                        <p><a class="en" href="<?php echo get_site_url() ?>/en/category/home-electronics/">HOME & ELECTRONICS</a></p>
                    </div>
                </li>
                <li>
                    <div class="services car-tech">
                        <span class="icon-icon-car-01"></span>
                        <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/vehicle-technology/">XE & CÔNG NGHỆ</a></p>
                        <p><a class="en" href="<?php echo get_site_url() ?>/en/category/vehicle-technology/">VEHICLE & TECHNOLOGY</a></p>
                    </div>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div><!--end top-header-tablet-->

        <div class="top-header-sp">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="unimedia-services">
                            <li>
                                <div class="services health">	
                                    <div class="dropdown ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <p><span class="icon-icon-health-01"></span></p>
                                        </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <p>
                                                        <a class="vi" href="<?php echo get_site_url() ?>/vi/category/feshion-health/">THỜI TRANG & SỨC KHỎE</a>
                                                    </p>
                                                    <p>
                                                        <a class="en" href="<?php echo get_site_url() ?>/en/category/feshion-health/">FASHION & HEALTH</a>
                                                    </p>
                                                </li>
                                          </ul>
                                        </div>
                                </div>
                            </li>
                            <li>
                                <div class="services taste">	
                                    <div class="dropdown ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <p><span class="icon-icon-taste-01"></span></p>
                                        </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/taste-event/">ẨM THỰC & TIỆC</a></p>
                                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/taste-event/">TASTE & EVENT</a></p>
                                                </li>
                                          </ul>
                                        </div>
                                </div>
                            </li>
                            <li>
                                <div class="services real">	
                                    <div class="dropdown ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <p><span class="icon-icon-real-01"></span></p>
                                        </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/real-estate-source/">NGUỒN ĐỊA ỐC</a></p>
                                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/real-estate-source/">REAL ESTATE SOURCE</a></p>
                                                </li>
                                          </ul>
                                        </div>
                                </div>
                            </li>
                            <li>
                                <div class="services four-seasons"> 
                                    <div class="dropdown ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <p><span class="icon-icon-promotion-01"></span></p>
                                        </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/seasons-promotion/">4 MÙA & KHUYẾN MÃI</a></p>
                                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/seasonss-promotion/">4 SEASONS & PROMOTION</a></p>
                                                </li>
                                          </ul>
                                        </div>
                                </div>
                            </li>
                            <li>
                                <div class="services home-elect">	
                                    <div class="dropdown ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <p><span class="icon-icon-elect-01"></span></p>
                                        </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/home-electronics/">ĐIỆN MÁY & GIA DỤNG</a></p>
                                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/home-electronics/">HOME & ELECTRONICS</a></p>
                                                </li>
                                          </ul>
                                        </div>
                                </div>
                            </li>
                        
                            <li>
                                <div class="services car-tech"> 
                                    <div class="dropdown ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <p><span class="icon-icon-car-01"></span></p>
                                        </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <p><a class="vi" href="<?php echo get_site_url() ?>/vi/category/vehicle-technology/">XE & CÔNG NGHỆ</a></p>
                                                    <p><a class="en" href="<?php echo get_site_url() ?>/en/category/vehicle-technology/">VEHICLE & TECHNOLOGY</a></p>
                                                </li>
                                          </ul>
                                        </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--end top-header-sp-->

        <div class="navigation">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="row">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <?php
                                echo '<a class="navbar-brand" href="'.esc_url( home_url( '/' ) ).'">';
                                    echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'">';
                                echo '</a>';
                            ?>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <!-- <img src="<?php echo get_template_directory_uri(); ?>/images/sale.png"> -->
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu'=> 'menu_top_private',
                                    'menu_class' => 'nav navbar-nav',
                                    'container_class' => '',
                                ) );
                            ?>
                            
                            <?php get_search_form(); ?>

                        </div><!-- /.navbar-collapse -->

                    </div>
                </div>
            </nav>
        </div><!-- /navigation -->


        <div class="navigation-tablet">
            
            <div class="container">
                <div class="row">
                    <div class="logo-search">
                        <div class="col-sm-3">
                            <div class="logo-tablet">
                                <?php
                                    echo '<a href="'.esc_url( home_url( '/' ) ).'">';
                                        echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'">';
                                    echo '</a>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="wrapp-form-search-tablet">
                        <div class="col-sm-9">
                            <?php get_search_form(); ?>
                        </div>
                    </div><!--end wrapp-form-search-tablet-->

                </div>
            </div>
         
            <div class="menu-tablet">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu'=> 'menu_top_private',
                                    'container_class' => '',
                                ) );
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div><!-- /navigation-tablet-->
        


        <div class="wrapp-form-search-sp">
            <div class="container">
                <?php get_search_form(); ?>
            </div>
        </div><!--end wrapp-form-search-sp-->

    </header><!-- /header -->