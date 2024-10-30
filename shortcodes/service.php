<?php
add_action('vc_before_init', 'cpitwpba_service_init');
function cpitwpba_service_init()
{
    vc_map(array(
        "name" => __("Service", 'cpitwpba'),
        "base" => "cpitwpba_service",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Service', 'js_composer'),
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

function cpitwpba_service_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'icon_image' => '',
        'title' => '',
        'link' => '',
        'desc' => '',
        'title_color' => '',
        'desc_color' => '',

    ), $atts));

    $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
    $icon_image = wp_get_attachment_image_src($icon_image, 'full');

    $output = '';

    // LINK
    $link_html = '';
    if ('' != $link) {
        $href = vc_build_link($link);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $link_item = '<h3 class="services-title"><a style="color:'.$title_color.'" ' . $target . ' href="' . $href['url'] . '">' . $title . '</a></h3>';

        }
    } else {
        $link_item = '<h3 class="services-title"><a style="color:'.$title_color.'" href="#">' . $title . '</a></h3>';

    }

    $output .= '<div class="rs-services">
    <div class="services-item">
        <div class="services-icon">
            <div class="image-part">
                <img class="item-image" src="' . $icon_image[0] . '" alt="">
            </div>
        </div>
        <div class="services-content">
            <div class="services-text">
                ' . $link_item . '
            </div>
            <div class="services-desc">
                <p style="color:'.$desc_color.'">
                    ' . $desc . '
                </p>
            </div>
        </div>
    </div></div>';

    return $output;
}

add_shortcode('cpitwpba_service', 'cpitwpba_service_shortcode_function');
