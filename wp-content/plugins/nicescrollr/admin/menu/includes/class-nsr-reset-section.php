<?php

/**
 * If this file is called directly, abort.
 */
if( ! defined('WPINC')) {
	die;
}

/**
 * The class that represents the "reset section" within the plugin options tab.
 *
 * @link              https://github.com/demispatti/nicescrollr
 * @since             0.1.0
 * @package           nicescrollr
 * @subpackage        nicescrollr/admin/menu/includes
 * Author:            Demis Patti <demis@demispatti.ch>
 * Author URI:        http://demispatti.ch
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
class nsr_reset_section {

	/**
	 * The domain of the plugin.
	 *
	 * @since  0.1.0
	 *
	 * @access private
	 *
	 * @var string $domain
	 */
	private $domain;

	/**
	 * Assigns the required parameter to its instance.
	 *
	 * @since 0.1.0
	 *
	 * @param $plugin_domain
	 *
	 * @return void
	 */
	public function __construct($domain) {

		$this->domain = $domain;
	}

	/**
	 * Echoes the html that defines the reset area and its content.
	 *
	 * @since  0.1.0
	 * @uses   get_section_heading()
	 * @uses   get_table()
	 * @return void / echo string $html
	 */
	public function echo_section($view) {

		$html = $this->get_section_heading();
		$html .= $this->get_table($view);

		echo $html;
	}

	/**
	 * Returns the html that defines the heading of the reset area.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return string $html
	 */
	private function get_section_heading() {

		return '<h2 class="reset nicescrollr_settings_toggle"><i class="fa fa-sliders" aria-hidden="true"></i>' . __('Reset Settings', $this->domain) . '</h2>';
	}

	/**
	 * Returns the html that defines the content of the reset area.
	 *
	 * @since  0.1.0
	 * @uses   reset_buttons()
	 * @access private
	 * @return string $html
	 */
	private function get_table($view) {

		$args = $this->get_reset_button_args($view);

		return $this->create_table($args);
	}

	/**
	 * Returns the meta data for the reset buttons.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return array $reset_buttons
	 */
	private function get_reset_button_args($view) {

		if('frontend' === $view) {

			return array(
				'id' => 'reset_frontend',
				'class' => 'nsr-reset-button',
				'name' => __('Reset Frontend', $this->domain),
				'title' => __('Resets the settings for the frontend.', $this->domain),
			);
		}

		return array(
			'id' => 'reset_backend',
			'class' => 'nsr-reset-button',
			'name' => __('Reset Backend', $this->domain),
			'title' => __('Resets the settings for the backend.', $this->domain),
		);
	}

	private function create_table($args) {

		$html = '<table class="form-table reset-panel" style="display: inline-block;">';
		$html .= '<tbody>';

		$nonce = wp_create_nonce($args['id'] . '_nonce');

		$html .= '<tr>';
		$html .= '<th>' . $args['name'] . '</th>';
		$html .= '<td>';
		$html .= '<div class="form-table-td-wrap">';
		$html .= '<p class="nsr-input-container">';
		$html .= '<a name="' . $args['id'] . '" id="' . $args['id'] . '" class="button button-secondary dp-button float-left ' . $args['class'] . '" title="' . $args['title'] . '" data-nonce="' . $nonce . '">' . __('Reset', $this->domain) . '</a>';
		$html .= '</p>';
		$html .= '</div>';
		$html .= '</td>';
		$html .= '</tr>';

		$html .= '</tbody>';
		$html .= '</table>';

		return $html;
	}

}
