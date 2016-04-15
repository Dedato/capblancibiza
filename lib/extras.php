<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);



/* ==========================================================================
   Theme Options
   ========================================================================== */

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

add_filter('acf/settings/default_language', 'my_acf_settings_default_language');
function my_acf_settings_default_language($language) {
  return 'en'; 
}
add_filter('acf/settings/current_language', 'my_acf_settings_current_language');
function my_acf_settings_current_language($language) {
  return 'en';
}


/* ==========================================================================
   Fullscreen Background
   ========================================================================== */
   
function set_vegas_background() {
  // Defaults 
  $df_bgimage           = get_field('default_background_image','option');
  $df_bgoverlay_pattern = get_field('default_background_overlay_pattern','option');
  $df_bgoverlay_opacity = get_field('default_background_overlay_opacity','option');
  // Page
  $pg_bgimage   = get_field('page_background_image');
  $pg_bgoverlay = get_field('page_background_overlay');
  // Set background image
  if(!$pg_bgimage){
    $bg_img_sm = $df_bgimage['sizes']['background-sm']; // > 768 wide
	  $bg_img_md = $df_bgimage['sizes']['background-md']; // > 1024 wide
	  $bg_img_lg = $df_bgimage['sizes']['background-lg']; // > 1280 wide
	  $bg_img_xl = $df_bgimage['sizes']['background-xl']; // > 1600 wide
  } else {
    $bg_img_sm = $pg_bgimage['sizes']['background-sm']; // > 768 wide
	  $bg_img_md = $pg_bgimage['sizes']['background-md']; // > 1024 wide
	  $bg_img_lg = $pg_bgimage['sizes']['background-lg']; // > 1280 wide
	  $bg_img_xl = $pg_bgimage['sizes']['background-xl']; // > 1600 wide
  }
  // Set background overlay
  if(!$pg_bgoverlay){
	  $bgoverlay = $df_bgoverlay_pattern;
  } else {
	  $bgoverlay = $pg_bgoverlay;
  }
  // Color Scheme
  $colorscheme  = get_field('page_color_scheme');
  if ($colorscheme) {
    $daynight = $colorscheme;
  } else {
    $daynight = get_field('default_color_scheme','option');
  }
  // Set background overlay image path
  if ($daynight == 'day')   $bgoverlayimage = get_template_directory_uri() . '/assets/img/Vegas/overlays/white/' . $bgoverlay . '.png';
  if ($daynight == 'night') $bgoverlayimage = get_template_directory_uri() . '/assets/img/Vegas/overlays/black/' . $bgoverlay . '.png';
  if ($pg_bgimage || $df_bgimage) : ?>
  <script>
	!function ($) {
		$(function() {
  		// Responsive image sizes
  		var bgimg;
      if ($(window).width() > 1400) {
      	bgimg = '<?php echo $bg_img_xl; ?>';
      } else if ($(window).width() > 1024) {
      	bgimg = '<?php echo $bg_img_lg; ?>';
      } else if ($(window).width() > 768) {
      	bgimg = '<?php echo $bg_img_md; ?>';	
      } else {
      	bgimg = '<?php echo $bg_img_sm; ?>';
      }  		
			$.vegas({src: bgimg })('overlay', {src:'<?php if($bgoverlay) { echo $bgoverlayimage; } ?>' , opacity:<?php echo $df_bgoverlay_opacity; ?> });
			<?php if (!$bgoverlay){ ?>
			  $.vegas('destroy', 'overlay');
			<?php } ?>
		});
	}(window.jQuery)
  </script>
  <?php endif;
}


/* ==========================================================================
   WPML Language Switcher
   ========================================================================== */
   
function languages_list_menu(){
  $languages = icl_get_languages('skip_missing=1&orderby=custom');
  if(!empty($languages)){
    echo '<ul id="language_list" class="flags nav navbar-nav">';
    foreach($languages as $l){
      if($l['active']) {
        echo '<li class="active"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></li>';
      } else {  
        echo '<li><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a></li>';
      }
    }
    echo '</ul>';
  }
}