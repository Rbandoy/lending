<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function pdf_create($html, $filename='', $stream=false, $size = 'letter') 
{
    //require_once("dompdf/dompdf_config.inc.php");
    require_once(BASEPATH.'helpers/dompdf/dompdf_config.inc.php');

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);

    if ($size != 'letter') {
        $customPaper = array(0,0,612,936);
        $dompdf->set_paper($customPaper);
    } else {
        $dompdf->set_paper($size, 'portrait');
    }
    
    $dompdf->render();
    if ($stream) {
        $dompdf->stream("{$filename}.pdf", array("Attachment" => 0));
    } else {
        $dompdf->stream("{$filename}.pdf", array("Attachment" => 0));
    }
}
?>