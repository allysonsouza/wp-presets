<?php

namespace Presets\Modules\WooCommerce;

use Presets\Actions\ActionBase;

class GeneralSettings extends ActionBase {

	/**
	 * Get all the avaliable locations for WooCommerce and return a formated array.
	 *
	 * @return array $countries_states_list Array of locations with the location
	 *  slug as the key and the location name as the value.
	 */
	private function getLocations() {

		$wc_countries = new \WC_Countries();

		$countries = $wc_countries->get_countries();

		$countries_states_list = array();

		foreach ($countries as $country_id => $country_value) {
			$states = $wc_countries->get_states($country_id);

			if (false === $states || array() === $states) {
				$countries_states_list[ $country_id ] = $country_value;
			} else {
				foreach ($states as $state_id => $state_value) {
					$countries_states_list[ $country_id . ':' . $state_id ] = $country_value . ' - ' . $state_value;
				}
			}
		}

		return $countries_states_list;
	}

	/**
	 * Create fields for the WooCommerce general settings.
	 *
	 * @param  object $metabox The CMB2 metabox object.
	 * @param  string $group    The slug of the repeater group that has all the fields.
	 *
	 * @return void
	 */
	public function createFields($metabox, $group) {

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Store Address', 'woocommerce'),
			'type' => 'title',
			'id'   => $this->prefix . 'title-1',
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Address line 1', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_store_address'),
			'type' => 'text',
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Address line 2', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_store_address_2'),
			'type' => 'text',
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('City', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_store_city'),
			'type' => 'text',
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Country / State', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_default_country'),
			'type' => 'select',
			'show_option_none' => ' ',
			'options' => $this->getLocations(),
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Postcode / ZIP', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_store_postcode'),
			'type' => 'text',
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Currency options', 'woocommerce'),
			'type' => 'title',
			'id'   => $this->prefix . 'title-2',
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Currency', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_currency'),
			'type' => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => get_woocommerce_currencies(), // WooCommerce core function
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Currency position', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_currency_pos'),
			'type' => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => array(
				'left'        => __('Left', 'woocommerce'),
				'right'       => __('Right', 'woocommerce'),
				'left_space'  => __('Left with space', 'woocommerce'),
				'right_space' => __('Right with space', 'woocommerce'),
			),
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Thousand separator', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_price_thousand_sep'),
			'type' => 'text_small',
			'classes' => $this->field_classes,
			)
		);

		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Decimal separator', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_price_decimal_sep'),
			'type' => 'text_small',
			'classes' => $this->field_classes,
			)
		);


		$metabox->add_group_field(
			$group,
			array(
			'name' => __('Number of decimals', 'woocommerce'),
			'id'   => $this->fieldID('woocommerce_price_num_decimals'),
			'type' => 'text_small',
			'classes' => $this->field_classes,
			)
		);
	}


	/**
	 * Apply the settings to the WooCommerce settings page.
	 *
	 * @param  array $entry Preset entry with action type and action data.
	 *
	 * @return void
	 */
	public function applyAction($entry) {

		foreach ($this->fields as $field) {
			if (empty($entry[$this->prefix . $field])) {
				continue;
			}

			if (array_key_exists($this->prefix . $field, $entry)) {
				update_option($field, $entry[$this->prefix . $field]);
			}
		}
	}
}
