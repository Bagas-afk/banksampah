
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MpdfController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelSampah');
        $this->load->model('ModelNasabah');
        $this->load->model('ModelSetor');
    }

    public function printPDF()
    {
        require_once APPPATH . 'vendor/autoload.php';

        $data['jenis_sampah'] = $this->ModelSampah->tampilSampah()->result();
        // print_r($data['jenis_sampah']);
        // die;
        $data = $this->load->view('mpdf_v', $data, true);
        $mpdf = new \Mpdf\Mpdf([
            'debug' => true,
            'allow_output_buffering' => true
        ]);
        $mpdf->WriteHTML($data);
        $mpdf->Output();
    }

    public function penarikan()
    {
        require_once APPPATH . 'vendor/autoload.php';

        // $data['jenis_sampah'] = $this->ModelSampah->tampilSampah()->result();
        // print_r($data['jenis_sampah']);
        // die;
        $html = $this->load->view('user/mpdf_penarikan', [], true);
        $mpdf = new \Mpdf\Mpdf([
            'debug' => true,
            'allow_output_buffering' => true,
            'format' => 'A5',
            'orientation' => 'L'
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->SetTitle('Cetak Bukti');
        $mpdf->Output();
    }
}
