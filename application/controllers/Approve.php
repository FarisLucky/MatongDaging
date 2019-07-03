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
        redirect("dashboard");
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
    public function accept()
    {
        $data = ['success'=>false];
        $confirm = $this->input->get('params',true);
        $getData = $this->MApprove->getDataWhere("hutang,jumlah_bayar,total_bayar,id_jenis,id_transaksi","pembayaran_transaksi",["id_pembayaran"=>$confirm])->row();
        if ($getData->hutang == 0) {
            $status = "selesai";
            $status_tj = "lunas";
        }else{
            $status = "belum bayar";
            $status_tj = "belum lunas";
        }
        $total = (int) ($getData->jumlah_bayar + $getData->total_bayar);
        $updatePembayaran = $this->MApprove->updateData(["status"=>$status,"total_bayar"=>$total,"jumlah_bayar"=>0],"pembayaran_transaksi",["id_pembayaran"=>$confirm]);
        if ($getData->id_jenis == 1) {
            $updateTransaksi = $this->MApprove->updateData(["status_tj"=>$status_tj],"transaksi_unit",["id_transaksi"=>$getData->id_transaksi]);
            $dataTransaksi = $this->MApprove->getDataWhere("id_konsumen,id_unit,status_tj","tbl_transaksi",["id_transaksi"=>$getData->id_transaksi])->row();
            if ($dataTransaksi->status_tj == "lunas") {
                $updateKonsumen = $this->MApprove->updateData(["status_konsumen"=>"konsumen"],"konsumen",["id_konsumen"=>$dataTransaksi->id_konsumen]);
                $updateunit = $this->MApprove->updateData(["status_unit"=>"booking"],"unit_properti",["id_unit"=>$dataTransaksi->id_unit]);
            }
            $data['confirm'] = true;
            $data['success'] = true;
            }else {
            $status_result = $this->MApprove->getDataWhere("COUNT(id_pembayaran) as result","tbl_pembayaran",["id_transaksi"=>$getData->id_transaksi,"id_jenis"=>$getData->id_jenis,"status"=>"selesai"])->row_array();
            $result_all = $this->MApprove->getDataWhere("COUNT(id_pembayaran) as result","tbl_pembayaran",["id_transaksi"=>$getData->id_transaksi,"id_jenis"=>$getData->id_jenis])->row_array();
            if ($status_result["result"] == $result_all["result"]) {
                if ($getData->id_jenis == 2) {
                    $this->MApprove->updateData(["status_um"=>"lunas"],"transaksi_unit",["id_transaksi"=>$getData->id_transaksi]);
                }else if($getData->id_jenis == 3){
                    $this->MApprove->updateData(["status_cicilan"=>"lunas"],"transaksi_unit",["id_transaksi"=>$getData->id_transaksi]);
                }
            }
            $data['confirm'] = true;
            $data['success'] = true;
        }
        $this->output->set_output(json_encode($data));
    }

    public function reject()
    {
        $data = ["success"=>false];
        $id = $this->input->get("params",true);
        if (!empty($id)) {
            $status="sementara";
            $getData = $this->MApprove->getDataWhere("hutang,jumlah_bayar,total_bayar","pembayaran_transaksi",["id_pembayaran"=>$id])->row();
            $hutang = (int) ($getData->hutang + $getData->jumlah_bayar);
            $update = $this->MApprove->updateData(["hutang"=>$hutang,"jumlah_bayar"=>0,"status"=>$status],"pembayaran_transaksi",["id_pembayaran"=>$id]);
            if ($update) {
                $data["success"] = true;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
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
