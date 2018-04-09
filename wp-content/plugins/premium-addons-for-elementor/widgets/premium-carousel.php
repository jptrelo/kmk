<?php 
namespace Elementor;
if( !defined( 'ABSPATH' ) ) exit; // No access of directly access

class Premium_Carousel_Widget extends Widget_Base {

    protected $templateInstance;

	public function getTemplateInstance() {
		return $this->templateInstance = premium_Template_Tags::getInstance();
	}

	public function get_name() {
		return 'premium-carousel-widget';
	}

	public function get_title() {
		return esc_html__( 'Premium Carousel', 'premium-addons-for-elementor' );
	}

	public function get_icon() {
		return 'pa-carousel';
	}
    
    public function is_reload_preview_required()
    {
       return true;
    }

	public function get_script_depends() {
		return ['slick-carousel-js'];
	}

	public function get_categories() {
		return [ 'premium-elements' ];
	}

    
    // Adding the controls fields for the premium carousel
    // This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		$this->start_controls_section(
			'premium_carousel_global_settings',
			[
				'label' => esc_html__( 'Carousel' , 'premium-addons-for-elementor' )
			]
		);

		$this->add_control(
		  	'premium_carousel_slider_content',
		  	[
		     	'label'			=> esc_html__( 'Content', 'premium-addons-for-elementor' ),
		     	'description'	=> esc_html__( 'Slider content is a template which you can choose from Elementor library. Each template will be a slider content', 'premium-addons-for-elementor' ),
		     	'type' => Controls_Manager::SELECT2,
		     	'options' => $this->getTemplateInstance()->get_elementor_page_list(),
		     	'multiple' => true,
		  	]
		);


		$this->add_control(
			'premium_carousel_slider_type',
			[
				'label'			=> esc_html__( 'Type', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Set a navigation type', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'horizontal',
				'options'		=> [
					'horizontal'	=> esc_html__( 'Horizontal', 'premium-addons-for-elementor' ),
					'vertical'		=> esc_html__( 'Vertical', 'premium-addons-for-elementor' )
				]
			]
		);

		$this->add_control(
			'premium_carousel_slides_to_show',
			[
				'label'			=> esc_html__( 'Appearance', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'all',
				'options'		=> [
					'all'			=> esc_html__( 'All visible', 'premium-addons-for-elementor' ),
					'single'		=> esc_html__( 'One at a time', 'premium-addons-for-elementor' )
				]
			]
		);

		$this->add_control(
			'premium_carousel_responsive_desktop',
			[
				'label'			=> esc_html__( 'Desktop Slides', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 5
			]
		);

		$this->add_control(
			'premium_carousel_responsive_tabs',
			[
				'label'			=> esc_html__( 'Tabs Slides', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 3
			]
		);

		$this->add_control(
			'premium_carousel_responsive_mobile',
			[
				'label'			=> esc_html__( 'Mobile Slides', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 2
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'premium_carousel_slides_settings',
			[
				'label' => esc_html__( 'Slides\' Settings' , 'premium-addons-for-elementor' )
			]
		);
        
		$this->add_control(
			'premium_carousel_loop',
			[
				'label'			=> esc_html__( 'Infinite Loop', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
                'description'   => esc_html__( 'Restart the slider automatically as it passes the last slide', 'premium-addons-for-elementor' ),
				'default'		=> 'yes'
			]
		);

		$this->add_control(
			'premium_carousel_speed',
			[
				'label'			=> esc_html__( 'Transition Speed', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Set a navigation speed value. The value will be counted in milliseconds (ms)', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 300
			]
		);

		$this->add_control(
			'premium_carousel_autoplay',
			[
				'label'			=> esc_html__( 'Autoplay Slides‏', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Slide will start automatically', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'yes'
			]
		);

		$this->add_control(
			'premium_carousel_autoplay_speed',
			[
				'label'			=> esc_html__( 'Autoplay Speed', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Autoplay Speed means at which time the next slide should come. Set a value in milliseconds (ms)', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 5000,
				'condition'		=> [
					'premium_carousel_autoplay' => 'yes'
				],
				'separator'		=> 'after'
			]
		);

        $this->add_control('premium_carousel_animation_list', 
            [
                'label'         => esc_html__('Animations', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::ANIMATION,
            ]
            );

		$this->add_control(
			'premium_carousel_extra_class',
			[
				'label'			=> esc_html__( 'Extra Class', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::TEXT,
                'description'	=> esc_html__( 'Add extra class name that will be applied to the carousel, and you can use this class for your customizations.', 'premium-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'premium_carousel_navigation',
			[
				'label' => esc_html__( 'Navigation', 'premium-addons-for-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);
        
        $this->add_control('premium_carousel_arrow_heading',
            [
                'label'         => esc_html__('Arrows','premium-addons-for-elementor'),
                'type'          => Controls_manager::HEADING,
            ]);

		$this->add_control(
			'premium_carousel_navigation_show',
			[
				'label'			=> esc_html__( 'Arrows', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Enable or disable navigation arrows', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'yes'
			]
		);
        
        $this->add_control(
		    'premium_carousel_arrow_icon_next',
		    [
		        'label' 	=> esc_html__( 'Right Icon', 'premium-addons-for-elementor' ),
		        'type' 		=> Controls_Manager::CHOOSE,
		        'options' 	=> [
		            'right_arrow_bold'    		=> [
		                'icon' => 'fa fa-arrow-right',
		            ],
		            'right_arrow_long' 			=> [
		                'icon' => 'fa fa-long-arrow-right',
		            ],
		            'right_arrow_long_circle' 	=> [
		                'icon' => 'fa fa-arrow-circle-right',
		            ],
		            'right_arrow_angle' 		=> [
		                'icon' => 'fa fa-angle-right',
		            ],
		            'right_arrow_chevron' 		=> [
		                'icon' => 'fa fa-chevron-right',
		            ]
		        ],
		        'default'		=> 'right_arrow_angle',
		        'condition'		=> [
					'premium_carousel_navigation_show' => 'yes',
					'premium_carousel_slider_type!' => 'vertical'
				]
		    ]
		);

		// If the carousel type vertical 
		$this->add_control(
		    'premium_carousel_arrow_icon_next_ver',
		    [
		        'label' 	=> esc_html__( 'Bottom Icon', 'premium-addons-for-elementor' ),
		        'type' 		=> Controls_Manager::CHOOSE,
		        'options' 	=> [
		            'right_arrow_bold'    		=> [
		                'icon' => 'fa fa-arrow-down',
		            ],
		            'right_arrow_long' 			=> [
		                'icon' => 'fa fa-long-arrow-down',
		            ],
		            'right_arrow_long_circle' 	=> [
		                'icon' => 'fa fa-arrow-circle-down',
		            ],
		            'right_arrow_angle' 		=> [
		                'icon' => 'fa fa-angle-down',
		            ],
		            'right_arrow_chevron' 		=> [
		                'icon' => 'fa fa-chevron-down',
		            ]
		        ],
		        'default'		=> 'right_arrow_angle',
		        'condition'		=> [
					'premium_carousel_navigation_show' => 'yes',
					'premium_carousel_slider_type' => 'vertical',
				]
		    ]
		);
        
        // If carousel slider is vertical type
		$this->add_control(
		    'premium_carousel_arrow_icon_prev_ver',
		    [
		        'label' 	=> esc_html__( 'Top Icon', 'premium-addons-for-elementor' ),
		        'type' 		=> Controls_Manager::CHOOSE,
		        'options' 	=> [
		            'left_arrow_bold'    		=> [
		                'icon' => 'fa fa-arrow-up',
		            ],
		            'left_arrow_long' 			=> [
		                'icon' => 'fa fa-long-arrow-up',
		            ],
		            'left_arrow_long_circle' 	=> [
		                'icon' => 'fa fa-arrow-circle-up',
		            ],
		            'left_arrow_angle' 		=> [
		                'icon' => 'fa fa-angle-up',
		            ],
		            'left_arrow_chevron' 		=> [
		                'icon' => 'fa fa-chevron-up',
		            ]
		        ],
		        'default'		=> 'left_arrow_angle',
		        'condition'		=> [
					'premium_carousel_navigation_show' => 'yes',
					'premium_carousel_slider_type' => 'vertical',
				]
		    ]
		);
        
		$this->add_control(
		    'premium_carousel_arrow_icon_prev',
		    [
		        'label' 	=> esc_html__( 'Left Icon', 'premium-addons-for-elementor' ),
		        'type' 		=> Controls_Manager::CHOOSE,
		        'options' 	=> [
		            'left_arrow_bold'    		=> [
		                'icon' => 'fa fa-arrow-left',
		            ],
		            'left_arrow_long' 			=> [
		                'icon' => 'fa fa-long-arrow-left',
		            ],
		            'left_arrow_long_circle' 	=> [
		                'icon' => 'fa fa-arrow-circle-left',
		            ],
		            'left_arrow_angle' 		=> [
		                'icon' => 'fa fa-angle-left',
		            ],
		            'left_arrow_chevron' 		=> [
		                'icon' => 'fa fa-chevron-left',
		            ]
		        ],
		        'default'		=> 'left_arrow_angle',
		        'condition'		=> [
					'premium_carousel_navigation_show' => 'yes',
					'premium_carousel_slider_type!' => 'vertical',
				]
		    ]
		);

		$this->add_control(
			'premium_carousel_arrow_style',
			[
				'label'			=> esc_html__( 'Style', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'default',
				'options'		=> [
					'default'			=> esc_html__( 'Default', 'premium-addons-for-elementor' ),
					'circle-bg'			=> esc_html__( 'Circle Background', 'premium-addons-for-elementor' ),
					'square-bg'			=> esc_html__( 'Square Background', 'premium-addons-for-elementor' ),
					'circle-border'		=> esc_html__( 'Circle border', 'premium-addons-for-elementor' ),
					'square-border'		=> esc_html__( 'Square border', 'premium-addons-for-elementor' ),
				],
				'condition' 	=> [
					'premium_carousel_navigation_show' => 'yes'
				]
			]
		);
        
        $this->add_control(
			'premium_carousel_arrow_color',
			[
				'label' 		=> esc_html__( 'Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_2,
				],
				'condition'		=> [
					'premium_carousel_navigation_show' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .premium-carousel-wrapper .slick-arrow' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
			'premium_carousel_arrow_size',
			[
				'label' => esc_html__( 'Size', 'premium-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60
					],
				],
				'condition'		=> [
					'premium_carousel_navigation_show' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .premium-carousel-wrapper .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'premium_carousel_arrow_bg_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'condition'		=> [
					'premium_carousel_arrow_style' => [ 'circle-bg', 'square-bg' ]
				],
				'selectors' => [
					'{{WRAPPER}} .premium-carousel-wrapper .circle-bg' => 'background: {{VALUE}};',
					'{{WRAPPER}} .premium-carousel-wrapper .square-bg' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'premium_carousel_arrow_border_color',
			[
				'label' 		=> esc_html__( 'Border Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'condition'		=> [
					'premium_carousel_arrow_style' => [ 'circle-border', 'square-border' ]
				],
				'selectors' => [
					'{{WRAPPER}} .premium-carousel-wrapper .square-border' => 'border: solid {{VALUE}};',
					'{{WRAPPER}} .premium-carousel-wrapper .circle-border' => 'border: solid {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'premium_carousel_border_size',
			[
				'label' => esc_html__( 'Border Size', 'premium-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60
					],
				],
				'condition'		=> [
					'premium_carousel_arrow_style' => [ 'circle-border', 'square-border' ]
				],
				'selectors' => [
					'{{WRAPPER}} .premium-carousel-wrapper .square-border' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .premium-carousel-wrapper .circle-border' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control('premium_carousel_arrow_position',
            [
                'label'     => esc_html__('Position (PX)', 'premium-addons-for-elementor'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'   => -50,
                        'max'   => 1,
                    ],
                ],
                'condition'		=> [
                    'premium_carousel_navigation_show' => 'yes',
                    'premium_carousel_slider_type'     => 'horizontal'
				],
            ]
            );
        
        $this->add_control('premium_carousel_dots_heading',
            [
                'label'         => esc_html__('Dots','premium-addons-for-elementor'),
                'type'          => Controls_manager::HEADING,
            ]);

		$this->add_control(
			'premium_carousel_dot_navigation_show',
			[
				'label'			=> esc_html__( 'Dots', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Enable or disable navigation dots', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'yes'
			]
		);
        
        $this->add_control(
		    'premium_carousel_dot_icon',
		    [
		        'label' 	=> esc_html__( 'Icon', 'premium-addons-for-elementor' ),
		        'type' 		=> Controls_Manager::CHOOSE,
		        'options' 	=> [
		            'square_white'    		=> [
		                'icon' => 'fa fa-square-o',
		            ],
		            'square_black' 			=> [
		                'icon' => 'fa fa-square',
		            ],
		            'circle_white' 	=> [
		                'icon' => 'fa fa-circle',
		            ],
		            'circle_thin' 		=> [
		                'icon' => 'fa fa-circle-thin',
		            ],
		            'circle_thin_bold' 		=> [
		                'icon' => 'fa fa-circle-o',
		            ]
		        ],
		        'default'		=> 'circle_white',
		        'condition'		=> [
					'premium_carousel_dot_navigation_show' => 'yes'
				]
		    ]
		);

		$this->add_control(
			'premium_carousel_dot_navigation_color',
			[
				'label' 		=> esc_html__( 'Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_2,
				],
				'condition'		=> [
					'premium_carousel_dot_navigation_show' => 'yes'
				],
				'selectors'		=> [
					'{{WRAPPER}} ul.slick-dots li' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'premium_carousel_dot_navigation_active_color',
			[
				'label' 		=> esc_html__( 'Active Color', 'premium-addons-for-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
				    'type' 	=> Scheme_Color::get_type(),
				    'value' => Scheme_Color::COLOR_1,
				],
				'condition'		=> [
					'premium_carousel_dot_navigation_show' => 'yes'
				],
				'selectors'		=> [
					'{{WRAPPER}} ul.slick-dots li.slick-active' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'premium-carousel-advance-settings',
			[
				'label' => esc_html__( 'Additional Settings' , 'premium-addons-for-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'premium_carousel_draggable_effect',
			[
				'label' 		=> esc_html__( 'Draggable Effect', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Allow the slides to be dragged by mouse click', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'yes'
			]
		);

		$this->add_control(
			'premium_carousel_touch_move',
			[
				'label' 		=> esc_html__( 'Touch Move', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Enable slide moving with touch', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'yes'
			]
		);

		$this->add_control(
			'premium_carousel_RTL_Mode',
			[
				'label' 		=> esc_html__( 'RTL Mode', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Turn on RTL mode if your language starts from right to left', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'no',
				'condition'		=> [
					'premium_carousel_slider_type!' => 'vertical'
				]
			]
		);

		$this->add_control(
			'premium_carousel_adaptive_height',
			[
				'label' 		=> esc_html__( 'Adaptive Height', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Adaptive height setting gives each slide a fixed height to avoid huge white space gaps', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'no'
			]
		);

		$this->add_control(
			'premium_carousel_pausehover',
			[
				'label' 		=> esc_html__( 'Pause on Hover', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Pause the slider when mouse hover', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'no'
			]
		);

		$this->add_control(
			'premium_carousel_center_mode',
			[
				'label' 		=> esc_html__( 'Center Mode', 'premium-addons-for-elementor' ),
				'description'	=> esc_html__( 'Center mode enables a centered view with partial next/previous slides. Animations and all visible scroll type doesn\'t work with this mode', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'no'
			]
		);

		$this->add_control(
			'premium_carousel_space_btw_items',
			[
				'label' 		=> esc_html__( 'Slides\' Spacing', 'premium-addons-for-elementor' ),
                'description'   => esc_html__('Set a spacing value in pixels (px)', 'premium-addons-for-elementor'),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> '15'
			]
		);
	}

	protected function render() {
		$settings = $this->get_settings();
		$options = '';
        $arrows_position = $settings['premium_carousel_arrow_position']['size'] . 'px';
		// Carousel sliding type 
		if( $settings['premium_carousel_slider_type'] == 'horizontal' ){
			$options .= 'vertical: false,'."\r\n";
		} else if( $settings['premium_carousel_slider_type'] == 'vertical' ) {
			$options .= 'vertical: true,'."\r\n";
		} 

		// responsive carousel set up

		$slides_on_desk = $settings['premium_carousel_responsive_desktop'];
		if( $settings['premium_carousel_slides_to_show'] == 'all' ) {
			$slide_to_scroll = $slides_on_desk;
			$options .= 'slidesToScroll: ' . $slide_to_scroll . ','."\r\n";
		} else {
			$slide_to_scroll = 1;
			$options .= 'slidesToScroll: ' . $slide_to_scroll .','."\r\n";
		}

		$options .= 'slidesToShow: ' .$slides_on_desk . ',';

		$slides_on_tabs = $settings['premium_carousel_responsive_tabs'];
		$slides_on_mob = $settings['premium_carousel_responsive_mobile'];

		if( $settings['premium_carousel_responsive_tabs'] == '' ) {
			$slides_on_tabs = $slides_on_desk;
		}

		if( $settings['premium_carousel_responsive_mobile'] == '' ) {
			$slides_on_mob = $slides_on_desk;
		}

		$options .= 'responsive : [
			{
			  	breakpoint: 1025,
			  	settings: {
					slidesToShow: ' . $slides_on_desk . ',
					slidesToScroll: ' . $slide_to_scroll . '
			  	}
			},
			{
			  	breakpoint: 769,
			  	settings: {
					slidesToShow: ' . $slides_on_tabs . ',
					slidesToScroll: ' . $slides_on_tabs . '
			  	}
			},
			{
			  	breakpoint: 481,
			  	settings: {
					slidesToShow: ' . $slides_on_mob . ',
					slidesToScroll: ' . $slides_on_mob . '
			  	}
			}
		],';

		if( $settings['premium_carousel_loop'] == 'yes' ) {
			$options . 'infinite : true,';
		} else {
			$options . 'infinite : false,';
		}

		if( $settings['premium_carousel_speed'] != '' ) {
			$options .= 'speed : ' . $settings['premium_carousel_speed'].',';
		}
		
		if( $settings['premium_carousel_autoplay'] == 'yes' ) {
			$options .= 'autoplay : true,';

			if( $settings['premium_carousel_autoplay_speed'] !== '' ) {
				$options .= 'autoplaySpeed : ' . $settings['premium_carousel_autoplay_speed'] .',';
			}
			
		}

		if( $settings['premium_carousel_draggable_effect'] == 'yes' ) {
			$options .= 'draggable : true,';
		}
		if( $settings['premium_carousel_touch_move'] == 'yes' ) {
			$options .= 'touchMove : true,';
		}
		$dir = '';
		if( $settings['premium_carousel_RTL_Mode'] == 'yes' ) {
			$options .= 'rtl : true,';
			$dir = 'dir="rtl"';
		}
		if( $settings['premium_carousel_adaptive_height'] == 'yes' ) {
			$options .= 'adaptiveHeight : true,';
		}
		if( $settings['premium_carousel_pausehover'] == 'no' ) {
			$options .= 'pauseOnHover: false,';
		} else {
			$options .= 'pauseOnHover: true,';
		}
		if( $settings['premium_carousel_center_mode'] == 'yes' ) {
			$options .= 'centerMode : true,';
		}
		if( $settings['premium_carousel_space_btw_items'] !== '' ) {
			$options .= 'centerPadding : ' . '"'.$settings['premium_carousel_space_btw_items'].'px",';
		}
		// Navigation arrow setting setup
		if( $settings['premium_carousel_navigation_show'] == 'yes') {
			$options .= 'arrows : true,';

			if( $settings['premium_carousel_slider_type'] == 'vertical' ) {
				$vertical_alignment = "ver-carousel-arrow";
			} else {
				$vertical_alignment = "carousel-arrow";
			}
			if( $settings['premium_carousel_arrow_style'] == 'circle-bg' ) {
				$arrow_class = ' circle-bg';
			}
			if( $settings['premium_carousel_arrow_style'] == 'square-bg' ) {
				$arrow_class = ' square-bg';
			}
			if( $settings['premium_carousel_arrow_style'] == 'square-border' ) {
				$arrow_class = ' square-border';
			}
			if( $settings['premium_carousel_arrow_style'] == 'circle-border' ) {
				$arrow_class = ' circle-border';
			}
			if( $settings['premium_carousel_arrow_style'] == 'default' ) {
				$arrow_class = '';
			}
			if( $settings['premium_carousel_slider_type'] == 'vertical' ) {
				$icon_next = $settings['premium_carousel_arrow_icon_next_ver'];
				if( $icon_next == 'right_arrow_bold' ) {
					$icon_next_class = 'fa fa-arrow-down';
				}
				if( $icon_next == 'right_arrow_long' ) {
					$icon_next_class = 'fa fa-long-arrow-down';
				}
				if( $icon_next == 'right_arrow_long_circle' ) {
					$icon_next_class = 'fa fa-arrow-circle-down';
				}
				if( $icon_next == 'right_arrow_angle' ) {
					$icon_next_class = 'fa fa-angle-down';
				}
				if( $icon_next == 'right_arrow_chevron' ) {
					$icon_next_class = 'fa fa-chevron-down';
				}
				$icon_prev = $settings['premium_carousel_arrow_icon_prev_ver'];

				if( $icon_prev == 'left_arrow_bold' ) {
					$icon_prev_class = 'fa fa-arrow-up';
				}
				if( $icon_prev == 'left_arrow_long' ) {
					$icon_prev_class = 'fa fa-long-arrow-up';
				}
				if( $icon_prev == 'left_arrow_long_circle' ) {
					$icon_prev_class = 'fa fa-arrow-circle-up';
				}
				if( $icon_prev == 'left_arrow_angle' ) {
					$icon_prev_class = 'fa fa-angle-up';
				}
				if( $icon_prev == 'left_arrow_chevron' ) {
					$icon_prev_class = 'fa fa-chevron-up';
				}
			} else {
				$icon_next = $settings['premium_carousel_arrow_icon_next'];
				if( $icon_next == 'right_arrow_bold' ) {
					$icon_next_class = 'fa fa-arrow-right';
				}
				if( $icon_next == 'right_arrow_long' ) {
					$icon_next_class = 'fa fa-long-arrow-right';
				}
				if( $icon_next == 'right_arrow_long_circle' ) {
					$icon_next_class = 'fa fa-arrow-circle-right';
				}
				if( $icon_next == 'right_arrow_angle' ) {
					$icon_next_class = 'fa fa-angle-right';
				}
				if( $icon_next == 'right_arrow_chevron' ) {
					$icon_next_class = 'fa fa-chevron-right';
				}
				$icon_prev = $settings['premium_carousel_arrow_icon_prev'];

				if( $icon_prev == 'left_arrow_bold' ) {
					$icon_prev_class = 'fa fa-arrow-left';
				}
				if( $icon_prev == 'left_arrow_long' ) {
					$icon_prev_class = 'fa fa-long-arrow-left';
				}
				if( $icon_prev == 'left_arrow_long_circle' ) {
					$icon_prev_class = 'fa fa-arrow-circle-left';
				}
				if( $icon_prev == 'left_arrow_angle' ) {
					$icon_prev_class = 'fa fa-angle-left';
				}
				if( $icon_prev == 'left_arrow_chevron' ) {
					$icon_prev_class = 'fa fa-chevron-left';
				}
			}

			$next_arrow = '<a type="button" data-role="none" class="'. $vertical_alignment .' carousel-next'.$arrow_class.'" aria-label="Next" role="button" style=""><i class="'.$icon_next_class.'" aria-hidden="true"></i></a>';

			$left_arrow = '<a type="button" data-role="none" class="'. $vertical_alignment .' carousel-prev'.$arrow_class.'" aria-label="Next" role="button" style=""><i class="'.$icon_prev_class.'" aria-hidden="true"></i></a>';

			$options .= 'nextArrow : \''.$next_arrow.'\',';
			$options .= 'prevArrow : \''.$left_arrow.'\',';
		} else {
			$options .= 'arrows : false,';
		}
		if( $settings['premium_carousel_dot_navigation_show'] == 'yes' ){
			$options .= 'dots: true,';
			if( $settings['premium_carousel_dot_icon'] == 'square_white' ) {
				$dot_icon = 'fa fa-square-o';
			}
			if( $settings['premium_carousel_dot_icon'] == 'square_black' ) {
				$dot_icon = 'fa fa-square';
			}
			if( $settings['premium_carousel_dot_icon'] == 'circle_white' ) {
				$dot_icon = 'fa fa-circle';
			}
			if( $settings['premium_carousel_dot_icon'] == 'circle_thin' ) {
				$dot_icon = 'fa fa-circle-thin';
			}
			if( $settings['premium_carousel_dot_icon'] == 'circle_thin_bold' ) {
				$dot_icon = 'fa fa-circle-o';
			}
			$options .= 'customPaging: function(slider, i) {
                   return \'<i class="' . $dot_icon . '"></i>\';
                },';
		}
		$extra_class = $settings['premium_carousel_extra_class'] !== '' ? ' '.$settings['premium_carousel_extra_class'] : '';
		
		$animation_class = $settings['premium_carousel_animation_list'];
		$animation = 'class="item-wrapper" data-animation="animated ' . $animation_class .'"';
		?>
            
			<div id="premium-carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?>" class="premium-carousel-wrapper carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?><?php echo $extra_class;?>" <?php echo $dir; ?>>
				<div id="premium-carousel-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php 
						$boosted_elements_page_id = is_array( $settings['premium_carousel_slider_content'] ) ? $settings['premium_carousel_slider_content'] : array();
						$boosted_elements_frontend = new Frontend;
						
						foreach( $boosted_elements_page_id as $elementor_post_id ) :
					 ?>
					<div <?php echo $animation; ?>>
						<?php echo $boosted_elements_frontend->get_builder_content($elementor_post_id, true); ?>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
            <style>
                <?php if(!empty($settings['premium_carousel_arrow_position']['size'])) : ?>
                #premium-carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?> a.carousel-arrow.carousel-next {
                    right: <?php echo $arrows_position; ?>
                }
                #premium-carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?> a.carousel-arrow.carousel-prev {
                    left: <?php echo $arrows_position; ?>
                }
                <?php endif; ?>
            </style>
			<script type="text/javascript">
				(function( $ ) {
					$(document).ready( function() {
						function slideToShow( slick ) {
							slidesToShow = slick.options.slidesToShow;
							windowWidth = jQuery( window ).width();
				            if ( windowWidth < 1025 ) {
				                slidesToShow = slick.options.responsive[0].settings.slidesToShow;
				            }
				            if ( windowWidth < 769 ) {
				                slidesToShow = slick.options.responsive[1].settings.slidesToShow;
				            }
				            if ( windowWidth < 481 ) {
				                slidesToShow = slick.options.responsive[2].settings.slidesToShow;
				            }
				            return slidesToShow;
						}
						$('.carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?>').on('init', function (event, slick ) {
				            event.preventDefault();
				            $('.carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?> .item-wrapper.slick-active').each(function (index, el) {
				                $this = $(this);
				                $this.addClass($this.data('animation'));
				            });

				           $('.slick-track').addClass('translate');
				            
				        });
						$('#premium-carousel-<?php echo esc_attr( $this->get_id() ); ?>').slick({ <?php echo $options; ?> });

						$('.carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?>').on('afterChange', function (event, slick, currentSlide, nextSlide) {
				            slidesScrolled = slick.options.slidesToScroll;
				            slidesToShow = slideToShow( slick );
				            centerMode = slick.options.centerMode;
				            $currentParent = slick.$slider[0].parentElement.id;
				            slideToAnimate = currentSlide + slidesToShow - 1;

				            if (slidesScrolled == 1) {
				                if ( centerMode == true ) {
				                    animate = slideToAnimate - 2;
				                    $inViewPort = $( '#' + $currentParent + " [data-slick-index='" + animate + "']");
				                    $inViewPort.addClass($inViewPort.data('animation'));
				                } else {
				                    $inViewPort = $( '#' + $currentParent + " [data-slick-index='" + slideToAnimate + "']");
				                    $inViewPort.addClass($inViewPort.data('animation'));
				                }
				            } else {
				                for (var i = slidesScrolled + currentSlide; i >= 0; i--) {
				                    $inViewPort = $( '#' + $currentParent + " [data-slick-index='" + i + "']");
				                    $inViewPort.addClass($inViewPort.data('animation'));
				                }
				            }
				        });

				        $('.carousel-wrapper-<?php echo esc_attr( $this->get_id() ); ?>').on('beforeChange', function (event, slick, currentSlide) {
					            $inViewPort = $("[data-slick-index='" + currentSlide + "']");
					            $inViewPort.siblings().removeClass($inViewPort.data('animation'));
					    });
				        <?php if( $settings['premium_carousel_slider_type'] == 'vertical' ) : ?>
					    var maxHeight = -1;
				        $('.slick-slide').each(function() {
						  if ($(this).height() > maxHeight) {
						    maxHeight = $(this).height();
						  }
						});
						$('.slick-slide').each(function() {
						  if ($(this).height() < maxHeight) {
						    $(this).css('margin', Math.ceil((maxHeight-$(this).height())/2) + 'px 0');
						  }
						});
						<?php endif; ?>
				        var marginFix = {
				        	element : $('a.ver-carousel-arrow'),
				        	getWidth :  function() {
				        		var width = this.element.outerWidth();
				        		return width / 2;
				        	},
				        	setWidth : function( type = 'vertical') {
				        		if( type == 'vertical' ) {
				        			this.element.css( 'margin-left', '-' + this.getWidth() + 'px' );
				        		} else {
				        			this.element.css( 'margin-top', '-' + this.getWidth() + 'px' );
				        		}
				        	}
				        }
					    marginFix.setWidth();
					    marginFix.element = $('a.carousel-arrow');
					    marginFix.setWidth('horizontal');
					});
				})(jQuery);
			</script>
		<?php 

	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Premium_Carousel_Widget() );
