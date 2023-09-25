<?php
/**
 * Health
 *
 * A template to force full-width layout, remove breadcrumbs, and remove the page title.
 *
 * Template Name: Home
 *
 * @package Health
 * @author  Health
 * @license GPL-2.0-or-later
 * @link    https://www.health.com/
 */

// Removes the entry header markup and page title.
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_before_header', 'section_left' );
add_filter( 'genesis_after_header', 'section_right' );
add_filter( 'genesis_before_footer', 'section_left_footer' );
add_filter( 'genesis_after_footer', 'section_right_footer' );
// add_filter( 'genesis_before_content_sidebar_wrap', 'splash_animate' );
//get ACFs
function section_left(){
    $latitud=get_field('latitude');
  ?>
    <div class="left-header">
      <img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/loadr.png" alt="">
      <div class="lati-info p-s flex">
        <img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/rectanglesxd.png" alt="">
        <div>
          <span>LATITUDE</span>
          <p><?php  echo  $latitud; ?></p>

        </div>

      </div>
    </div>
  <?php
}
function section_right(){
  ?>
    <div class="righr-header">
        <img  src="<?php  echo get_stylesheet_directory_uri(); ?>/images/imgr.png" alt="">
        <div class="date">
            <span id="weekDay" class="weekDay"></span>,
            <span id="day" class="day"></span> de
            <span id="month" class="month"></span> del
            <span id="year" class="year"></span>
        </div>
        <div class="clock">
            <span id="hours" class="hours"></span> :
            <span id="minutes" class="minutes"></span> :
            <span id="seconds" class="seconds"></span>
        </div>
    </div>

    <script>
                      var udateTime = function() {
                    let currentDate = new Date(),
                        hours = currentDate.getHours(),
                        minutes = currentDate.getMinutes(),
                        seconds = currentDate.getSeconds(),
                        weekDay = currentDate.getDay(),
                        day = currentDate.getDay(),
                        month = currentDate.getMonth(),
                        year = currentDate.getFullYear();

                    const weekDays = [
                        'Domingo',
                        'Lunes',
                        'Martes',
                        'Miércoles',
                        'Jueves',
                        'Viernes',
                        'Sabado'
                    ];

                    document.getElementById('weekDay').textContent = weekDays[weekDay];
                    document.getElementById('day').textContent = day;

                    const months = [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ];

                    document.getElementById('month').textContent = months[month];
                    document.getElementById('year').textContent = year;

                    document.getElementById('hours').textContent = hours;

                    if (minutes < 10) {
                        minutes = "0" + minutes
                    }

                    if (seconds < 10) {
                        seconds = "0" + seconds
                    }

                    document.getElementById('minutes').textContent = minutes;
                    document.getElementById('seconds').textContent = seconds;
                };

                udateTime();

                setInterval(udateTime, 1000);
    </script>
    <!-- Big Spinner -->
    <div class="main-spinner">
          <div class="main-spinner-content">
              <img class="main-spinner1" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-1.png" alt="">
              <img class="main-spinner2 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-2.png" alt="">
              <img class="main-spinner3 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-3.png" alt="">
              <img class="main-spinner4 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-4.png" alt="">
              <img class="main-spinner5 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-5.png" alt="">
          </div>
    </div>
      <!-- End Big Spinner -->
  <?php
}
function section_left_footer(){
  ?>
    <div class="second-spinner" data-sr-id="12" style="; visibility: visible;  -webkit-transform: scale(0.7); opacity: 1;transform: scale(0.7); opacity: 1;-webkit-transition: -webkit-transform 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: transform 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; ">
        <div class="second-spinner-content">
            <img class="second-spinner1" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-1@2x.png" alt="">
            <img class="second-spinner2 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-2@2x.png" alt="">
            <img class="second-spinne3 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-3@2x.png" alt="">
            <img class="second-spinne4 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-4@2x.png" alt="">
            <img class="second-spinne5 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-5@2x.png" alt="">
        </div>
    </div>
    <!-- <div class="line-y">
      <div class="line-x"></div>
    </div> -->
  <?php
}
function section_right_footer(){
  $longitude=get_field('longitude');
  ?>
    <div class="lati-info t-a-r">
      <ul class="circles">
        <li class="c1"></li>
        <li class="c2"></li>
        <li class="c3"></li>
        <li class="c4"></li>
      </ul>
      <span>LONGITUDE</span>
      <p><?php  echo  $longitude; ?></p>
    </div>
  <?php
}

// Removes the breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_loop', 'home_body' );
function home_body() {

  $settings = array(
    'showposts' => -1, 
    'post_type' => 'episode', 
    'post_status' => 'publish', 
    'orderby' => 'menu_order', 
    'order' => 'ASC', 

  ); 
  $loop = new WP_Query( $settings );
  if($loop->have_posts()):
    $countLine = 0;
    $time_line_future = array();
    while ( $loop->have_posts() ) : $loop->the_post();
      $real_title=get_the_title();
      $info_episode = get_field( 'information_episode' );
      $time_line_future[$countLine]['title'] = get_the_title();//$info_episode['number_episode'];
      $time_line_future[$countLine]['date'] = get_the_date('M')." ".get_the_date('d').", ".get_the_date('Y');
      $time_line_future[$countLine]['url'] = get_the_permalink();
      $countLine++;
    endwhile;wp_reset_query();
  endif;
  ?> 
    <div class="slider-tl no-index">
          <?php
              while (count($time_line_future)>0) {
          
          ?> 
          <div class="home-main-content">
            <div class="content-tl ">
              <div class="time-live-l">
                  <div class="line"></div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                  <div class="points-3" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont">
                        <div class="info ">
                        <span>
                          <?php   
                            if ($removed['title']==null) {
                                echo "Coming Soon";

                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                          ?></span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                        </div>
                    </div>
                  </div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                  <div class="points-2" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont dow">
                        <div class="info">
                        <span>
                        <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                        ?></span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                        </div>
                    </div>
                  </div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                  <div class="points-1" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont">
                      <div class="info">
                        <span>
                        <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                          ?>  
                        </span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="home-logo">
                <img src="<?php  echo get_field('main_logo'); ?>" />
              </div>

              <div class="time-live-r">
                  <div class="line"></div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                <div class="points-1 rh" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont">
                        <div class="info">
                        <span>
                        <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                        ?>
                        </span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                        </div>
                    </div>
                  </div>
                  <?php  $removed = array_shift($time_line_future); 
                    
                  ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                  <div class="points-2 rh" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont dow">
                        <div class="info">
                        <span>
                          <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                          ?>
                        </span>
                        <p><?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                        </div>
                    </div>
                  </div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                <div class="points-3 rh" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont">
                        <div class="info">
                        <span>
                          <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                          ?>
                        </span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                        </div>
                    </div>
                  </div>
              </div>
            </div>

          </div>
          <?php
          }
          ?>
    </div>
    
          <!-- slider numero 2 -->

          <?php  
            if($loop->have_posts()):
              $countLine = 0;
              $time_line_future = array();
              while ( $loop->have_posts() ) : $loop->the_post();
                $info_episode = get_field( 'information_episode' );
                $time_line_future[$countLine]['title'] = get_the_title();// $info_episode['number_episode'];
                $time_line_future[$countLine]['date'] = get_the_date('M')." ".get_the_date('d').", ".get_the_date('Y');
                $time_line_future[$countLine]['url'] = get_the_permalink();
                $countLine++;
              endwhile;wp_reset_query();
            endif;
          ?>
          <div class="slider-tl responsive-slider no-index">
<?php
              while (count($time_line_future)>0) {
          
          ?> 
          <div class="home-main-content">
          
            <div class="content-tl ">
              <div class="time-live-l">
                  <div class="line"></div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                  <div class="points-3" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont">
                        <div class="info">
                        <span>
                          <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                          ?></span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                        </div>
                    </div>
                  </div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                  <div class="points-2" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont dow">
                        <div class="info">
                        <span>
                        <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                        ?></span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                        </div>
                    </div>
                  </div>
                  <?php  $removed = array_shift($time_line_future); ?>
                  <?php   
                    if ($removed['url']==null) {
                      $url_post= "#";
                    }else{
                      $url_post =$removed['url'];
                    }
                  ?>
                  <div class="points-1" onclick="redirectPage('<?php echo $url_post; ?>');">
                    <div class="line-dont">
                      <div class="info">
                        <span>
                        <?php   
                            if ($removed['title']==null) {
                              echo "Coming Soon";
                            }else{
                              echo  wp_trim_words($removed['title'], 2);// $removed['title'];
                              ?>
                              <strong class="tooltiptext"><?php echo $removed['title']; ?></strong>
                             
                              <?php
                            }
                          ?>  
                        </span>
                        <p>
                          <?php   
                            if ($removed['date']==null) {
                              echo "New Episode";
                            }else{
                              echo $removed['date'];
                            }
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="home-logo">
                <img src="<?php  echo get_field('main_logo'); ?>" />
              </div>
            </div>
            

          </div>
          <?php
          }
          ?>
          </div>


<script>
  jQuery(document).ready(function() {
      jQuery('.slider-timeline').slick({
        autoplay: true,
        autoplaySpeed: 2100,
        arrows:true,
        fade:true,
        nextArrow: '<div class="slick-img-arrow next-slick"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-l.png" alt=""></div>',
        prevArrow: '<div class="slick-img-arrow prev-slick"><img src="<?php echo get_stylesheet_directory_uri();?>/images/arrow-r.png" alt=""></div>'
      });
  });
  jQuery(window).load(function () {
     setTimeout(function(){
       jQuery('.slider-tl').removeClass('no-index');
     }, 5000);
  });
</script>
 <?php
}

// Runs the Genesis loop.
genesis();
