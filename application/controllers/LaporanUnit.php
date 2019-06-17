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
        $data['id_properti'] = '';
        $data['id_unit'] = '';
        if ($_SESSION['id_akses'] === "1") {
            $data['unit'] = $this->Mlaporan->getData("tbl_unit_properti")->result();
        }else{
            $data['unit'] = $this->Mlaporan->getDataWhere("*","tbl_unit_properti",['id_properti'=>$this->session->userdata("id_properti")])->result();
        }
        $data['sasaran_unit'] = $this->Mlaporan->getDataWhere("id_sasaran","persyaratan_sasaran",['id_kategori_persyaratan'=>2])->result();
        $data["properti"] = $this->Mlaporan->getData("tbl_properti")->result();
        $this->pages("laporan/view_unit",$data);
    }
    public function search()
    {
        $data['title'] = 'Laporan Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(17); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $data["properti"] = $this->Mlaporan->getData("tbl_properti")->result();
        $data['id'] = $this->input->post('status_item',true);
        $data['id_properti'] = $this->input->post('properti',true);
        $data['id_unit'] = $this->input->post('id_unit',true);
        if (!empty($data['id'])) {
            if ($_SESSION["id_akses"] === "1") {
                $where = "";
                $where .= "status_unit = '".$this->db->escape_str($data['id'])."' ";
                if (!empty($data["id_properti"])) {
                    $where .= "and id_properti = '".$this->db->escape_str($this->input->post('properti',true))."' ";
                }
                if (!empty($data['id_unit'])) {
                    $where .= "and id_unit = '".$this->db->escape_str($this->input->post('id_unit',true))."'";
                }
                $data["where"] = $where;
            }else{
                $where = ['id_properti'=>$this->session->userdata('id_properti'),'status_unit'=>$data['id']];
            }
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

    public function getModal()
    {
        $id = $this->input->get('params1');
        if (!empty($id)) {
            // $this->Mlaporan->getDataWhere("*","");
        }
    }

    public function getUnit()
    {
        $id = $this->input->get('params1',true);
        if (!empty($id)) {
            $result = $this->Mlaporan->getDataWhere("id_unit,nama_unit","tbl_unit_properti",["id_properti"=>$id])->result();
            $data["html"] = "<option value=''>-- Pilih Unit --</option>";
            foreach ($result as $key => $value) {
                $data["html"] .= "<option value='".$value->id_unit."'>".$value->nama_unit."</option>";
            }
        }
        $this->output->set_output(json_encode($data));
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


