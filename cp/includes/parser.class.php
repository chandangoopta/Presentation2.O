<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');

class Parser{

	public static $parseResult;
	public static $slide = array();

	private function toHTML($line){
		$line = trim($line);

		$line = preg_replace('/\*\*(.*?)\*\*/', "<em>$1</em>", $line);
		$line = preg_replace('/\[\[(.*?)\]\]/', "<img src=\"presentations/images/$1\">", $line);

		if(substr($line, 0, 1) == "*"){
			$line = '<li>'.trim(substr($line, 1)).'</li>';
		}else{
			$line ="<div class=\"no-list\">".$line."</div>";
		}
		return $line;
	}

	public static function Parse(){
		$slidesAll = explode("\n\n", Slide::getPresentationFileContents());
		
		$header = array_shift($slidesAll);
		
		$contents_on_slide = array();

		$presentation = array();
		$blockI=0;
		foreach ($slidesAll as $slideBlock){

			$contentsAll = explode("\n", $slideBlock);
			
			$title = self::toHTML(array_shift($contentsAll));
			
			array_push($contents_on_slide,count($contentsAll));
			
			$contents ='';
			if($blockI == Slide::$presentationSlideId){
				for ($i=0; $i<=(Slide::$presentationBlockId); $i++){
					$contents .= self::toHTML($contentsAll[$i]);
				}
			}
			$blockI++;
			
			$slide = array('header' => $header, 'title' => $title, 'content' => $contents);
			array_push ($presentation, $slide);
		}
		
		self::$slide = $contents_on_slide;
		self::$parseResult = str_replace('\/','/',json_encode($presentation[Slide::$presentationSlideId]));
	}
}

