<?php 
        $parent_obj = get_category_by_slug('magazine');
        if($parent_obj):
        $args = array(
            'orderby'           => 'id',
            'order'             => 'DESC',
            'parent'            => $parent_obj->term_id,
            'taxonomy'          => 'category',
            'hide_empty'        => 0 ,
            'number'    => 6,
          );
        $categories = get_categories( $args ); ?>
<div class="title magazine">
    <h2><?php echo $parent_obj->name; ?></h2>
    <div class="line">
        <span class="icon-dotted-01"></span>
    </div>
</div><!--end title-->
<div class="show-magazine" >
    <ul id="owl-product-carousel-first" class="owl-carousel">
    
        <?php foreach ( $categories as $category ) { 
            $custom_field = get_field('featured_image', $category );
            ?>
        <li>
            <figure>
                <a href="<?php echo get_category_link( $category->term_id ); ?>"><img src="<?php echo $custom_field['sizes']['zerif_magazine_category_thumbnail']; ?>" alt=""></a>
                <!-- <figcaption>
                    <p><a href="<?php //echo get_category_link( $category->term_id ); ?>"><?php //echo $category->name; ?></a></p>
                </figcaption> -->
            </figure>
        </li>
      <?php } ?>


    </ul>
</div>
<?php endif; ?>
