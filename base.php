<?php get_template_part('templates/head'); ?>
<?php
// ACF values
$colorscheme = get_field('page_color_scheme'); 
if ($colorscheme) {
  $daynight = $colorscheme;
} else {
  $daynight = get_field('default_color_scheme','option');
} 
$bodyclass = $daynight .' '. ICL_LANGUAGE_CODE;
?>
<body <?php body_class($bodyclass); ?>>
  <div id="wrap">
    <!--[if lt IE 8]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
      </div>
    <![endif]-->
    <?php
    do_action('get_header');
    get_template_part('templates/header');
    ?>
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main" role="main">
          <div class="main-inner col-xs-12">
            <?php include roots_template_path(); ?>
          </div>
        </main>
      </div>
    </div>
    <div id="push"></div>
  </div>
  <?php get_template_part('templates/footer'); ?>
  <?php wp_footer(); ?>
</body>
</html>
