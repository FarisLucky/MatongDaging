<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApproveList extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_approve','MApprove');
    }
    public function index()
    {
        $data['title'] = 'Approve Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(23); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['approve_pengeluaran'] = $this->MApprove->getDataWhere("*","tbl_pengeluaran",["id_properti"=>$_SESSION['id_properti'],"status_manager"=>"pending"])->result();
        $this->pages("approve/view_list_approve",$data);
    }
    public function search()
    {
        $data['title'] = 'Approve Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(23); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['approve_bayar'] = $this->MApprove->getDataWhere("*","tbl_pembayaran",["status"=>"pending"])->result();
        $this->pages("approve/view_list_approve",$data);
    }
    public function confirm()
    {
        $data = ['success'=>false];
        $confirm = $this->input->post('id_confirm');
        if (!empty($confirm)) {
            $update = $this->MApprove->updateData(["status_manager"=>"selesai","update_by"=>$_SESSION["id_user"]],"pengeluaran",["id_pengeluaran"=>$confirm]);
            $data["success"] = true;
        }
        $this->output->set_output(json_encode($data));
    }
    public function data_approve()
    {
        $data = ['success'=>false];
        $pembayaran = $this->input->post('id_approve');
        if (!empty($pembayaran)) {
            $query = $this->MApprove->getDataWhere("*","tbl_pembayaran",["id_pembayaran"=>$pembayaran])->row();
            if ($query) {
                $data['approve'] = $query;
                if ($query->jenis_pembayaran == 'Tanda Jadi') {
                    $data['image'] = base_url().'assets/uploads/images/pembayaran/tanda_jadi/'.$query->bukti_bayar;
                }else if($query->jenis_pembayaran == "Uang Muka"){
                    $data['image'] = base_url().'assets/uploads/images/pembayaran/uang_muka/'.$query->bukti_bayar;
                }else{
                    $data['image'] = base_url().'assets/uploads/images/pembayaran/cicilan/'.$query->bukti_bayar;
                }
                $data['success'] = true;
            }else{
                $data['success'] = false;
            }
        }
        $this->output->set_output(json_encode($data));
    }
    public function getModal()
    {
        $data = ["success"=>false];
        $dataId = $this->input->post('params');
        if (!empty($dataId)) {
            $data["success"] = true;
            $query = $this->MApprove->getDataWhere("bukti_kwitansi","pengeluaran",["id_pengeluaran"=>$dataId]);
            if ($query->num_rows() > 0) {
                $rs_img = $query->row();
                $img = base_url()."assets/uploads/images/pengeluaran/".$rs_img->bukti_kwitansi;
                if (file_exists($img)) {
                    $data['bukti_kwitansi'] = $img;
                }else{
                    $data["img"] = "gambar_kosong";
                    $data["bukti_kwitansi"] = "Gambar Tidak ditemukan";
                }
            }else{
                $data["img"] = "belum_upload";
                $data["bukti_kwitansi"] = "Gambar belum di upload";
            }
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

}

/* End of file Approve.php */