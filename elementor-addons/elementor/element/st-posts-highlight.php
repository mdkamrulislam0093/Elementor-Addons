<?php 

namespace elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


use Elementor\Core\Kits\Documents\Tabs\Global_Typography;



// Slider

class st_recent_blog extends Widget_Base {

	public function get_name(){

		return "posts_highlight";
	}

	public function get_title(){
		return "Posts Highlight";
	}

	public function get_icon() {

		return "eicon-post-list";
	}

	public function get_categories() {
		return [ 'themeey_elementor_addon_cat' ];
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'st_post_layout',
			[
				'label' => __( 'Layout', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// $this->add_control(
		// 	'layout',
		// 	[
		// 		'label' => __( 'Layout', 's_themeey' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'default' => 'solid',
		// 		'options' => [
		// 			'highligh_post'  => __( 'HightLight', 's_themeey' ),
		// 			'grid'  => __( 'Grid', 's_themeey' ),
		// 			// 'dashed' => __( 'Dashed', 's_themeey' ),
		// 			// 'dotted' => __( 'Dotted', 's_themeey' ),
		// 			// 'double' => __( 'Double', 's_themeey' ),
		// 			// 'none' => __( 'None', 's_themeey' ),
		// 		],
		// 	]
		// );

		$this->add_control(
			'posts_columns',
			[
				'label' => __( 'Columns', 's_themeey' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1'  => '1',
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
				]	
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 4,
				'max' => 99,
				'step' => 1,
				'default' => 4,

			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => __( 'Category', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => __( 'Date', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_read_time',
			[
				'label' => __( 'Read Time', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'open_new_window',
			[
				'label' => __( 'Open in new window', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);



/**
category
title
date
read time
*/

	$this->end_controls_section();		


/*
*  Tab Style Contraols
*
*/
		// $this->start_controls_section(
		// 	'title_style_section',
		// 	[
		// 		'label' => __( 'Title', 'plugin-name' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_control(
		// 	'title_color_style',
		// 	[
		// 		'label' => __( 'Color', 'plugin-domain' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'scheme' => [
		// 			'type' => \Elementor\Scheme_Color::get_type(),
		// 			'value' => \Elementor\Scheme_Color::COLOR_1,
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .title' => 'color: {{VALUE}}',
		// 		],
		// 	]
		// );

		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[	
		// 		'label' => __( 'Typography', 'elementor' ),
		// 		'name' => 'title_typography',
		// 		'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-title',
		// 		'global' => [
		// 			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
		// 		],
		// 	]
		// );


		// $this->end_controls_section();



		// $this->start_controls_section(
		// 	'date_cat_style_section',
		// 	[
		// 		'label' => __( 'Date', 'plugin-name' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_control(
		// 	'date_cat_color_style',
		// 	[
		// 		'label' => __( 'Color', 'plugin-domain' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'scheme' => [
		// 			'type' => \Elementor\Scheme_Color::get_type(),
		// 			'value' => \Elementor\Scheme_Color::COLOR_1,
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .title' => 'color: {{VALUE}}',
		// 		],
		// 	]
		// );

		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[	
		// 		'label' => __( 'Typography', 'elementor' ),
		// 		'name' => 'date_cat_typography',
		// 		'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-title',
		// 		'global' => [
		// 			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
		// 		],
		// 	]
		// );


		// $this->end_controls_section();







	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$posts_columns = $settings['posts_columns'];
		$posts_per_page = $settings['posts_per_page'];
		$show_title = $settings['show_title'];
		$show_category = $settings['show_category'];
		$show_date = $settings['show_date'];
		$show_read_time = $settings['show_read_time'];
		$open_new_window = $settings['open_new_window'];
		$posts_elementor_columsn = '4';

		switch ($posts_columns) {
			case '4':
				$posts_elementor_columsn = 'elementor-col-25';
				break;
			case '3':
				$posts_elementor_columsn = 'elementor-col-33';
				break;
			case '2':
				$posts_elementor_columsn = 'elementor-col-50';
				break;
			case '1':
				$posts_elementor_columsn = 'elementor-col-100';
				break;
			
			default:
				$posts_elementor_columsn = 'elementor-col-25';
				break;
		}



		$query = new \WP_Query([
			'posts_per_page' => $posts_per_page,
			'orderby' => 'date',
	    	'order'   => 'DESC'	
		]);



		if ( $query->have_posts() ) : 
?>

<div class="elementor-section elementor-section-full_width acf-highlight-post ACF_elements">
	<div class="elementor-container elementor-column-gap-no">
		<div class="elementor-row">


<?php while ( $query->have_posts() ) : $query->the_post(); 

	$post_thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );

	?>
 				
			<div class="elementor-column <?php esc_attr_e( $posts_elementor_columsn ); ?>">
				<div class="post-wrapper-inner">
					<div class="post-image" style="background-image: url('<?php echo esc_url( $post_thumbnail_url ); ?>');">
						<!-- <div class="icon"><i class="fa fa-picture-o" aria-hidden="true"></i></div> -->
						<div class="post-highlight-content">
							<?php if ( $show_category == 'yes' ): ?>
								<div class="post-categories">
									<?php 
										foreach (get_the_category() as $value) {
											echo '<a href="'. esc_url( get_category_link( $value->term_id ) ) .'" class="'. $value->slug .'">'. $value->name .'</a>';
										}

									 ?>
									
								</div>
							<?php endif ?>

							<?php if ( $show_title == 'yes' ): ?>
								<div class="post-title">
									<h3><a href="<?php the_permalink(); ?>" target="<?php echo ( $open_new_window == 'yes' ) ? '_blank' : ''; ?>"><?php the_title(); ?></a></h3>
								</div>
							<?php endif ?>
<!-- 

							<div class="post-meta">
								<div class="post-author">By <span><?php echo get_the_author(); ?></span></div>

								<?php if ( $show_date == 'yes' ): ?>
									<div class="post-date"><?php echo get_the_date(); ?></div>
								<?php endif ?>

								<?php if ( $show_read_time == 'yes' ): ?>
									<div class="post-read-time">5 Mins read</div>
								<?php endif ?>
							</div>
 -->
						</div>
					</div>
				</div>

			</div>

<?php endwhile; ?>


		</div>
	</div>
</div>

<?php 			
		endif;


	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_recent_blog );
