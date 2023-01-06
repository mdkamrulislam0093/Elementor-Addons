<?php 

namespace elementor;




// Slider

class st_recent_post extends Widget_Base {

	public function get_name(){

		return "recent_product";
	}

	public function get_title(){
		return "Recent Product";
	}

	public function get_icon() {

		return "eicon-product-categories";
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'st_recent_post',
			[
				'label' => __( 'Slider', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label' => __( 'Title', 's_themeey' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->end_controls_section();		
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

	$text = '';
	$query = new \WP_Query([
		'post_type' => 'product',
		'posts_per_page' => 16,
		'orderby' => 'date',
    	'order'   => 'DESC'	
	]);

	if ( $query->have_posts() ) { 
		$text .= '<div class="recent-post slide-4">';

			while ( $query->have_posts() ) { $query->the_post();
				$product = wc_get_product(get_the_ID());
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

				$text .= '<div class="item"><a href="'. get_the_permalink() .'"><div class="img"><img src="'. $image[0] .'" /></div><div class="content"><h2>'. $product->get_name() .'</h2>'. $product->get_short_description() .'<div class="price">'. get_woocommerce_currency_symbol() . $product->get_price() .'</div></div></a></div>';
			}
		$text .= '</div>';
	}

	echo $text;

	}





}


Plugin::instance()->widgets_manager->register_widget_type( new st_recent_post );
