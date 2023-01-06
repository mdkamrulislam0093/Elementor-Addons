<?php 

namespace elementor;




// Slider

class st_options_slider extends Widget_Base {

	public function get_name(){

		return "options_slider";
	}

	public function get_title(){
		return "Options Slider";
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

		// $repeater->add_control(
		// 	'slider_bg',
		// 	[
		// 		'label' => __( 'Choose Image', 's_themeey' ),
		// 		'type' => \Elementor\Controls_Manager::MEDIA,
		// 		'default' => [
		// 			'url' => \Elementor\Utils::get_placeholder_image_src(),
		// 		],
		// 	]
		// );

		$repeater->add_control(
			'slider_author',
			[
				'label' => __( 'Author', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Elizabeth' , 's_themeey' ),
			]
		);

		$repeater->add_control(
			'slider_place',
			[
				'label' => __( 'Author Address', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Newwark, New Jersy' , 's_themeey' ),
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


<div id="options-slider" class="elementor-section elementor-section-boxed">
	<div class="elementor-container">

		<div class="custom_select">
			<form>
				<span class="select-wrap">
				<select>
					<?php foreach ($settings['tabs_slider_list'] as $value): ?>
						<option value="<?php echo str_replace(' ', '', strtolower( $value['dropdown_name']) ); ?>"><?php echo $value['dropdown_name']; ?></option>		
					<?php endforeach ?>

				</select>					
				</span>
			</form>
		</div>		
	</div>
	<div class="elementor-container">



    		<div class="options-button-prev"><span class="dashicons dashicons-arrow-left-alt"></span></div>					
		<div class="swiper-container">
			<div class="swiper-wrapper">
				
		<?php foreach ($settings['tabs_slider_list'] as $value): ?>
			<div class="elementor-section swiper-slide slider-item" data-tabs="<?php echo str_replace(' ', '', strtolower( $value['dropdown_name']) ); ?>">
				<div class="elementor-container">

					<div class="elementor-column elementor-col-100 slider-content">
						<div class="elementor-widget-wrap">
							<div class="author-info">
								<h4><?php echo $value['slider_author'] ?></h4>
								<span><?php echo $value['slider_place'] ?></span>
							</div>

							<h2><?php echo $value['slider_title']; ?></h2>
							<div class="item-content">
								<?php echo $value['slider_content']; ?>
							</div>
						</div>			
					</div>
				</div>		
			</div>
		<?php endforeach ?>
			</div>
		</div>
		<div class="others-swiper-pagination"></div>
    <div class="options-button-next"><span class="dashicons dashicons-arrow-right-alt"></span></div>	
	</div>		
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
	    var swiper = new Swiper('#options-slider .swiper-container', {
	      loop: true,
	      centeredSlides: true,
	      pagination: {
	        el: '.others-swiper-pagination',
	        clickable: true,
	        renderBullet: function (index, className) {
				var pagination_name = $('#options-slider .slider-item').eq(index).data('tabs');
				return '<span class="' + className + '" data-pagination="'+ pagination_name +'">' + index + '</span>';
	        },
	      },
	      navigation: {
	        nextEl: '.options-button-next',
	        prevEl: '.options-button-prev',
	      },	      
	    });


	    setTimeout(function(){
	    	if ( $('#options-slider .swiper-container').hasClass('swiper-container-initialized') ) {
	    		$('#options-slider .swiper-container').addClass('custom_visible');
	    	}
	    }, 1000);


	   	$('#options-slider .custom_select').find('select').change(function(){
			var target = $(this).val();
			$("div#options-slider").find(".others-swiper-pagination span.swiper-pagination-bullet[data-pagination=\"" + target + "\"]").click();
			// console.log();

			// $("div#options-slider').find('.others-swiper-pagination span.swiper-pagination-bullet[data-pagination=\"" + target + "\"]").click();
		});



	});
</script>

<?php 
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_options_slider );
