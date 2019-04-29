<?php

class Server_side 
{
    private $Sd;
    public function __construct()
    {
        $this->Sd=& get_instance();
    }
    public function dataUsers($val_column)
    {
        $fetch_values = $this->Muser->makeDataTables();
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = strval($no);
            $sub[] = $value->category;
            $sub[] = '<button type="button" class="btn btn-sm btn-outline-info btn-rounded" id="edit_kategori" data-id="'.$value->category_id.'"><i class="fa fa-edit"></i>Edit</button>
            <button type="button" class="btn btn-sm btn-outline-danger btn-rounded" id="delete_kategori" data-id="'.$value->category_id.'"><i class="fa fa-trash"></i>Hapus</button>';
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->Kategori_model->get_all_datas()),
            'recordsFiltered'=>intval($this->Kategori_model->get_filtered_datas()),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
}
