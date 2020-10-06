
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MpdfController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function printPDF()
    {
        require_once APPPATH . 'vendor/autoload.php';
        $data = $this->load->view('mpdf_v','',true);
        
        $mpdf = new \Mpdf\Mpdf([
    'debug' => true,
    'allow_output_buffering' => true
]);
        $mpdf->WriteHTML($data);
        $mpdf->Output('test.pdf','I');
    }
}
