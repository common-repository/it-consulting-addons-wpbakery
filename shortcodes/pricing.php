<?php
add_action('vc_before_init', 'cpitwpba_pricing_init');
function cpitwpba_pricing_init()
{
    vc_map(array(
        "name" => __("Pricing Table", 'cpitwpba'),
        "base" => "cpitwpba_pricing",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Pricing Table', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Image Icon", "asvc"),
                "param_name" => "image_icon",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Badge Text", "cpitwpba"),
                "param_name" => "badge",
                "value" => "",
                "description" => __("eg: Premium, Silver, Gold etc", "cpitwpba"),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Currency", "cpitwpba"),
                "param_name" => "currency",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Price", "cpitwpba"),
                "param_name" => "price",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Time Period", "cpitwpba"),
                "param_name" => "time_period",
                "value" => "",
            ),
            array(
                "type" => "checkbox",
                "heading" => __("Make Highlight", "cpitwpba"),
                "param_name" => "highlight",
            ),
            array(
                'type' => 'vc_link',
                'heading' => __('Button Text & Link', 'cpitwpba'),
                'param_name' => 'button',
                'value' => '',
            ),
            array(
                'type' => 'param_group',
                'param_name' => 'features',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Feature Text", "cpitwpba"),
                        "param_name" => "feature_text",
                        "value" => __("", "cpitwpba"),
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Is Available?", "cpitwpba"),
                        "param_name" => "available",
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

function cpitwpba_pricing_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'image_icon' => '',
        'badge' => '',
        'currency' => '',
        'price' => '',
        'time_period' => '',
        'highlight' => '',
        'button' => '',
        'features' => '',
        'price_color' => '',
        'tmp_color' => '',

    ), $atts));

    $image_icon = wp_get_attachment_image_src($image_icon, 'full');

    $features = vc_param_group_parse_atts($atts['features']);

    $output = '';

    $features_html = '';
    foreach ($features as $feature) {
        if (isset($feature['available'])) {
            $f_icon = 'fa-check';
        } else {
            $f_icon = 'fa-close';
        }
        $features_html .= '<li><i class="fa ' . $f_icon . '"></i><span>' . $feature['feature_text'] . '</span></li>';

    }

    // Button LINK
    $button_html = '';
    if ('' != $button) {
        $href = vc_build_link($button);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $button_html = '<a class="readon buy-now" href="' . $href['url'] . '">' . $href['title'] . '</a>';

        }
    }

    if ($highlight) {
        $hlt_class = 'primary-bg';
    } else {
        $hlt_class = '';
    }

    $output .= '<div class="rs-pricing white-bg">
    <div class="pricing-table ' . $hlt_class . '">
        <div class="pricing-badge">
            ' . $badge . '
        </div>
        <div class="pricing-icon">
            <img src="' . $image_icon[0] . '" alt="">
        </div>
        <div class="pricing-table-price">
            <div class="pricing-table-bags">
                <span class="pricing-currency" style="color: '.$price_color.'">' . $currency . '</span>
                <span class="table-price-text" style="color: '.$price_color.'">' . $price . '</span>
                <span class="table-period" style="color: '.$tmp_color.'">' . $time_period . '</span>
            </div>
        </div>
        <div class="pricing-table-body">
            <ul>
                ' . $features_html . '
            </ul>
        </div>
        <div class="btn-part">
            ' . $button_html . '
        </div>
    </div>
    </div>';

    return $output;
}

add_shortcode('cpitwpba_pricing', 'cpitwpba_pricing_shortcode_function');
