<?php global $mosacademy_options ?>
  <?php get_template_part( 'template-parts/section', 'widgets' ); ?>
  <footer id="footer">
    <div class="content-wrap">
      <div class="container">
        <?php echo do_shortcode( $mosacademy_options['sections-footer-content'] ); ?>
      </div>
    </div>
  </footer>
<?php wp_footer(); ?> 
</body>
</html>