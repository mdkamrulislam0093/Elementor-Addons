<?php 

namespace elementor;




// Slider

class st_speical_service extends Widget_Base {

	public function get_name(){

		return "spe_services";
	}

	public function get_title(){
		return "Special Services";
	}

	public function get_icon() {

		return "eicon-posts-justified";
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'st_services',
			[
				'label' => __( 'Services', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		// $repeater->add_control(
		// 	'dropdown_name', [
		// 		'label' => __( 'Dropdown Name', 's_themeey' ),
		// 		'type' => Controls_Manager::TEXT,
		// 		'default' => __( 'Women Fashion' , 's_themeey' ),
		// 		'label_block' => true,
		// 	]
		// );

		$repeater->add_control(
			'service_title', [
				'label' => __( 'Title', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Women Fashion' , 's_themeey' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'service_content', [
				'label' => __( 'Content', 's_themeey' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( '' , 's_themeey' ),
				'show_label' => false,
			]
		);



		$this->add_control(
			'service_list',
			[
				'label' => __( 'Service Item', 's_themeey' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'service_title' => __( 'Service item #1', 's_themeey' ),
						'service_content' => '',
					],
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'flip_style_content',
			[
				'label' => __( 'Flip Front Background', 's_themeey' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'flip_front_bg',
				'label' => __( 'Flip Front Background', 's_themeey' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 'div#special_service div.elementor-widget-wrap .title',
				'default' => '#fff',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'flip_back_content',
			[
				'label' => __( 'Flip Back Background', 's_themeey' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'flip_back_bg',
				'label' => __( 'Flip Back Background', 's_themeey' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 'div#special_service div.elementor-widget-wrap .content',
				'default' => '#2980b9',
			]
		);

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$i = 0;

	// echo "<pre>";
		// var_dump($settings);
		// echo "</pre>";

?>

	<div class="options-button-prev"><span class="dashicons dashicons-arrow-left-alt"></span></div>		
<div id="special_service" class="elementor-section swiper-container" >

	<div class="special_service-content swiper-wrapper">

		<?php 
			foreach ($settings['service_list'] as $value): 
			
			if ( $i == 0 ) {
				echo '<div class="service-item-sl swiper-slide">';
			}
		?>
		<div class="elementor-column elementor-col-33">
			<div class="elementor-widget-wrap" data-service="<?php echo str_replace(' ', '', strtolower( $value['dropdown_name']) ); ?>">
				<div class="flip-wrap">
					<div class="title"><?php echo $value['service_title']; ?></div>
					<div class="content"><?php echo $value['service_content']; ?></div> 					
				</div>

			</div>
		</div>
		<?php 

			if ( $i == 1 ) {
				echo '</div>';
				$i = 0;
			} else {
				$i++;
			}

			endforeach 
		?>	

	</div>
</div>
	<div class="options-button-next"><span class="dashicons dashicons-arrow-right-alt"></span></div>	

<script type="text/javascript">
	jQuery(document).ready(function($){
	    var swiper = new Swiper('#special_service.swiper-container', {
	      loop: false,
	      slidesPerView: 1,
	      // spaceBetween: 30,      
	      navigation: {
	        nextEl: '.options-button-next',
	        prevEl: '.options-button-prev',
	      },
	      breakpoints: {
	        1024: {
	          slidesPerView: 1,
	        },	
	        1200: {
	          slidesPerView: 3,
	        },		        	        
	      }		      
	    });
	});
</script>
<?php 
		// var_dump($settings);
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_speical_service );
