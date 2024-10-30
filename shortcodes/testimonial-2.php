<?php
add_action('vc_before_init', 'cpitwpba_testimonial_two_init');
function cpitwpba_testimonial_two_init()
{
    vc_map( array (
        "name" => __("Testimonial 2 Carousel", 'cpitwpba'),
        "base" => "cpitwpba_testimonial_two",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('testimonial_two Carousel', 'js_composer'),
        "params" => array(

            array(
                'type' => 'param_group',
                'param_name' => 'testimonials',
                'params' => array(
                    array(
                        "type" => "textarea",
                        "heading" => __("Testimonial Text", "cpitwpba"),
                        "param_name" => "text",
                        "value" => "",
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Customer Image", "asvc"),
                        "param_name" => "image",
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Customer Name", "cpitwpba"),
                        "param_name" => "name",
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Designation", "cpitwpba"),
                        "param_name" => "designation",
                        "value" => "",
                    ),

                )
            ),

        )
    ));
}

function cpitwpba_testimonial_two_shortcode_function($atts, $content = null)
{
    extract( shortcode_atts( array (
        'testimonials' => '',

    ), $atts));

    $testimonials = vc_param_group_parse_atts($atts['testimonials']);

    $output = '';

    $testimonial_html = '';
    foreach ($testimonials as $testimonial) {

        $image = wp_get_attachment_image_src( $testimonial['image'], 'full' );

        $testimonial_html .= '<div class="testi-item">
            <div class="author-desc">                                
                <div class="desc"><img class="quote" src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/quote-white.png'.'" alt="">'.$testimonial['text'].'</div>
                <div class="author-img">
                    <img src="'.$image[0].'" alt="">
                </div>
            </div>
            <div class="author-part">
                <a class="name" href="#">'.$testimonial['name'].'</a>
                <span class="designation">'.$testimonial['designation'].'</span>
            </div>
        </div>';
    }

    $output .= '<div class="rs-testimonial style2 mt-50">
    <div class="container">
        <div class="rs-carousel owl-carousel" 
            data-loop="true" 
            data-items="2" 
            data-margin="30" 
            data-autoplay="true" 
            data-hoverpause="true" 
            data-autoplay-timeout="5000" 
            data-smart-speed="800" 
            data-dots="true" 
            data-nav="false" 
            data-nav-speed="false" 

            data-md-device="2" 
            data-md-device-nav="false" 
            data-md-device-dots="true" 
            data-center-mode="false"

            data-ipad-device2="1" 
            data-ipad-device-nav2="false" 
            data-ipad-device-dots2="true"

            data-ipad-device="1" 
            data-ipad-device-nav="false" 
            data-ipad-device-dots="true" 

            data-mobile-device="1" 
            data-mobile-device-nav="false" 
            data-mobile-device-dots="false">

            '.$testimonial_html.'

        </div>
    </div>
</div>';


    return $output;
}


add_shortcode('cpitwpba_testimonial_two', 'cpitwpba_testimonial_two_shortcode_function');