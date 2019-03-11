<?php
function mosacademy_metaboxes() {
    $prefix = '_mosacademy_';

	$post_gallery_details = new_cmb2_box(array(
        'id' => $prefix . 'post_gallery_details',
        'title' => __('Gallery Details', 'cmb2'),
        'object_types' => array('post'),
        //'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template/lightbox-gallery-page.php' ),
    )); 
    $post_gallery_details->add_field( array(
        'name' => 'Each image width',
        'id'   => $prefix . 'post_image_width',
        'type' => 'text_number',
    ));
    $post_gallery_details->add_field( array(
        'name' => 'Each image height',
        'id'   => $prefix . 'post_image_height',
        'type' => 'text_number',
    ));
    $post_gallery_details->add_field( array(
        'name' => 'Item per page',
        'id'   => $prefix . 'post_image_per_page',
        'type' => 'text_number',
    ));
    $post_gallery_details->add_field( array(
        'name'             => 'Large Image Size',
        'desc'             => 'Select an option',
        'id'               => $prefix . 'post_large_image_size',
        'type'             => 'select',
        'default'          => 'container',
        'options'          => array(
            'actual' => __( 'Actual Size', 'cmb2' ),
            'max'   => __( 'Max Size (Width 1920px)', 'cmb2' ),
            'container'     => __( 'Container Size (Width 1140px)', 'cmb2' ),
        ),
    ) );
    $post_gallery_details->add_field( array( 
        'name' => __('Gallery Layout', 'cmb2'), 
        'id' => $prefix . 'post_gallery_layout', 
        'type' => 'select', 
        'default'          => '6',
        'options'          => array(
            '6' => __( 'Two Column', 'cmb2' ),
            '4'   => __( 'Three Column', 'cmb2' ),
            '3'     => __( 'Four Column', 'cmb2' ),
        ),
    ));      
    $post_gallery_details->add_field(array(
        'name' => 'Gallery Images',
        'desc' => '',
        'id'   => $prefix.'post_gallery_images',
        'type' => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    ));


	$gallery_details = new_cmb2_box(array(
        'id' => $prefix . 'gallery_details',
        'title' => __('Gallery Details', 'cmb2'),
        'object_types' => array('page'),
        //'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template/lightbox-gallery-page.php' ),
    )); 
    $gallery_details->add_field( array(
        'name' => 'Each image width',
        'id'   => $prefix . 'image_width',
        'type' => 'text_number',
    ));
    $gallery_details->add_field( array(
        'name' => 'Each image height',
        'id'   => $prefix . 'image_height',
        'type' => 'text_number',
    ));
    $gallery_details->add_field( array(
        'name'             => 'Large Image Size',
        'desc'             => 'Select an option',
        'id'               => $prefix . 'large_image_size',
        'type'             => 'select',
        'default'          => 'container',
        'options'          => array(
            'actual' => __( 'Actual Size', 'cmb2' ),
            'max'   => __( 'Max Size (Width 1920px)', 'cmb2' ),
            'container'     => __( 'Container Size (Width 1140px)', 'cmb2' ),
        ),
    ) );
    $gallery_details->add_field( array( 
        'name' => __('Gallery Layout', 'cmb2'), 
        'id' => $prefix . 'gallery_layout', 
        'type' => 'select', 
        'default'          => '6',
        'options'          => array(
            '6' => __( 'Two Column', 'cmb2' ),
            '4'   => __( 'Three Column', 'cmb2' ),
            '3'     => __( 'Four Column', 'cmb2' ),
        ),
    )); 
    $gallery_details->add_field( array(
        'name' => 'Item per page',
        'id'   => $prefix . 'image_per_page',
        'type' => 'text_number',
    ));     
    $gallery_details->add_field(array(
        'name' => 'Gallery Images',
        'desc' => '',
        'id'   => $prefix.'gallery_images',
        'type' => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    ));

    $link_gallery_details = new_cmb2_box(array(
        'id'           => $prefix . 'link_gallery_details',
        'title'        => 'Gallery Details',
        'object_types' => array( 'page' ),
        //'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template/link-gallery-page.php' ),
        'context'      => 'normal',
        'priority'     => 'default'
    )); 
    $link_gallery_details->add_field( array( 
        'name' => __('Gallery Layout', 'cmb2'), 
        'id' => $prefix . 'link_gallery_layout', 
        'type' => 'select', 
        'default'          => '6',
        'options'          => array(
            '6' => __( 'Two Column', 'cmb2' ),
            '4'   => __( 'Three Column', 'cmb2' ),
            '3'     => __( 'Four Column', 'cmb2' ),
        ),
    ));    
    $link_gallery_details->add_field( array(
        'name' => 'Each image width',
        'id'   => $prefix . 'link_image_width',
        'type' => 'text_number',
    ));
    $link_gallery_details->add_field( array(
        'name' => 'Each image height',
        'id'   => $prefix . 'link_image_height',
        'type' => 'text_number',
    )); 
    $link_gallery_details->add_field( array(
        'name' => 'Item per page',
        'id'   => $prefix . 'link_image_per_page',
        'type' => 'text_number',
    )); 

    $link_gallery_details_id = $link_gallery_details->add_field( array(
        'id'   => $prefix . 'link_gallery_details_group',
        'type' => 'group',
    ));

    $link_gallery_details->add_group_field( $link_gallery_details_id, array(
        'name' => 'Gallery Image Text',
        'id'   => $prefix . 'link_gallery_details_text',
        'type' => 'text',
    ));

    $link_gallery_details->add_group_field( $link_gallery_details_id, array(
        'name' => 'Gallery Image URL',
        'id'   => $prefix . 'link_gallery_details_url',
        'type' => 'text_url',
    ));

    $link_gallery_details->add_group_field( $link_gallery_details_id, array(
        'name'    => 'Gallery Image',
        'desc'    => 'Upload an image or enter an URL.',
        'id'      => $prefix . 'link_gallery_details_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        // 'query_args' => array(
        //     'type' => 'application/pdf', // Make library only display PDFs.
        // ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));

}
add_action('cmb2_admin_init', 'mosacademy_metaboxes');