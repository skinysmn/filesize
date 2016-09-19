<?php

namespace Bolt\Extension\levin\filesize;

use Bolt;

class Extension extends \Bolt\BaseExtension
{
    public function getName()
    {
        return "filesize";
    }

    public function initialize()
    {
        $this->addTwigFunction('filesize', 'twigFilesize');
    }

    public function twigFilesize($file)
    {

 if (file_exists($_SERVER['DOCUMENT_ROOT']."/files/".$file)){
        $bytes = filesize ($_SERVER['DOCUMENT_ROOT']."/files/".$file);
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
