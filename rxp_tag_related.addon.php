<?php
/**
 * @author BNU <bnufactory@gmail.com>
 * http://xemagazine.com
 **/

if (defined('RX_VERSION'))
{
	// return;
}
if(Context::getResponseMethod() != 'HTML' || Context::get('module') == 'admin') return;

// 미리 스킨의 CSS 파일 로드
if($called_position == 'before_module_proc')
{
	$addon_info->skin_path = file_exists($addon_info->skin . '/index.html') ? $addon_info->skin : 'default';
	$addon_info->skin_path = './addons/rxp_tag_related/skins/' . $addon_info->skin_path;
	Context::addCSSFile($addon_info->skin_path . '/css/default.css');

	return;
}

if($called_position != 'before_display_content') return;

// 변수 정리
$addon_info->skin_path = file_exists($addon_info->skin . '/index.html') ? $addon_info->skin : 'default';
$addon_info->skin_path = './addons/rxp_tag_related/skins/' . $addon_info->skin_path;
$addon_info->list_count = (int)$addon_info->list_count ? (int)$addon_info->list_count : 5;
$addon_info->lowest_tag = (int)$addon_info->lowest_tag ? (int)$addon_info->lowest_tag : 1;
$addon_info->cut_subject = (int)$addon_info->cut_subject ? (int)$addon_info->cut_subject : 0;
$GLOBALS['_rxp_tag_related_addon_info_'] = $addon_info;

require_once($addon_path . 'rxp_tag_related.lib.php');

$pos_regx = '|<\!--AfterDocument\(([0-9]+),([0-9]+)\)-->|is';
$output = preg_replace_callback($pos_regx, getTagRelation, $output);

/* EOF */
