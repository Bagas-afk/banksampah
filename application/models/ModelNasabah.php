<?php class ModelNasabah extends CI_Model
{

    function tampilNasabah()
    {
        $this->db->where('role_id', 2);
        return $this->db->get('user');
    }

    function cari_data_nasabah($id_nasabah)
    {
        $this->db->where('id_user', $id_nasabah);
        $this->db->where('role_id', 2);
        return $this->db->get('user');
    }

    function tambahNasabah($data)
    {
        return $this->db->insert('user', $data);
    }

    function editNasabah($data, $id)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('user', $data);
    }

    function hapusNasabah($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->delete('user');
    }

    function countUser()
    {
        return $this->db->get('user')->num_rows();
    }
}
