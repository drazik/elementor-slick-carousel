<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Slick_Carousel_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return "slick_carousel_widget";
	}

	public function get_title() {
		return esc_html__("Slick Carousel", "elementor-addon");
	}

	public function get_icon() {
		return "eicon-code";
	}

	public function get_categories() {
		return ["basic"];
	}

	public function get_keywords() {
		return ["hello", "world"];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => esc_html__( 'Image Carousel', 'elementor' ),
			]
		);

		$this->add_control(
			'images',
			[
				'label' => esc_html__( 'Add Images', 'elementor' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'navigation_previous_icon',
			[
				'label' => esc_html__( 'Previous Arrow Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'skin_settings' => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon' => 'eicon-chevron-left',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended' => [
					'fa-regular' => [
						'arrow-alt-circle-left',
						'caret-square-left',
					],
					'fa-solid' => [
						'angle-double-left',
						'angle-left',
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'caret-left',
						'caret-square-left',
						'chevron-circle-left',
						'chevron-left',
						'long-arrow-alt-left',
					],
				],
			]
		);

		$this->add_control(
			'navigation_next_icon',
			[
				'label' => esc_html__( 'Next Arrow Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'skin_settings' => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon' => 'eicon-chevron-right',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended' => [
					'fa-regular' => [
						'arrow-alt-circle-right',
						'caret-square-right',
					],
					'fa-solid' => [
						'angle-double-right',
						'angle-right',
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'caret-right',
						'caret-square-right',
						'chevron-circle-right',
						'chevron-right',
						'long-arrow-alt-right',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slide',
			[
				'label' => esc_html__( 'Slide', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 400,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 400,
				],
				'mobile_default' => [
					'unit' => 'vh',
					'size' => 300,
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label' => esc_html__( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'tablet_default' => [
					'size' => 20,
				],
				'mobile_default' => [
					'size' => 20,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide' => 'padding-inline: calc({{SIZE}}{{UNIT}} / 2);',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_typography',
			[
				'label' => esc_html__( 'Typography', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => esc_html__( 'Arrows Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slider__control' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this-> end_controls_section();
	}

	protected function render() {
		$id = uniqid();
		$settings = $this->get_settings_for_display();
		$slides = [];

		foreach ( $settings['images'] as $index => $image ) {
			$slides[] = '<div><img src="' . esc_attr($image["url"]) . '" alt="' . esc_attr(Control_Media::get_image_alt($image)) . '" /></div>';
		}
	?>
	<div data-component="slider" class="slider" id="<?php echo $id; ?>">
		<div data-slot="slides" class="slider__slides">
			<?php echo implode('', $slides); ?>
		</div>
		<div class="slider__footer">
			<button type="button" data-slot="prevButton" class="slider__control">
				<?php $this->render_swiper_button("previous"); ?>
			</button>
			<span><span data-slot="nbSlide">1</span> / <?php echo count($slides); ?></span>
			<button type="button" data-slot="nextButton" class="slider__control">
				<?php $this->render_swiper_button("next"); ?>
			</button>
		</div>
	</div>
<script>function initSlider(id) {
	const root = $(`#${id}`)
	const slidesContainer = root.find("[data-slot='slides']")
	const prevButton = root.find("[data-slot='prevButton']")
	const nextButton = root.find("[data-slot='nextButton']")
	const nbSlide = root.find("[data-slot='nbSlide']")

	slidesContainer.on("afterChange", (e, slick) => {
		nbSlide.text(slick.currentSlide + 1)
	})

	const slider = slidesContainer.slick({
		infinite: true,
		centerMode: true,
		variableWidth: true,
		arrows: false,
	}).on("init", () => {
		console.log("init")
	})

	prevButton.on("click", (e) => {
		slidesContainer.slick("slickPrev")
	})

	nextButton.on("click", (e) => {
		slidesContainer.slick("slickNext")
	})
}

initSlider("<?php echo $id; ?>")
</script>
	<?php
	}

	private function render_swiper_button( $type ) {
		$direction = 'next' === $type ? 'right' : 'left';
		$icon_settings = $this->get_settings_for_display( 'navigation_' . $type . '_icon' );

		if ( empty( $icon_settings['value'] ) ) {
			$icon_settings = [
				'library' => 'eicons',
				'value' => 'eicon-chevron-' . $direction,
			];
		}

		Icons_Manager::render_icon( $icon_settings, [ 'aria-hidden' => 'true' ] );
	}
}
