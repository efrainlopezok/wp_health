<?php
/**
 * Health
 *
 * A template to force full-width layout, remove breadcrumbs, and remove the page title.
 *
 * Template Name: About
 *
 * @package Health
 * @author  Health
 * @license GPL-2.0-or-later
 * @link    https://www.health.com/
 */


remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'about_body' );
function about_body() {
  $small_title_1 = get_field('small_title_1');
  $title_1 = get_field('title_1');
  $content_1 = get_field('content_1');
  $small_title_2 = get_field('small_title_2');
  $title_2 = get_field('title_2');
  $content_2 = get_field('content_2');
  ?>
  <section class="entry-content section-content" itemprop="text">
    <h5 style="color:#ffffff;text-align:center" class="has-text-color has-small-font-size small-text"><?php echo $small_title_1?></h5>
    <h2 style="text-align:center"><strong><?php echo $title_1;?></strong></h2>
    <?php echo do_shortcode( $content_1 );?>
</section>
<section class="detail-page">

<!-- img-h.png -->
    <div class="row-div">
    <div class="div-col-3">
        <img src="<?php echo get_stylesheet_directory_uri()?>/images/img-h.png" alt="">
    </div>
    <div class="div-col-8 div-padding">
        <h5 class="small-text">
            <?php echo $small_title_2?>
        </h5>
        <h3>
            <?php echo $title_2?>
        </h3>
          <?php echo do_shortcode( $content_2 );?>
    </div>
    </div>



</section>
  <?php
}

genesis();
