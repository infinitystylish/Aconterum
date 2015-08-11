<?php
    function registerScriptsStyles() {
       /*global style*/
       //wp_enqueue_style( 'global-font', 'http://fonts.googleapis.com/css?family=Raleway:400,800' );
       wp_enqueue_style( 'normalize', get_stylesheet_directory_uri().'/css/normalize.css' );
       wp_enqueue_style( 'webflow-css', get_stylesheet_directory_uri().'/css/webflow.css' );
       wp_enqueue_style( 'aconterum-webflow-css', get_stylesheet_directory_uri().'/css/aconterum.webflow.css' );
       wp_enqueue_style( 'global-css', get_stylesheet_directory_uri().'/css/aconterum.global.css' );
       /*global script*/
       wp_enqueue_script( 'script-jquery', 'https://code.jquery.com/jquery-1.11.3.min.js', array(), '1.0.0', true );
       wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri().'/js/modernizr.js', array(), '1.0.0', true );
       wp_enqueue_script( 'webflow-js', get_stylesheet_directory_uri().'/js/webflow.js', array(), '1.0.0', true );
       //wp_enqueue_script( 'script-bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array(), '1.0.0', true );
       wp_enqueue_script( 'webfont-js', 'https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js', array(), '1.0.0', true );
    }

    add_action( 'wp_enqueue_scripts', 'registerScriptsStyles' );

    add_theme_support( 'post-thumbnails' );

    // Our custom post type function
    function create_posttype_ron() {

      register_post_type( 'ron',
      // CPT Options
        array(
          'labels' => array(
            'name' => __( 'Ron' ),
            'singular_name' => __( 'Ron' )
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'ron'),
          'capability_type'    => 'post',
          'menu_position'      => null,
          'supports'           => array( 'title', 'editor', 'thumbnail')

        )
      );
    }
    // Hooking up our function to theme setup
    add_action( 'init', 'create_posttype_ron' );



    function my_enqueue($hook) {       
      wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri().'/js/admin-script.js', array('jquery'), '1.0.0', true);
    }

    add_action( 'admin_enqueue_scripts', 'my_enqueue' );



    function meta_box_images($post,$name)
    {

        $name = $name['args'][0];
        $img_url = get_post_meta( $post->ID, '_image-'.$name, true );
        $distintive = 'image-'.$name;
        $distintive_img = 'img-image-'.$name;

    ?>
         <input name="<?php echo $distintive; ?>" class="<?php echo $distintive; ?>" type="hidden" value='<?php if(isset($img_url)){ echo $img_url; } ?>'>
         <img style="max-width: 100%; height: auto;" class="<?php echo $distintive_img; ?>" src="<?php echo $img_url; ?>" alt="">
         <?php  
         if(empty($img_url)){

          ?>
          <a class="add-title-image general" href="#"> Asignar imagen destacada</a>

          <?php
          }
          else{
            ?>
          <a class="remove-title-image general" href="#"> Quitar imagen destacada</a>
          <?php 
          }
    }

    function meta_box_image_title($post,$name)
    {
        meta_box_images($post,$name);    
    }

    function meta_box_image_bottle($post,$name)
    {
        meta_box_images($post,$name);
         
    }

    function meta_box_image_award($post,$name)
    {
        meta_box_images($post,$name);
         
    }
    
    function add_custom_meta_box()
    {
        add_meta_box("meta-box", "Title image", "meta_box_image_title", "ron", "side", "low", array('title'));
        add_meta_box("meta-box_bottle", "Bottle image", "meta_box_image_bottle", "ron", "side", "low", array('bottle'));
        add_meta_box("meta-box_award", "Award image", "meta_box_image_award", "ron", "side", "low", array('award'));

    }
     
    add_action("add_meta_boxes", "add_custom_meta_box");



    function meta_box_data_sheet($post)
    {
        ?>

           <label>Título principal</label>
          <p>
            <input type="text" name="mt_data_sheet" value="<?php echo esc_attr( get_post_meta( $post->ID, '_mt_data_sheet', true ) ); ?>" />
          </p>

          <label>Primer titulo</label>
          <p>
            <input type="text" name="ft_data_sheet" value="<?php echo esc_attr( get_post_meta( $post->ID, '_ft_data_sheet', true ) ); ?>" />
          </p>
          <label>Primer descripción</label>
          <p>
            <textarea name="fd_data_sheet" class="vista" rows="3" cols="60"><?php echo esc_attr( get_post_meta( $post->ID, '_fd_data_sheet', true ) ); ?></textarea> 
          </p>
          
          <label>Segundo titulo</label>
          <p>
            <input type="text" name="st_data_sheet" value="<?php echo esc_attr( get_post_meta( $post->ID, '_st_data_sheet', true ) ); ?>" />
          </p>
          <label>Segunda descripción</label>
          <p>
            <textarea name="sd_data_sheet" class="olfato" rows="3" cols="60"><?php echo esc_attr( get_post_meta( $post->ID, '_sd_data_sheet', true ) ); ?></textarea> 
          </p>
          

          <label>Tercer titulo</label>
          <p>
            <input type="text" name="tt_data_sheet" value="<?php echo esc_attr( get_post_meta( $post->ID, '_tt_data_sheet', true ) ); ?>" />
          </p>
          <label>Tercer descripción</label>
          <p>
            <textarea name="td_data_sheet" class="sabor" rows="3" cols="60"><?php echo esc_attr( get_post_meta( $post->ID, '_td_data_sheet', true ) ); ?></textarea> 
          </p>
          
        <?php 

    }

    function add_mb_data_sheet()
    {
        add_meta_box("meta-box-data-sheet", "Ficha Técnica", "meta_box_data_sheet", "ron", "normal", "low", null);
    }
     
    add_action("add_meta_boxes", "add_mb_data_sheet");


    function meta_box_buy($post)
    {
        ?>
           <label>Titulo comprar</label>
          <p>
            <input type="text" name="buy" value="<?php echo esc_attr( get_post_meta( $post->ID, '_buy', true ) ); ?>" />
          </p>
          
        <?php 

    }


    function add_buy()
    {
        add_meta_box("meta-box-buy", "Comprar", "meta_box_buy", "ron", "normal", "low", null);
    }
     
    add_action("add_meta_boxes", "add_buy");


    function meta_box_firm($post)
    { 
        $img_url = get_post_meta( $post->ID, '_image-firm', true );
        ?> 
          <p>
            <input name="image-firm" class="image-firm" type="hidden" value='<?php if(isset($img_url)){ echo $img_url; } ?>'>
          </p>
          <p>
            <img style="max-width: 100%; height: auto;" class="img-image-firm" src="<?php echo $img_url; ?>" alt="">
          </p>
           <?php  
         if(empty($img_url)){

          ?>
          <p>
            <a class="add-title-image firm" href="#"> Asignar imagen destacada</a>
          </p>
          <?php
          }
          else{
            ?>
          <p>
            <a class="remove-title-image firm" href="#"> Quitar imagen destacada</a>
          </p>
          <?php 
          }
          ?>

           <label>Nombre</label>
          <p>
            <input type="text" name="firm" value="<?php echo esc_attr( get_post_meta( $post->ID, '_firm', true ) ); ?>" />
          </p>
          
        <?php 

    }


    function add_firm()
    {
        add_meta_box("meta-box-firm", "Firma", "meta_box_firm", "ron", "normal", "low", null);
    }
     
    add_action("add_meta_boxes", "add_firm");




    function save_metabox( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
      }

      $meta_box_array = 
      array(
       'image-title',
       'image-bottle',
       'image-award',
       'mt_data_sheet',
       'ft_data_sheet',
       'st_data_sheet',
       'tt_data_sheet',
       'fd_data_sheet',
       'sd_data_sheet',
       'td_data_sheet',
       'buy',
       'image-firm',
       'firm'
       );
      

      foreach ($meta_box_array as $key => $value) {
         if ( isset( $_POST[$value] ) ) {
          update_post_meta( $post_id, '_'.$value, strip_tags( $_POST[$value] ) );
        }
      }


    }

    add_action('save_post', 'save_metabox');



    

   


?>