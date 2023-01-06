<?php 

namespace elementor;




// Slider

class st_approach_slider extends Widget_Base {

	public function get_name(){

		return "approach_slider";
	}

	public function get_title(){
		return "Approach Slider";
	}

	public function get_icon() {

		return "eicon-slider-full-screen";
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {


		$this->start_controls_section(
			'st_approach_slider',
			[
				'label' => __( 'Slider', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

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
			'st_icon',
			[
				'label' => __( 'Icon', 's_themeey' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
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

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
?>


<div class="approach-slider" data-id="approach-slider" class="elementor-section">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				
		<?php foreach ($settings['tabs_slider_list'] as $value): 
			$icons = ( $value['st_icon']['library'] == 'svg' ) ? '<img src=\''. $value['st_icon']['value']['url'] .'\'>'  : '<i class=\''.$value['st_icon']['value'] .'\'></i>';
			?>
			<div class="elementor-section swiper-slide slider-item" data-pagination-icon="<?php echo $icons; ?>" data-pagination-title="<?php echo $value['slider_title']; ?>">
				<div class="slider-item-bg" style="background-image: url('<?php echo $value['slider_bg']['url']; ?> ');"></div>
				<div class="slider-item-icon"><div class="elementor-icon"><?php echo $icons; ?></div></div>
				<div class="elementor-container">

					<div class="elementor-column elementor-col-100 slider-content">
						<div class="elementor-widget-wrap">
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
		<div class="elementor-section elementor-section-boxed approach-pagination">
			<div class="elementor-container">
				<div class="approach-slider-pagination"></div>
			</div>
		</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
	    var swiper = new Swiper('.approach-slider .swiper-container', {
	      loop: false,
	      centeredSlides: true,
	      pagination: {
	        el: '.approach-slider-pagination',
	        clickable: true,
	        renderBullet: function (index, className) {
				var pagination_icon = $('.approach-slider .slider-item').eq(index).data('pagination-icon');
				var pagination_name = $('.approach-slider .slider-item').eq(index).data('pagination-title');
				return '<span class="' + className + '"><div class="elementor-icon">'+ pagination_icon +'</div><h4>'+ pagination_name +'</h4></span>';
	        },
	      },
	    });
	});
</script>

<?php 
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_approach_slider );
