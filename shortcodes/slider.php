<?php
add_action('vc_before_init', 'cpitwpba_slider_init');
function cpitwpba_slider_init()
{
    vc_map(array(
        "name" => __("Slider", 'cpitwpba'),
        "base" => "cpitwpba_slider",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Slider', 'js_composer'),
        "params" => array(

            array(
                'type' => 'param_group',
                'param_name' => 'sliders',
                'params' => array(
                    array(
                        "type" => "attach_image",
                        "heading" => __("Slider Image", "asvc"),
                        "param_name" => "image",
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Sub Heading", "cpitwpba"),
                        "param_name" => "sub_heading",
                        "value" => "",
                        "description" => __("Leave empty if you don't want", "cpitwpba"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Heading", "cpitwpba"),
                        "param_name" => "heading",
                        "value" => "",
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Description", "cpitwpba"),
                        "param_name" => "desc",
                        "value" => "",
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => __('Button Text & Link', 'cpitwpba'),
                        'param_name' => 'button',
                        'value' => '',
                        "description" => __("Leave empty if you don't want", "cpitwpba"),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Text Alignment', 'asvc'),
                        'param_name' => 'alignment',
                        "value" => array(
                            "Default" => "text-center",
                            "Left" => "text-left",
                            "Center" => "text-center",
                        ),
                        "std" => "text-center",
                    ),

                ),
            ),

            // Style Group  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            array(
                'type' => 'colorpicker',
                'heading' => __('Price Color', 'cpitwpba'),
                'param_name' => 'price_color',
                'group' => __('Style', 'cpitwpba'),
                'admin_label' => true,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Time Period Color', 'cpitwpba'),
                'param_name' => 'tmp_color',
                'group' => __('Style', 'cpitwpba'),
                'admin_label' => true,
            ),

        ),
    ));
}

function cpitwpba_slider_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'sliders' => '',
        'color' => '',
        'heading_color' => '',
        'desc_color' => '',

    ), $atts));

    $sliders = vc_param_group_parse_atts($atts['sliders']);

    $output = '';

    $slider_html = '';
    foreach ($sliders as $slider) {

        $image = wp_get_attachment_image_src($slider['image'], 'full');

        // Button LINK
        $button = $slider['button'];
        $button_html = '';
        if ('' != $button) {
            $href = vc_build_link($button);
            if ($href['url'] !== "") {
                $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
                $button_html = '<a class="readon learn-more slider-btn" href="' . $href['url'] . '">' . $href['title'] . '</a>';

            }
        }

        $slider_html .= '<div class="slider-content slide1" style="background: url('.$image[0].')">
        <div class="container">
            <div class="content-part ' . $slider['alignment'] . '">
                <div class="sl-sub-title wow bounceInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">' . $slider['sub_heading'] . '</div>
                <h2 class="sl-title mb-mb-10 wow fadeInRight" data-wow-delay="600ms" data-wow-duration="2000ms">' . $slider['heading'] . '</h2>
                <div class="sl-desc wow fadeInUp" data-wow-delay="900ms" data-wow-duration="2000ms">
                ' . $slider['desc'] . '
                </div>
                <div class="sl-btn wow fadeInUp" data-wow-delay="200ms" data-wow-duration="3000ms">
                    ' . $button_html . '
                </div>
                <div class="slider-video">
                                            <a class="popup-videos" href="https://www.youtube.com/watch?v=atMUy_bPoQI">
                                            <i class="fa fa-play"></i>
                                            </a>
                                        </div>
            </div>
        </div>
    </div>';
    }

    $output .= '<div class="rs-slider style1">
    <div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="true" data-md-device-dots="false">
        ' . $slider_html . '
    </div>
</div>';

    return $output;
}

add_shortcode('cpitwpba_slider', 'cpitwpba_slider_shortcode_function');
