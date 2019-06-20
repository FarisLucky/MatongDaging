<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Approve extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_approve','MApprove');
    }
    public function index()
    {
        redirect("auth");
    }
    public function kwitansi()
    {
        $data['title'] = 'Approve Pembayaran';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(12); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['approve_bayar'] = $this->MApprove->getDataWhere("*","tbl_pembayaran",["status"=>"pending"])->result();
        $this->pages("approve/view_approve_pembayaran",$data);
    }
    public function confirm()
    {
        $data = ['success'=>false];
        $confirm = $this->input->post('id_confirm');
        $updatePembayaran = $this->MApprove->updateData(["status"=>"selesai"],"pembayaran_transaksi",["id_pembayaran"=>$confirm]);
        $getJenis = $this->MApprove->getDataWhere("id_jenis,id_transaksi","tbl_pembayaran",["id_pembayaran"=>$confirm])->row();
        if ($getJenis->id_jenis == 1) {
            $updateTransaksi = $this->MApprove->updateData(["status_transaksi"=>"progress"],"transaksi_unit",["id_transaksi"=>$getJenis->id_transaksi]);
            if ($updateTransaksi) {
                $transaksi = $this->MApprove->getDataWhere("id_konsumen,id_unit","tbl_transaksi",["id_transaksi"=>$getJenis->id_transaksi])->row();
                $updateKonsumen = $this->MApprove->updateData(["status_konsumen"=>"konsumen"],"konsumen",["id_konsumen"=>$transaksi->id_konsumen]);
                if ($updateKonsumen) {
                    $updateunit = $this->MApprove->updateData(["status_unit"=>"booking"],"unit_properti",["id_unit"=>$transaksi->id_unit]);
                    
                    $data['confirm'] = true;
                    $data['success'] = true;
                }
            }
        }else {
            // Get uang muka type of pay
            $status_result = $this->MApprove->getDataWhere("COUNT(id_pembayaran) as result","tbl_pembayaran",["id_transaksi"=>$getJenis->id_transaksi,"id_jenis"=>$getJenis->id_jenis,"status"=>"selesai"])->row_array();
            $result_all = $this->MApprove->getDataWhere("COUNT(id_pembayaran) as result","tbl_pembayaran",["id_transaksi"=>$getJenis->id_transaksi,"id_jenis"=>$getJenis->id_jenis])->row_array();
            if ($status_result["result"] == $result_all["result"]) {
                $this->MApprove->updateData(["status_um"=>"selesai"],"transaksi_unit",["id_transaksi"=>$getJenis->id_transaksi]);
            }
            $query = $this->MApprove->updateData(["status"=>"selesai"],"pembayaran_transaksi",["id_pembayaran"=>$confirm]);
            $data['confirm'] = true;
            $data['success'] = true;
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
    public function penjualan()
    {
        $id = $this->session->userdata('id_properti');
        $data['title'] = 'Approve Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(10); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['approve_trans'] = $this->MApprove->getDataWhere("*","tbl_transaksi",["status_transaksi"=>"lunas"])->result();
        $this->pages("approve/view_approve_transaksi",$data);
    }
    public function detail($id)
    {
        $data['title'] = 'Approve Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(10); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['detail_trans'] = $this->MApprove->getDataWhere("*","detail_transaksi",["id_transaksi"=>$id])->result();
        $data['data_pembayaran'] = $this->MApprove->getDataWhere("*","tbl_pembayaran",["id_transaksi"=>$id,"status"=>"selesai"])->result();
        $data['data_transaksi'] = $this->MApprove->getDataWhere("*","tbl_transaksi",["id_transaksi"=>$id])->row();
        $data['hutang_um'] = $this->MApprove->getHutang($id,2);
        $data['bayar_um'] = $this->MApprove->getBayar($id,2);
        $data['hutang_ccl'] = $this->MApprove->getHutang($id,3);
        $data['bayar_ccl'] = $this->MApprove->getBayar($id,3);

        $this->pages("approve/view_detail_approve",$data);
    }
    public function getDataModal()
    {
        $data = ["success"=>false];
        $dataId = $this->input->post('id');
        if (!empty($dataId)) {
            $data["success"] = true;
            $data ["pembayaran"] = $this->MApprove->getDataWhere("*","tbl_pembayaran",["id_pembayaran"=>$dataId])->row();
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
