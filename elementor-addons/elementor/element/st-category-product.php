<?php 

namespace elementor;




// Slider

class st_product_category extends Widget_Base {

	public function get_name(){

		return "category_product";
	}

	public function get_title(){
		return "Product Category";
	}

	public function get_icon() {

		return "fa fa-archive";
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'st_recent_category',
			[
				'label' => __( 'Product Category', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'category_title',
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

		$terms = get_terms([
		    'taxonomy' => 'product_cat',
		    'hide_empty' => false,
		]);


		if ( !empty($terms) ) { 
			$text .= '<div class="recent-post product-category slide-4">';

			foreach ($terms as $term) {
				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
    			$image = ( wp_get_attachment_url( $thumbnail_id ) ) ? wp_get_attachment_url( $thumbnail_id ) : '/wp-content/uploads/2019/11/woocommerce-placeholder.jpg' ;

				$text .= '<div class="item"><div class="img"><img src="'. $image .'" /></div><div class="content"><h2>'. $term->name .'</h2><a href="'. get_category_link( $term->term_id ) .'">Shop</a></div></div>';
			}

			$text .= '</div>';
		}

		echo $text;


	}



}


Plugin::instance()->widgets_manager->register_widget_type( new st_product_category );
