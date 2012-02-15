/**
 * Created by JetBrains PhpStorm.
 * User: h4
 * Date: 06.12.11
 * Time: 10:27
 * To change this template use File | Settings | File Templates.
 */

/* Make dock horizontally
    See details: http://docs.moodle.org/dev/Themes_2.0_how_to_make_the_dock_horizontal
    */

function customise_dock_for_theme() {
    var dock = M.core_dock;
    dock.cfg.position = 'top';
    dock.cfg.orientation = 'horizontal';
}
