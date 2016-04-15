<?php
/*
Template Name: Gallery
*/
?>

<div class="row">
  <div class="entry-content col-xs-12">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
      <?php 
      // Gallery
      $gallery  = get_field('page_gallery');
      $fresco_options = "";
      $fresco_group_options = "ui: 'outside', loop: true";
      if ($gallery) {
        $i = 0;
        $firstimg = $gallery[0]; ?>
        <div class="gallery">
          <ul class="images row">
            <?php foreach($gallery as $image): ?>
              <li class="col-xs-6 col-sm-2">
                <a class="fresco" data-fresco-options="<?php echo $fresco_options; ?>" data-fresco-group="page_gallery" data-fresco-group-options="<?php echo $fresco_group_options; ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php _e('Click for enlargement','capblanc'); ?>">
                  <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>">
                </a>
              </li>
            <?php $i++;
            endforeach; ?>
          </ul>
        </div>  
      <?php } ?>
    <?php endwhile; ?>  
  </div>
</div>
