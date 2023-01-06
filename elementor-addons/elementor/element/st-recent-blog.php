<?php 

namespace elementor;




// Slider

class st_recent_blog extends Widget_Base {

	public function get_name(){

		return "recent_blog";
	}

	public function get_title(){
		return "Recent Blog";
	}

	public function get_icon() {

		return "eicon-post-list";
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'st_recent_post',
			[
				'label' => __( 'Blog', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_title',
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
			'posts_per_page' => 3,
			'orderby' => 'date',
	    	'order'   => 'DESC'	
		]);

		if ( $query->have_posts() ) { 
			$text .= '<div class="the-recent-post"><div class="row">';

				while ( $query->have_posts() ) { $query->the_post();

					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

					$text .= '<div class="col-md-4"><article><div class="post-bg" style="background-image: url('. $image[0] .');"><a href="'. get_the_permalink() .'"><i class="fa fa-link"></i>'. get_the_title() .'</a></div><div class="post-content"><div class="title"><h2><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></h2><span>'. get_the_date() .'</span></div><p>'. wp_trim_words( get_the_content(), 25, ' <a href="'. get_the_permalink() .'">[...]</a>' )  .'</p></div></article></div>';
				}
			$text .= '</div></div>';
		}

		echo $text;

	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_recent_blog );
