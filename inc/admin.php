<?php

function fantasticpagescroller_admin_pages() {
    ?>
    <style type="text/css">
        #gif,#gif1,#gif2,#gif3
        {
            width:100%;
            height:100%;
            display:none;
            margin-left: 393px;
        }
        #result,#result1,#result2,#result3
        {
            display:none;
            border-color:#e8426d;
            background-color:#FFFFF;
            color:#e8426d;
            border: solid;
            width:160px;
            text-align: center;
            margin-left: 389px;
        }


    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('#submit_general').click(function($)
            {
                jQuery('#gif').css("display", "block");


            });
        });
        function submitgeneral() {
            jQuery.ajax({type: 'POST', url: 'options.php', data: jQuery('#form_general').serialize(), success: function(response) {


                    jQuery('#gif').css("display", "none");
                    jQuery('#result').css("display", "block");
                    jQuery('#result').html("Settings Saved");
                    jQuery('#result').fadeOut(2500, "linear");
                }});

            return false;
        }

    </script>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <link href ="<?php echo WP_CONTENT_URL; ?>/plugins/responsive-page-scroller/css/admin_style.css" type="text/css" rel="stylesheet"/>
    <div class="wrap">
        <?php
        $bpageheader = true;
        if ($bpageheader == true) {
            ?>
            <div class="ic"></div>
            <a href="http://fantasticplugins.com" target="_blank"><h2 style="text-align: left;"><img style="position:relative;top:66px;" src="<?php echo WP_CONTENT_URL; ?>/plugins/responsive-page-scroller/assets/favicon.png"/></h2></a><br/><br/>
            <h2 style="text-align: right;margin-top:-160px;"><label><strong>Check Out Our Pro Version</strong></label></h2>
            <a href="http://fantasticplugins.com/shop/easy-wordpress-scroller/" target="_blank"><h2 style="text-align: right;"><img style="height: 200px;
                                                                                                                                    width: 315px;" src="<?php echo WP_CONTENT_URL; ?>/plugins/responsive-page-scroller/assets/easywordpressscroller.jpg"/></h2></a>
                                                                                                                                <?php } ?>
        <div class="left">

            <div class="metabox-holder4">
                <div class="postbox4">
                    <h3>General Settings</h3>
                    <div class="inside4">
                        <form id="form_general" onsubmit="return submitgeneral();">

                            <?php $opt = get_option('scroll_up'); ?>
                            <?php $optio = get_option('page_align'); ?>
                            <?php
                            $oopti = get_option('page_align_image');
                            $credit = get_option('scroller_credit_link');
                            ?>
                            <?php
                            settings_fields('fantastic_page_scroller');


                            $onoff = get_option('page_scroller_on');
                            ?>
                            <ul>
                                <li>
                                    <label>Disable this Plugin</label>
                                    <input type="checkbox" class="checkbox_general" name="page_scroller_on" style="margin-left:256px;" value="1"<?php checked('1', $onoff); ?>/>
                                </li>
                                <br/>


                                <li>
                                    <label>Alignment</label>
                                    <input type="radio" class="rb2" name="page_align" style="margin-left: 315px;" value="1"<?php checked('1', $optio); ?>/>
                                    <label> LEFT </label><br/>
                                    <input type="radio" class="rbg2" name="page_align" style="margin-left: 392px;" value="2"<?php checked('2', $optio); ?>/>
                                    <label> RIGHT </label>
                                </li><br/><br/>

                                <li>
                                    <label>Credit Link</label>
                                    <input type="radio" class="rb2" name="scroller_credit_link" style="margin-left:308px;" value="1"<?php checked('1', $credit); ?>/><label>&nbsp;ON</label><br/>
                                    <input type="radio" class="rbg2" name="scroller_credit_link" style="margin-left:392px;" value="2"<?php checked('2', $credit); ?>/><label>&nbsp;OFF</label><br/><br/><br/>



                                    <style type="text/css">
                                        .fb > input[type=radio]{
                                            display:none;
                                        }
                                        input[type=radio] + img{
                                            cursor:pointer;
                                            border:2px solid transparent;
                                        }
                                        input[type=radio]:checked + img{
                                            border:2px solid #f00;
                                        }
                                    </style>
                                    <ul>
                                        <li>
                                            <label>Button Style</label>
                                        </li>
                                    </ul>
                                    <table id="auto" style="margin-top:-40px;margin-left:379px;">


                                        <?php
                                        $directory_number = 1;
                                        for ($row = 1; $row <= 1; $row++) {
                                            ?>
                                            <tr>
                                                <?php
                                                $i = 0;
                                                $j = 0;
                                                for ($i = 1, $j = 1; $i <= 5; $i++, $j = $j + 2) {
                                                    $directory_name_temp = "/responsive-page-scroller/assets/type";
                                                    $directory_slash = "/";
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
                                                    $fb_number = ((($row - 1) * 10) + $i);
                                                    ?>

                                                    <td>
                                                        <label class="fb" for='fb<?php echo $fb_number; ?>'>
                                                            <input id="fb<?php echo $fb_number; ?>" type="radio" name="page_align_image" value="<?php echo $fb_number; ?>"<?php checked($fb_number, $oopti); ?> />

                                                            <img src="<?php
                                                            echo WP_PLUGIN_URL .
                                                            $full_file_name_previous;
                                                            ?>">
                                                        </label>
                                                    </td>
                                                    <?php
                                                }
                                                $directory_number++;
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>




                                    </table><br/>




                                    <div id="gif"><img src="<?php echo WP_PLUGIN_URL; ?>/responsive-page-scroller/assets/bar.gif"/></div>
                                    <div id="result"></div>
                                    <p class="submit">
                                        <input type="submit" value="Save" id="submit_general" name="submit" class="button-primary"/>
                                    </p>
                                    </form>

                                    <form method="post" class="form-1" style="margin-top:-46px;">
                                        <input type="submit" value="Reset" name="reset" class="button-secondary"/>
                                        <br/><br/><br/>
                                    </form>

                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <?php
                                    $bpageside1 = true;
                                    if ($bpageside1 == false) {
                                        ?>
                                        <div class="metabox-holder_lp">
                                            <div class="postbox_lp"  >
                                                <h3 class="ad">Want More Fantastic WordPress Plugins?</h3>
                                                <div class="inside_lp">
                                                    <p><strong>If you are not a Member of Fantastic Plugins, try becoming a <a href="http://fantasticplugins.com/" target="_blank">Fantastic Plugins Member</a>. Afterall each Fantastic WordPress Plugin will cost less than a $1 for Members.</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    $bpageside2 = true;
                                    if ($bpageside2 == false) {
                                        ?>
                                        <div class="metabox-holder_latest">
                                            <div class="postbox_latest"  >
                                                <h3 class="ad">Latest News</h3>
                                                <div class="inside_latest">
                                                    <?php
                                                    $new = file_get_contents("http://fantasticplugins.com/blog/feed");
                                                    $x = new SimpleXmlElement($new);
                                                    echo "<ul>";
                                                    $i = 0;
                                                    foreach ($x->channel->item as $entry) {
                                                        if ($i == 5)
                                                            break;
                                                        echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
                                                        $i++;
                                                    }
                                                    echo "</ul>";
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>