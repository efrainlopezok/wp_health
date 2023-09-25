
var $ = jQuery.noConflict();

// Init table for storing wavesurfer objects
var wavesurfer = [];
var markers = [];

// On Document Ready and Ajax Complete
$(document).on('ready', function() { // NOTE :  ajaxComplete
   // Play And pause icon
   jQuery(".audio-box .actions").click(function() {
      if (jQuery(this).hasClass("play")) {

         jQuery(this).removeClass("play");
         jQuery(this).addClass("pause");
      } else {
         jQuery(this).addClass("play");
         jQuery(this).removeClass("pause");
      }
   });

   if ($('#wavesurfer-player-0').find('canvas').length === 0) {
      WaveSurferInit();
   }
});
// On Document Ready and Ajax Complete
jQuery(document).on('ready', function() { // NOTE :  ajaxComplete
   jQuery('.slider-tl').slick({
         dots: false,
         infinite: true,
         speed: 300,
         fade:true,
         slidesToShow: 1,
         adaptiveHeight: true,
         prevArrow: '<i class="fa fa-angle-left prev1"></i>',
         nextArrow: '<i class="fa fa-angle-right next1"></i>',
    });
   jQuery('.responsive-slider').slick({
         dots: false,
         infinite: true,
         speed: 300,
         fade:true,
         slidesToShow: 1,
         adaptiveHeight: true,
         prevArrow: '<i class="fa fa-angle-left prev1"></i>',
         nextArrow: '<i class="fa fa-angle-right next1"></i>',
    });
});

$(document).on(' ready wavesurfer-wp-init wavesurfer-markers-init', function() { // 
   MarkerInit();
});
/* FUNCTIONS */

// WaveSurfer Init
function WaveSurferInit() {

   // Loop in each wavesurfer block
   $('.wavesurfer-block').each(function(i) {

      // Get WaveSurfer block for datas attribute
      var container = $(this).children('.wavesurfer-player');
      var split = container.data('split-channels');

      // Wavesurfer block object
      var object = this;

      var hash = container.data('hash');

      init(i, container, object, hash, split);

   }); // End loop in each wavesurfer-block

} // End function WaveSurferInit

function init(i, container, object) {

   // Text selector for the player
   var selector = '#wavesurfer-player-' + i;

   // Add unique ID to WaveSurfer Block
   container.attr('id', 'wavesurfer-player-' + i);

   // Get data attribute
   var file_url = container.data('url');

   // Init and Control
   var options = {
      container: selector,
      waveColor: '#707070',
      progressColor: '#5CFFBA',
      cursorWidth: 0,
      backend: 'MediaElement',
      barWidth: 2,
   };

   // Create WaveSurfer object
   wavesurfer[i] = WaveSurfer.create(options);

   // File
   wavesurfer[i].load(file_url);

   // Responsive Waveform
   $(window).resize(function() {
      wavesurfer[i].drawer.containerWidth = wavesurfer[i].drawer.container.clientWidth;
      wavesurfer[i].drawBuffer();
   });


   // Timecode blocks
   var timeblock = $(object).find('.wavesurfer-time');
   var duration = $(object).find('.wavesurfer-duration');

   // Controls Definition
   var buttonPlay = $(object).find('button.wavesurfer-play');
   var buttonBack = $(object).find('button.wavesurfer-back');
   var progressBar = $(object).find('progress');

   wavesurfer[i].on('error', function() {
      progressBar.hide();
   });

   // Timecode during Play
   wavesurfer[i].on('audioprocess', function() {
      var current_time = wavesurfer[i].getCurrentTime();
      timeblock.html(secondsTimeSpanToMS(current_time));
      $.each(markers[i], function(i) {
         if (current_time >= this.time_start && current_time <= this.time_end) {
            $(this.dom).addClass("wavesurfer-marker-current");
         } else {
            $(this.dom).removeClass("wavesurfer-marker-current");
         }
      });
   });

   // Timecode and duration at Ready
   wavesurfer[i].on('ready', function() {
      progressBar.hide();
      var audio_duration = wavesurfer[i].getDuration();
      duration.html(secondsTimeSpanToMS(audio_duration));
      var current_time = wavesurfer[i].getCurrentTime();
      timeblock.html(secondsTimeSpanToMS(current_time));
   });

   // Timecode during pause + seek
   wavesurfer[i].on('seek', function() {
      var current_time = wavesurfer[i].getCurrentTime();
      timeblock.html(secondsTimeSpanToMS(current_time));
   });

   // Controls Functions
   buttonPlay.click(function() {
      wavesurfer[i].playPause();
   });

   buttonBack.click(function() {
      wavesurfer[i].skipBackward();
   });
}

// Convert seconds into MS
function secondsTimeSpanToMS(s) {
   var m = Math.floor(s / 60); //Get remaining minutes
   s -= m * 60;
   s = Math.floor(s);
   return (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s : s); //zero padding on minutes and seconds
} // End secondsTimeSpanToMS

// Pause the other players if Play is pressed on a player
function PauseOtherPlayers(wavesurfer, i) {
   $.each(wavesurfer, function(j) {
      if (wavesurfer[j].isPlaying() && j != i) {
         wavesurfer[j].playPause();
      }
   });

}

// Set Button to Pause
function SetPauseButton(object) {
   $(object).removeClass('wavesurfer-active-button');

   $(object).addClass('wavesurfer-paused-button');

   $(object).children('span').text(wavesurfer_localize.resume);
}

$('.wavesurfer-marker').click(function(event) {
   //event.preventDefault(); // Useful if links. Links can help TAB naivgation.
   var time_start = $(this).data('start');
   var time_stop = $(this).data('stop');
   if (time_stop !== undefined) {
      var time_end = $(this).data('end');
   } else {
      var time_end = 0;
   }
   var id = $(this).data('id');
   if (id >= 1) {
      id = id - 1;
   } else {
      id = 0;
   }
   time_start = TimeCodeToSeconds(time_start);
   time_end = TimeCodeToSeconds(time_end);
   var autoplay = $(this).data('autoplay');
   if (autoplay === false) {
      wavesurfer[id].seekTo(time_start / wavesurfer[id].getDuration());
   } else {
      PauseOtherPlayers(wavesurfer, id);
      wavesurfer[id].play(time_start, time_end);
   }
});

function MarkerInit() {
   $('.wavesurfer-marker').each(function(i) {
      var time_start = $(this).data('start');
      var time_end = $(this).data('end');
      var id = $(this).data('id');
      if (id >= 1) {
         id = id - 1;
      } else {
         id = 0;
      }
      marker = {};
      marker.time_start = time_start;
      marker.time_end = time_end;
      marker.dom = this;
      if (typeof(markers[id]) === 'undefined') {
         markers[id] = [];
      }
      markers[id].push(marker);
   });
}

function TimeCodeToSeconds(value) {
   if (typeof value === 'number') return value;
   var time_array = value.split(':');
   time_array = time_array.reverse();
   time_array[0] = time_array[0].replace(',', '.');

   var multiply = [1, 60, 3600, 86400];
   var seconds = 0;
   for (i = 0; i < time_array.length; i++) {
      seconds = time_array[i] * multiply[i] + seconds;
   }

   return seconds;
}


function redirectPage(url){
   window.location.href = url;
}