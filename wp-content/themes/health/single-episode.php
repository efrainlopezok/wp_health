<?php

remove_action('genesis_entry_content', 'genesis_do_post_content');
add_action( 'genesis_entry_content', 'custom_entry_content' ); // Add custom loop

function custom_entry_content() {
   ?>
<div class="wrap-top">

   <?php
   $img_single = get_the_post_thumbnail_url(get_the_id(), 'full');
   if ($img_single !== '') {
      $img_single = $img_single;
   }else{
      $img_single = get_site_url().'/wp-content/themes/health/images/home-bkg.jpg';
   }
   ?>
   <div class="one-half first episode-main-image" style="background-image: url('<?php echo $img_single; ?>')">
   </div>
   <div class="text-content one-half first episode-main-content"
      style="background-image: url('<?php echo get_site_url().'/wp-content/themes/health/images/episode-bkg.jpg' ?>')">
      <a class="link-view" href="<?php echo get_home_url() ?>">View All Episodies</a>
      <?php
   $info_episode = get_field( 'information_episode' );
   if ($info_episode['number_episode'] != '' ) {
      echo "<h4>".$info_episode['number_episode']."</h4>";
   } ?>
      <h2><?php the_title(); ?></h2>
      <?php the_content(); ?>
      <!-- Big Spinner -->
      <div class="main-spinner">
         <div class="main-spinner-content">
            <img class="main-spinner1" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-1.png" alt="">
            <img class="main-spinner2 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-2.png"
               alt="">
            <img class="main-spinner3 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-3.png"
               alt="">
            <img class="main-spinner4 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-4.png"
               alt="">
            <img class="main-spinner5 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-5.png"
               alt="">
         </div>
      </div>
      <!-- End Big Spinner -->
   </div>
   <div class="clearfix"></div>
</div>
<div class="wrap-bottom">
   <div class="audio-box one-half first">
      <div class="second-spinner" data-sr-id="12"
         style="; visibility: visible;  -webkit-transform: scale(1); opacity: 1;transform: scale(1); opacity: 1;-webkit-transition: -webkit-transform 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: transform 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; ">
         <div class="second-spinner-content">
            <img class="second-spinner1" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-1@2x.png"
               alt="">
            <img class="second-spinner2 animated"
               src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-2@2x.png" alt="">
            <img class="second-spinne3 animated"
               src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-3@2x.png" alt="">
            <img class="second-spinne4 animated"
               src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-4@2x.png" alt="">
            <img class="second-spinne5 animated"
               src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-5@2x.png" alt="">
         </div>
      </div>
      <!-- Audio -->
      <div class="content-iframe">
            <?php  echo $info_episode['audio_iframe']; ?>
      </div>
      <a target="_blank" href="http://ice55.securenetsystems.net/DASH76" class="custom-link"  ><h2>Listen to Live Stream <i class="fa fa-podcast" aria-hidden="true"></i></h2></a>
      <!-- <div class="wavesurfer-block">
         <?php $info_episode = get_field( 'information_episode' ); ?>
         <div class="controls">
            <button type="button" class="actions btn play wavesurfer-play"></button>
            <button class="btn wavesurfer-back">
               <i class="fa fa-undo" aria-hidden="true"></i>
            </button>
         </div>

         <div class="wavesurfer-player" data-wave-color="violet" data-progress-color="purple"
            data-url="<?php echo $info_episode['single_audio']['url'] ?>?dl=0" data-height="128">
         </div>
         
         <div class="wavesurfer-time"></div>
         <div class="wavesurfer-duration"></div>
      </div> -->
      <!-- Audio -->
   </div>
   <div class="cta-action one-half first">
      <div class="prev-next-links">
         <?php
      if ( $prev = get_previous_post() ) {
         $prev_ex_con = ( $prev->post_content ) ? $prev->post_content : strip_shortcodes( $prev->post_content );
         $prev_text = wp_trim_words( apply_filters( 'the_content', $prev_ex_con ), 10 );
         $info_episode = get_field( 'information_episode' , $prev->ID);
         ?>
         <div class="prev-box">
            <span><?php echo previous_post_link( '%link','UP PREV' ); ?></span>
            <?php
               if ($info_episode['number_episode'] != '' ) {
                  echo "<p>".$info_episode['number_episode']."</p>";
               }
               echo $prev_text;
            ?>
         </div>
         <?php
         }
         if ( $next = get_next_post() ) {
            $next_ex_con = ( $next->post_content ) ? $next->post_content : strip_shortcodes( $next->post_content );
            $next_text = wp_trim_words( apply_filters( 'the_content', $next_ex_con ), 10 );
            $info_episode = get_field( 'information_episode' , $next->ID);
            ?>
         <div class="next-box">
            <span><?php echo next_post_link( '%link','UP NEXT' ); ?>  </span>
            <?php
               if ($info_episode['number_episode'] != '' ) {
                  echo "<p>".$info_episode['number_episode']."</p>";
               }
               echo $next_text;
            ?>
         </div>
         <?php
      }
      ?>
      </div>
      <div class="arrows">
         <?php
               
            if(!next_post_link('')){
               previous_post_link( '%link','<div class="next"></div>' );
               next_post_link( '%link','<div class="prev"></div>' );
            }else{
               next_post_link( '%link','<div class="next"></div>' );
               previous_post_link( '%link','<div class="prev"></div>' );
            }
         ?>
      </div>
   </div>
</div>
<?php
   }

   //* Remove .site-inner
   add_filter( 'genesis_markup_site-inner', '__return_null' );
   // add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
   add_filter( 'genesis_markup_content', '__return_null' );

   //* Remove the entry title (requires HTML5 theme support)
   remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

   //* Remove the entry header markup (requires HTML5 theme support)
   remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
   remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

   //* Remove the entry meta in the entry header (requires HTML5 theme support)
   remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

   genesis();
   ?>