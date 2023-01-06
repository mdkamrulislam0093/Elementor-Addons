<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class The_Categories_Products extends \Elementor\Widget_Base {
	public function get_name() {
		return 'the-category-products';
	}

	public function get_title() {
		return __('Category Products', 'am2am-elementor');
	}

	public function get_icon() {
		return 'eicon-archive-posts';
	}
	
	public function get_keywords() {
		return ['products'];
	}

	public function get_categories() {
		return ['basic'];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'am2am-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'limit',
			[
				'label' => __('Limit', 'am2am-elementor'),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$this->add_control(
			'include',
			[
				'label' => __('Include Categories', 'am2am-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('12,16', 'am2am-elementor'),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$terms = get_terms( 'product_cat', [
			'hide_empty' => true
		]);

?>

<div id="t_products_cat_list">
    <div class="product-cat">
        <h3>Categories</h3>
      <ul>
      	<?php foreach ($terms as $value): ?>
      		<li data-p_cat="<?php echo $value->slug; ?>"><?php echo $value->name; ?></li>
      	<?php endforeach ?>
      </ul>
    </div>
    <div class="product-item-cat">
    <h2>Shop All</h2>
    <?php 
    foreach ($terms as $value) :

        $loop = new WP_Query([
            'post_type' => 'product', 
            'posts_per_page' => -1, 
            'product_cat' => $value->name
        ]);
            $thumbnail_id = get_woocommerce_term_meta( $value->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            $image_class = ( $image ) ? 'has_arc_bg' : '' ;
    ?>
        <div class="category-item" data-cat="<?php echo $value->slug; ?>">
    		<h2 style="background-image: url(<?php echo $image; ?>);" class="<?php echo $image_class; ?>"><?php echo $value->name; ?></h2>
            <?php 

            if ( $loop->have_posts() ) {
                echo '<ul class="products">';
                    while ( $loop->have_posts() ) : $loop->the_post();
                        wc_get_template_part( 'content', 'product' );
                    endwhile;
                echo '</ul>';
            }
            wp_reset_postdata();
            ?>       
    	</div>
    <?php endforeach; ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('div#t_products_cat_list .product-cat li').click(function(){
            var target = $(this).data('p_cat');

            jQuery.each($('.category-item'), function(index, item){
                if ( target == $(item).data('cat') ) {
                    $(item).fadeIn();
                } else {
                    $(item).hide();
                }
            });
        });
    });
</script>
<?php 
	}
}