<?php

namespace ElementorTourmake\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Viewmake Elementor widget.
 * @since 1.0.0
 */
class Viewmake extends Widget_Base
{
    /**
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'viewmake';
    }

    /**
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Viewmake', 'tourmake-elementor-addons');
    }

    /**
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'icon-tourmake_icon';
    }

    /**
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['tourmake'];
    }

    /**
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Tour', 'tourmake-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => __('Tour URL', 'tourmake-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('https://viewmake-link.it', 'tourmake-elementor-addons'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Tour options', 'tourmake-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'altezza',
            [
                'label' => __('Height', 'tourmake-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 600,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 400,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 400,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 600,
                        'max' => 1000
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tea-viewmake' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'larghezza',
            [
                'label' => esc_html__('Width %', 'tourmake-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'width: {{SIZE}}{{UNIT}}; margin: auto !important;',
                ],
            ]
        );
        $this->add_control(
            'scroll',
            [
                'label' => __('Zoom lock', 'tourmake-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'tourmake-elementor-addons'),
                'label_on' => __('Yes', 'tourmake-elementor-addons'),
                'return_value' => 'true',
            ]
        );
        $this->add_control(
            'fullscreen',
            [
                'label' => __('Fullscreen', 'tourmake-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'tourmake-elementor-addons'),
                'label_on' => __('Yes', 'tourmake-elementor-addons'),
                'return_value' => 'true',
                'default' => 'true',
            ]
        );
        $this->end_controls_section();
    }

    /**
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $scroll = '';
        $fullscreen = '';

        if($settings['scroll']) {
            $scroll = '?scroll=0';
        }

        if ($settings['fullscreen']) {
            $fullscreen = 'allowfullscreen';
        }

        if (filter_var($settings['url'], FILTER_VALIDATE_URL)) {
            $result = $this->tea_check_viewmake_domain($settings['url']);
            if($result) {
                echo '<iframe class="tea-viewmake" src="'.$settings['url'].$scroll.'" '.$fullscreen.'></iframe>';
            } else {
                echo '<iframe height="600px" src="http://tourmake.it/404"></iframe>';
            }
        } else {
            echo '<div class="tea-empty-viewmake">
                      <img src="'.plugins_url('/includes/assets/images/logo_viewmake.png', __DIR__).'">
                  </div>';
        }
    }

    private function tea_check_viewmake_domain($url){
        $data = parse_url($url);
        $host = $data['host'];
        $hostname = explode(".", $host);
        $domain = $hostname[count($hostname) - 2] . "." . $hostname[count($hostname) - 1];

        if (strpos($domain, 'viewmake') === false) {
            return false;
        }
        return true;
    }
}