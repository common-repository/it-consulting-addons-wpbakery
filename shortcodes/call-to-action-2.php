<?php
add_action('vc_before_init', 'cpitwpba_call_to_action_two_init');
function cpitwpba_call_to_action_two_init()
{
    vc_map(array(
        "name" => __("Call To Action 2", 'cpitwpba'),
        "base" => "cpitwpba_call_to_action_two",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Call To Action 2', 'js_composer'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", "cpitwpba"),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                'type' => 'vc_link',
                'heading' => __('Button Text & Link', 'cpitwpba'),
                'param_name' => 'button',
                'value' => '',
            ),
        ),
    ));
}

function cpitwpba_call_to_action_two_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'title' => '',
        'button' => '',

    ), $atts));

    $output = '';

    // Button LINK
    $button_html = '';
    if ('' != $button) {
        $href = vc_build_link($button);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $button_html = '<a class="readon learn-more" href="' . $href['url'] . '">' . $href['title'] . '</a>';

        }
    }

    $output .= '<div class="rs-cta style1 bg7 pt-70 pb-70">
    <div class="container">
        <div class="cta-wrap">
            <div class="row align-items-center">
                <div class="col-lg-9 col-md-12 md-pr-0 pr-148 md-pl-15 md-mb-30 md-center">
                    <div class="title-wrap">
                        <h2 class="epx-title">'.$title.'</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 text-righ">
                    <div class="button-wrapt md-center">
                        '.$button_html.'
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

    return $output;
}

add_shortcode('cpitwpba_call_to_action_two', 'cpitwpba_call_to_action_two_shortcode_function');
