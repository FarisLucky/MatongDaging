<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct()   
    {
        parent::__construct();
        $this->load->model('Model_pembayaran',"Mpembayaran");
        checkSession();
    }
    
    public function index()
    {
        $active = 'Pembayaran';
        $data['title'] = 'Pembayaran';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(7); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->pages("pembayaran/view_tanda_jadi",$data);
}
    public function tandajadi()
    {
        $active = 'Pembayaran';
        $data['title'] = 'Tanda Jadi';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(7); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->pages("pembayaran/view_tanda_jadi",$data);
    }
    public function dataTj() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_transaksi";
        $order = "nama_lengkap";
        $column_where = "id_properti";
        $value_where = "1";
        $search = ['nama_lengkap','nama_properti','nama_unit'];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where,$value_where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->nama_properti;
            $sub[] = $value->nama_unit;
            $sub[] = $value->tempo_tanda_jadi;
            $sub[] = "Rp. ".number_format($value->tanda_jadi,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_kesepakatan,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_transaksi,2,',','.');
            $sub[] = $value->status_transaksi;
            $sub[] = '<a href="'.base_url().'unit_properti/detail_unit/'.$value->id_unit.'" class="btn btn-sm btn-primary mr-1" id="detail_data_unit">Bayar</a>';
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where,$value_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
}

/* End of file Controllername.php */
