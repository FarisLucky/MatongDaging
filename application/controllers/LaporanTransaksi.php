<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class LaporanTransaksi extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_laporan','Mlaporan');
    }
    public function index()
    {
        $data['title'] = 'Laporan Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(22); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["properti"] = $this->Mlaporan->getData("properti")->result();
        $this->pages("laporan/transaksi/view_transaksi_unit",$data);
    }

    public function data() //Fungsi Untuk Load Datatable
    {
        if (isset($_POST["id_properti"]) || isset($_POST["id_unit"]) || isset($_POST["tgl_mulai"]) || isset($_POST["tgl_akhir"])) {
            $where = "";
            if (!empty($_POST["id_properti"])) {
                $where .= "id_properti = '".$this->db->escape_str($_POST['id_properti'])."' ";
            }
            if (!empty($_POST["id_unit"])) {
                $where .= "and id_unit = '".$this->db->escape_str($_POST['id_unit'])."' ";
            }
            if ((!empty($_POST["tgl_mulai"])) && (empty($_POST["tgl_akhir"]))) {
                $where .= "and tgl_transaksi >= '".$this->db->escape_str($_POST['tgl_mulai'])."' ";
            }
            else if ((!empty($_POST["tgl_akhir"])) && (empty($_POST["tgl_mulai"]))) {
                $where .= "and tgl_transaksi <= '".$this->db->escape_str($_POST['tgl_akhir'])."' ";
            }
            else if((!empty($_POST['tgl_mulai'])) && (!empty($_POST['tgl_akhir']))){
                $where .= "tgl_transaksi BETWEEN '".$this->db->escape_str($_POST['tgl_mulai'])."' and '".$this->db->escape_str($_POST['tgl_akhir'])."' ";
            }
            $where .= "and status_transaksi != 'sementara'";
        }
        else{
            $where = "status_transaksi != 'sementara'";
        }
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_transaksi";
        $order = "no_ppjb";
        $search = ['no_ppjb',"nama_lengkap","status_transaksi","nama_pembuat"];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,null,$where);
        $data = array();
        foreach ($fetch_values as $value) {
            if (($value->kunci == "lock") && ($_SESSION['id_akses'] == 1)) {
                $badge = 'badge-success';
                $btn = '<button type="button" class="btn btn-sm btn-danger btn-unlock" data-id='.$value->id_transaksi.'>Unlock</button>';
            }
            else{
                $btn="";
                $badge = 'badge-success';
            }
            $sub = array();
            $sub[] = $value->no_ppjb;
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->nama_unit;
            $sub[] = $value->nama_properti;
            $sub[] = $value->tgl_transaksi;
            $sub[] = $value->nama_pembuat;
            $sub[] = '<div class="badge '.$badge.'">'.$value->status_transaksi.'</badge>';
            $sub[] = '<a href="'.base_url('laporantransaksi/getdetail/'.$value->id_transaksi).'" class="btn btn-sm btn-info mx-2" data-id="'.$value->id_transaksi.'">Detail</a>'.$btn;
            $data[] = $sub;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order,null,$where)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    public function getUnit()
    {
        $id = $this->input->post('id_properti');
        $query = $this->Mlaporan->getDataWhere("id_unit,nama_unit,id_properti","unit_properti",["id_properti"=>$id])->result();
        $html = "<option value=''> -- Units -- </option>";
        foreach ($query as $key => $value) {
            $html .= '<option value="'.$value->id_unit.'"> '.$value->nama_unit.' </option>';
        }
        $data["html"] = $html;
        return $this->output->set_output(json_encode($data));
        
    }
    public function getDetail()
    {
        $this->load->helper('date');
        $id = $this->uri->segment(3);
        $params4 = $this->uri->segment(4);
        $data["title"] = "Detail Transaksi";
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(22); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        if (!empty($id)) {
            $query = $this->Mlaporan->getDataWhere("*","tbl_transaksi",["id_transaksi"=>$id]);
            if ($query->num_rows() > 0) {
                $data["transaksi"] = $query->row();
                $data["konsumen"] = $this->Mlaporan->getDataWhere("*","tbl_konsumen",["id_konsumen"=>$data["transaksi"]->id_konsumen])->row();
                $data["unit"] = $this->Mlaporan->getDataWhere("*","tbl_unit_properti",["id_unit"=>$data["transaksi"]->id_unit])->row();
                $data["detail_transaksi"] = $this->Mlaporan->getDataWhere("*","detail_transaksi",["id_transaksi"=>$data["transaksi"]->id_transaksi])->result();
            }
        }
        if ($params4 == "un") {
            $data["link"] = '<a href="'.base_url("laporantransaksi/listunlock") .'" class="btn btn-dark mr-2 float-right d-block"><i class="fa fa-arrow-left"></i>Kembali</a>';
        }else{
            $data["link"] = '<a href="'.base_url("laporantransaksi") .'" class="btn btn-dark mr-2 float-right d-block"><i class="fa fa-arrow-left"></i>Kembali</a>';
        }
        $this->pages("laporan/transaksi/view_detail",$data);
    }

    public function unlock()
    {
        $data = ["success"=>false];
        $id = $this->input->post("id",true);
        if (!empty($id)) {
            $query = $this->Mlaporan->updateData(["kunci"=>"unlock"],"transaksi_unit",["id_transaksi"=>$id]);
            $data["success"] = true;
        }
        return $this->output->set_output(json_encode($data));
    }

    public function listUnlock()
    {
        $data['title'] = 'List Unlock Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(22); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["transaksi"] = $this->Mlaporan->getDataWhere("*","tbl_transaksi",["kunci"=>"unlock","status_transaksi"=>"progress"])->result();
        $this->pages("laporan/transaksi/view_list_unlock",$data);
    }
    public function hapus()
    {
        $data = ["success"=>false];
        $id = $this->input->get('params',true);
        if (!empty($id)) {
            $transaksi = $this->Mlaporan->deleteData("transaksi_unit",["id_transaksi"=>$id]);
            if ($transaksi) {
                $this->Mlaporan->deleteData("pembayaran_transaksi",["id_transaksi"=>$id]);
                $data["success"] = true; 
            }
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }

}

/* End of file Approve.php */
