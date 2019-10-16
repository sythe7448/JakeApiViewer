<?php
/*
 * @package JakeApiViewer
 */
/*
Plugin Name: Jake Api Viewer
Plugin URI: http://github.com/sythe7448
Description: A test plugin to learn about calling and displaying APIs
Version: 1.0
Author: Jake Colburn
Author URI: http://github.com/sythe7448
License: GPL2
Text Domain: jake-api-viewer
*/

if ( ! defined( 'ABSPATH')) {
    die;
}

require 'vendor/autoload.php';

function getEveAlliances(){
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'https://esi.evetech.net/latest/alliances/?datasource=tranquility');
    $allianceArray = json_decode($res->getBody());
    ob_start();
    for ($i = 0; $i < 10; $i++) {
        $result = $client->request('GET', "https://esi.evetech.net/latest/alliances/{$allianceArray[$i]}/?datasource=tranquility");
        $allianceData = json_decode($result->getBody());
        echo "<p>{$allianceData->name}</p>";
    }
    return ob_get_clean();
}
add_shortcode( 'eveAlliances', 'getEveAlliances' );