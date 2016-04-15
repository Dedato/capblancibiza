<?php
/*
Template Name: Location
*/
?>

<div class="row">
   <div class="entry-content col-xs-12 col-md-6">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/page', 'header'); ?>
        <?php get_template_part('templates/content', 'page'); ?>
      <?php endwhile; ?>  
   </div>
   <div class="location col-xs-12 col-md-6">
      <?php
      $map = get_field('page_location_map');
      if($map):
        echo $map;
      endif; ?>			
   </div>
</div>
