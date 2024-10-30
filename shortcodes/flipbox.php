<?php
add_action('vc_before_init', 'cpitwpba_flipbox_init');
function cpitwpba_flipbox_init()
{
    vc_map(array(
        "name" => __("Flip Box", 'cpitwpba'),
        "base" => "cpitwpba_flipbox",
        "icon" => "cpitwpba-icon",
        "category" => __('IT Consult Addons', 'js_composer'),
        //'description' => __('Flip Box', 'js_composer'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Image Icon", "asvc"),
                "param_name" => "image_icon",
                "value" => "",
                'group' => __('Front', 'cpitwpba'),
            ),

            array(
                "type" => "textfield",
                "heading" => __("Title", "cpitwpba"),
                "param_name" => "title_front",
                "value" => "",
                'group' => __('Front', 'cpitwpba'),
            ),
            array(
                "type" => "textarea",
                "heading" => __("Description", "cpitwpba"),
                "param_name" => "desc_front",
                "value" => "",
                'group' => __('Front', 'cpitwpba'),
            ),

            // Flipbox Back Group  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            array(
                "type" => "textfield",
                "heading" => __("Title", "cpitwpba"),
                "param_name" => "title_back",
                "value" => "",
                'group' => __('Back', 'cpitwpba'),
            ),
            array(
                "type" => "textarea",
                "heading" => __("Description", "cpitwpba"),
                "param_name" => "desc_back",
                "value" => "",
                'group' => __('Back', 'cpitwpba'),
            ),
            array(
                'type' => 'vc_link',
                'heading' => __('Button Text and Link', 'cpitwpba'),
                'param_name' => 'button',
                'value' => '',
                'group' => __('Back', 'cpitwpba'),
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

function cpitwpba_flipbox_shortcode_function($atts, $content = null)
{
    extract(shortcode_atts(array(
        'image_icon' => '',
        'title_front' => '',
        'title_back' => '',
        'desc_front' => '',
        'desc_back' => '',
        'button' => '',
        'title_color' => '',
        'desc_color' => '',

    ), $atts));

    $image_icon = wp_get_attachment_image_src($image_icon, 'full');

    $output = '';

    // Button LINK
    $button_html = '';
    if ('' != $button) {
        $href = vc_build_link($button);
        if ($href['url'] !== "") {
            $target = isset($href['target']) && $href['target'] ? "target='" . esc_attr($href['target']) . "'" : 'target="_self"';
            $button_html = '<a class="readon view-more" href="' . $href['url'] . '">' . $href['title'] . '</a>';
        }
    }

    $output .= '<div class="rs-services style2">
    <div class="flip-box-inner">
    <div class="flip-box-wrap">
        <div class="front-part">
           <div class="front-content-part">
                <div class="front-icon-part">
                    <div class="icon-part">
                        <img src="' . $image_icon[0] . '" alt=""> 
                    </div>
                </div>
                <div class="front-title-part">
                    <h3 class="title" style="color: '.$title_color.'">'.$title_front.'</h3>
                </div>
                <div class="front-desc-part">
                    <p style="color: '.$desc_color.'">
                        '.$desc_front.'
                    </p>
                </div>
            </div>
        </div>
        <div class="back-front">
            <div class="back-front-content">
                <div class="back-title-part">
                    <h3 class="back-title">'.$title_back.'</h3>
                </div>
                <div class="back-desc-part">
                    <p class="back-desc">'.$desc_back.'</p>
                </div>
                <div class="back-btn-part">
                   '.$button_html.'
                </div>
            </div>
        </div>
    </div>
</div>
</div>';

    return $output;
}

add_shortcode('cpitwpba_flipbox', 'cpitwpba_flipbox_shortcode_function');
