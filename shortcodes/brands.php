<?php
add_action('vc_before_init', 'cpitwpba_brands_init');
function cpitwpba_brands_init()
{
    vc_map(array(
        "name" => __("Brands", 'cpitwpba'),
        "base" => "cpitwpba_brands",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Brands', 'js_composer'),
        "params" => array(

            array(
                'type' => 'param_group',
                'param_name' => 'images',
                'params' => array(

                    array(
                        "type" => "attach_image",
                        "heading" => __("Brand Image", "js_composer"),
                        "param_name" => "image",
                        "value" => "",
                    ),

                ),
            ),

        ),
    ));
}

function cpitwpba_brands_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(

        'images' => '',

    ), $atts));

    $output = '';

    $brands = vc_param_group_parse_atts($atts['images']);

    $output = '';

    $brand_html = '';
    foreach ($brands as $brand) {

        $image = wp_get_attachment_image_src( $brand['image'], 'full' );

        $brand_html .= '<div class="partner-item">
        <div class="logo-img">
            <img class="hover-logo" src="'.$image[0].'" alt="">
        </div>
    </div>';
    }

    $output .= '<div class="pt-50 pb-50">
    <div class="container">
        <div class="rs-carousel owl-carousel" data-loop="true" data-items="5" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="2" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="3" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="5" data-md-device-nav="false" data-md-device-dots="false">

        '.$brand_html.'

        </div>
    </div>
</div>';

    return $output;
}

add_shortcode('cpitwpba_brands', 'cpitwpba_brands_shortcode_function');
