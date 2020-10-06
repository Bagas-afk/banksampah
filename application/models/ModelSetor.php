<?php class ModelSetor extends CI_Model
{
    public function tampilDataSetor()
    {
        return $this->db->query("SELECT * FROM `tb_setor`
                                INNER JOIN user ON user.id_user=tb_setor.id_nasabah
                                INNER JOIN tb_harga ON tb_harga.id_harga=tb_setor.id_sampah");
    }

    public function simpanSetor($data)
    {
        return $this->db->insert('tb_setor', $data);
    }
}
