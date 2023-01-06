<?php 

namespace elementor;




// Slider

class st_package_item extends Widget_Base {
	public function get_name(){

		return "spe_package_item";
	}

	public function get_title(){
		return "Services Package";
	}

	public function get_icon() {

		return "fas fa-cubes";
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function package_category()	{
		$category = [
					'boosters' => __( 'Boosters', 's_themeey' ),
					'injections' => __( 'Injections', 's_themeey' ),
					'medical' => __( 'Medical IVs', 's_themeey' ),
				];
		return $category;
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'st_package_services',
			[
				'label' => __( 'Packages', 's_themeey' ),
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
			'package_image',
			[
				'label' => __( 'Choose Image', 's_themeey' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'service_title', [
				'label' => __( 'Title', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'service_content', [
				'label' => __( 'Content', 's_themeey' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'package_price', [
				'label' => __( 'Price', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'package_link',
			[
				'label' => __( 'Package Link', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$repeater->add_control(
			'package_category',
			[
				'label' => __( 'Category', 's_themeey' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->package_category(),
			]
		);

		$this->add_control(
			'service_list',
			[
				'label' => __( 'Items', 's_themeey' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'service_title' => __( 'item #1', 's_themeey' ),
						'service_content' => '',
					],
				],
			]
		);

		$this->end_controls_section();


	}


	protected function render() {
		$settings = $this->get_settings_for_display(); 

		$booster = [];
		$medical = [];
		$injections = [];

		foreach ($settings['service_list'] as $value) { 
			if ( $value['package_category'] == 'boosters' ) {
				$booster[] = $value;
			} elseif ( $value['package_category'] == 'injections' ) {
				$injections[] = $value;
			} elseif ( $value['package_category'] == 'medical' ) {
				$medical[] = $value;
			}						

		}
				?>





		<div id="package_category">
			<div class="category-item">
				<ul>
					<?php 
						$i = 0;
						foreach ($this->package_category() as $key => $value): ?>
						<li data-id="<?php echo $key ?>" class="<?php if ( $i == 0 ) { echo 'active'; } $i++;?>"><?php echo $value; ?></li>
					<?php endforeach ?>					
				</ul>
			</div>

			<div class="package-items">
				<?php if ( count($booster) != 0 ): ?>
					<div class="swiper-container" data-category="boosters">
						<div class="swiper-button-prev"></div>
						<div class="swiper-wrapper">
							<?php foreach ($booster as $key => $value): ?>
								<div class="swiper-slide slider-item">
									<a href="<?php echo $value['package_link']['url']; ?>">
										<div class="package-image">
											<img src="<?php echo esc_attr( $value['package_image']['url'] ); ?>">
										</div>
										<h2><?php echo $value['service_title']; ?></h2>
										<p><?php echo $value['service_content']; ?></p>
										<h3>Starting at <?php echo $value['package_price']; ?>* </h3>
									</a>
								</div>								
							<?php endforeach; ?>							
						</div>
						<div class="swiper-button-next"></div>
					</div>					
				<?php endif; ?>


				<?php if ( count($medical) != 0 ): ?>
					<div class="swiper-container" data-category="medical">
						<div class="swiper-button-prev"></div>
						<div class="swiper-wrapper">
							<?php foreach ($medical as $key => $value): ?>
								<div class="swiper-slide slider-item">
									<a href="<?php echo $value['package_link']['url']; ?>">
										<div class="package-image">
											<img src="<?php echo esc_attr( $value['package_image']['url'] ); ?>">
										</div>
										<h2><?php echo $value['service_title']; ?></h2>
										<p><?php echo $value['service_content']; ?></p>
										<!--<h3>Starting at <?php echo $value['package_price']; ?>* </h3>-->
										<h3><?php echo $value['package_price']; ?></h3>
									</a>
								</div>								
							<?php endforeach; ?>							
						</div>
						<div class="swiper-button-next"></div>
					</div>					
				<?php endif; ?>


				<?php if ( count($injections) != 0 ): ?>
					<div class="swiper-container" data-category="injections">
						<div class="swiper-button-prev"></div>
						<div class="swiper-wrapper">
							<?php foreach ($injections as $key => $value): ?>
								<div class="swiper-slide slider-item">
									<a href="<?php echo $value['package_link']['url']; ?>">
										<div class="package-image">
											<img src="<?php echo esc_attr( $value['package_image']['url'] ); ?>">
										</div>
										<h2><?php echo $value['service_title']; ?></h2>
										<p><?php echo $value['service_content']; ?></p>
										<h3>Starting at <?php echo $value['package_price']; ?>* </h3>
									</a>
								</div>								
							<?php endforeach; ?>							
						</div>
						<div class="swiper-button-next"></div>
					</div>					
				<?php endif; ?>
			</div>	

		</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
	    var swiper = new Swiper('#package_category .swiper-container', {
		      slidesPerView: 1,
		      spaceBetween: 20,
		      loop: true,
		      navigation: {
		        nextEl: '.swiper-button-next',
		        prevEl: '.swiper-button-prev',
		      },		      
		      breakpoints: {
		        640: {
		          slidesPerView: 1,
		          spaceBetween: 20,
		        },
		        768: {
		          slidesPerView: 2,
		          spaceBetween: 40,
		        },
		        1024: {
		          slidesPerView: 4,
		          spaceBetween: 50,
		        },		        
		      }		      
	    });


	    $('#package_category .category-item').find('li').click(function(){
	    	var trigger = $(this).data('id');
	    	var items = $('#package_category .swiper-container');
	    	// $('#package_category .swiper-slide').removeClass('active');


		     items.each(function(){
		        var $this = $(this);
		        var id = $this.data('category');
		          if( id == trigger){
		          	$this.removeClass('hidden').addClass('visible');
		          } else {
		            $this.removeClass('visible').addClass('hidden');
		          }

		      });

		     $('#package_category .category-item li').removeClass('active');
		     $(this).addClass('active');

		     // swiper.update();
		    // var swiper2 = new Swiper('#package_category .swiper-container', {
			   //    slidesPerView: 4,
			   //    spaceBetween: 50,	  
		    // });

	    });

	});
</script>

		<?php 
		// var_dump($settings['service_list']);
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_package_item );
