<?php 
// ACF values
$colorscheme  = get_field('page_color_scheme');
if ($colorscheme) {
  $daynight = $colorscheme;
} else {
  $daynight = get_field('default_color_scheme','option');
}
// Logo
if ($daynight == 'day') $logo = get_field('logo_day','option');
if ($daynight == 'night') $logo = get_field('logo_night','option');
if ($logo) {
  // Image Sizes
  $img_alt  = $logo['alt'];
  $img_md 	= $logo['sizes']['medium'];
  // Get Retina images
  if (function_exists('wr2x_get_retina')) {
  	$img_md_2x 		= wr2x_get_retina( trailingslashit( ABSPATH ) . wr2x_get_pathinfo_from_image_src($img_md) );
  	$img_md_2x_src = trailingslashit( get_site_url() ) . ltrim( str_replace( ABSPATH, "", $img_md_2x ), '/' );
  }
} ?>
<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
        <?php if ($logo) { ?>
          <img srcset="<?php if($img_md_2x){ echo $img_md_2x_src .' 2x, '; } echo $img_md .' 1x';  ?>" width="400" height="75" alt="<?php echo $img_alt; ?>">
        <?php } else {
          bloginfo('name');
        } ?>
      </a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <?php if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
      endif; ?>
      <?php do_action('icl_language_selector'); ?>
      <?php //languages_list_menu(); ?>
    </nav>
  </div>
</header>
