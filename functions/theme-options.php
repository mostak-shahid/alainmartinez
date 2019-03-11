<?php


    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "mosacademy_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        //'display_name'         => $theme->get( 'Name' ),
        'display_name'         => 'Mos Academy',
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null, //number or null 0 te dashboard er upore
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => 'dashicons-smiley', //dash icon or directly image link
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/mostak-shahid/',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/mosacademybd/',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://twitter.com/mostak_shahid',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.linkedin.com/in/mdmostakshahid/',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */




    // -> Add options here

    
    //Logo Settings
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Logo Settings', 'redux-framework-demo' ),
        'id'               => 'logo-settings',
        'desc' => "<div class='redux-info-field'><h3>".__('Welcome to Mos Academy Options', 'redux-framework-demo')."</h3>
        <p>".__('This theme was developed by', 'redux-framework-demo')." <a href=\"https://github.com/mostak-shahid/\" target=\"_blank\">Md. Mostak Shahid</a></p></div>",
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-dashboard',
        'fields'     => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                'subtitle' => __( 'Upload your logo here.', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_template_directory_uri().'/images/logo.png' ),
            ),
            array(
                'id'       => 'logo-option',
                'type'     => 'radio',
                'title'    => __( 'Logo option for large devices', 'redux-framework-demo' ),
                'options'  => array(
                    'logo' => 'Logo',
                    'title' => 'Title and Description'
                ),
                'default'  => 'title'
            )
        )
    ) );
    //Logo Settings
    //Basic Styling
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Basic Styling', 'redux-framework-demo' ),
        'id'               => 'basic-styling',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-art',
        'fields'     => array(            
            array(
                'id'       => 'basic-styling-stylesheet',
                'type'     => 'select',
                'title'    => __( 'Theme Skin Stylesheet', 'redux-framework-demo' ),
                'subtitle' => __( 'Note* changes made in options panel will override this stylesheet. Example: Colors set in typography.', 'redux-framework-demo' ),
                'options'  => array( 
                    'default' => 'default.css', 
                    'orange' => 'orange.css', 
                    'red' => 'red.css', 
                    'green' => 'green.css', 
                ),
                'default'  => 'default',
            ),
            array(
                'id'       => 'basic-styling-link-color',
                'type'     => 'link_color',
                'title'    => __( 'Links Color', 'redux-framework-demo' ),
                'output'   => array('a'),
            ),
        )
    ) );
    //Basic Styling     
    //General Page  
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General Page', 'redux-framework-demo' ),
        'id'               => 'general-page',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-admin-page',
        'fields'     => array(
            array(
                'id'       => 'general-page-layout',
                'type'     => 'image_select',
                'title'    => __( 'General Page Layout', 'redux-framework-demo' ),
                'options'  => array(
                    'ns' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'ls' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'rs' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'ns'
            ),
            array(
                'id'       => 'page-layout-settings',
                'type'     => 'sorter',
                'title'    => 'General Page Layout',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => array(),
                    'Disabled' => array(
                        'about' => "About",
                        'team' => "Team",
                        'investment' => "Investment",
                    ),
                ),
            ),
        )
    ) );
    //General Page 
    
    //Home Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Home Page', 'redux-framework-demo' ),
        'id'               => 'home',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'     => array(
            array(
                'id'       => 'home-layout-settings',
                'type'     => 'sorter',
                'title'    => 'Home Page Layout',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => array(
                        'banner' => 'Banner',
                        'feature' => 'Featured Work',
                        'blog' => 'Blog',
                    ),
                    'Disabled' => array(
                        'about' => "About",
                        'team' => "Team",
                        'investment' => "Investment",
                    )
                ),
            ),

        )
    ) );   

    
    
    //Contact Info   
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact Info', 'redux-framework-demo' ),
        'id'               => 'contact-section',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'fa fa-address-card',
        'fields'     => array(
            array(
                'id'        => 'contact-phone',
                'type'      => 'multi_text',
                'title'     => __( 'Phone', 'redux-framework-demo' ),
                'desc'      => __( '<b>Example:</b> 00 0000 0000', 'redux-framework-demo' ),                
                'validate' => 'no_html',
            ),
            array(
                'id'        => 'contact-fax',
                'type'      => 'multi_text',
                'title'     => __( 'Fax', 'redux-framework-demo' ),
                'desc'      => __( '<b>Example:</b> 00 0000 0000', 'redux-framework-demo' ),                
                'validate' => 'no_html',
            ),
            array(
                'id'        => 'contact-email',
                'type'      => 'multi_text',
                'title'     => __( 'Email', 'redux-framework-demo' ),
                'default'   => '',
                'desc'     => '<b>Example:</b> example@domain.com',
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'contact-hour',
                'type'     => 'multi_text',
                'title'    => __( 'Business Hours', 'redux-framework-demo' ),
                'subtitle'       => __( 'You can use span tag ( &lt;span&gt;&lt;/span&gt; ) here.', 'redux-framework-demo' ),
                'desc'     => __( '<b>Example:</b> 6.30am - 6pm <span>(Mon-Fri)</span>', 'redux-framework-demo' ),
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'          => 'contact-address',
                'type'        => 'mos_address',
                'title'       => __( 'Contact Address', 'redux-framework-demo' ),           
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'map_link' => true,
                    'review_link' => false,
                    'review_link_img' => false,
                    'review_link_img_h' => false,
                    'target' => false,
                )
            ),
            array(
                'id'          => 'contact-social',
                'type'        => 'mos_social',
                //'type'        => 'kad_icons',
                'title'       => __( 'Social Media', 'redux-framework-demo' ),             
                'show' => array(
                    'title' => true,
                    'basic_icon' => true,
                    'hover_icon' => true,
                    'link_url' => true,
                    'target' => true,
                )
            ),
        )
    ) );
    //Contact Section




    //Misc Settings
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Misc Settings', 'redux-framework-demo' ),
        'id'               => 'misc-settings',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-css',
    ) );
    //Scripting
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Scripting', 'redux-framework-demo' ),
        'id'               => 'misc-scripting',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-settings-css',
                'type'     => 'ace_editor',
                'title'    => __( 'CSS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                //'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_mosacademy">' . 'http://' . 'ace.c9.io/</a>.',
                //'default'  => "body{\n   margin: 0 auto;\n}"
            ),
            array(
                'id'       => 'misc-settings-js',
                'type'     => 'ace_editor',
                'title'    => __( 'JS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your JS code here.', 'redux-framework-demo' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                //'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_mosacademy">' . 'http://' . 'ace.c9.io/</a>.',
                //'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
        )
    ) );
    //Page Loader
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Loader', 'redux-framework-demo' ),
        'id'               => 'misc-loader',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-page-loader',
                'type'     => 'switch',
                'title'    => __( 'Page Loader Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you want to use the page loader', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'misc-page-loader-image',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Page Loader image', 'redux-framework-demo' ),
                'compiler' => 'true'
            ),
            array(
                'id'       => 'misc-page-loader-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Footer Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'misc-page-loader-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'misc-page-loader-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Footer Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'misc-page-loader-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'misc-page-loader-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),
                'required' => array( 'misc-page-loader-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'misc-page-loader-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'misc-page-loader-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'misc-page-loader-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );
    //Back to Top
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Back to Top', 'redux-framework-demo' ),
        'id'               => 'misc-btt',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-back-top',
                'type'     => 'switch',
                'title'    => __( 'Back to Top Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you want to use the back to top', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
        )
    ) );
	//MISC

    //Page Sections
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Sections', 'redux-framework-demo' ),
        'id'               => 'sections',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-adjust-alt'
    ) );
    //Header Section 
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header Section', 'redux-framework-demo' ),
        'id'               => 'header-section',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-header-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#main-header .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-header-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#main-header .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'sections-header-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#main-header .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'header-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',    
                'default'   => array(
                    'color'     => '#000000',
                    'alpha'     => .5
                ),
                'output' => array('background-color' => '.navbar-custom-bg')
            )

        )
    ) );    
    //Page Title Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Title Section', 'redux-framework-demo' ),
        'id'               => 'sections-title',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'             => 'sections-title-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#page-title .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-title-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#page-title .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),         
            array(
                'id'       => 'sections-title-border',
                'type'     => 'border',
                'title'    => __( 'Page Title Border', 'redux-framework-demo' ),
                'output'   => array( '#page-title .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-title-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Page Title Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-title-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-title-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Page Title Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-title-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-title-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Page Title Background', 'redux-framework-demo' ),
                'required' => array( 'sections-title-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-title-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Page Title Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-title-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-title-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );
    //Breadcrumbs Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Breadcrumbs Section', 'redux-framework-demo' ),
        'id'               => 'sections-breadcrumbs',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-breadcrumbs-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-breadcrumbs .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-breadcrumbs-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-breadcrumbs .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-breadcrumbs-border',
                'type'     => 'border',
                'title'    => __( 'Breadcrumbs Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-breadcrumbs .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-breadcrumbs-title',
                'type'     => 'text',
                'title'    => __( 'Breadcrumbs Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-breadcrumbs-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            
            array(
                'id'       => 'sections-breadcrumbs-option',
                'type'     => 'switch',
                'title'    => __( 'Breadcrumbs', 'redux-framework-demo' ),
                //'options' => array('on', 'off'),
                'default'  => false,
            ),

            array(
                'id'       => 'sections-breadcrumbs-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Breadcrumbs Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-breadcrumbs-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Breadcrumbs Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-breadcrumbs-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Breadcrumbs Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-breadcrumbs-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Breadcrumbs Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-breadcrumbs-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-breadcrumbs-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );  
    //Baner Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Banner Section', 'redux-framework-demo' ),
        'id'               => 'sections-banner',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-banner-select',
                'type'     => 'select',
                'title'    => __( 'Choose a Home Image Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'If you don\'t want an image slider on your home page choose none.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'banner' => 'Banner',
                    'carousel' => 'Carousel Slider',
                    'shortcode' => 'From Shortcode',
                ),
                'default'  => 'banner'
            ),
            array(
                'id'          => 'sections-banner-details',
                'type'        => 'mos_slides',
                'title'       => __( 'Slider Images', 'redux-framework-demo' ),
                'subtitle'    => __( 'Use large images (Max Width 1920px) for best results.', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'link_title' => true,
                    'link_url' => true,
                    'target' => true,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'link_title'         => __( 'Link Title', 'redux-framework-demo' ),
                    'url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                ),
                'required' => array( 'sections-banner-select', '!=', 'shortcode' ),
            ),            
            array(
                'id'       => 'sections-banner-shortcode',
                'type'     => 'text',
                'title'    => __( 'Shortcode', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'default'  => 'No HTML is allowed in here.',
                'required' => array( 'sections-banner-select', '=', 'shortcode' ),
            ),
        )
    ) );    
    //Content Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Content Section', 'redux-framework-demo' ),
        'id'               => 'sections-content',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'             => 'sections-content-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '.page-content .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-content-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '.page-content .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),         
            array(
                'id'       => 'sections-content-border',
                'type'     => 'border',
                'title'    => __( 'Content Border', 'redux-framework-demo' ),
                'output'   => array( '.page-content .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-content-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Content Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-content-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-content-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Content Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-content-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-content-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Content Background', 'redux-framework-demo' ),
                'required' => array( 'sections-content-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-content-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Content Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-content-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-content-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) ); 

    //Featured Work
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Featured Work', 'redux-framework-demo' ),
        'id'               => 'sections-feature',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-feature-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-feature .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-feature-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-feature .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-feature-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-feature .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'          => 'sections-feature-slides',
                'type'        => 'mos_slides',
                'title'       => __( 'Featere Details', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => false,
                    'link_title' => true,
                    'link_url' => true,
                    'target' => true,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'link_title'         => __( 'Date', 'redux-framework-demo' ),
                    'url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                )
            ),
            array(
                'id'       => 'sections-feature-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-feature-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-feature-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'output'   => array( '#section-feature' ),
            )
        )
    ) );  

    //Blog Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Section', 'redux-framework-demo' ),
        'id'               => 'sections-blog',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-blog-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-blog .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-blog-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-blog .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-blog-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-blog .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-blog-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-blog-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),       
            array(
                'id'       => 'sections-blog-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
            ),
        )
    ) );  
    //About Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'About Section', 'redux-framework-demo' ),
        'id'               => 'sections-about',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-about-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-about .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-about-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-about .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-about-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-about .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-about-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-about-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'teeny'         => false,
                )
            ),
            array(
                'id'       => 'sections-about-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
            ),
        )
    ) );  

    //Team Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Team Section', 'redux-framework-demo' ),
        'id'               => 'sections-team',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-team-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-team .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-team-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-team .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-team-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-team .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-team-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-team-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'teeny'         => false,
                )
            ),
            array(
                'id'       => 'sections-team-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
            ),
        )
    ) );  
    //Investment Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Investment Section', 'redux-framework-demo' ),
        'id'               => 'sections-investment',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-investment-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-investment .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-investment-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-investment .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-investment-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-investment .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-investment-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-investment-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'teeny'         => false,
                )
            ),
            array(
                'id'       => 'sections-investment-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
            ),
        )
    ) );  

    //Gallery Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Basic Gallery', 'redux-framework-demo' ),
        'id'               => 'sections-gallery',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'             => 'sections-gallery-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-gallery .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-gallery-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-gallery .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),       
            array(
                'id'       => 'sections-gallery-border',
                'type'     => 'border',
                'title'    => __( 'Gallery Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-gallery .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-gallery-title',
                'type'     => 'text',
                'title'    => __( 'Gallery Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-gallery-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-gallery-images',
                'type'     => 'gallery',
                'title'    => __( 'Add/Edit Gallery', 'redux-framework-demo' ),                
            ),
            array(
                'id'            => 'sections-gallery-count',
                'type'          => 'slider',
                'title'         => __( 'Max number of images to show', 'redux-framework-demo' ),
                'subtitle'      => __( 'Set more than 1 for slider.', 'redux-framework-demo' ),
                'desc'          => __( 'Slider description. Min: 1, max: 30, step: 1, default value: 3', 'redux-framework-demo' ),
                'default'       => 3,
                'min'           => 1,
                'step'          => 1,
                'max'           => 30,
                'display_value' => 'label'
            ),
            array(
                'id'       => 'sections-gallery-layout',
                'type'     => 'image_select',
                'title'    => __( 'Gallery Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '3'
            ),

            array(
                'id'       => 'sections-gallery-small-size',
                'type'     => 'mos_group',                
                'title'    => 'Each Image Size',
                'show' => array (
                    'text_field_1' => true,
                    'text_field_2' => true,
                ),
                'placeholder' => array(
                   'text_field_1' => 'Image Width',
                   'text_field_2' => 'Image Hwight',
                )
            ),

            array(
                'id'       => 'sections-gallery-large-size',
                'type'     => 'select',
                'title'    => __( 'Large Image Size', 'redux-framework-demo' ),
                'desc'     => __( 'Select an option.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'actual' => __( 'Actual Size', 'redux-framework-demo' ),
                    'max'   => __( 'Max Size (Width 1920px)', 'redux-framework-demo' ),
                    'container'     => __( 'Container Size (Width 1140px)', 'redux-framework-demo' ),
                ),
                'actual'  => '2'
            ),
            array(
                'id'       => 'sections-gallery-view',
                'type'     => 'select',
                'title'    => __( 'Gallery View', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'grid' => 'Grid',
                    'slider' => 'Slider',
                    
                ),
                'default'  => 'grid'
            ), 
            array(
                'id'       => 'sections-gallery-gap',
                'type'     => 'checkbox',
                'title'    => __( 'Grid Spacing', 'redux-framework-demo' ),                
                'options'  => array(
                    '1' => 'Yes I like to use gap between grids.',
                ),
            ),  
            array(
                'id'       => 'sections-gallery-zoom',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Zoom Icon', 'redux-framework-demo' ),
                'compiler' => 'true',                
                'default'  => array( 'url' => get_template_directory_uri() . '/images/plus.png' ),
            ), 
            array(
                'id'       => 'sections-gallery-view-more',
                'type'     => 'mos_group',                
                'title'    => 'View More Link(if any)',
                'show' => array (
                    'text_field_1' => true,
                    'text_field_2' => true,
                    'text_field_3' => true,
                    'text_field_4' => true,
                ),
                'placeholder' => array(
                   'text_field_1' => 'Text',
                   'text_field_2' => 'URL',
                   'text_field_3' => 'Container Class',
                   'text_field_4' => 'Link Class',
                )
            ),  
            array(
                'id'       => 'sections-gallery-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Gallery Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-gallery-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-gallery-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Gallery Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-gallery-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-gallery-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Gallery Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-gallery-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-gallery-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Gallery Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-gallery-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-gallery-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );        
    //New Gallery Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Advanced Gallery', 'redux-framework-demo' ),
        'id'               => 'sections-newgallery',
        'desc'             => '',
        'customizer_width' => '450px',
        'subsection' => true,
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'             => 'sections-newgallery-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-newgallery .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-newgallery-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-newgallery .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-newgallery-border',
                'type'     => 'border',
                'title'    => __( 'New Gallery Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-newgallery .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-newgallery-title',
                'type'     => 'text',
                'title'    => __( 'New Gallery Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-newgallery-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-newgallery-zoom',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Zoom Image', 'redux-framework-demo' ),
                'compiler' => 'true',
                'default'  => array( 'url' => get_template_directory_uri() . '/images/zoom.png' ),
            ),
            array(
                'id'       => 'sections-newgallery-gallery',
                'type'     => 'gallery',
                'title'    => __( 'Add/Edit Gallery', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'sections-newgallery-large-size',
                'type'     => 'select',
                'title'    => __( 'Large Image Size', 'redux-framework-demo' ),
                'desc'     => __( 'Select an option.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'actual' => __( 'Actual Size', 'redux-framework-demo' ),
                    'max'   => __( 'Max Size (Width 1920px)', 'redux-framework-demo' ),
                    'container'     => __( 'Container Size (Width 1140px)', 'redux-framework-demo' ),
                ),
                'default'  => 'max',
            ),
            array(
                'id'       => 'sections-newgallery-gap',
                'type'     => 'checkbox',
                'title'    => __( 'Grid Spacing', 'redux-framework-demo' ),                
                'options'  => array(
                    '1' => 'Yes I like to use gap between grids.',
                ),
            ), 
            array(
                'id'      => 'sections-newgallery-layout',
                'type'    => 'select_image',
                'title'   => __( 'Gallery Layout', 'redux-framework-demo' ),
                'options' => array(
                    array(
                        'alt' => 'Layout 2',
                        'img' => ReduxFramework::$_url . '../sample/presets/gallery-template-2.jpg',
                    ),
                ),
                'default' => ReduxFramework::$_url . '../sample/presets/gallery-template-2.jpg',
            ),
            array(
                'id'       => 'sections-newgallery-url',
                'type'     => 'text',
                'title'    => __( 'View More Link(if any)', 'redux-framework-demo' ),
                'validate'     => 'no_html',
            ),
            array(
                'id'       => 'sections-newgallery-background-type',
                'type'     => 'button_set',
                'title'    => __( 'New Gallery Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-newgallery-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-newgallery-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'New Gallery Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-newgallery-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-newgallery-background-solid',
                'type'     => 'background',                
                'title'    => __( 'New Gallery Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-newgallery-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-newgallery-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'New Gallery Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-newgallery-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-newgallery-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );  
    //Widgets Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Widgets Section', 'redux-framework-demo' ),
        'id'               => 'sections-widgets',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'             => 'sections-widgets-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-widgets .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-widgets-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-widgets .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),       
            array(
                'id'       => 'sections-widgets-border',
                'type'     => 'border',
                'title'    => __( 'Widgets Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-widgets .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-widgets-title',
                'type'     => 'text',
                'title'    => __( 'Widgets Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-widgets-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-widgets-layout',
                'type'     => 'image_select',
                'title'    => __( 'Widgets Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => 'One Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => 'Two Columns',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => 'Three Columns',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => 'Four Columns',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '3'
            ), 
            array(
                'id'       => 'sections-widgets-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Widgets Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-widgets-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-widgets-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Widgets Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-widgets-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-widgets-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Widgets Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-widgets-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-widgets-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Widgets Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-widgets-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-widgets-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) ); 
    //Footer Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer Section', 'redux-framework-demo' ),
        'id'               => 'sections-footer',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'             => 'sections-footer-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#footer .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-footer-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#footer .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-footer-border',
                'type'     => 'border',
                'title'    => __( 'Footer Section Border', 'redux-framework-demo' ),
                'output'   => array( '#footer .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-footer-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                //'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'desc'     => __( 'All HTML will be stripped.', 'redux-framework-demo' ),
                'validate' => 'no_html',
            ),
            array(
                'id'      => 'sections-footer-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-footer-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Footer Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-footer-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-footer-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Footer Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-footer-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-footer-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-footer-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-footer-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-footer-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-footer-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );     	

	/*
    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
	*/
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a mosacademy section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
/*    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }*/

