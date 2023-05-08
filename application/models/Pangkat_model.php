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
}
?>