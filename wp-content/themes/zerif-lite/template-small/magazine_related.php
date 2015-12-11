<section id="wrap-magazine" class="wrap-magazine-related">
    <div class="container">
        <div class="row">
            <div class="col-md-12">               
<?php  
    global $language;
    wp_reset_postdata();
    $parent_obj = get_category_by_slug('magazine');
    $magazine_related_args = array(
        'orderby'           => 'id',
        'order'             => 'DESC',
        'parent'            => $parent_obj->term_id,
        'taxonomy'          => 'category',
        'hide_empty'        => 0 ,
//        'hierarchical' => false,
//        'exclude' => '16',
      );
    $categories_related = get_categories( $magazine_related_args ); 
    unset($categories_related[0]); 
    $categories_related = array_values($categories_related);
    $numOfItems = 12;
    $page = isset( $_GET['page'] ) ? abs( (int) $_GET['page'] ) : 1;
    $to = $page * $numOfItems;
    $current = $to - $numOfItems;
    $total = sizeof($categories_related);
    $to = ($to > $total)? $total: $to;
    ?>
                <?php if(!empty($categories_related)): ?>
                <div class="title magazine">
                    <h2><?php echo ($language == 'vi') ? 'Tạp chí khác': 'magazine related'; ?></h2>
                    <div class="line">
                        <span class="icon-dotted-01"></span>
                    </div>
                </div><!--end title-->
                <div class="show-magazine" >
                    <ul id="owl-product-carousel">

                        <?php for ($i=$current; $i<$to; ++$i){
                            $category = $categories_related[$i];
                            $custom_field = get_field('featured_image', $category );
                            ?>
                        <li>
                            <figure>
                                <a href="<?php echo get_category_link( $category->term_id ); ?>"><img src="<?php echo $custom_field['sizes']['zerif_magazine_category_thumbnail']; ?>" alt=""></a>
                                <figcaption>
                                    <p><a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a></p>
                                </figcaption>
                            </figure>
                        </li>
                      <?php } unset($category); ?>


                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <?php if(!empty($categories_related)): ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="paging">
                    <nav>
                        <?php
                            echo paginate_links( array(
                                    'base' => add_query_arg( 'page', '%#%' ),
                                    'format' => '',
                                    'prev_text' => __('&laquo;'),
                                    'next_text' => __('&raquo;'),
                                    'total' => ceil($total / $numOfItems),
                                    'current' => $page,
                                    'type' => 'list'
                                ));
                            ?>
                    </nav>
                </div><!--end pagination-->
            </div>
            <?php endif; ?>
        </div>
        
        
    </div>
</section><!--end wrap-magazine-->




