<?php

namespace Presets\Modules\WooCommerce;

use Presets\Actions\ActionBase;

class GeneralSettings extends ActionBase {
	/**
     * Constructor
     */
    public function __construct() {
        add_action( 'presets_create_metabox', array( $this, 'createFields' ) );	
		add_action( 'presets_apply_meta', array( $this, 'createAction' ) );
    }

	private function getInfo($value) {

		$info = array();

		$this->info['slug'] = 'woocommerce-general-settings';
		$this->info['name'] = __( '[WooCommerce] General Settings', 'presets' );
		$this->info['description'] = 'General Settings for WooCommerce';

		return $this->info[$value];
	}

	private function getLocations() {

		$wc_countries = new WC_Countries();

		$countries = $wc_countries->get_countries();
	
		$countries_states_list = array();
	
		foreach ( $countries as $country_id => $country_value ) {
	
			$states = $wc_countries->get_states( $country_id );
	
			if ( false === $states || array() === $states ) {
	
				$countries_states_list[ $country_id ] = $country_value;
	
			} else {
	
				foreach ( $states as $state_id => $state_value ) {
	
					$countries_states_list[ $country_id . ':' . $state_id ] = $country_value . ' - ' . $state_value;
	
				}
			}
		}
	
		return $countries_states_list;
	
	}

	public function createFields() {

		$prefix_meta = 'presets_' . $this->getInfo('slug');

		/**
		 * Initiate the metabox
		 */
		$cmb = new_cmb2_box(
			array(
				'id'           => $prefix_meta . 'metabox',
				'title'        => $this->getInfo('name'),
				'object_types' => array( 'presets' ), // Post type
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Store Address', 'woocommerce' ),
				'type' => 'title',
				'id'   => $prefix_meta . 'title-1',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Address line 1', 'woocommerce' ),
				'id'   => $prefix_meta . 'woocommerce_store_address',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Address line 2', 'woocommerce' ),
				'id'   => $prefix_meta . 'woocommerce_store_address_2',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'City', 'woocommerce' ),
				'id'   => $prefix_meta . 'woocommerce_store_city',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name'             => __( 'Country / State', 'woocommerce' ),
				'id'               => $prefix_meta . 'woocommerce_default_country',
				'type'             => 'select',
				'show_option_none' => ' ',
				'default'          => 'custom',
				'options'          => $this->getLocations(),
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Postcode / ZIP', 'woocommerce' ),
				'id'   => $prefix_meta . 'woocommerce_store_postcode',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Currency options', 'woocommerce' ),
				'type' => 'title',
				'id'   => $prefix_meta . 'title-2',
			)
		);

		$cmb->add_field(
			array(
				'name'             => __( 'Currency', 'woocommerce' ),
				'id'               => $prefix_meta . 'woocommerce_currency',
				'type'             => 'select',
				'show_option_none' => ' ',
				'default'          => 'custom',
				'options'          => get_woocommerce_currencies(), // WooCommerce function that returns full list of currency symbols and names - https://woocommerce.github.io/code-reference/namespaces/default.html#function_get_woocommerce_currencies
			)
		);

		$cmb->add_field(
			array(
				'name'             => __( 'Currency position', 'woocommerce' ),
				'id'               => $prefix_meta . 'woocommerce_currency_pos',
				'type'             => 'select',
				'show_option_none' => ' ',
				'default'          => 'custom',
				'options'          => array(
					'left'        => __( 'Left', 'woocommerce' ),
					'right'       => __( 'Right', 'woocommerce' ),
					'left_space'  => __( 'Left with space', 'woocommerce' ),
					'right_space' => __( 'Right with space', 'woocommerce' ),
				),
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Thousand separator', 'woocommerce' ),
				'id'   => $prefix_meta . 'woocommerce_price_thousand_sep',
				'type' => 'text_small',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Decimal separator', 'woocommerce' ),
				'id'   => $prefix_meta . 'woocommerce_price_decimal_sep',
				'type' => 'text_small',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Number of decimals', 'woocommerce' ),
				'id'   => $prefix_meta . 'woocommerce_price_num_decimals',
				'type' => 'text_small',
			)
		);
	}

	public function createAction() {

		$prefix = $this->getInfo('slug');

		$fields = array(
			'woocommerce_store_address',
			'woocommerce_store_address_2',
			'woocommerce_store_city',
			'woocommerce_default_country',
			'woocommerce_store_postcode',
			'woocommerce_currency',
			'woocommerce_currency_pos',
			'woocommerce_price_thousand_sep',
			'woocommerce_price_decimal_sep',
			'woocommerce_price_num_decimals',
		);

		foreach ( $fields as $field ) {

			$meta = get_presets_meta( $prefix, $field );

			if ( array_key_exists( 'presets_' . $prefix . $field, get_presets_meta() ) ) {

				update_option( $field, $meta );

			}
		}
	}
}