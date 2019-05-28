<?php
if (!defined("BASEPATH"))
    exit("No direct script access allowed");
/**
 * The class name of the library which has to be called
 */
class GMTlinker{
	
	function __construct()
	{
		$neededjs= array('assets/js/jquery-3.3.1.min.js','assets/js/bootstrap.min.js','assets/js/bootstrap_validator.js','assets/js/notify.min.js','assets/DataTables-1.10.18/js/dataTables.min.js','assets/DataTables-1.10.18/js/dataTables.buttons.min.js','assets/DataTables-1.10.18/js/buttons.flash.min.js','assets/DataTables-1.10.18/js/jszip.min.js','assets/DataTables-1.10.18/js/pdfmake.min.js','assets/DataTables-1.10.18/js/vfs_fonts.js','assets/DataTables-1.10.18/js/buttons.html5.min.js','assets/DataTables-1.10.18/js/buttons.print.min.js');

        $neededcss= array('assets/css/bootstrap.css','assets/css/notify.css','assets/css/animate.css','assets/css/font-awesome.min.css','assets/DataTables-1.10.18/css/jquery.dataTables.css','assets/DataTables-1.10.18/css/dataTables.bootstrap4.css','assets/DataTables-1.10.18/css/buttons.bootstrap.min.css','assets/DataTables-1.10.18/css/buttons.dataTables.min.css');

	}

   public function AddLinks($js=false, $css=false){

    $requiredjs='';
    $requiredcss='';
    if (!($js === false)) {
        foreach ($js as $key => $link) {
          $requiredjs +=$this->template->javascript->add(base_url($link));
        }
    }
    if (!($css === false)) {
        foreach ($css as $key => $link) {
        $requiredcss +=$this->template->stylesheet->add(base_url($link), array('media' => 'all'));
      }
    }

    return json_encode($requiredjs.''.$requiredcss);
  }

}


 ?>
