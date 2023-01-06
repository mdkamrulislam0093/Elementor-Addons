<?php 

namespace elementor;


class st_slider extends Widget_Base {

	public function get_name(){

		return "st-slider";
	}

	public function get_title(){
		return "ST-Slider";
	}

	public function get_icon() {

		return "fa fa-sliders";
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
			'slider_image',
			[
				'label' => __( 'Choose Slider Background', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);


		$repeater->add_control(
			'slider_title', [
				'label' => __( 'Title', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Women Fashion' , 's_themeey' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_sub_title', [
				'label' => __( 'Sub Title', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Welcome to Fashion' , 's_themeey' ),
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
			'slider_btn',
			[
				'label' => __( 'Button', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Shop Now' , 's_themeey' ),
			]
		);


		$repeater->add_control(
			'slider_btn_url',
			[
				'label' => __( 'Button URL', 's_themeey' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://themeey.com', 's_themeey' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);



		$this->add_control(
			'slider_list',
			[
				'label' => __( 'Slider Item', 's_themeey' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'slider item #1', 's_themeey' ),
						'list_content' => '',
					],
				],
			]
		);

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['slider_list'] ) {

			echo '<section class="slide-1 home-slider">';
			foreach (  $settings['slider_list'] as $slider_item ) {
	?>	
		<div>
	       <div class="text-center">
	            <img src="<?php esc_attr_e( $slider_item['slider_image']['url'] ); ?>" alt="" class="bg-img blur-up lazyload">
	            <div class="container">
	                <div class="row">
	                    <div class="col">
	                        <div class="slider-contain">
	                            <div>
	                                <h4><?php esc_html_e( $slider_item['slider_sub_title'] ); ?></h4>
	                                <h2><?php esc_html_e( $slider_item['slider_title'] ); ?></h2>
	                                <a href="<?php esc_attr_e( $slider_item['slider_btn_url']['url'] ); ?>" class="btn btn-solid"><?php echo esc_html_e( $slider_item['slider_btn'] ); ?></a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	<?php 
			}
			echo '</section>';
		}

	}





}


Plugin::instance()->widgets_manager->register_widget_type( new st_slider );


