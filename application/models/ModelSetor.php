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

    public function saldoNasabah($data)
    {
        $this->db->select('saldo');
        $this->db->where('id_user', $data);
        return $this->db->get('user');
    }

    public function updateSaldo($last_balance, $id_nasabah)
    {
        $this->db->where('id_user', $id_nasabah);
        $this->db->set('saldo', $last_balance);
        return $this->db->update('user');
    }

    public function tambahTransaksi($transaksi)
    {
        return $this->db->insert('tb_transaksi', $transaksi);
    }

    public function tampilSetoranNasabah($id_user)
    {
        return $this->db->query("SELECT * FROM `tb_setor`
                                INNER JOIN user ON user.id_user=tb_setor.id_nasabah
                                INNER JOIN tb_harga ON tb_harga.id_harga=tb_setor.id_sampah
                                WHERE user.id_user = '$id_user'");
    }
}
