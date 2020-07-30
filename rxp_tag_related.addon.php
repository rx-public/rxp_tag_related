<?php
/**
 * @author RXPublic <rhymixpublic@gmail.com>
 * @author BNU <bnufactory@gmail.com>
 * @license https://creativecommons.org/publicdomain/zero/1.0/deed.ko CC0-1.0
 **/

if (!defined('RX_VERSION')) {
    exit;
}

if (Context::getResponseMethod() !== 'HTML' || Context::get('module') === 'admin') {
    return;
}

if ($called_position !== 'before_display_content') {
    return;
}

// 변수 정리
$addon_info->skin_path = file_exists($addon_info->skin . '/index.html') ? $addon_info->skin : 'default';
$addon_info->skin_path = './addons/rxp_tag_related/skins/' . $addon_info->skin_path;
$addon_info->list_count = (int)$addon_info->list_count ? (int)$addon_info->list_count : 5;
$addon_info->lowest_tag = (int)$addon_info->lowest_tag ? (int)$addon_info->lowest_tag : 1;
$addon_info->cut_subject = (int)$addon_info->cut_subject ? (int)$addon_info->cut_subject : 0;
$GLOBALS['_rxp_tag_related_addon_info_'] = $addon_info;

require_once($addon_path . 'rxp_tag_related.lib.php');

if (stripos($output, '<!--rxp-tag-related(')) {
    $posRegx = '/<\!--rxp-tag-related\(([0-9]+),([0-9]+)\)-->/is';
} else {
    $posRegx = '/<\!--AfterDocument\(([0-9]+),([0-9]+)\)-->/is';
}
$output = preg_replace_callback($posRegx, getRxpTagRelated, $output);
/* EOF */
