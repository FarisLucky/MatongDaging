<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Server_side extends CI_Model
{
    // private $table="category",$column_order = "category_id,category",$column_search = 'category';
    public function makeQuery($column_orders,$table,$search,$order)
    {
        $this->db->select($column_orders);
        $this->db->from($table);
        if (!empty($this->input->post('search')['value'])) {
            foreach ($search as $key => $value) {
                $this->db->or_like($value,$_POST['search']['value']);
            }
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']],$this->input->post('order')['0']['dir']);
        }
        else{
            $this->db->order_by($order,'ASC');
        }
    }
    public function makeDataTables($column_orders,$table,$search,$order)
    {
        $column = $column_orders;
        $tbl = $table;
        $src = $search;
        $ord = $order;
        $this->makeQuery($column,$tbl,$src,$ord);
        if($this->input->post('length') != -1)  
        {  
            $this->db->limit($this->input->post('length'),$this->input->post('start'));  
        }  
        $query = $this->db->get();  
        return $query->result();
    }
    function get_filtered_datas($column_orders,$table,$search,$order){  
        $this->makeQuery($column_orders,$table,$search,$order);  
        $query = $this->db->get();  
        return $query->num_rows();  
    }       
    function get_all_datas($tbl)  
    {  
        $this->db->select("*");  
        return $this->db->from($tbl)->count_all_results();  
    }

}

/* End of file Server_side.php */
