<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');


class Parser{

	public static $parseResult;
	public static $slide = array();

	private function toHTML($line){
		$line = trim($line);

		$line = preg_replace('/\*\*(.*?)\*\*/', "<em id=\"em\">$1</em>", $line);
		$line = preg_replace('/\[\[(.*?)\]\]/', "<img src=\"presentations/images/$1\" id=\"img\">", $line);

		if(substr($line, 0, 1) == "*"){
			$line = '<li>'.trim(substr($line, 1)).'</li>';
		}else{
			$line .="<br>";
		}
		
		return $line;
	}

	public static function Parse(){
		$slidesAll = explode("\n\n", Slide::getPresentationFileContents());
		
		$header = self::toHTML(array_shift($slidesAll));
		
		$points_on_slide = array();

		$presentation = array();
		foreach ($slidesAll as $slideBlock){
			$pointsAll = explode("\n", $slideBlock);
			
			$title = self::toHTML(array_shift($pointsAll));
			
			array_push($points_on_slide,count($pointsAll));
			
			$points = array();
			
			foreach ($pointsAll as $point){
				array_push($points,self::toHTML($point));
			}
			
			$slide = array('header' => $header, 'title' => $title, 'content' => $points);
			array_push ($presentation, $slide);
		}
		
		self::$slide = $points_on_slide;
		
		self::$parseResult = str_replace('\/','/',json_encode($presentation[Slide::$presentationSlideId]));
	}
}

