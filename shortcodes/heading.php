<?php
add_action('vc_before_init', 'cpitwpba_heading_init');
function cpitwpba_heading_init()
{
    vc_map(array(
        "name" => __("Heading", 'cpitwpba'),
        "base" => "cpitwpba_heading",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Heading', 'js_composer'),
        "params" => array(

            array(
                "type" => "textfield",
                "heading" => __("Sub Heading", "cpitwpba"),
                "param_name" => "sub_heading",
                "value" => "",
                "description" => __("Leave empty if you don't want", "cpitwpba")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Heading", "cpitwpba"),
                "param_name" => "heading",
                "value" => "",
            ),

            // Style Group  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
            array(
                'type' 			=> 'colorpicker',
                'heading' 		=> __( 'Sub heading color', 'cpitwpba' ),
                'param_name' 	=> 'sub_heading_color',
                'group' 		=> __( 'Style', 'cpitwpba' ),
            ),
            array(
                'type' 			=> 'colorpicker',
                'heading' 		=> __( 'heading color', 'cpitwpba' ),
                'param_name' 	=> 'heading_color',
                'group' 		=> __( 'Style', 'cpitwpba' ),
                //'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
            ),



        )
    ));
}

function cpitwpba_heading_shortcode_function($atts, $content = null)
{
    extract( shortcode_atts( array (
        'sub_heading' => '',
        'heading' => '',
        'heading_color' => '',
        'sub_heading_color' => '',

    ), $atts));

    $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

    $output = '';

    $output .= '<div class="sec-title2 text-center">
                        <span class="sub-text" style="color:'.$sub_heading_color.'">'.$sub_heading.'</span>
                        <h2 class="title" style="color:'.$heading_color.'">
                        '.$heading.'
                        </h2>
                        <div class="heading-line" style="background-color:'.$sub_heading_color.'"></div>
                    </div>';


    return $output;
}


add_shortcode('cpitwpba_heading', 'cpitwpba_heading_shortcode_function');