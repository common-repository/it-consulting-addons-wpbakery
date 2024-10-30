<?php
add_action('vc_before_init', 'cpitwpba_about_us_three_init');
function cpitwpba_about_us_three_init()
{
    vc_map( array (
        "name" => __("About Us 3", 'cpitwpba'),
        "base" => "cpitwpba_about_us_three",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('About Us 3', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Image", "asvc"),
                "param_name" => "image",
                "value" => "",
            ),
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
            ),


            // Style Group  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
            array(
                'type' 			=> 'colorpicker',
                'heading' 		=> __( 'Color', 'cpitwpba' ),
                'param_name' 	=> 'color',
                'group' 		=> __( 'Style', 'cpitwpba' ),
                "value"         => "#03228F",
                'admin_label' 	=> true,
            ),
            array(
                'type' 			=> 'colorpicker',
                'heading' 		=> __( 'Heading Color', 'cpitwpba' ),
                'param_name' 	=> 'heading_color',
                'group' 		=> __( 'Style', 'cpitwpba' ),
                'admin_label' 	=> true,
            ),
            array(
                'type' 			=> 'colorpicker',
                'heading' 		=> __( 'Description Color', 'cpitwpba' ),
                'param_name' 	=> 'desc_color',
                'group' 		=> __( 'Style', 'cpitwpba' ),
                'admin_label' 	=> true,
            ),

        )
    ));
}

function cpitwpba_about_us_three_shortcode_function($atts, $content = null)
{
    extract( shortcode_atts( array (
        'image' => '',
        'sub_heading' => '',
        'heading' => '',
        'desc' => '',
        'button' => '',
        'color' => '',
        'heading_color' => '',
        'desc_color' => '',

    ), $atts));

    $image = wp_get_attachment_image_src( $image, 'full' );

    $output = '';

    // Button LINK
    $button_html = '';
    if ('' != $button) {
        $href = vc_build_link($button);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $button_html = '<a class="readon learn-more contact-us" href="' . $href['url'] . '">' . $href['title'] . '</a>';

        }
    }


    $output .= '<div class="rs-about pt-80 pb-80 md-pt-60 md-pb-60">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 md-mb-30">
                <div class="rs-animation-shape">
                    <div class="images">
                       <img src="'.$image[0].'" alt=""> 
                    </div>
                    <div class="middle-image2">
                       <img class="dance" src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/effect-1.png'.'" alt=""> 
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pl-60 md-pl-15">
                <div class="contact-wrap">
                    <div class="sec-title mb-30">
                        <div class="sub-text style-bg" style="color:'.$color.'">'.$sub_heading.'</div>
                        <h2 class="title pb-38" style="color:'.$heading_color.'">
                        '.$heading.'
                        </h2>
                        <div class="desc pb-35">
                        '.$desc.'
                        </div>
                    </div>
                    <div class="btn-part">
                    ' . $button_html . '
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <img class="top dance" src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/dotted-3.png'.'" alt="">
            <img class="bottom dance" src="'.plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/shape3.png'.'" alt="">
        </div>
    </div>
</div>';

    return $output;
}


add_shortcode('cpitwpba_about_us_three', 'cpitwpba_about_us_three_shortcode_function');