<?php get_header(); 
$page_id = get_queried_object_id();

?>


<?php
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id,'default-size', true);
	
?>

<body class="blanco-body" style="background-image: url(' <?php echo $thumb_url[0];  ?>');">
  <div class="black-curtain" data-ix="black-fade-home"></div>
  <a class="w-inline-block menu-icon closed" href="#" data-ix="open-menu"><img src="<?php bloginfo('template_url'); ?>/images/menu_icon1.png" width="45">
  </a>
  <div class="menu-container">
    <div class="menu-top">
      <a class="w-inline-block menu-icon" href="#" data-ix="close-menu">
      <img src="<?php bloginfo('template_url'); ?>/images/menu_icon.png" width="28">
      </a>
      <a class="w-inline-block menu-logo-link" href="home.html"><img src="<?php bloginfo('template_url'); ?>/images/Logo-Aconte.png" width="122">
      </a><a class="menu-text first" href="home.html">INICIO</a><a class="menu-text" href="blanco.html">RUM BLANCO</a><a class="menu-text" href="anejo-3.html">AÑEJO 3 AÑOS</a><a class="menu-text" href="anejo-7.html">AÑEJO 7 AÑOS</a><a class="menu-text" href="anejo-15.html">AÑEJO 15 AÑOS</a><a class="menu-text" href="puntos-de-venta/main.html">Puntos de venta</a><a class="menu-text" href="contacto.html">CONTACTO</a>
      <div class="social"><img src="<?php bloginfo('template_url'); ?>/images/social_icons.png" width="106">
      </div>
    </div>
  </div>
  <div class="w-container">
    <div class="product-center-div">
      <div class="product-top">
        <a class="w-inline-block chevron back" href="home.html" data-ix="left-arrow"></a>
        <a class="w-inline-block chevron next" href="anejo-3.html" data-ix="right-arrow"></a>
      </div>
      <div class="product-bottom">
        <div class="w-row product-row">
          <div class="w-col w-col-4 w-col-small-4 product-column" data-ix="fade-down">
            <div class="ron-blanco-name-center">
            <img src="<?php echo get_post_meta($page_id,'_image-title', true);?>" width="202">
              <div class="product-description">
				<?php 
					if ( have_posts() ) {
						while ( have_posts() ) {
							//
							the_post();
							$getPost = get_the_content();
							$postwithbreaks = wpautop( $getPost, true);
							echo $postwithbreaks;
							
						} // end while
					} // end if
				?> 
				</div>        
            </div>
          </div>
          <div class="w-col w-col-4 w-col-small-4 botella-column">
            <img class="producto-blanco" src="<?php echo get_post_meta($page_id,'_image-bottle', true);?>" data-ix="botella1">
            <a class="button comprar" href="#" data-ix="comprar-but-int"><?php echo get_post_meta($page_id,'_buy', true);?></a>
            <img class="medalla-img inside" src="<?php echo get_post_meta($page_id,'_image-award', true);?>" width="200" data-ix="sun-up">
          </div>
          <div class="w-col w-col-4 w-col-small-4 product-column" data-ix="fade-down">
            <div class="ron-blanco-des-center">
              <div class="ficha-tecnica"><?php echo get_post_meta($page_id,'_mt_data_sheet', true);?></div>
              <p class="product-sommelier"> <?php echo get_post_meta($page_id,'_ft_data_sheet', true);?>
                <br><span class="sommelier-sub"><?php echo get_post_meta($page_id,'_fd_data_sheet', true);?></span>
                <br>
                <br><?php echo get_post_meta($page_id,'_st_data_sheet', true);?>
                <br><span class="sommelier-sub"><?php echo get_post_meta($page_id,'_sd_data_sheet', true);?></span>
                <br>
                <br><?php echo get_post_meta($page_id,'_tt_data_sheet', true);?>
                <br><span class="sommelier-sub"><?php echo get_post_meta($page_id,'_td_data_sheet', true);?></span>
              </p><img class="sommelier-img" src="<?php echo get_post_meta($page_id,'_image-firm', true);?>" width="156">
              <div class="sommelier"><?php echo get_post_meta($page_id,'_firm', true);?>/div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>