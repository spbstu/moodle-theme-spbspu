<?php

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$hastop = $PAGE->blocks->region_has_content('top', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
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
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <link rel="stylesheet" href="<?php echo $CFG->wwwroot?>/theme/spbspu/style/moodle-theme.css">
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
    <?php echo $OUTPUT->standard_top_of_body_html() ?>
    <div id="page">
        <?php if ($hasheading) { ?>
        <div id="header">
            <div id="logo">
                <?php if ($haslogo) {
                        echo html_writer::link(new moodle_url('/'), "<img src='".$PAGE->theme->settings->logo."' alt='logo' class='logo' />");
                    } ?>
                <h5 class="subtitle"><?php echo $tagline ?></h5>

                <h2 class="site-name"><?php echo html_writer::link(new moodle_url('/'), $PAGE->heading); ?></h2>
            </div>
            <div id="userbar">
                    <?php if (isloggedin()) {
                        echo html_writer::start_tag('ul', array('class'=>"userbsar-links"));
                        echo html_writer::tag('span', $OUTPUT->user_picture($USER, array('size'=>24)), array('class'=>'userimg'));
                        echo html_writer::start_tag('li', array('id'=>'userdetails', 'class'=>'user-name current-user'));
                        echo html_writer::tag('span', $USER->firstname.'&nbsp;'.$USER->lastname);
                        echo html_writer::start_tag('li', array('class'=>'prolog'));
                        echo html_writer::link(new moodle_url('/user/profile.php', array('id'=>$USER->id)), get_string('myprofile'));
                        echo html_writer::end_tag('li');
                        echo html_writer::start_tag('li', array('class'=>'prolog'));
                        echo html_writer::link(new moodle_url('/login/logout.php', array('sesskey'=>sesskey())), get_string('logout'));
                        echo html_writer::end_tag('li');
                        echo html_writer::end_tag('ul');
                        } else {
                            echo html_writer::start_tag('ul', array('class'=>"userbsar-links"));
                            $loginlink = html_writer::link(new moodle_url('/login/'), get_string('loginhere', 'theme_spbspu'));
                            echo html_writer::tag('li', get_string('welcome', 'theme_spbspu', $loginlink));
                            $signuplink = html_writer::link(new moodle_url('/login/signup.php'), get_string('newaccount', 'theme_spbspu'));
                            echo html_writer::tag('li', $signuplink);
                            echo html_writer::end_tag('ul');;
                        }
                    ?>
            </div>

            <div id="page-header-wrapper" class="wrapper clearfix">
                <?php if ($hasheading) { ?>
                <div id="headermenu">
                </div>
                <?php if ($haslogo) { ?>
                <h4 class="headermain inside">&nbsp;</h4>
                <?php } else { ?>
                <h4 class="headermain inside"><?php echo $PAGE->heading ?></h4>
                <?php } ?>
            <?php } // End of if ($hasheading)?>
            </div>
        </div>
    <?php } // if ($hasheading) ?>
        <!-- END OF HEADER -->

        <!-- START OF CONTENT -->
        <div id="content">
            <?php if ($hassidepre || $hassidepost) { ?>
            <div id="sidebar">

            <?php if ($hassidepre) { ?>
            <div id="region-pre" class="block-region">
                <div class="region-content">
                    <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                </div>
            </div>
            <?php } ?>

            <?php if ($hassidepost) { ?>
            <div id="region-post" class="block-region">
                <div class="region-content">
                    <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                </div>
            </div>
            <?php } ?>
            </div>
            <?php } ?>

            <div class="content-box">
                <!-- DROP DOWN MENU -->
                <?php if($hasnavbar) { ?>
                <div id="dropdownmenu">
                    <?php if ($hascustommenu) { ?>
                    <div id="custommenu"><?php echo $custommenu; ?></div>
                    <?php } ?>
                    <div class="navbar">
                        <div class="breadcrumb"><?php if ($hasnavbar) echo $OUTPUT->navbar(); ?></div>
                        <div class="navbutton"> <?php echo $PAGE->button; ?></div>
                    </div>
                </div>
                <?php } // End of if ($hasnavbar)?>
                <!-- END DROP DOWN MENU -->

                <?php if ($hastop) { ?>
                <div id="region-post" class="block-region">
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
        <!-- END OF CONTENT -->
        <div class="clearfix"></div>

    <!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>
    <div id="footer">
        <div id="footer-wrapper">
            <div id="footer-first">
                <p>© 2011 СПбГПУ</p>
                <?php if ($hasfootnote) { ?>
                    <div id="footnote"><?php echo $PAGE->theme->settings->footnote; ?></div>
                <?php } ?>
            </div>
            <div id="footer-second">
                <?php
                echo $OUTPUT->login_info();
                echo $OUTPUT->home_link();
                echo $OUTPUT->standard_footer_html();?>
                <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
            </div>
    </div>
    </div>
    <?php } ?>
    </div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
