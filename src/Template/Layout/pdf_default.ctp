<?php

require_once(ROOT . DS . 'vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');

spl_autoload_register('DOMPDF_autoload');

$dompdf = new DOMPDF();
$dompdf->set_paper = 'A4';
$dompdf->load_html($this->fetch('content'), 'utf-8');
$dompdf->render();
echo $dompdf->output();