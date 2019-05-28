 <?php
// FOR CSS FILES
$css = '';
$handle = '';
$file = '';

//The needed cssfiles to be loaded in this particular case
$neededcss= array("bootstrap.css","jquery.dataTables.css");

$cssdir = base_url('assets/css/');
// open the "css" directory
if ($handle = opendir($cssdir)) {
    // list directory contents
    while (false !== ($file = readdir($handle))) {
        // only grab file names
        if (is_file('css/' . $file) && in_array($currentfile, $neededcss)) {
            // insert HTML code for loading Javascript files
            $css .= '<link rel="stylesheet" href="'.$cssdir.$file.
                '" type="text/css" media="all" />' . "\n";
        }
    }
    closedir($handle);
    echo $css;
}

// FOR JAVASCRIPT FILES
$js = '';
$handle = '';
$file = '';

//The needed jsfiles to be loaded in this particular case
$neededjs= array("jquery-3.3.1.min.js","bootstrap_validator.js","bootstrap.min.js");

$jsdir= '../assets/js/';
// open the "js" directory
if ($handle = opendir($jsdir)) {
    // list directory contents
    while (false !== ($file = readdir($handle))) {
        // only grab file names
        $currentfile='js/' . $file;
        if (is_file($currentfile) && in_array($currentfile, $neededjs)) {
            
           // insert HTML code for loading Javascript files
            $js .= '<script src="'.$jsdir.$file. '" type="text/javascript"></script>' . "\n";
        }
    }
    closedir($handle);
    echo $js;
}
 
?>