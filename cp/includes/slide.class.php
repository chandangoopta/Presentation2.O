<?php 


class Slide
{
	static private $currentSlideFile = CURRENT_SLIDE_FILE;
	static public $currentSlideStatus;
	static public $presentationFilename;
	static public $presentationSlideId;
	static public $presentationBlockId;
	
	static public function extractCurrentSlideId(){
		if(self::fileExists(self::$currentSlideFile)){
			if(is_readable(self::$currentSlideFile)){
				if(self::$currentSlideStatus = file_get_contents(self::$currentSlideFile)){
					$content = explode(':|:', self::$currentSlideStatus);
					self::$presentationFilename = $content[0];
					self::$presentationSlideId = intval($content[1]);
					self::$presentationBlockId = intval($content[2]);
				}else{
					Log::log_action('Current Slide', 'could not be read');
					die('Current Slide could not be read');
				}
			}else{
				Log::log_action('Current Slide', 'file is not readable');
				die('Current Slide file is not readable');
			}
		}
	}
	
	private function fileExists($filename){
		if(file_exists($filename)){
			return true;
		}else{
			Log::log_action("{$filename}", 'file missing');
			die("{$filename} file missing");
			return false;
		}
	}
	
	public static function changeCurrentSlide($content){
		if(self::fileExists(self::$currentSlideFile)){
			if(is_writable(self::$currentSlideFile)){
				if(file_put_contents(self::$currentSlideFile, $content)){
					return true;
				}else{
					Log::log_action('Current Slide', 'could not be written');
					die('Current Slide could not be written');
					return false;
				}
			}else{
				Log::log_action('Current Slide', 'file is not writeable');
				die('Current Slide file is not writable');
				return false;
			}
		}
	}
	
	public static function getPresentationFileContents(){
		self::extractCurrentSlideId();
		$presentationFile = PRESENTATION_PATH.DS.self::$presentationFilename;
		if(self::fileExists($presentationFile)){
			if(is_readable($presentationFile)){
				if($contents = file_get_contents($presentationFile)){
					return $contents;
				}else{
					Log::log_action("{$presentationFile}", 'could not be read');
					die("{$presentationFile} could not be read");
				}
			}else{
				Log::log_action("{$presentationFile}", 'is not readable');
				die("{$presentationFile} is not readable");
			}
		}
	}

}
