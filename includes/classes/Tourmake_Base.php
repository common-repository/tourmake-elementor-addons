<?php

namespace ElementorTourmake;

use Elementor\Widget_Base;

class Tea_Tourmake_Base
{
    public static function tea_check_tourmake_domain($url){
        $data = parse_url($url);

        $host = $data['host'];

        $hostname = explode(".", $host);
        $domain = $hostname[count($hostname) - 2] . "." . $hostname[count($hostname) - 1];

        if (strpos($domain, 'tourmake') === false && strpos($domain, 'tm3.co') === false) {
            return false;
        }

        return true;
    }

    public static function tea_get_idembed($url){
        $data = parse_url($url);

        $query = explode('&', $data['query']);
        $size = sizeof($query);
        $startingPosition = array();

        for($i=0; $i<$size; $i++){
            $element = explode('=', $query[$i]);
            $startingPosition[$element[0]] = $element[1];
        }

        $hostname = explode(".", $data['host']);
        $path = $data['path'];
        $domain = $hostname[count($hostname) - 2] . "." . $hostname[count($hostname) - 1];

        if(self::tea_check_tourmake_domain($url) === false){
            $id_embed = false;
        }elseif (strpos($domain, 'tm3.co') !== false) { //shortlink
            $long_url = self::tea_get_long_url($url);
            $path = parse_url($long_url,PHP_URL_PATH);
            $path_sections = explode('/', $path);
            $id_embed = $path_sections[count($path_sections) - 1];
	        $lang = $path_sections[count($path_sections) - 3];
        } elseif (strpos($domain, 'tourmake') !== false && strpos($path, '/tour') === false ){ //slug
            $slug = str_replace('/', '', $path);
            $tour_data = self::tea_get_tour_data_api($slug);
            $id_embed = $tour_data['idEmbed'];
	        $lang = 'en';
        }else { //id embed
            $path_sections = explode('/', $path);
            $id_embed = $path_sections[count($path_sections) - 1];
	        $lang = $path_sections[count($path_sections) - 3];
        }

	    if (!$id_embed){
		    return false;
	    }else{
		    $info = array(
			    'idembed' => $id_embed,
			    'lang' => $lang,
                'startingPosition' => $startingPosition
		    );
		    return $info;
	    }
    }

    public static function tea_get_long_url($short_url){
	    $result = wp_remote_get($short_url);
	    $response = $result['http_response']->get_response_object();
	    $long_url = $response->url;
	    return $long_url;
    }

    public static function tea_get_tour_data_api($slug){
	    $url = "https://tourmake.it/it/tour/api/tour.json?s=".$slug;
	    $args = array(
		    'headers' => array(
			    'Content-type' => 'application/json'
		    )
	    );
	    $result = wp_remote_get($url, $args);
	    return json_decode($result['body'], true);
    }

    public static function tea_display_tour($tour_id, $fullscreen, $scroll, $lang, $startingPosition){
        $openingStatement = '<div id="tea-tour-container" class="tea-tour-container" data-id="' . $tour_id . '" data-locale="'.$lang.'" data-fullscreen="' . $fullscreen . '" data-scroll="' . $scroll. '"';
        $closingStatement = '></div>';
        //echo '<div id="tea-tour-container" data-id="' . $tour_id . '" data-locale="'.$lang.'" data-fullscreen="' . $fullscreen . '" data-scroll="' . $scroll .'"></div>';

        echo $openingStatement;
        foreach ($startingPosition as $data => $value){
            if($data){
                echo ' data-'.$data.'="'.$value.'"';
            }
        }
        echo $closingStatement;
    }

    public static function tea_display_empty_content(){
        echo '<div class="tea-empty" style="height: 600px;"><img src="'.plugins_url('/assets/images/logo_tourmake.png', __DIR__).'"></div>';
    }
}