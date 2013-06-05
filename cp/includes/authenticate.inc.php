<?php

require_once(LIB_PATH.DS.'session.class.php');

if(!$session->is_logged_in()){
	redirect_to('index.php');
}
