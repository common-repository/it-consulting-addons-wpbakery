<?php
add_action('vc_before_init', 'cpitwpba_process_init');
function cpitwpba_process_init()
{
    vc_map(array(
        "name" => __("Process Section", 'cpitwpba'),
        "base" => "cpitwpba_process",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Process Section', 'js_composer'),
        "params" => array(
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
                'type' => 'vc_link',
                'heading' => __('Button Text & Link', 'cpitwpba'),
                'param_name' => 'button',
                'value' => '',
            ),

            // Process Group  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            array(
                'type' => 'param_group',
                'param_name' => 'process_items',
                'group' => __('Process Items', 'cpitwpba'),
                'params' => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Number", "cpitwpba"),
                        "param_name" => "number",
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
                ),

            ),
        ),
    ));
}

function cpitwpba_process_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'sub_title' => '',
        'title' => '',
        'button' => '',
        'desc' => '',
        'process_items' => '',

    ), $atts));

    $process_items = vc_param_group_parse_atts($atts['process_items']);

    $output = '';

    if (!empty($process_items)) {
        $process_html = '<div class="col-lg-8 pl-30 md-pl-15">
        <div class="row">';
        foreach ($process_items as $item) {
            $process_html .= '<div class="col-md-6 mb-40">
            <div class="rs-addon-number">
                <div class="number-text">
                    <div class="number-area">
                        '.$item['number'].'
                    </div>
                    <div class="number-title">
                        <h3 class="title">'.$item['title'].'</h3>
                    </div>
                    <p class="number-txt">'.$item['desc'].'</p>
                </div>
            </div>
        </div>';
        }
        $process_html .= '</div></div>';
    } else {
        $process_html = '';
    }

    // Button LINK
    $button_html = '';
    if ('' != $button) {
        $href = vc_build_link($button);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $button_html = '<a class="readon learn-more contact-us" href="' . $href['url'] . '">' . $href['title'] . '</a>';

        }
    }

    $output .= '<div class="rs-process pt-100 pb-80 md-pt-70 md-pb-50">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4  md-mb-40">
                <div class="process-wrap bg3">
                    <div class="sec-title mb-30">
                        <div class="sub-text new">'.$sub_title.'</div>
                        <h2 class="title white-color">
                        '.$title.'
                        </h2>
                    </div>
                    <div class="btn-part mt-40">
                        '.$button_html.'
                    </div>
                </div>
            </div>

            ' . $process_html . '

        </div>
    </div>
</div>';

    return $output;
}

add_shortcode('cpitwpba_process', 'cpitwpba_process_shortcode_function');
