<?php
add_action('vc_before_init', 'cpitwpba_process_two_init');
function cpitwpba_process_two_init()
{
    vc_map(array(
        "name" => __("Process Two", 'cpitwpba'),
        "base" => "cpitwpba_process_two",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('process_two', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Image", "asvc"),
                "param_name" => "image",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Title", "cpitwpba"),
                "param_name" => "title",
                "value" => "",
            ),

        ),
    ));
}

function cpitwpba_process_two_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'image' => '',
        'title' => '',

    ), $atts));

    $image = wp_get_attachment_image_src($image, 'full');

    $output = '';

    $output .= '<div class="rs-process style2">
    <div class="addon-process">
        <div class="process-wrap">
            <div class="process-img">
                <img src="'.$image[0].'" alt="">
            </div>
            <div class="process-text">
                <h3 class="title">'.$title.'</h3>
            </div>
        </div>
        </div>
    </div>';

    return $output;
}

add_shortcode('cpitwpba_process_two', 'cpitwpba_process_two_shortcode_function');
