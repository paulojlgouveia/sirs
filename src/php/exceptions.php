
<?php

// top level exception handler for uncaught exceptions
function uncaught_exception_handler($exception) {
	
	log_top_level_error($exception->getMessage());
	
	die(header("location: error_page.html"));	
}

// set_exception_handler('uncaught_exception_handler');



class QueryException extends Exception {

    // redefine exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}




?>