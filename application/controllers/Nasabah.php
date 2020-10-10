<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != 1) {
            redirect('auth/cek_session');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('nasabah/index', $data);
        $this->load->view('templates/footer');
    }

    public function cek_saldo()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('ModelSetor');
        $data['subtotal'] = $this->ModelSetor->saldoNasabah(['id_nasabah' => $this->session->userdata('id_nasabah')])->get_array();

        $data['title'] = 'Cek Saldo';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('nasabah/index', $data);
        $this->load->view('templates/footer');
    }
}
