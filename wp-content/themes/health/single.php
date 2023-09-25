<?php
/**
 * This file adds the Single Post Template to any Genesis child theme.
 *
 * @author Brad Dalton
 * @link https://wpsites.net/web-design/basic-single-post-template-file-for-genesis-beginners/
 */
//* Add custom body class to the head

add_filter( 'body_class', 'single_posts_body_class' );
function single_posts_body_class( $classes ) {
   $background_color = get_field('background_color');
   $classes[] = 'custom-single';
   if($background_color == 'black')
      $classes[] = 'custom-single-black';
   else
      $classes[] = 'custom-single-white';
   return $classes;
}
add_action( 'genesis_before_header', 'view_posts' );
function view_posts() {
  ?>
  <div class="view-posts">
    <a href="<?php echo get_site_url()?>/blog"><?php echo __('View All Blogs')?></a>
  </div>
  <?php
}
remove_action('genesis_entry_content', 'genesis_do_post_content');
add_action( 'genesis_entry_content', 'custom_entry_content' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'loop_start', 'remove_entry_meta' );
function remove_entry_meta() {
if ( is_singular('post') ) {
    remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
    remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
    }
}
function custom_entry_content() {
    ?>
        <section class="single-post-page">
                <h1>
                    <?php  echo single_post_title();?>
                </h1>
                <p class="date-single-post">
                    <span><?php echo get_the_date('d').', '.get_the_date('F').' '.get_the_date('Y'); ?>  - <?php echo __('Topic of the Week')?></span>
                </p>
                <?php if (has_post_thumbnail( get_the_id() ) ): ?>
                <div class="feacture-img">
                    <?php echo get_the_post_thumbnail( get_the_id(), 'large' ); ?>
                </div>
              <?php endif; ?>

                <div class="red-social">
                <?php
                    $titleSinglePost = urlencode(rtrim(single_post_title('', false), '- ')); //urlencode(single_post_title());    
                    $twitterURL = 'https://twitter.com/intent/tweet?text='.$titleSinglePost.'&amp;url='.get_permalink().'&amp;via=Crunchify';
                    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.get_permalink();
                    $pinterestURL =  'https://pinterest.com/pin/create/button/?url='.get_permalink().'&amp;media='.get_the_post_thumbnail_url().'&amp;description='.$titleSinglePost; 
                ?>
                    <ul>
                        <li><a  href="<?php echo $facebookURL; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a  href="<?php echo $twitterURL; ?>" target="_blank" ><i class="fab fa-twitter"></i></a></li>
                        <li><a  href="<?php echo $pinterestURL; ?>" target="_blank" data-pin-custom="true" ><i class="fab fa-pinterest-p"></i></a></li>
                    </ul> 
                </div>
                <div class="content-post">
                    <?php
                        echo get_the_content();
                    ?>
                </div>
        </section>
    <?php
}
genesis();
