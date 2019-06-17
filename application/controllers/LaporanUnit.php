<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanUnit extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_laporan','Mlaporan');
        //Do your magic here
    }
    
    public function index()
    {
        $data['title'] = 'Laporan Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(17); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $data['id'] = '';
        $data['unit'] = $this->Mlaporan->getDataWhere("*","tbl_unit_properti",['id_properti'=>$this->session->userdata("id_properti")])->result();
        $this->pages("laporan/view_unit",$data);
    }
    public function search()
    {
        $data['title'] = 'Laporan Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(17); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $data['id'] = $this->input->post('status_item');
        if (!empty($data['id'])) {
            $where = ['id_properti'=>$this->session->userdata('id_properti'),'status_unit'=>$data['id']];
            $data['unit'] = $this->Mlaporan->getDataWhere("*","tbl_unit_properti",$where)->result();
        }
        else{
            $data['unit'] = $this->Mlaporan->getData("tbl_unit_properti")->result();
        }
        $this->pages("laporan/view_unit",$data);
    }
    public function print()
    {
        $this->load->library('Pdf');
        $session = $this->session->userdata('id_properti');
        $where = ['id_properti'=>$session];
        $data['unit'] = $this->Mlaporan->getDataWhere("*","tbl_unit_properti",$where)->result();
        $data['terjual'] = $this->Mlaporan->getDataWhere("count(id_unit) as sudah_terjual","tbl_unit_properti",['status_unit'=>'Sudah Terjual','id_properti'=>$session])->row();
        $data['belum'] = $this->Mlaporan->getDataWhere("count(id_unit) as belum_terjual","tbl_unit_properti",['status_unit'=>'Belum Terjual','id_properti'=>$session])->row();
        // $this->load->view('print/print_unit',$data);
        $this->pdf->load_view('List Unit','print/print_unit',$data);
    }

    private function pages($url ,$data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($url, $data);
        $this->load->view('partials/part_footer', $data);
    }
}

/* End of file laporan.php */


