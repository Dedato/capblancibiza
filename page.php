<div class="row">
  <div class="entry-content col-xs-12 col-md-6">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
    <?php endwhile; ?>
  </div>
  <div class="entry-image col-xs-12 col-md-6">
    <?php
    // Background
    $pg_bgimage = get_field('page_background_image');
    $df_bgimage = get_field('default_background_image','option');
    if(!$pg_bgimage){
      $bgimage = $df_bgimage;
    } else {
      $bgimage = $pg_bgimage;
    }
    // Gallery
    $gallery  = get_field('page_gallery');
    $fresco_options = "";
    $fresco_group_options = "ui: 'outside', loop: true";
    ?>
    <div class="gallery">
      <?php if ($gallery) {
        $i = 0;
        $firstimg = $gallery[0]; ?>
        <ul class="images">
          <?php foreach($gallery as $image): ?>
            <li <?php if (!$i == 0) { echo 'class="hidden"'; } ?>>
              <a class="fresco" data-fresco-options="<?php echo $fresco_options; ?>" data-fresco-group="page_gallery" data-fresco-group-options="<?php echo $fresco_group_options; ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php _e('Click for enlargement','capblanc'); ?>">
                <div class="enlarge"><i class="glyphicon glyphicon-plus"></i></div>
                <img src="<?php echo $image['sizes']['gallery-grid']; ?>" alt="<?php echo $image['alt']; ?>">
              </a>
            </li>
          <?php $i++;
          endforeach; ?>
        </ul>
      <?php } ?>
    </div>
  </div>
</div>
