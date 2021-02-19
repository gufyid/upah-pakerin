<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "asset/Mobile_Detect.php"; 
 
class Mobile extends Mobile_Detect {
    public function __construct() {
        parent::__construct();
    }
}