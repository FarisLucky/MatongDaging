<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPengeluaran extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_laporan','Mlaporan');
    }
    public function index()
    {
        $data['title'] = 'Laporan Pengeluaran';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(25); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["kelompok"] = $this->Mlaporan->getDataWhere("*","kelompok_item",["id_kategori"=>3])->result();
        $this->pages("laporan/pengeluaran/view_pengeluaran",$data);
    }

    public function data() //Fungsi Untuk Load Datatable
    {
        $where = $this->whereData();
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_pengeluaran";
        $order = "id_pengeluaran";
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,null,$order,null,$where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $no;
            $sub[] = $value->nama_pengeluaran;
            $sub[] = $value->nama_kelompok;
            $sub[] = $value->volume." ".$value->satuan;
            $sub[] = number_format($value->harga_satuan,2,",",".");
            $sub[] = number_format($value->total_harga,2,",",".");
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->created_at;
            $sub[] = '<a href="'.base_url('laporanpengeluaran/printspesific/'.$value->id_pengeluaran).'" class="btn btn-sm btn-info mx-2">Print</a>';
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
    public function printAll()
    {
        $this->load->library('Pdf');
        $where = $this->whereData();
        $data['pengeluaran'] = $this->Mlaporan->getDataWhere("*","tbl_pengeluaran",$where)->result();
        // $this->load->view("print/print_pengeluaran",$where);
        $this->pdf->load_view('Semua Pengeluaran','print/print_pengeluaran',$data);
    }
    public function printSpesific($id_pengeluaran)
    {
        $this->load->library('Pdf');
        $where = ["id_pengeluaran"=>$id_pengeluaran];
        $data['pengeluaran'] = $this->Mlaporan->getDataWhere("*","tbl_pengeluaran",$where)->result();
        $this->pdf->load_view('Spesific Pengeluaran','print/print_spesifik_pengeluaran',$data);
    }
    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
    private function whereData()
    {
        $where = [];
        $session = $this->session->userdata("id_akses");
        if (isset($_POST["id_kelompok"]) || isset($_POST["tgl_mulai"]) || isset($_POST["tgl_akhir"])) {
            $id_kelompok = $this->input->post('id_kelompok',true);
            $tgl_mulai = $this->input->post('tgl_mulai',true);
            $tgl_akhir = $this->input->post('tgl_akhir',true);
            if (!empty($id_kelompok)) {
                $where += ["id_kelompok"=>$id_kelompok];
            }
            if ((!empty($tgl_mulai)) && (empty($tgl_akhir))) {
                $where += ["created_at >="=>$tgl_mulai]; 
                // "created_at >= '".$this->db->escape_str($_POST['tgl_mulai'])."' and ";
            }
            else if ((!empty($tgl_akhir)) && (empty($tgl_mulai))) {
                $where += ["created_at <="=>$tgl_akhir]; 
                // "created_at <= '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
            else if((!empty($tgl_mulai)) && (!empty($tgl_akhir))){
                $where += ["created_at >="=>$tgl_mulai,"created_at <="=>$tgl_akhir]; 
                // "created_at BETWEEN '".$this->db->escape_str($_POST['tgl_mulai'])."' and '".$this->db->escape_str($_POST['tgl_akhir'])."' and ";
            }
        }
        if ($session != 1) {
            $where += ["id_properti"=>$this->session->userdata('id_properti')];
        }
        return $where;
    }
}

/* End of file Laporan_Keuangan.php */
