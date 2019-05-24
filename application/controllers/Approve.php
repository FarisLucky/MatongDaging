<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Approve extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_approve','MApprove');
        checkSession();
        
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
        $data['approve_bayar'] = $this->MApprove->getPembayaran();
        $this->pages("approve/view_approve_pembayaran",$data);
    }
    public function confirm()
    {
        $data = ['success'=>false];
        $confirm = $this->input->post('id_confirm');
        if (!empty($confirm)) {
            $query = $this->MApprove->setConfirm($id);
            if ($query) {
                $data['confirm'] = true;
                $data['success'] = true;
            }else{
                $data['success'] = false;
            }
        }
        $this->output->set_output(json_encode($data));
    }
    public function data_approve()
    {
        $data = ['success'=>false];
        $pembayaran = $this->input->post('id_approve');
        if (!empty($pembayaran)) {
            $query = $this->MApprove->getDataApprove($pembayaran);
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
        $data['approve_trans'] = $this->MApprove->getTransaksi();
        $this->pages("approve/view_approve_transaksi",$data);
    }
    public function detail($id)
    {
        $active = 'Approve Transaksi';
        $data['title'] = 'Approve Transaksi';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(10); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['detail_trans'] = $this->MApprove->getDetailTransaksi($id);
        $data['data_pembayaran'] = $this->MApprove->getDataPembayaran($id);
        $data['data_transaksi'] = $this->MApprove->getAllTransaksi($id);
        $data['hutang_um'] = $this->MApprove->getHutang($id,2);
        $data['bayar_um'] = $this->MApprove->getBayar($id,2);
        $data['hutang_ccl'] = $this->MApprove->getHutang($id,3);
        $data['bayar_ccl'] = $this->MApprove->getBayar($id,3);
        $this->pages("approve/view_detail_approve",$data);
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