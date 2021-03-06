<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != '1') {
            redirect('auth/cek_session');
        }
        $this->load->model('ModelNasabah');
        $this->load->model('ModelSampah');
        $this->load->model('ModelSetor');
    }

    public function index()
    {

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Dashboard';
        $data['query'] = $this->ModelNasabah->countUser();
        $data['query1'] = $this->ModelSampah->countSampah();
        $data['query2'] = $this->ModelSetor->countSetor();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function verifAkun($id_user)
    {
        $data = ['status_akun' => 1];
        $id_user = $this->uri->segment(3);
        $this->ModelNasabah->verifAkun($data, $id_user);
        redirect('user/nasabah');
    }

    public function nasabah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['title'] = 'Form Data Nasabah';
        $data['data_nasabah'] = $this->ModelNasabah->tampilNasabah()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/nasabah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSetor()
    {
        $id_user = $this->input->post('namanasabah');
        $id_sampah = $this->input->post('jenis_sampah');
        $sub_total = $this->input->post('subtotal');
        $data = [
            'id' => '',
            'tanggal_setor' => date('Y-m-d H:i:s'),
            'id_user' => $id_user,
            'id_sampah' => $id_sampah,
            'jumlah_kg' => $this->input->post('jumlah_kg'),
            'sub_total' => $sub_total,
        ];

        $transaksi = [
            'id' => '',
            'id_user' => $id_user,
            'jumlah_penarikan' => $sub_total,
            'keterangan' => 'setoran',
            'tanggal' => date('Y-m-d H:i:s')

        ];
        $saldoNasabah = $this->ModelSetor->saldoNasabah($id_user)->row();
        $last_balance = intval($saldoNasabah->saldo + $sub_total);
        // print_r($last_balance);
        // die;
        $this->ModelSetor->updateSaldo($last_balance, $id_user);
        $this->ModelSetor->tambahTransaksi($transaksi);
        $this->ModelSetor->simpanSetor($data);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Berhasil menambahkan data setor sampah!</div>'
        );
        redirect('user/setor');
    }

    public function setor()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['nasabah'] = $this->ModelNasabah->tampilNasabahAktif()->result();
        $data['sampah'] = $this->ModelSampah->tampilSampah()->result();
        $data['setor'] = $this->ModelSetor->tampilDataSetor()->result();
        // print_r($data['nasabah']);
        // die;
        $data['title'] = 'Form Tambah Setor Sampah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/setor', $data);
        $this->load->view('templates/footer');
    }


    function tampilDataNasabah($id_nasabah)
    {
        $id_nasabah = $this->uri->segment(3);
        $data = $this->ModelNasabah->cari_data_nasabah($id_nasabah)->row();
        echo json_encode($data);
    }

    function tampilDataSampah($id)
    {
        $id = $this->uri->segment(3);
        $data = $this->ModelSampah->cari_data_sampah($id)->row();
        echo json_encode($data);
    }

    public function sampah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Form Data Sampah';
        $data['data_sampah'] = $this->ModelSampah->tampilSampah()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/sampah', $data);
        $this->load->view('templates/footer');
    }

    public function verifikasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['tampilPenarikan'] = $this->ModelNasabah->tampilPenarikan()->result();
        $data['title'] = 'Verifikasi Penarikan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/verifikasi', $data);
        $this->load->view('templates/footer');
    }

    public function verifPenarikan($id)
    {
        $id = $this->uri->segment(3);
        // tampil data transaksi tarik (id_transksi, id_user)
        $data_penarikan = $this->ModelNasabah->tampilTarik($id)->row();
        $data_user = $this->ModelNasabah->cari_data_nasabah($data_penarikan->id_user)->row();
        // hitung saldo - jumlah_penarikan
        $saldoAkhir = $data_user->saldo - $data_penarikan->jumlah_penarikan;

        // update user saldo dan verifikasi penarikan menjadi Berhasil
        if ($saldoAkhir >= 0) {
            $data = ['verifikasi_penarikan' => 'Berhasil'];
            $saldo = ['saldo' => $saldoAkhir];
            // print_r($saldo);
            // die;
            $this->ModelNasabah->updatePenarikan($data, $id);
            $this->ModelNasabah->updateSaldo($saldo, $data_user->id);
            redirect('user/verifikasi');
        } else {
            redirect('user/verifikasi');
        }
    }

    public function tambahnasabah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Tambah Nasabah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tambahnasabah', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSampah()
    {
        $jenis_sampah = $this->input->post('jenis_sampah');
        $harga = $this->input->post('harga');
        $satuan = $this->input->post('satuan');
        $data = [
            'jenis_sampah' => $jenis_sampah,
            'harga' => $harga,
            'satuan' => $satuan
        ];
        if ($this->ModelSampah->tambahSampah($data)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Berhasil menambahkan data sampah!</div>'
            );
            redirect('user/sampah');
        } else {
            echo 'gagal';
        }
    }

    public function editSampah()
    {
        $id = ($this->input->post('id'));
        $harga = $this->input->post('harga');
        $satuan = $this->input->post('satuan');
        $data = [
            'harga' => $harga,
            'satuan' => $satuan
        ];
        // print_r($data);
        // die;
        if ($this->ModelSampah->editSampah($data, $id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Berhasil update data sampah!</div>'
            );
            redirect('user/sampah');
        } else {
            echo "gagal";
        }
    }

    public function hapusSampah($id)
    {
        $id = $this->uri->segment(3);
        if ($this->ModelSampah->hapusSampah($id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Berhasil menghapus data sampah!</div>'
            );
            redirect('user/sampah');
        } else {
            echo 'gagal';
        }
    }



    public function tambahAksi()
    {
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $no_telpon = $this->input->post('no_telpon');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $agama = $this->input->post('agama');
        $alamat = $this->input->post('alamat');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $status = $this->input->post('status');
        $pekerjaan = $this->input->post('pekerjaan');

        if ($_FILES['file']['name']) {
            $data = [
                'id' => '',
                'nik' => $nik,
                'nama' => $nama,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'no_telpon' => $no_telpon,
                'email' => $email,
                'password' => $password,
                'agama' => $agama,
                'alamat' => $alamat,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'status' => $status,
                'pekerjaan' => $pekerjaan,
                'role_id' => '2',
                'file' => $this->upload_gambar_profile($this->input->post('file', true)),
                'status_akun' => 1
            ];
        }
        if ($this->ModelNasabah->tambahNasabah($data)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Berhasil menambahkan data nasabah!</div>'
            );
            redirect('user/nasabah');
        } else {
            echo 'gagal';
        }
    }

    function upload_gambar_profile($nama)
    {
        $config['upload_path']          = './assets/file/';
        $config['allowed_types']        = 'jpg|png|jpeg|pdf';
        $config['file_name']            = $nama;
        $config['max_size']             = 5120;
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $config['image_library'] = 'gd2';
            // $config['width'] = "150";
            // $config['height'] = "150";
            $config['maintain_ratio'] = FALSE;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            return $this->upload->data('file_name');
        } else {
            return $this->upload->display_errors();
        }
    }

    public function editNasabah()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $no_telpon = $this->input->post('no_telpon');
        $alamat = $this->input->post('alamat');
        $data = [
            'nama' => $nama,
            'no_telpon' => $no_telpon,
            'alamat' => $alamat
        ];
        if ($this->ModelNasabah->editNasabah($data, $id)) {
            echo 'berhasil';
            redirect('user/nasabah');
        } else {
            echo 'gagal';
        }
    }

    public function hapusNasabah($id)
    {
        $id = $this->uri->segment(3);
        if ($this->ModelNasabah->hapusNasabah($id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">Berhasil menghapus data nasabah!</div>'
            );
            redirect('user/nasabah');
        } else {
            echo 'gagal';
        }
    }



    public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/editProfile', $data);
            $this->load->view('templates/footer');
        } else {

            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Profile berhasil di update</div>'
            );
            redirect('user/index_nasabah');
        }
    }

    public function m_user()
    {
        $data['title'] = 'Management User';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['tampilUser'] = $this->ModelNasabah->tampilNasabahAktif()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/m_user', $data);
        $this->load->view('templates/footer');
    }

    public function editRole()
    {
        $id = $this->input->post('id');
        $role_id = $this->input->post('role_id');
        $data = [
            'role_id' => $role_id,
        ];
        if ($this->ModelNasabah->editRole($data, $id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Role id berhasil di update</div>'
            );
            redirect('user/m_user');
        } else {
            echo 'gagal';
        }
    }
}
