<?php
add_action('vc_before_init', 'cpitwpba_call_to_action_init');
function cpitwpba_call_to_action_init()
{
    vc_map(array(
        "name" => __("Call To Action", 'cpitwpba'),
        "base" => "cpitwpba_call_to_action",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Call To Action', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Image", "asvc"),
                "param_name" => "image",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Sub Title", "cpitwpba"),
                "param_name" => "sub_title",
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
                'heading' => __('Button Text & Link', 'cpitwpba'),
                'param_name' => 'button',
                'value' => '',
            ),

            // Counter Group  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            array(
                'type' => 'param_group',
                'param_name' => 'counters',
                'group' => __('Counter', 'cpitwpba'),
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Counter Title", "cpitwpba"),
                        "param_name" => "title",
                        "value" => "",
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Counter Value", "cpitwpba"),
                        "param_name" => "value",
                        "value" => "",
                    ),
                ),

            ),
        ),
    ));
}

function cpitwpba_call_to_action_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'image' => '',
        'sub_title' => '',
        'title' => '',
        'button' => '',
        'desc' => '',
        'counters' => '',

    ), $atts));

    $image = wp_get_attachment_image_src($image, 'full');

    $counters = vc_param_group_parse_atts($atts['counters']);

    $output = '';

    if (!empty($counters)) {
        $counter_items = '<div class="rs-counter">
        <div class="counter-top-area text-center bg2">
        <div class="row">';
        foreach ($counters as $counter) {
            $counter_items .= '<div class="col-md-4">
            <div class="counter-list">
                <div class="counter-text">
                    <div class="count-number">
                        <span class="rs-count">' . $counter['value'] . '</span>
                    </div>
                    <h3 class="title">' . $counter['title'] . '</h3>
                </div>
            </div>
            </div>';
        }
        $counter_items .= '</div></div></div>';
    } else {
        $counter_items = '';
    }

    // Button LINK
    $button_html = '';
    if ('' != $button) {
        $href = vc_build_link($button);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $button_html = '<a class="readon lets-talk" href="' . $href['url'] . '">' . $href['title'] . '</a>';

        }
    }

    $output .= '<div class="rs-call-us bg1 pt-120 md-pt-70 md-pb-80">
                <div class="container">
                    <div class="row rs-vertical-middle">
                        <div class="col-lg-6">
                            <div class="image-part">
                              <img src="' . $image[0] . '" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="rs-contact-box text-center">
                                <div class="address-item mb-25">
                                    <div class="address-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div>
                                <div class="sec-title3">
                                    <span class="sub-text">CALL US 24/7</span>
                                    <h2 class="title">(+123) 456-9989</h2>
                                    <p class="desc">Have any idea or project for in your mind call us or schedule a appointment. Our representative will reply you shortly.</p>
                                </div>
                                <div class="btn-part mt-40">
                                    ' . $button_html . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            ' . $counter_items . '

            ';

    return $output;
}

add_shortcode('cpitwpba_call_to_action', 'cpitwpba_call_to_action_shortcode_function');
