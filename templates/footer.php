<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - <a href="<?php echo get_the_author_meta('user_url', 2); ?>" target="_blank"><?php echo get_the_author_meta('display_name', 2); ?></a></p>
  </div>
</footer>
<?php set_vegas_background(); ?>