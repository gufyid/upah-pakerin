<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH."/libraries/PHPExcel.php"; 
require_once APPPATH."/libraries/PHPExcel/IOFactory.php"; 
 
class Excell extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}