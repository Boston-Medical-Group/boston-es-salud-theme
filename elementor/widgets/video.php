<?php

namespace Bmg\Elementor;

use Elementor\Videos;

if ( ! defined( 'ABSPATH' ) ) exit;

class Video extends Videos {
	public function get_name() {
		return __('BMG Video', 'bmg');
	}

	public function get_title() {
		return __('BMG Video', 'bmg');
	}

	public function get_categories() {
		return ['basic'];
	}

	public function get_icon() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section',
			[
				'label' => __( 'Video', 'bmg' ),
			]
		);

	}
}
