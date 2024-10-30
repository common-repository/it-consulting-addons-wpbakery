<?php
add_action('vc_before_init', 'cpitwpba_service_two_init');
function cpitwpba_service_two_init()
{
    vc_map(array(
        "name" => __("Service Two", 'cpitwpba'),
        "base" => "cpitwpba_service_two",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('service_two', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Icon Image", "asvc"),
                "param_name" => "icon_image",
                "value" => "",
            ),

            array(
                "type" => "textfield",
                "heading" => __("Title", "cpitwpba"),
                "param_name" => "title",
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
                'heading' => __('Service Link', 'cpitwpba'),
                'param_name' => 'link',
                'value' => '',
            ),

            // Style Group  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            array(
                'type' => 'colorpicker',
                'heading' => __('Title Color', 'cpitwpba'),
                'param_name' => 'title_color',
                'group' => __('Style', 'cpitwpba'),
                'admin_label' => true,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Description Color', 'cpitwpba'),
                'param_name' => 'desc_color',
                'group' => __('Style', 'cpitwpba'),
                'admin_label' => true,
            ),

        ),
    ));
}

function cpitwpba_service_two_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'icon_image' => '',
        'title' => '',
        'link' => '',
        'desc' => '',
        'title_color' => '',
        'desc_color' => '',

    ), $atts));

    $icon_image = wp_get_attachment_image_src($icon_image, 'full');

    $output = '';

    // LINK
    $link_html = '';
    if ('' != $link) {
        $href = vc_build_link($link);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $link_html = '<h3 class="title"><a style="color:' . $title_color . '" ' . $target . ' href="' . $href['url'] . '">' . $title . '</a></h3>';

        }
    } else {
        $link_html = '<h3 class="title"><a style="color:' . $title_color . '" href="#">' . $title . '</a></h3>';

    }

    $output .= '<div class="rs-services style4">
    <div class="services-item">
    <div class="services-icon">
        <img src="' . $icon_image[0] . '" alt="">
    </div>
    <div class="services-content">
    ' . $link_html . '
        <p class="desc" style="color:' . $desc_color . '">
        ' . $desc . '
        </p>
    </div>
</div>
</div>';

    return $output;
}

add_shortcode('cpitwpba_service_two', 'cpitwpba_service_two_shortcode_function');
