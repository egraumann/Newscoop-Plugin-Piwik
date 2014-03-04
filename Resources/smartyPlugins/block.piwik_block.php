<?php
/**
 * @package Piwik plugin
 * @author Evelyn Graumann
 * @copyright 2014 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Newscoop piwik_block block plugin
 *
 * Type:     block
 * Name:     piwik_block
 * Purpose:  Generates the piwik tracking data for a page
 *
 * @param string
 *     $params
 * @param string
 *     $p_smarty
 * @param string
 *     $content
 *
 * @return
 *
 */

function smarty_block_piwik_block($params, $content, &$smarty, &$repeat)
{
    if (!isset($content)) {
        return '';
    }

    $smarty->smarty->loadPlugin('smarty_shared_escape_special_chars');
    $context = $smarty->getTemplateVars('gimme');

    $piwikService = new Newscoop\PiwikBundle\Services\PiwikService;

    $confdata = $piwikService->getConfigData();
    $url = $confdata['url'];
    $id = $confdata['id'];
    $type = $confdata['type'];

    if($type == "JavaScript"){

    $html = $piwikService->getJavascriptTracker($url, $id);
    }
    else $html = $piwikService->getImageTracker($url, $id);

    return $html;

}