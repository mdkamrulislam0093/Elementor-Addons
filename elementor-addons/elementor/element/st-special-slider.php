<?php 

namespace elementor;




// Slider

class st_tabs_slider extends Widget_Base {

	public function get_name(){

		return "tabs_slider";
	}

	public function get_title(){
		return "Tabs Slider";
	}

	public function get_icon() {

		return "eicon-slider-full-screen";
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {


		$this->start_controls_section(
			'st_slider',
			[
				'label' => __( 'Slider', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'dropdown_name', [
				'label' => __( 'Select Name', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Structural' , 's_themeey' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_title', [
				'label' => __( 'Title', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Structural' , 's_themeey' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_content', [
				'label' => __( 'Content', 's_themeey' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( '' , 's_themeey' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'slider_bg',
			[
				'label' => __( 'Choose Image', 's_themeey' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'slider_btn',
			[
				'label' => __( 'Button Text', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Structural' , 's_themeey' ),
			]
		);

		$repeater->add_control(
			'slider_btn_link',
			[
				'label' => __( 'Slider Link', 's_themeey' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 's_themeey' ),
				'show_external' => true,
				// 'default' => [
				// 	'url' => '',
				// 	'is_external' => true,
				// 	'nofollow' => true,
				// ],
			]
		);


		$this->add_control(
			'tabs_slider_list',
			[
				'label' => __( 'Slider Item', 's_themeey' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'slider_title' => __( 'Slider item #1', 's_themeey' ),
						'slider_content' => '',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'st_slider_label',
			[
				'label' => __( 'Height', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'st_slider_height',
			[
				'label' => __( 'Height', 's_themeey' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 700,
			]
		);

		$this->end_controls_section();

		// $this->start_controls_section(
		// 	'slider_title_syle',
		// 	[
		// 		'label' => __( 'Title', 's_themeey' ),
		// 		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_group_control(
		// 	\Elementor\Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'flip_front_bg',
		// 		'label' => __( 'Flip Front Background', 's_themeey' ),
		// 		'types' => [ 'classic', 'gradient', 'video' ],
		// 		'selector' => 'div#special_service div.elementor-widget-wrap .title',
		// 		'default' => '#fff',
		// 	]
		// );

		// $this->end_controls_section();



		// $this->start_controls_section(
		// 	'flip_back_content',
		// 	[
		// 		'label' => __( 'Flip Back Background', 's_themeey' ),
		// 		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_group_control(
		// 	\Elementor\Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'flip_back_bg',
		// 		'label' => __( 'Flip Back Background', 's_themeey' ),
		// 		'types' => [ 'classic', 'gradient', 'video' ],
		// 		'selector' => 'div#special_service div.elementor-widget-wrap .content',
		// 		'default' => '#2980b9',
		// 	]
		// );

		// $this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
?>


<div id="tabs-slider">
	<div class="swiper-pagination"></div>	
	<div class="swiper-container">
		<div class="swiper-wrapper">
			
	<?php foreach ($settings['tabs_slider_list'] as $value): ?>
		<div class="elementor-section swiper-slide slider-item" data-tabs="<?php echo esc_attr( $value['dropdown_name'] ); ?>">
			<div class="elementor-container">
				<div class="elementor-column elementor-col-50 height-bg" style="min-height: <?php echo $settings['st_slider_height']; ?>px">
					<div class="elementor-widget-wrap" style="background-image: url(<?php echo esc_url( $value['slider_bg']['url'] ); ?>);"></div>
				</div>
				<div class="elementor-column elementor-col-50 slider-content">
					<div class="elementor-widget-wrap">
						<h2><?php echo $value['slider_title']; ?></h2>
						<div class="item-content">
							<?php echo $value['slider_content']; ?>
						</div>
						<a href="<?php echo esc_url( $value['slider_btn_link']['url'] ); ?>" class="btn"><?php echo $value['slider_btn']; ?></a>
					</div>			
				</div>
			</div>		
		</div>
	<?php endforeach ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
	    var swiper = new Swiper('#tabs-slider .swiper-container', {
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	        renderBullet: function (index, className) {
				var pagination_name = $('#tabs-slider .slider-item').eq(index).data('tabs');
				return '<span class="' + className + '">' + pagination_name + '</span>';
	        },
	      },
	    });


	});
</script>

<?php 
		// var_dump($settings);
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_tabs_slider );
