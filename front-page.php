<?php 
global $mosacademy_options;
$sections = $mosacademy_options['home-layout-settings']['Enabled'];
?>
<?php get_header(); ?>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer(); ?>