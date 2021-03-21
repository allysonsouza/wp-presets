<?php

$prefix_meta = $prefix . 'core_user_';

/**
 * Initiate the metabox
 */
$cmb = new_cmb2_box( array(
    'id'            => $prefix_meta . 'metabox',
    'title'         => __( '[Core] Current user', 'wppresets' ),
    'object_types'  => array( 'wppresets', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
) ); 

$cmb->add_field( array(
	'name'    => __( 'First Name', 'wppresets' ),
	'id'      => $prefix_meta . 'first_name',
	'type'    => 'text',
) );

$cmb->add_field( array(
	'name'    => __( 'Last Name', 'wppresets' ),
	'id'      => $prefix_meta . 'last_name',
	'type'    => 'text',
) );

$cmb->add_field( array(
	'name'    => __( 'Display Name', 'wppresets' ),
	'id'      => $prefix_meta . 'display_name',
	'type'    => 'text',
) );

$cmb->add_field( array(
	'name' => __( 'Website', 'wppresets' ),
	'id'   => $prefix_meta . 'user_url',
	'type' => 'text_url',
) );

$cmb->add_field( array(
	'name' => __( 'Email', 'wppresets' ),
	'id'   => $prefix_meta . 'user_email',
	'type' => 'text_email',
) );

$cmb->add_field( array(
	'name' => __( 'Bio', 'wppresets' ),
	'id' => $prefix_meta . 'description',
	'type' => 'textarea'
) );