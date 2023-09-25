<?php
/**
 * Health
 *
 * A template to force full-width layout, remove breadcrumbs, and remove the page title.
 *
 * Template Name: Blog
 *
 * @package Health
 * @author  Health
 * @license GPL-2.0-or-later
 * @link    https://www.health.com/
 */

add_filter( 'body_class', 'blog_body_class' );
function blog_body_class( $classes ) {
	
    $background_color = get_field('background_color');
    $classes[] = 'custom-single';
    $classes[] = 'blog-class';
    if($background_color == 'black')
       $classes[] = 'custom-single-black';
    else
       $classes[] = 'custom-single-white';
    return $classes;
	return $classes;
	
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'blog_body' );
function blog_body() {
    global $wpdb;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $settings = array(
        'posts_per_page' => 7, 
        'post_type' => 'post', 
        'orderby' => 'date', 
        'order' => 'DESC', 
        'paged' => $paged
    ); 
    $loop = new WP_Query( $settings );
  ?>
    <div class="list-single-post">
    <?php   
    if($loop->have_posts()):
        while ( $loop->have_posts() ) : $loop->the_post();
        $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-list');
        $img_thumb = '';
        $detailPost =  wp_trim_words(get_the_excerpt(), 50);
        if (has_post_thumbnail()): 
            $img_thumb = $thumb_url[0];
        else:
            $img_thumb = get_stylesheet_directory_uri()."/images/logo.png";
        endif;
    ?>
        <div class="row-list-post">
            <div class="col-list-12">
                <h2><?php echo get_the_title(); ?></h2>
                <p class="date-single-post">
                    <span><?php echo get_the_date('d').', '.get_the_date('F').' '.get_the_date('Y'); ?>  - <?php echo __('Topic of the Week')?></span>
                </p>
            </div>

            <div class="col-list-6 img-post" style="background-image: url(<?php echo  $img_thumb;?>);">
                  
            </div>

            <div class="col-list-6 padding-detail">
                <p>
                    <?php echo $detailPost;?>
                </p>
                <a class="btn btn-read" href="<?php echo get_the_permalink(); ?>">Read more </a> 
            </div>
            <div  class="col-list-12">
                <p class="line-dot-post">-----------</p>
            </div>

        </div>

<?php 
    endwhile;
endif 
;?>
        <div class="pagination-blog">
			<?php
                $big = 999999999;
                echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $loop->max_num_pages,
                'prev_text' => __( '<i class="fa fa-chevron-left"></i> Prev ', 'textdomain' ),
                'next_text' => __( 'Next <i class="fa fa-chevron-right"></i>', 'textdomain' ),
                ));
            ?>
		</div>


    </div>

  <?php
}
genesis();
