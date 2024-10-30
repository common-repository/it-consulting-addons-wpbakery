<?php
add_action('vc_before_init', 'cpitwpba_banner_init');
function cpitwpba_banner_init()
{
    vc_map(array(
        "name" => __("Banner", 'cpitwpba'),
        "base" => "cpitwpba_banner",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Banner', 'js_composer'),
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
            array(
                "type" => "checkbox",
                "heading" => __("Add Video", "cpitwpba"),
                "param_name" => "is_video",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Enter Youtube Video Url", "cpitwpba"),
                "param_name" => "video_url",
                "value" => "",
                'description' => __('eg: https://www.youtube.com/watch?v=y5sPjzN0iaA', 'js_composer'),
                'dependency' => array(
                    'element' => 'is_video',
                    'value' => "true",
                ),
            ),
        

        ),
    ));
}

function cpitwpba_banner_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'image' => '',
        'button' => '',
        'sub_heading' => '',
        'heading' => '',
        'desc' => '',
        'is_video' => '',
        'video_url' => '',
        'color' => '',

    ), $atts));

    $image = wp_get_attachment_image_src($image, 'full');

    $output = '';

    $video_html = '';
    if (isset($is_video) && $video_url !== "") {
        $video_html = '<div class="rs-videos">
        <div class="animate-border white-color style3">
            <a class="popup-border popup-videos" href="'.$video_url.'">
                <i class="fa fa-play"></i>
            </a>
        </div>
    </div>';
    }

    // Button LINK
    $button_html = '';
    if ('' != $button) {
        $href = vc_build_link($button);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $button_html = '<a class="readon started" href="' . $href['url'] . '">' . $href['title'] . '</a>';

        }
    }

    $output .= '<div class="rs-banner style3 rs-rain-animate modify1" style="height:700px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                    '.$video_html.'
                    <div class="sub-title">'.$sub_heading.'</div>
                   <h1 class="title">'.$heading.' </h1>
                    <p class="desc">
                    '.$desc.'
                    </p>
                    <ul class="banner-btn">
                        <li>'.$button_html.'</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>                
    <div class="images-part hidden-md">
        <img src="'.$image[0].'" alt="">
    </div>
    <div class="line-inner style2">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
</div>';

    return $output;
}

add_shortcode('cpitwpba_banner', 'cpitwpba_banner_shortcode_function');
