<?php

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hasside = $PAGE->blocks->region_has_content('side', $OUTPUT);
$hastop = $PAGE->blocks->region_has_content('top', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($hasside) {
    $bodyclasses[] = 'side-only';
} else if (!$hasside) {
    $bodyclasses[] = 'content-only';
}

$haslogo = (!empty($PAGE->theme->settings->logo));
$hasfootnote = (!empty($PAGE->theme->settings->footnote));
$hidetagline = (!empty($PAGE->theme->settings->hide_tagline) && $PAGE->theme->settings->hide_tagline == 1);

if (!empty($PAGE->theme->settings->tagline)) {
    $tagline = $PAGE->theme->settings->tagline;
} else {
    $tagline = get_string('defaulttagline', 'theme_spbspu');
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>"/>
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>"/>
    <?php echo $OUTPUT->standard_head_html() ?>
    <link rel="stylesheet" href="<?php echo $CFG->wwwroot?>/theme/spbspu/style/spbstu.css">

    <link rel="stylesheet" href="<?php echo $CFG->wwwroot?>/theme/spbspu/javascript/jquery.jscrollpane.css">
    <script type="text/javascript"
            src="<?php echo $CFG->wwwroot?>/theme/spbspu/javascript/jquery-1.7.1.min.js"></script>
    <script type="text/javascript"
            src="<?php echo $CFG->wwwroot?>/theme/spbspu/javascript/jquery.mousewheel.js"></script>
    <script type="text/javascript"
            src="<?php echo $CFG->wwwroot?>/theme/spbspu/javascript/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot?>/theme/spbspu/javascript/spbstu.js"></script>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses . ' ' . join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page" class="<?php if ($hasnavbar) { ?>with-navbar<?php } else { ?>without-navbar<?php } ?>">
    <?php if ($hasheading) { ?>
    <div id="header">

        <div class="logobar">
            <div class="header-wrapper">
                <div id="logo">
                    <?php if ($haslogo) {
                    echo html_writer::link(new moodle_url('/'), "<img src='" . $PAGE->theme->settings->logo . "' alt='logo' class='logo' />");
                } ?>
                    <h5 class="subtitle"><?php echo $tagline ?></h5>

                    <h2 class="site-name"><?php echo html_writer::link(new moodle_url('/'), $SITE->fullname); ?></h2>

                </div>
                <?php if (isloggedin()) {
                echo html_writer::start_tag('div', array('id' => "userbar"));
                echo html_writer::start_tag('ul', array('class' => "userbsar-links"));
                echo html_writer::tag('span', $OUTPUT->user_picture($USER, array('size' => 16)), array('class' => 'userimg'));
                echo html_writer::start_tag('li', array('id' => 'userdetails', 'class' => 'user-name current-user'));
                echo html_writer::link(new moodle_url('/user/profile.php', array('id' => $USER->id)), $USER->firstname . '&nbsp;' . $USER->lastname);
                echo html_writer::end_tag('li');
                echo html_writer::start_tag('li', array('class' => 'prolog'));
                echo html_writer::link(new moodle_url('/login/logout.php', array('sesskey' => sesskey())), get_string('logout'));
                echo html_writer::end_tag('li');
                echo html_writer::end_tag('ul');
                echo html_writer::end_tag('div');
            } else {
//                                echo html_writer::start_tag('ul', array('class'=>"userbsar-links"));
//                                $loginlink = html_writer::link(new moodle_url('/login/'), get_string('loginhere', 'theme_spbspu'));
//                                echo html_writer::tag('li', get_string('welcome', 'theme_spbspu', $loginlink));
//                                $signuplink = html_writer::link(new moodle_url('/login/signup.php'), get_string('newaccount', 'theme_spbspu'));
//                                echo html_writer::tag('li', $signuplink);
//                                echo html_writer::end_tag('ul');;
            }
                ?>
            </div>
        </div>
        <div class="navbar">
            <div class="header-wrapper">
                <?php if ($hasnavbar) { ?>
                <div class="navbutton"> <?php echo $PAGE->button; ?></div>
                <?php }?>
                <?php
                /* if ($hasheading) { ?>
                 <div id="page-header-wrapper" class="wrapper clearfix">

                    <div id="headermenu">
                    </div>
                    <?php if ($haslogo) { ?>
                    <h4 class="headermain inside">&nbsp;</h4>
                    <?php } else { ?>
                    <h4 class="headermain inside"><?php echo $PAGE->heading ?></h4>
                    <?php } ?>
                </div>
                <?php } // End of if ($hasheading)
                */
                ?>
                <?php if ($hasnavbar) { ?>
                <div class="breadcrumb"><?php if ($hasnavbar) {
                    echo $OUTPUT->navbar();
                } ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } // if ($hasheading) ?>
    <!-- END OF HEADER -->

    <!-- START OF CONTENT -->
    <div id="content">

        <div class="content-box">
            <div class="main-content">
                <!-- DROP DOWN MENU -->
                <?php if ($hasnavbar) { ?>
                <div id="dropdownmenu">
                    <?php if ($hascustommenu) { ?>
                    <div id="custommenu"><?php echo $custommenu; ?></div>
                    <?php } ?>
                </div>
                <?php } // End of if ($hasnavbar)?>
                <!-- END DROP DOWN MENU -->
                <?php if ($hastop) { ?>
                <div id="region-top" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('top') ?>
                    </div>
                </div>
                <?php } ?>

                <div id="region-main">
                    <div class="region-content">
                        <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($hasside) { ?>
        <div id="sidebar">
            <div class="lores-only sidebar-controls" rel="#sidebar"></div>
            <div class="sidebar-content">
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side') ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
    <!-- END OF CONTENT -->


</div>
<!-- START OF FOOTER -->
<?php if ($hasfooter) { ?>
<div id="footer">
    <div id="footer-wrapper">
        <div id="footer-first">
            <p><span class="date">© 2011-<?php echo date('Y'); ?></span>Санкт-Петербургский государственный
                политехнический университет<br>
                Департамент методического обеспечения</p>
            <?php if ($hasfootnote) { ?>
            <div id="footnote"><?php echo $PAGE->theme->settings->footnote; ?></div>
            <?php } ?>
        </div>
        <div id="footer-second">
        </div>
    </div>
</div>
    <?php } ?>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
