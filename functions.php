<?php
show_admin_bar( false );
require_once('functions/theme-functions.php');
require_once('functions/scripts.php');
require_once('functions/setup.php');
require_once('functions/shortcodes.php');
require_once('functions/widgets.php');
require_once('functions/custom-comments.php');

require_once('inc/theme-options/ReduxCore/framework.php'); 
//require_once('inc/theme-options/sample/sample-config.php');
require_once('functions/theme-options.php');
require_once('inc/theme-options/loader.php');

require_once('inc/metabox/init.php'); 
require_once('inc/metabox/custom-cmb2-fields.php'); 
require_once('functions/metaboxes.php'); 

require_once('functions/aq_resizer.php');
require_once('functions/Mobile_Detect.php');
require_once('functions/bs4navwalker.php');
require_once('functions/breadcrumb.php');
if (version_compare($GLOBALS['wp_version'], '5.0-beta', '>')) {    
    // WP > 5 beta
    add_filter('use_block_editor_for_post_type', '__return_false', 100);    
} else {    
    // WP < 5 beta
    add_filter('gutenberg_can_edit_post_type', '__return_false');    
}