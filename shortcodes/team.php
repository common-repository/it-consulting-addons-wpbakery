<?php
add_action('vc_before_init', 'cpitwpba_team_init');
function cpitwpba_team_init()
{
    vc_map(array(
        "name" => __("Team Member", 'cpitwpba'),
        "base" => "cpitwpba_team",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Team Member', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Member Image", "asvc"),
                "param_name" => "image",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Member Name", "cpitwpba"),
                "param_name" => "name",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Designation", "cpitwpba"),
                "param_name" => "designation",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Facebook Url", "cpitwpba"),
                "param_name" => "facebook",
                "value" => "",
                'group' => __('Social Links', 'cpitwpba'),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Twitter Url", "cpitwpba"),
                "param_name" => "twitter",
                "value" => "",
                'group' => __('Social Links', 'cpitwpba'),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Instagram Url", "cpitwpba"),
                "param_name" => "instagram",
                "value" => "",
                'group' => __('Social Links', 'cpitwpba'),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Pintarest Url", "cpitwpba"),
                "param_name" => "pintarest",
                "value" => "",
                'group' => __('Social Links', 'cpitwpba'),
            ),

        ),
    ));
}

function cpitwpba_team_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'image' => '',
        'name' => '',
        'designation' => '',
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'pintarest' => '',

    ), $atts));

    $image = wp_get_attachment_image_src($image, 'full');

    $output = '';

    $output .= '<div class="rs-team">
    <div class="team-item-wrap">
    <div class="team-wrap">
        <div class="image-inner">
            <img src="' . $image[0] . '" alt="">
        </div>
    </div>
    <div class="team-content text-center">
        <h4 class="person-name">' . $name . '</h4>
        <span class="designation">' . $designation . '</span>
        <ul class="team-social">';

    if (!empty($facebook)) {
        $output .= '<li><a href="' . $facebook . '"><i class="fa fa-facebook"></i></a></li>';
    }
    if (!empty($twitter)) {
        $output .= '<li><a href="' . $twitter . '"><i class="fa fa-twitter"></i></a></li>';
    }
    if (!empty($instagram)) {
        $output .= '<li><a href="' . $instagram . '"><i class="fa fa-instagram"></i></a></li>';
    }
    if (!empty($pintarest)) {
        $output .= '<li><a href="' . $pintarest . '"><i class="fa fa-pinterest-p"></i></a></li>';
    }

    $output .= '</ul></div></div></div>';

    return $output;
}

add_shortcode('cpitwpba_team', 'cpitwpba_team_shortcode_function');
