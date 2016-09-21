<?php
namespace Bolt\Extension\levin\filesize;

use Bolt\Extension\SimpleExtension;

class filesizeExtension extends SimpleExtension
{
 protected function registerTwigFunctions()
    {
        return [
            'filesize' => 'TwigFilesize',
        ];
    }

    public function TwigFilesize($file)
    {

	if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)){
	    $bytes = filesize ($_SERVER['DOCUMENT_ROOT'].$file);
	    $units = array('b', 'Kb', 'Mb', 'Gb', 'Tb');
	    $bytes = max($bytes, 0);
	    $pow = floor(($bytes?log($bytes):0)/log(1024));
	    $pow = min($pow, count($units)-1);
	    $bytes /= pow(1024, $pow);
	    $size = round($bytes, '2').' '.$units[$pow];
	    
	return new \Twig_Markup($size, 'UTF-8');
	}
    }
}
