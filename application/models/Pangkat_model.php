<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Pangkat_model extends CI_Model
{
    public function getPangkatOptions()
    {
        $this->db->select('pangkat_id, nama_pangkat');
        $query = $this->db->get('pangkat');

        $options = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $options[$row['pangkat_id']] = $row['nama_pangkat'];
            }
        }

        return $options;
    }
    public function updatePangkat($pangkat_id, $nama_pangkat, $singkatan) {
        $data = array(
            'nama_pangkat' => $nama_pangkat,
            'singkatan' => $singkatan,
            'updated_at' => date('Y-m-d H:i:s') // Tambahkan perubahan pada kolom updated_at
        );
    
        $this->db->where('pangkat_id', $pangkat_id);
        $this->db->update('pangkat', $data);
    }
    public function deletePangkat($pangkat_id)
    {
    return $this->db->delete($this->pangkat, array('pangkat_id' => $pangkat_id));
    }
}
?>