<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPemasukan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_laporan','Mlaporan');
    }
    public function index()
    {
        $data['title'] = 'Laporan Pemasukan';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(25); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["kelompok"] = $this->Mlaporan->getDataWhere("*","kelompok_item",["id_kategori"=>2])->result();
        $this->pages("laporan/pemasukan/view_pemasukan",$data);
    }

    public function data() //Fungsi Untuk Load Datatable
    {
        if (isset($_POST["id_kelompok"]) || isset($_POST["tgl_mulai"]) || isset($_POST["tgl_akhir"])) {
            $where = "";
            if (!empty($_POST["id_kelompok"])) {
                $where .= "id_kelompok = '".$this->db->escape_str($_POST['id_kelompok'])."' and ";
            }
            if ((!empty($_POST["tgl_mulai"])) && (empty($_POST["tgl_akhir"]))) {
                $where .= "created_at >= '".$this->db->escape_str($_POST['tgl_mulai'])."' and ";
            }
            else if ((!empty($_POST["tgl_akhir"])) && (empty($_POST["tgl_mulai"]))) {
                $where .= "created_at <= '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
            else if((!empty($_POST['tgl_mulai'])) && (!empty($_POST['tgl_akhir']))){
                $where .= "created_at BETWEEN '".$this->db->escape_str($_POST['tgl_mulai'])."' and '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
            $where .= "id_properti = '".$this->session->userdata("id_properti")."'";
        }
        else{
            $where = "id_properti = '".$this->session->userdata("id_properti")."'";
        }
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_pemasukan";
        $order = "id_pemasukan";
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,null,$order,null,$where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $no;
            $sub[] = $value->nama_pemasukan;
            $sub[] = $value->nama_kelompok;
            $sub[] = $value->volume." ".$value->satuan;
            $sub[] = number_format($value->harga_satuan,2,",",".");
            $sub[] = number_format($value->total_harga,2,",",".");
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->created_at;
            $sub[] = '<a href="'.base_url('laporanpemasukan/printSpesific/'.$value->id_pemasukan).'" class="btn btn-sm btn-info mx-2">Print</a>';
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,null,$order,null,$where)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    public function getDetail()
    {
        $this->load->helper('date');
        $id = $this->uri->segment(3);
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
    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
        public function printAll()
    {
        $this->load->library('Pdf');
        $session = $this->session->userdata('id_pemasukan');
        if (isset($_POST["id_kelompok"]) || isset($_POST["tgl_mulai"]) || isset($_POST["tgl_akhir"])) 
        {
            $where = "";
            if (!empty($_POST["id_kelompok"])) {
                $where .= "id_kelompok = '".$this->db->escape_str($_POST['id_kelompok'])."' and ";
            }
            if ((!empty($_POST["tgl_mulai"])) && (empty($_POST["tgl_akhir"]))) {
                $where .= "created_at >= '".$this->db->escape_str($_POST['tgl_mulai'])."' and ";
            }
            else if ((!empty($_POST["tgl_akhir"])) && (empty($_POST["tgl_mulai"]))) {
                $where .= "created_at <= '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
            else if((!empty($_POST['tgl_mulai'])) && (!empty($_POST['tgl_akhir']))){
                $where .= "created_at BETWEEN '".$this->db->escape_str($_POST['tgl_mulai'])."' and '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
            $where .= "id_properti = '".$this->session->userdata("id_properti")."'";
        }
        else{
            $where = "id_properti = '".$this->session->userdata("id_properti")."'";
        }
        $data['pemasukan'] = $this->Mlaporan->getDataWhere("*","tbl_pemasukan",$where)->result();
        $this->pdf->load_view('Semua Pemasukan','print/print_pemasukan',$data);
    }
    public function printSpesific($id_pemasukan)
    {
        $this->load->library('Pdf');
        $where = ["id_pemasukan"=>$id_pemasukan];
        $data['pemasukan'] = $this->Mlaporan->getDataWhere("*","tbl_pemasukan",$where)->result();
        $this->pdf->load_view('Spesific Pemasukan','print/print_spesifikasi_pemasukan',$data);
    }
}

/* End of file Laporan_Keuangan.php */
