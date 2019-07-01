<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class KartuKontrol extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_laporan',"Mlaporan");
        
    }
    
    public function index()
    {
        $data["title"] = "Kartu Kontrol";
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(21); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["properti"] = $this->Mlaporan->getData("properti")->result();
        $data["unit"] = $this->Mlaporan->getData("unit_properti")->result();
        $this->pages("kartu_kontrol/view_kontrol",$data);
    }

    public function dataKontrol() //Fungsi Untuk Load Datatable
    {
        if (isset($_POST["id_properti"]) || isset($_POST["id_unit"]) || isset($_POST["tgl_mulai"]) || isset($_POST["tgl_akhir"])) {
            $where = "";
            if (!empty($_POST["id_properti"])) {
                $where .= "id_properti = '".$this->db->escape_str($_POST['id_properti'])."' and ";
            }
            if (!empty($_POST["id_unit"])) {
                $where .= "id_unit = '".$this->db->escape_str($_POST['id_unit'])."' and ";
            }
            if ((!empty($_POST["tgl_mulai"])) && (empty($_POST["tgl_akhir"]))) {
                $where .= "tgl_transaksi >= '".$this->db->escape_str($_POST['tgl_mulai'])."' and ";
            }
            else if ((!empty($_POST["tgl_akhir"])) && (empty($_POST["tgl_mulai"]))) {
                $where .= "tgl_transaksi <= '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
            else if((!empty($_POST['tgl_mulai'])) && (!empty($_POST['tgl_akhir']))){
                $where .= "tgl_transaksi BETWEEN '".$this->db->escape_str($_POST['tgl_mulai'])."' and '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
            $where .= "status_transaksi != 'sementara'";
        }else{
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
            $sub = array();
            $sub[] = $value->no_ppjb;
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->nama_properti;
            $sub[] = $value->nama_unit;
            $sub[] = $value->status_transaksi;
            $sub[] = $value->tgl_transaksi;
            $sub[] = $value->nama_pembuat;
            $sub[] = '<a href="'.base_url()."kartukontrol/detail/".$value->id_transaksi.'" class="btn btn-info">Detail</a>';
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

    public function detail()
    {
        $id = $this->uri->segment(3);
        $data["title"] = "Detail Kontrol";
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(21); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["detail_kontrol"] = $this->Mlaporan->getDataWhere("*","tbl_pembayaran",["id_transaksi"=>$id],"id_jenis","ASC")->result();
        $data["transaksi"] = $this->Mlaporan->getDataWhere("id_transaksi,total_transaksi,tanda_jadi,uang_muka,periode_uang_muka,pembayaran,bayar_periode","tbl_transaksi",["id_transaksi"=>$id])->row();
        $data["pemasukan"] = $this->Mlaporan->getDataWhere("SUM(total_bayar) as pemasukan","tbl_pembayaran",["id_transaksi"=>$id])->row();
        $data["hutang"] = $this->Mlaporan->getDataWhere("SUM(hutang) as hutang","tbl_pembayaran",["id_transaksi"=>$id])->row();
        $this->pages("kartu_kontrol/view_detail_kontrol",$data);
    }
    
    public function dataModal()
    {
        $data = ["success"=>false];
        $id = $this->input->post('id');
        if (!empty($id)) {
            $data["success"] = true;
            $data["modal"] = $this->Mlaporan->getDataWhere("tgl_bayar,tgl_jatuh_tempo,pembuat,bukti_bayar,id_jenis","tbl_pembayaran",["id_pembayaran"=>$id])->row();
        }
        return $this->output->set_output(json_encode($data));
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
    // Pages
    private function pages($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
}

/* End of file KartuKontrol.php */
