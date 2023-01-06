<?php 
namespace elementor;


add_action( 'elementor/elements/categories_registered', function ( $elements_manager ) {
    $elements_manager->add_category(
        'ele_addon',
        [
            'title' => 'Advanced',
            'icon' => 'fa fa-plug',
        ]
    );
});



// require_once ACF_DIR_PATH . 'elementor/element/st-slider.php';