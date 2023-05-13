<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class usulkp_model extends CI_Model
{
    public function getjeniskenaikan()
    {
       {
        $this->db->select('kp_id, jenis_kenaikan');
        $query = $this->db->get('kp_t');

        $options = array();

        if ($query->num_rows() > 0) 
            {
            foreach ($query->result_array() as $row) 
                {
                    $options[$row['kp_id']] = $row['jenis_kenaikan'];
                
                }
            }
        return $options;
        }
    }      
}