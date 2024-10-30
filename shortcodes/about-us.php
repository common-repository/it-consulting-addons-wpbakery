<?php
add_action('vc_before_init', 'cpitwpba_about_us_init');
function cpitwpba_about_us_init()
{
    vc_map( array (
        "name" => __("About Us", 'cpitwpba'),
        "base" => "cpitwpba_about_us",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Heading', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Image 1", "asvc"),
                "param_name" => "image1",
                "value" => "",
            ),
            array(
                "type" => "attach_image",
                "heading" => __("Image 2", "asvc"),
                "param_name" => "image2",
                "value" => "",
            ),
            array(
                "type" => "attach_image",
                "heading" => __("Image 3", "asvc"),
                "param_name" => "image3",
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
                'type' => 'param_group',
                'param_name' => 'skillbars',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Skill Name", "cpitwpba"),
                        "param_name" => "skill_name",
                        "value" => __("", "cpitwpba"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Skill Value", "cpitwpba"),
                        "param_name" => "skill_value",
                        "value" => __("", "cpitwpba"),
                        "description" => __("In percent, eg: 92", "cpitwpba")
                    ),
                )

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

function cpitwpba_about_us_shortcode_function($atts, $content = null)
{
    extract( shortcode_atts( array (
        'image1' => '',
        'image2' => '',
        'image3' => '',
        'sub_heading' => '',
        'heading' => '',
        'desc' => '',
        'color' => '',
        'heading_color' => '',
        'desc_color' => '',

    ), $atts));

    $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
    $image1 = wp_get_attachment_image_src( $image1, 'full' );
    $image2 = wp_get_attachment_image_src( $image2, 'full' );
    $image3 = wp_get_attachment_image_src( $image3, 'full' );

    $skillbars = vc_param_group_parse_atts($atts['skillbars']);

    $output = '';

    $skillbar_items = '';
    foreach ($skillbars as $skillbar) {
        $skillbar_items .= '<span class="skillbar-title">'.$skillbar['skill_name'].'</span>
                              <div class="skillbar" data-percent="'.$skillbar['skill_value'].'">
                                  <p class="skillbar-bar"></p>
                                  <span class="skill-bar-percent"></span> 
                              </div>';
    }

    $output .= '<div id="rs-about" class="rs-about style1">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 md-mb-50">
                <div class="rs-animation-shape">
                    <div class="pattern">
                       <img src="'.$image1[0].'"> 
                    </div>
                    <div class="middle">
                       <img class="dance" src="'.$image2[0].'"> 
                    </div>
                    <div class="bottom-shape">
                       <img class="dance2" src="'.$image3[0].'"> 
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 pl-40 md-pl-15 md-pt-200 sm-pt-0">
                <div class="sec-title mb-30">
                    <div class="sub-text" style="color:'.$color.'">'.$sub_heading.'</div>
                    <h2 class="title pb-20" style="color:'.$heading_color.'">
                        '.$heading.'
                    </h2>
                    <div class="desc pr-90 md-pr-0" style="color:'.$desc_color.'">
                       '.$desc.'
                    </div>
                </div>
                <!-- Skillbar Section Start -->
                <div class="row">
                    <div class="col-lg-10">
                        <div class="rs-skillbar style1">
                           <div class="cl-skill-bar">
                              <!-- Start Skill Bar -->
                              '.$skillbar_items.'
                          </div>
                       </div>
                    </div>
                </div>
               <!-- Skillbar Section End -->
            </div>
        </div>
    </div>
</div>';

    $output .= '<style>
    .rs-skillbar.style1 .cl-skill-bar .skillbar .skillbar-bar {
        background-color: '.$color.'
    }
    .sec-title .sub-text::before {
        background-color: '.$color.'
    }
    .sec-title .sub-text::after {
        background-color: '.$color.'
    }
    </style>';

    return $output;
}


add_shortcode('cpitwpba_about_us', 'cpitwpba_about_us_shortcode_function');