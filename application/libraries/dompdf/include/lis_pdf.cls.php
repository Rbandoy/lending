<?php
class lis_pdf {
	static function render($pdf) {
		$footer = $pdf->open_object();
	    $w = $pdf->get_width();
	    $h = $pdf->get_height();
	    
	    $size=24;
	    $font = Font_Metrics::get_font("verdana", "bold");
	    $text = $GLOBALS['pdf']['HEADER_TITLE'];
	    $width = Font_Metrics::get_text_width($text, $font, $size);
	    $text_height = Font_Metrics::get_font_height($font, $size);
	    
	    //header line
	    $y = 4 * $text_height - 24;
	    
	    $ext = explode(".",$GLOBALS['pdf']['HEADER_LOGO']["filename"]);
	    
	    $pdf->image($GLOBALS['pdf']['HEADER_LOGO']["filename"],$ext[1],16,2,$GLOBALS['pdf']['HEADER_LOGO']["height"],$GLOBALS['pdf']['HEADER_LOGO']["width"]);
	    $pdf->text(16+$GLOBALS['pdf']['HEADER_LOGO']["width"]*2.5, 2, $GLOBALS['pdf']['HEADER_TITLE'], $font, 16);
	    //$pdf->text(16, 20, , $font, 24);
	    $pdf->line(16, $y, $w - 16, $y, array(0,0,0), 1);
	    //footer line
	    $y = $h - 2 * $text_height - 24;
	    $pdf->line(16, $y, $w - 16, $y, array(0,0,0), 1);
	    
	    
	    $pdf->close_object();
	  	$pdf->add_object($footer, "all");
	}
}