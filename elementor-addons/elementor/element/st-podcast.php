<?php 

namespace elementor;




// Slider

class st_podcast_archive extends Widget_Base {

	public function get_name(){

		return "st_podcast_archive_slider";
	}

	public function get_title(){
		return "Podcast Archive Slider";
	}

	public function get_icon() {

		return "fas fa-podcast";
	}

	public function get_categories() {
		return [ 'basic' ];
	}


	protected function _register_controls() {

		$cate_podcast_arr = [];
		$cat_podcast = get_terms([
		    'taxonomy' => 'podcast_category',
		    'hide_empty' => false, 			
		]); 

		foreach ($cat_podcast as $value) {
			$cate_podcast_arr[$value->term_id] = $value->name;
		}


		$this->start_controls_section(
			'st_slider',
			[
				'label' => __( 'Slider', 's_themeey' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'st_cat_category',
			[
				'label' => __( 'Category', 's_themeey' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => $cate_podcast_arr,
			]
		);

		$this->end_controls_section();


	}


	protected function render() {
		$settings = $this->get_settings_for_display();


 
// The Query
$query = new \WP_Query([
	'post_type' => 'postcast',
	'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'podcast_category',
            'field'    => 'term_id',
            'terms'    => $settings['st_cat_category'],
        ),
    ),	
]);
 
// The Loop
if ( $query->have_posts() ) { ?>
<div id="podcast_archive-slider">
	<div class="swiper-pagination"></div>	
	<div class="swiper-container">
		<div class="swiper-wrapper">

	<?php while ( $query->have_posts() ) { $query->the_post(); ?>
		<div class="swiper-slide">
			<div class="podcast-item">
				<a href="<?php the_permalink(); ?>">
					<div class="podcast-speaker" style="background-image: url('<?php echo get_field('speaker_picture', get_the_ID()); ?>');">
						<h2><?php echo get_field('speaker_name', get_the_ID()); ?></h2>
						<i class="fas fa-play"></i>
					</div>
					<div class="podcast-details">
						<ul>
							<li><?php echo get_field('speaker_name', get_the_ID()); ?></li>
							<li>Subject</li>
						</ul>

						<h2><?php the_title(); ?></h2>
						<p><?php echo wp_trim_words(get_the_content(), 25); ?></p>

					</div>
				</a>
			</div>			
		</div>
    <?php } ?>
		</div>
	</div>
</div>
<?php 
} 
wp_reset_postdata();
?>

<style type="text/css">
	div#podcast_archive-slider .podcast-item .podcast-speaker {
	    background-color: var(--e-global-color-primary);
	    color: #fff;
	    text-align: center;
	    min-height: 250px;
	    display: flex;
	    align-items: flex-end;
	    flex-wrap: wrap;
	    justify-content: space-between;
	    padding: 0;
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size: contain;
	}

	div#podcast_archive-slider .podcast-item .podcast-speaker i.fa-play {
	    background: var(--e-global-color-e0ac991);
	    height: 70px;
	    width: 70px;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	}

	div#podcast_archive-slider .podcast-item .podcast-speaker h2 {
	    color: #fff;
	    font-size: 21px;
	    text-transform: uppercase;
	    padding-left: 18px;
	    font-weight: 600;
	}

	div#podcast_archive-slider .podcast-details {
	    background: #000;
	    padding: 25px;
	}

	div#podcast_archive-slider .podcast-details ul li {
	    color: #fff;
	    list-style: none;
	    display: inline-block;
	    padding-right: 15px;
	    margin-right: 5px;
	    position: relative;
	}

	div#podcast_archive-slider .podcast-details ul {
	    margin: 0;
	}

	div#podcast_archive-slider .podcast-details ul li:first-child:after {content: '';position: absolute;right: 0;top: 0;bottom: 0;width: 5px;height: 5px;background: #fff;border-radius: 50%;display: flex;margin: auto 0;}

	div#podcast_archive-slider .podcast-details h2 {
	    color: #fff;
	    font-weight: 700;
	    font-size: 25px;
	    margin-top: 20px;
	    margin-bottom: 20px;
	}

	div#podcast_archive-slider .podcast-details p {
	    color: #fff;
	    line-height: 1.7em;
	    font-size: 16px;
	        margin-bottom: 0;
	}	
</style>

<script type="text/javascript">
	jQuery(document).ready(function($){
	    var swiper = new Swiper('#podcast_archive-slider .swiper-container', {
			slidesPerView: 3,
			spaceBetween: 30,	    	
	        breakpoints: {
	          320: {
	            slidesPerView: 1,
	          },
	          768: {
	            slidesPerView: 2,
	            spaceBetween: 20,
	          },

	        },
	    });


	});
</script>

<?php 
		// var_dump($settings);
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new st_podcast_archive );
