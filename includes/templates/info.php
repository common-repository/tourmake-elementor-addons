<?php
function tea_tourmake_info(){
    ?>
    <div class="wrap">
        <div class="row">
            <h1 class="tea-info-title"><?php _e('Tourmake Elementor Addons', 'tourmake-elementor-addons'); ?></h1>
        </div>
    </div>
    <div class="tea-wrapper">
        <div class="thanks">
            <div class="tea-note">
                <i class="dashicons dashicons-format-quote" aria-hidden="true"></i>
                <p>
				    <?php _e('Thank you for using our plugin! From today, integrating virtual tours created with Tourmake and Viewmake on WordPress sites will be easier and more practical. For any report, request for information or problems encountered, do not hesitate to contact us by writing to wordpress@tourmake.it', 'tourmake-elementor-addons'); ?>
                </p>
            </div>
        </div>
        <div class="tea-box tea-pro">
            <div class="tea-box-title">
                <i class="fa fa-star-o" aria-hidden="true"></i><?php _e('Pro Version', 'tourmake-elementor-addons'); ?>
            </div>
            <div class="tea-box-content">
                <p><?php _e('<b>Tourmake Elementor Addons Pro</b> gives you the opportunity to enrich your website\'s pages with <b>Tourmake hotspots</b> and to create a <b>gallery</b> with your Viewmakes, thanks to 3 new widgets: <b>Tourmake hotspots</b>, <b>Hotspots carousel</b> and <b>Viewmake gallery</b>.', 'tourmake-elementor-addons'); ?></p>
                <p><?php _e('The display of the hotspots is fully customizable according to the style that best suits your website and it\'s responsive, to adapt to mobile devices like tablets and smartphones.', 'tourmake-elementor-addons'); ?></p>
                <p><?php _e('Tourmake Elementor Addons Pro gives you the option to <b>enable/disable</b> the display of the hotspots related to your virtual tour: in this way you will be able to better illustrate to visitors the products and services you offer!', 'tourmake-elementor-addons'); ?></p>
                <p class="tea-usage-title"><?php _e('Usage', 'tourmake-elementor-addons'); ?></p>
                <span class="tea-subtitle"><?php _e('Hotspots', 'tourmake-elementor-addons'); ?></span>
                <p style="line-height: 1.8; margin: 8px 0 0;">
		            <?php _e('Go to the admin menu <span class="tea-menu-tag"> Tourmake Elementor Addons<b> > </b>My tours </span> and click <span class="tea-add-new-action">Add new Tourmake</span>.', 'tourmake-elementor-addons'); ?><br>
                </p>
                <p style="margin-top: 0;">
		            <?php _e('Fill the <b>form</b> and then you will see your Tourmake in the table. Click on the <span class="tea-button-example">Show hotspots</span> button to see all hotspots and choose which you want to show in your website page.<br>Now go to the <b>Elementor panel</b>, choose the Tourmake you want and customize it as you like!', 'tourmake-elementor-addons'); ?>
                </p>
                <span class="tea-subtitle"><?php _e('Gallery', 'tourmake-elementor-addons'); ?></span>
                <p style="line-height: 1.8; margin: 8px 0 0;">
		            <?php _e('Go to the admin menu <span class="tea-menu-tag"> Tourmake Elementor Addons<b> > </b>My tours </span> and click <span class="tea-add-new-action">Create new gallery</span>.', 'tourmake-elementor-addons'); ?><br>
                </p>
                <p style="margin-top: 0;">
		            <?php _e('Fill the <b>form</b> and select the Viewmakes you want to add to the gallery.<br>Now go to the <b>Elementor panel</b>, drag and drop Viewmake gallery widget, choose the gallery you want and customize it as you like!', 'tourmake-elementor-addons'); ?>
                </p>
            </div>
        </div>
        <div class="tea-box info">
            <div class="tea-box-title">
                <i class="fa fa-question-circle" aria-hidden="true"></i><?php _e('What is Tourmake Elementor Addons?', 'tourmake-elementor-addons'); ?>
            </div>
            <div class="tea-box-content">
                <p><?php _e('<b>Tourmake Elementor Addons</b> gives the user new widgets for Elementor Page Builder. With these widgets you can have a new chance to promote your business by adding to your website your <b>Tourmake</b>\'s and <b>Viewmake</b>\'s virtual tours.', 'tourmake-elementor-addons'); ?></p>
                <p style="margin: 8px 0 20px;">
		            <?php _e('Go to the <b>Elementor panel</b> and search for <b>Tourmake widgets</b>. You just have to insert your <b>Tourmake</b> or <b>Viewmake</b> link and your virtual tour will be soon displayed on your page.', 'tourmake-elementor-addons'); ?>
                </p>
                <div class="tea-example">
                    <img src="<?php echo plugins_url('/includes/assets/images/category.jpg', dirname(__DIR__)); ?>">
                </div>
            </div>
        </div>
        <div class="tea-box tea-screenshot">
            <div class="tea-box-title">
                <i class="fa fa-lightbulb-o" aria-hidden="true"></i><?php _e('Examples', 'tourmake-elementor-addons'); ?>
            </div>
            <div class="tea-box-content">
                <p class="tea-usage-title"><?php _e('Tourmake and Viewmake widgets', 'tourmake-elementor-addons'); ?></p>
                <div class="tea-example-pro-grid">
                    <div class="tea-example-pro">
                        <img src="<?php echo plugins_url('/includes/assets/images/tourmake.jpg', dirname(__DIR__)); ?>">
                    </div>
                    <div class="tea-example-pro">
                        <img src="<?php echo plugins_url('/includes/assets/images/viewmake.jpg', dirname(__DIR__)); ?>">
                    </div>
                </div>
                <p class="tea-usage-title"><?php _e('Tourmake hotspots and Hotspots carousel widgets', 'tourmake-elementor-addons'); ?></p>
                <div class="tea-example-pro-grid">
                    <div class="tea-example-pro">
                        <img src="<?php echo plugins_url('/includes/assets/images/tm-hotspots-list.jpg', dirname(__DIR__)); ?>">
                    </div>
                    <div class="tea-example-pro">
                        <img src="<?php echo plugins_url('/includes/assets/images/tm-hotspots-grid.jpg', dirname(__DIR__)); ?>">
                    </div>
                    <div class="tea-example-pro">
                        <img src="<?php echo plugins_url('/includes/assets/images/tm-hotspots-carousel.jpg', dirname(__DIR__)); ?>">
                    </div>
                </div>
                <p class="tea-usage-title"><?php _e('Viewmake gallery widget', 'tourmake-elementor-addons'); ?></p>
                <div class="tea-example-pro-grid">
                    <div class="tea-example-pro">
                        <img src="<?php echo plugins_url('/includes/assets/images/vm-gallery-grid.jpg', dirname(__DIR__)); ?>">
                    </div>
                    <div class="tea-example-pro">
                        <img src="<?php echo plugins_url('/includes/assets/images/vm-gallery-carousel.jpg', dirname(__DIR__)); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}