<?php

namespace Elementor;

use Elementor\Videos;
use Streamlab_Core\Elementor_widgets\Custom_Post_Data;

if (!defined('ABSPATH')) exit;

class BmgVideo extends Videos
{
	public function get_name()
	{
		return __('BMG Video', 'bmg');
	}

	public function get_title()
	{
		return __('BMG Video', 'bmg');
	}

	public function get_categories()
	{
		return ['basic'];
	}

	public function get_icon()
	{
		return '';
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section',
			[
				'label' => __('Video', 'bmg'),
			]
		);

		// layout_style = banner-slider-style-1

		$this->add_control(
			'posts_per_page',
			[
				'label' => __('Posts Per Page', 'plugin-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -1,

				'step' => 1,
				'default' => 10,
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __('Order', 'streamlab-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'inherit',
				'options' => [
					'DESC' => 'DESC',
					'ASC' => 'ASC',
				],


			]
		);

		$this->add_control(
			'meta_filter',
			[
				'label' => __('Filter', 'streamlab-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '',
				'options' => [
					'none' => 'none',
					'liked' => 'Most Liked',
					'view' => 'Most Viewed',
				],


			]
		);

		$this->add_control(
			'watch_trailer',
			[
				'label' => __('Watch Traielr Text | Watch Now Text', 'streamlab-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'multiple' => false,
				'default' => 'Watch Trailer',
				'label_block' => true
			]
		);

		$this->add_control(
			'post_type',
			[
				'label' => __('Post Type', 'plugin-domain'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'video',
			]
		);

		$this->add_control(
			'show_front_image',
			[
				'label' => __('Show Front Image', 'streamlab-core'),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'yes',
				'options' => [
					'yes'  => __('yes', 'streamlab-core'),
					'no'  => __('no', 'streamlab-core'),


				]
			]
		);

		$custom_post = new Custom_Post_Data($this);

		$this->add_control(
			'post_ids',
			[
				'label' => __('Select Videos', 'streamlab-core'),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $custom_post->get_custom_post('video',  'id'),

			]
		);
		$this->add_control(
			'post_genre',
			[
				'label' => __('Select Genre', 'streamlab-core'),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $custom_post->get_taxonony('video_genre'),

			]
		);
		$this->add_control(
			'post_tag',
			[
				'label' => __('Select Tag', 'streamlab-core'),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $custom_post->get_taxonony('video_tag'),

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section__194d0c0232',
			[
				'label' => __('Slider Control', 'streamlab-core')
			]
		);
		$slider = new Slider_Controls;
		$slider->slider_control($this);


		$this->end_controls_section();
		$this->start_controls_section(
			'section_Jnza43wt8d9QH5b77duo',
			[
				'label' => __('Button 1', 'hostingo-core'),
				'condition' => ['layout_style' => ['banner-slider', 'vertical-nav-slider']]
			]
		);
		$btn = new Button_Controls();
		$btn->get_btn_1_controls($this);
		//$this->end_controls_section();

		$this->start_controls_section(
			'section_92h3f98h49g8h349f389g5h',
			[
				'label' => __('Layout', 'bmg')
			]
		);

		$this->add_control(
			'block_layout',
			[
				'label' => __('Block layout', 'bmg'),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '50_50',
				'options' => [
					'50_50'  => __('50% - 50%', 'bmg'),
					'33_66'  => __('33% - 66%', 'bmg'),
					'66_33'  => __('66% - 33%', 'bmg'),
					'25_75'  => __('25% - 75%', 'bmg'),
					'75_25'  => __('75% - 25%', 'bmg'),
				],
			]
		);

		$this->add_control(
			'bg_mask',
			[
				'label' => __('BG Mask', 'bmg'),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'default' => 'yes',
				'options' => [
					'yes' => __('Yes', 'bmg'),
					'no'  => __('No', 'bmg')
				],
				'selectors' => [
					'{{WRAPPER}} .item-bg::before' => 'display: none !important;',
				]
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => __('BG Mask color', 'bmg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-bg::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function get_layout($layout)
	{
		$result = ['6', '6'];
		switch ($layout) {
			case '33_66':
				$result = ['4', '8'];
				break;

			case '66_33':
				$result = ['8', '4'];
				break;

			case '25_75':
				$result = ['3', '9'];
				break;

			case '75_25':
				$result = ['9', '3'];
				break;

			case '50_50':
			default:
				break;
		}

		return $result;
	}

	protected function render()
	{
		$settings = $this->get_settings();
		$custom_post  = new Custom_Post_Data();
		$slider = new Slider_Controls;
		$slider->add_render_attribute($this, $settings);
		// Buid Args elementor_key  => taxonomy_name
		$args = $custom_post->build_args('video', $settings, array('post_genre' => 'video_cat',  'post_tag' => 'video_tag'));

		$wp_query = new \WP_Query($args);

		$layout = $this->get_layout($settings['block_layout']);
		require plugin_dir_path(__FILE__) . 'banner-slider-style-1.php';

		if (Plugin::$instance->editor->is_edit_mode()) {
			$slider->load_owl_js();
			$slider->load_slick_js();
		}
	}
}

Plugin::instance()->widgets_manager->register(new \Elementor\BmgVideo());
