<?php get_header(); ?>
<section id="wrap-new-adv" class="animate-bounce-up">
    <div class="container subject">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php get_template_part('template-small/advertisement'); ?>
            </div><!-- /col-md-6 -->

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="row">
                    <?php get_template_part('template-small/advertisement_four'); ?>
                    <!--end top-sub-adv-->								
                </div>
            </div><!-- /col-md-6 -->
        </div>
    </div>
</section><!--end wrap-new-adv-->


<section id="wrap-magazine" class="animate-bounce-up">
    <div class="container subject">
        <div class="row">
            <div class="col-md-12">
                    <?php get_template_part('template-small/magazine'); ?>
                <!--end show-magazine-->
            </div>
        </div>
    </div>
</section><!--end wrap-magazine-->


<?php get_template_part('template-small/list_category'); ?>

<?php get_footer(); ?>
