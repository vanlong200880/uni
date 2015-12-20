<?php global $language; ?>    
<footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 border-right-footer first">
                    <div class="menu-footer">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu'=> 'menu_footer',
                                'menu_class' => '',
                                'container_class' => '',
                            ) );
                        ?>
                    </div><!--end menu-footer-->
                    <div class="info-company">
                        <?php //the_widget(); ?>
                        <h4>công ty tnhh unimedia</h4>
                        <p><?php echo ($language == 'vi'? 'Tầng 11, Bảo Minh Tower': 'Floor 11, Bao Minh Tower'); ?></p>
                        <p><?php echo ($language == 'vi') ? '217 Nam Kỳ Khởi Nghĩa, P.7, Q.3': '217 Nam Ky Khoi Nghia Street, Ward 7, District 3' ?></p>
                        <p>Tel:(08) 3932 9777</p>
                        <p>Fax: (08) 3932 9222</p>
                        <p class="logo-footer hiden">
                            <?php
                                echo '<a href="'.esc_url( home_url( '/' ) ).'">';
                                    echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" title="'.get_bloginfo('title').'">';
                                echo '</a>';
                            ?>
                        </p>
                        <p>Copyright © 2015 UNIMEDIA All rigths reserved.</p>
                    </div><!--end info-company-->
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 hidden-xs border-right-footer">
                    <div class="wrap-about">
                        <h1><?php echo ($language == 'vi')? 'Giới thiệu': 'about us'; ?></h1>
						<?php if($language == 'vi'): ?>
						<!-- <p>Để mang sản phẩm, thương hiệu đến gần hơn người tiêu dùng, các doanh nghiệp đã và đang thực hiện rất nhiều hình thức PR – Marketing với mức chi phí không nhỏ, nhưng đã trở nên bão hòa trong thời đại hiện nay. </p> -->
                        <p><b>UNIMEDIA</b> tự hào cho ra mắt ấn phẩm mang phong cách hoàn toàn khác biệt với 100% quảng cáo – phát triển thành công hơn 15 năm tại thị trường Mỹ. Chúng tôi tin chắc UNIMEDIA sẽ là lựa chọn hàng đầu cho các doanh nghiệp để đưa sản phẩm, dịch vụ của mình đến tay người tiêu dùng một cách nhanh chóng và hiệu quả nhất.</p>
						<?php else: ?>
						
						<!-- <p>For increasing the customers’awareness about products and brands, most companies have spent more and more expenses on means of PR – Marketing, which is getting into saturation nowsadays.</p> -->
						<p>UNIMEDIA proudly issue advertising magazines in completely impressive version with 100% ads – used to succeed over 15 years in USA. We strongly believe that UNIMEDIA is the 
best choice for all companies to bring products & services to millions of customer fast and effectively.</p>
						<?php endif; ?>
                        
						
                        <p>
                            <a href="<?php echo ($language == 'vi')? esc_url( home_url( '/en/about-us' )): esc_url( home_url( '/vi/about-us' ) ); ?>" class="btn btn-primary"><?php echo ($language == 'vi')? ' Đọc thêm ': ' Read more '; ?><span class="arrow">&rsaquo;&rsaquo;</span></a>
                        </p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 border-right-footer last">
                    <div class="info-social">
                        <div class="icon-social">
                            <span><a href="https://www.facebook.com/Unimedia-459692210885646/?fref=ts" targer="_blank"><i class="fa fa-facebook-square"></i></a></span>
                            <span><a href="#"><i class="fa fa-twitter-square"></i></a></span>
                        </div>
                        <div class="wrap-ipisocial">
                            <!--<p>Nhung IPI</p>-->
                        </div>
                        <div class="wrap-chat">
                            <p>
                                <span><i class="fa fa-envelope"></i></span>
                                <a href="">contact@unimedia.vn</a>	
                            </p>
                            <p>
                                <span><i class="fa fa-mobile"></i></span>
                                <span class="phone-number">090 474 0278 (Ms. Lan)</span>	
                            </p>

                            <p>
                                <span><i class="fa fa-skype"></i></span> 
                                <a href="skype:sale.vinarealtor?chat">Sale Vina Realtor</a>	
								
								
                            </p>
                            <p>
                                <span><i class="fa fa-skype"></i></span> 
                                <a href="skype:sale.unimedia?chat">Sale Unimedia</a>	
                            </p>

                        </div>
                        <div class="appstore">
                            <div class="ios-store">
                                <a href=""></a>
                            </div>
                            <div class="google-store">
                                <a href=""></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </footer>
</div>
<a id="support"><?php echo ($language == 'vi')? 'Tư vấn <br> online': 'Support <br> online'; ?></a>
<div class="support">
    <div class="group-support">
		
		
		<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
        <p class="title-support">Sales Bất Động Sản</p>
        <div id="SkypeButton_Call_sale.vinarealtor_1">
		
		 <script type="text/javascript">
		 Skype.ui({
		 "name": "chat",
		 "element": "SkypeButton_Call_sale.vinarealtor_1",
		 "participants": ["sale.vinarealtor"],
		 "imageSize": 24
		 });
		 </script>
		 </div> 
    </div>
    <div class="group-support">
        <p class="title-support">Sales Tạp Chí</p>
        <p>
            <span id="SkypeButton_Call_sale.unimedia_1">
				<script type="text/javascript">
				Skype.ui({
				"name": "chat",
				"element": "SkypeButton_Call_sale.unimedia_1",
				"participants": ["sale.unimedia"],
				"imageSize": 24
				});
				</script>
			</span> 
        </p>
    </div>
    
</div>

<?php wp_footer(); ?>
<?php if(is_front_page()): ?>
<!--<script src="<?php //echo esc_url( get_template_directory_uri() ); ?>/js/jquery.appear.js"></script>-->
<!--<script src="<?php //echo esc_url( get_template_directory_uri() ); ?>/js/custom.js"></script>-->
<?php endif; ?>
<script type="text/javascript">
        $(document).ready(function() {
            $("#support").on('click', function(){
                $("div.support").toggleClass("active");
            });
            
//            if($('#four-seasons').hasClass('fix-top')){
//                $('html, body').animate({scrollTop:$('.fix-top').position().top - 10}, 'slow');  
//            }else{
//                if($('#wrapp-details').hasClass('fix-top')){
//                    $('html, body').animate({scrollTop:$('.fix-top').position().top - 10}, 100);  
//                }
//            }
           
          $("#owl-product-carousel").owlCarousel({
                items : 5,
                itemsDesktop: [1400, 5],
                itemsDesktopSmall: [1100, 5],
                itemsTablet: [767, 2],
                itemsMobile: [480, 1],
                autoPlay: 3000,
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                pagination : false,
                paginationNumbers: false,
                //singleItem : true,
                navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                rewindNav : true,
                stopOnHover : true
          });

          $("#owl-product-carousel-first").owlCarousel({
                items : 6,
                itemsDesktop: [1400, 6],
                itemsDesktopSmall: [1100, 6],
                itemsTablet: [767, 2],
                itemsMobile: [480, 1],
                autoPlay: false,
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                pagination : false,
                paginationNumbers: false,
                //singleItem : true,
                navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                rewindNav : true,
                stopOnHover : true
          });
          
          $(".advertisement").owlCarousel({
                items : 1,
                itemsDesktop: [1400, 1],
                itemsDesktopSmall: [1100, 1],
                itemsTablet: [767, 1],
                itemsMobile: [500, 1],
                autoPlay: 4000,
                navigation : false,
                slideSpeed : 300,
                paginationSpeed : 400,
                pagination : true,
                paginationNumbers: true,
                //singleItem : true,
                navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
                rewindNav : true,
                stopOnHover : true
          });
        });
    </script>
	<?php if(wpmd_is_notdevice()): ?>
	<script type="text/javascript">
		$(document).ready(function() {
			var headerOffset = $('.navigation nav.navbar').offset().top;
			$(window).scroll(function(){
				var header = $('.navigation nav.navbar'),
					scroll = $(window).scrollTop();
				if (scroll > headerOffset){ 
					header.addClass('fixed');
				}else {
					header.removeClass('fixed');
				}
			});
		});
	</script>
	<?php endif; ?>
	
        <?php if(!wpmd_is_phone()): ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $num = 0;
                $('footer .row .border-right-footer').each(function(index, el) {
                    $height = $(this).innerHeight();
                    if($height > $num){
                    $num = $height;
                }
                });
                $('footer .row .border-right-footer').css('height', $num);
            });
        </script>
        <?php endif; ?>
</body>

</html>