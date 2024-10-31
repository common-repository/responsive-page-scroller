<?php
/*
  Plugin Name: Responsive Page Scroller
  Plugin URI: http://fantasticplugins.com/shop/responsive-page-scroller
  Description: Responsive Page Scroller adds beautiful scroller buttons to scroll from top to bottom and vice versa of your WordPress site. Checkout Pro Version <a href="http://fantasticplugins.com/shop/easy-wordpress-scroller/">Easy WordPress Scroller</a>.
  Version: 1.2
  Author: Fantastic Plugins
  Author URI: http://fantasticplugins.com
  License: GPLv2
 */

class ResponsivePageScroller {

    function __construct() {

        require_once('inc/admin.php');
        if (isset($_POST['reset'])) {
            add_action('admin_init', array($this, 'add_pagescroll_option'));
        }
    }

    function fantastic_page_scroll_admin_menu() {
        add_submenu_page('options-general.php', 'Responsive Page Scroller', 'Responsive Page Scroller', 'manage_options', 'fantastic_page_scroller_button', 'fantasticpagescroller_admin_pages');
    }

    function update_pagescroll_option() {


        register_setting('fantastic_page_scroller', 'page_align');
        register_setting('fantastic_page_scroller', 'page_align_image');
        register_setting('fantastic_page_scroller', 'page_scroller_on');
        register_setting('fantastic_page_scroller', 'scroller_credit_link');
    }

    function add_pagescroll_option() {


        delete_option('page_align');
        delete_option('page_align_image');
        delete_option('page_scroller_on');
        add_option('page_align', '2');
        add_option('page_align_image', '1');
        delete_option('scroller_credit_link');
        add_option('scroller_credit_link', '1');
        delete_option('scroller_credits_defaults_new');
        delete_option('scroller_credits');
        delete_option('scroller_credit_text_new');

//Anchor Text
        $input_random_key = rand(0, 1);
        if ($input_random_key == '0') {
            $input_anchor_text = array("WordPress Plugins", "WordPress Plugin", "WordPress Plugins", "WordPress Plugin", "Premium WordPress Plugins", "Premium WordPress Plugin", "Premium WordPress Plugins", "Premium WordPress Plugin", "Fantastic Plugins", "Fantastic Plugin", "WordPress Premium Plugins", "WordPress Premium Plugin", "WP Plugins", "WP Plugin", "Premium WP Plugins", "Premium WP Plugin", "WP Premium Plugins", "WP Premium Plugin", "Plugins", "Plugin");
            $rand_anchor_text = rand(0, 19);
            $input_url = array("http://fantasticplugins.com");
            $rand_url = rand(0, 0);
            $input_text = array("Responsive Page Scroller Sponsor", "Plugin Sponsor", "Plugin Supporter", "Plugin Engineered By", "Responsive Page Scroller Supported By", "Page Scroller Engineered By", "Supporter of Page Scroller", "Plugin Support By", "Plugin Sponsor", "Plugin Sponsor Credit To");
            $random_text = rand(0, 9);
        }
        if ($input_random_key == '1') {
            $input_anchor_text = array("WordPress Page Scroller", "WordPress Scroller Plugin", "WordPress Scroller Plugins", "Easy WordPress Scroller", "Responsive Page Scroller", "Smooth Scroller", "Easy Scroller", "Top to Bottom", "Bottom to Top", "Scroller Plugins");
            $rand_anchor_text = rand(0, 9);
            $input_url = array("http://fantasticplugins.com/shop/easy-wordpress-scroller");
            $rand_url = rand(0, 0);
            $input_nofollow = array("nofollow", "dofollow");
            $random = rand(0, 100);
            $input_text = array("Page Scroller Sponsor", "Plugin Sponsor", "Plugin Supporter", "Plugin Engineered By", "Page Scroller Supported By", "Page Scroller Engineered By", "Supporter of Page Scroller", "Plugin Support By", "Plugin Sponsor", "Plugin Sponsor Credit To");
            $random_text = rand(0, 9);
        }
        $nofollow_key = 1;
        if ($random <= 90) {
            $nofollow_key = 1;
        } else {
            $nofollow_key = 0;
        }
        add_option('scroller_credits_defaults_new', $input_url[$rand_url]);
        add_option('scroller_credits', $input_anchor_text[$rand_anchor_text]);
        add_option('scroller_credits_nofollow_new', $input_nofollow[$nofollow_key]);
        add_option('scroller_credit_text_new', $input_text[$random_text]);
    }

    function pagescroller() {
        if (get_option('page_scroller_on') != '1') {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {

                    jQuery('.scrollup').click(function($) {

                        jQuery('a:focus').css("outline", "none");
                    });
                    jQuery('.scrolldown').click(function($) {

                        jQuery('a:focus').css("outline", "none");
                    });
                    jQuery('.scrolldown').fadeIn();
                    var firsthalf = jQuery(document).height();
                    var first = firsthalf / 6;
                    jQuery(window).scroll(function($) {

                        if (jQuery(this).scrollTop() >= first) {
                            jQuery('.scrollup').fadeIn();
                        } else {
                            jQuery('.scrollup').fadeOut();
                        }
                        if (jQuery(this).scrollTop() <= first) {
                            jQuery('.scrolldown').fadeIn();
                        } else {
                            jQuery('.scrolldown').fadeOut();
                        }
                    });

                    jQuery('.scrollup').click(function() {
                        jQuery("html, body").animate({scrollTop: 0}, 900);
                        return false;

                    });
                    jQuery('.scrolldown').click(function() {
                        jQuery("html, body").animate({scrollTop: jQuery(document).height() - jQuery(window).height()}, 900);
                        return false;
                    });


                });
            </script>

            <?php
            $i = 0;
            $j = 0;

            for ($i = 1, $j = 1; $i <= 5; $i++, $j = $j + 2) {
                if ($j > 10) {
                    $j = 1;
                }

                if (get_option('page_align_image') == $i) {
//Dynamically generate the foler name
                    $directory_name_temp = "/responsive-page-scroller/assets/type";
                    $directory_slash = "/";
                    $directory_mod_number = ($i + 10) % 10;
                    if ($directory_mod_number == '0') {
                        $directory_mod_number = 10;
                    }
                    $directory_div_number = ($i + 10) / 10;
                    $directory_number = $directory_div_number - ($directory_mod_number / 10);
                    $directory_name = $directory_name_temp . $directory_number;
                    $directory_name = $directory_name . $directory_slash;


//Dynamically generate the file name
                    $file_name_temp = ".png";
                    $file_name_previous = $j;
                    $file_name_previous = $file_name_previous . $file_name_temp;
                    $file_name_next = $j + 1;
                    $file_name_next = $file_name_next . $file_name_temp;

                    $full_file_name_previous = $directory_name . $file_name_previous;
                    $full_file_name_next = $directory_name . $file_name_next;
                    $full_file_name_previous;
                    ?>
                    <style type="text/css">

                        .scrollup{
                            background: url('<?php echo WP_PLUGIN_URL . $full_file_name_previous; ?>') no-repeat;
                        }
                        .scrolldown {
                            background: url('<?php echo WP_PLUGIN_URL . $full_file_name_next; ?>') no-repeat;
                        }
                    </style>


                    <?php
                    break;
                }
            }
            ?>

            <style type="text/css">
                .scrollup{
                    width:120px;
                    height:80px;

                    position:fixed;
                    bottom:50px;
                    <?php if (get_option('page_align') == '2') { ?>
                        right:100px;
                    <?php } else { ?>
                        left:100px;
                    <?php } ?>
                    display:none;
                    text-indent:-9999px;
                    z-index:999999999;

                }

                .scrolldown {
                    width:120px;
                    height:80px;

                    position:fixed;
                    <?php if (get_option('page_align') == '2') { ?>
                        right:100px;
                    <?php } else { ?>
                        left:100px;
                    <?php } ?>
                    top:50px;
                    display:none;
                    text-indent:-9999px;
                    z-index:999999999;

                }
                @media screen and (min-width: 320px) and (max-width: 480px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:33%;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:30px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:33%;

                    }



                }
                @media screen and (min-width: 0px) and (max-width: 320px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:33%;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:30px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:33%;

                    }



                }
                @media screen and (min-width: 360px) and (max-width: 640px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:35%;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:50px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:35%;

                    }



                }
                @media screen and (min-width: 768px) and (max-width: 1024px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:40%;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:50px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:40%;

                    }



                }
                @media screen and (min-width: 800px) and (max-width: 1280px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:45%;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:50px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-75px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:45%;

                    }



                }
                @media screen and (min-width: 980px) and (max-width: 1280px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-65px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:40%;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:50px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-65px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;
                        background-size:40%;

                    }



                }
                @media screen and (min-width: 1280px) and (max-width: 600px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-65px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:50px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-65px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;

                    }



                }
                @media screen and (min-width: 1920px) and (max-width: 900px)  {
                    .scrolldown
                    {
                        width:120px;
                        height:80px;
                        z-index:999999999;
                        position:fixed;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-65px;
                        <?php } else { ?>
                            left: -4px;
                        <?php } ?>
                        top:50px;
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;


                    }
                    .scrollup{
                        width:120px;
                        height:80px;

                        position:fixed;
                        bottom:50px;
                        <?php if (get_option('page_align') == '2') { ?>
                            right:-65px;
                        <?php } else { ?>
                            left:-4px;
                        <?php } ?>
                        display:none;
                        text-indent:-9999px;
                        z-index:999999999;

                    }



                }

            </style>

            <a href="#" class="scrollup">Scroll</a>

            <a href="#" class="scrolldown">Scroll Down</a>
            <?php
        }
    }

}

function jquery_add_to_head() {
    wp_enqueue_script('jquery');  // Enqueue jQuery that's already built into WordPress
}

add_action('wp_enqueue_scripts', 'jquery_add_to_head');

function add_scroller_credit_link() {
    if (get_option('page_scroller_on') != '1') {
        if (get_option('scroller_credit_link') != 2) {
            ?>
            <center><small> <small align="center"><?php echo get_option('scroller_credit_text_new'); ?><a href="<?php echo get_option('scroller_credits_defaults_new'); ?>" rel="<?php echo get_option('scroller_credits_nofollow_new'); ?>" > <?php echo get_option('scroller_credits'); ?></a> </small> </small> </center>
            <?php
        }
    }
}

$new = new ResponsivePageScroller();
add_action('wp_footer', array('ResponsivePageScroller', 'pagescroller'));
add_action('wp_footer', 'add_scroller_credit_link');
add_action('admin_init', array('ResponsivePageScroller', 'update_pagescroll_option'));
add_action('admin_menu', array('ResponsivePageScroller', 'fantastic_page_scroll_admin_menu'));
register_activation_hook(__FILE__, array('ResponsivePageScroller', 'add_pagescroll_option'));
?>