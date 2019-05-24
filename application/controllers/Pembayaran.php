<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct()   
    {
        parent::__construct();
        $this->load->model('Model_pembayaran',"Mpembayaran");
        checkSession();
    }
    public function index()
    {
        $data['title'] = "Tanda Jadi";
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(7); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->pages("pembayaran/view_tanda_jadi",$data);
    }
    // View Pembayaran tandajadi,Uang muka,Transaksi
    public function tandajadi()
    {
        $data['title'] = "Tanda Jadi";
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(7); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->pages("pembayaran/view_tanda_jadi",$data);
    }
    public function uangMuka()
    {
        $data['title'] = "Tanda Jadi";
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(8); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->pages("pembayaran/view_uang_muka",$data);
    }
    public function cicilan()
    {
        $data['title'] = "Tanda Jadi";
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(8); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->pages("pembayaran/view_transaksi",$data);
    }
    // Server Side table view tandajadi,uang muka,transaksi
    public function dataTj() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_transaksi";
        $order = "nama_lengkap";
        $id_properti = $this->session->userdata("id_properti");
        $column_where = ["id_properti"=>$id_properti,"status_transaksi"=>"pending"];
        $search = ['nama_lengkap','nama_properti','nama_unit'];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            if ($value->status_transaksi == "pending") {
                $badge = "badge-primary";
                $button = '<button type="button" class="btn btn-sm btn-primary mr-1 bayar_tj" data-id="'.$value->id_transaksi.'">Bayar</button>';
            }
            else if ($value->status_transaksi == "progress") {
                $badge = "badge-info";
                $button = " - ";
            }else{
                $badge="badge-success";
                $button = '<button type="button" class="btn btn-sm btn-primary mr-1 bayar_tj" data-id="'.$value->id_transaksi.'">Print</button>';
            }
            $sub = array();
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->nama_properti;
            $sub[] = $value->nama_unit;
            $sub[] = $value->tempo_tanda_jadi;
            $sub[] = '<span class="badge '.$badge.'">'.$value->status_transaksi.'</span>';
            $sub[] = "Rp. ".number_format($value->tanda_jadi,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_kesepakatan,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_transaksi,2,',','.');
            $sub[] = $button;
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    public function dataUm() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_transaksi";
        $order = "nama_lengkap";
        $id_properti = $this->session->userdata("id_properti");
        $column_where = ["id_properti"=>$id_properti,"status_transaksi"=>"progress"];
        $search = ['nama_lengkap','nama_properti','nama_unit'];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            if ($value->status_transaksi == "progress") {
                $badge = "badge-info";
                $button = '<a href="'.base_url()."pembayaran/uangmuka/kelola/".$value->id_transaksi.'" class="btn btn-sm btn-success mr-1 bayar_tj" >Bayar</button>';
            }
            else if ($value->status_transaksi == "progress") {
                $badge = "badge-info";
                $button = " - ";
            }else{
                $badge="badge-success";
                $button = '<button type="button" class="btn btn-sm btn-primary mr-1 bayar_tj" data-id="'.$value->id_transaksi.'">Print</button>';
            }
            $sub = array();
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->nama_properti;
            $sub[] = $value->nama_unit;
            $sub[] = $value->tempo_uang_muka;
            $sub[] = $value->periode_uang_muka;
            $sub[] = '<span class="badge '.$badge.'">'.$value->status_transaksi.'</span>';
            $sub[] = "Rp. ".number_format($value->uang_muka,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_kesepakatan,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_transaksi,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_akhir,2,',','.');
            $sub[] = $button;
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    public function data_transaksi() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_transaksi";
        $order = "nama_lengkap";
        $id_properti = $this->session->userdata("id_properti");
        $column_where = ["id_properti"=>$id_properti,"status_transaksi"=>"progress"];
        $search = ['nama_lengkap','nama_properti','nama_unit'];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            if ($value->status_transaksi == "progress") {
                $badge = "badge-info";
                $button = '<a href="'.base_url()."pembayaran/transaksi/bayar/".$value->id_transaksi.'" class="btn btn-sm btn-success mr-1 bayar_tj" >Bayar</button>';
            }
            else if ($value->status_transaksi == "progress") {
                $badge = "badge-info";
                $button = " - ";
            }else{
                $badge="badge-success";
                $button = '<button type="button" class="btn btn-sm btn-primary mr-1 bayar_tj" data-id="'.$value->id_transaksi.'">Print</button>';
            }
            $sub = array();
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->nama_properti;
            $sub[] = $value->nama_unit;
            $sub[] = $value->tempo_bayar;
            $sub[] = '<span class="badge '.$badge.'">'.$value->status_transaksi.'</span>';
            $sub[] = $value->type_pembayaran;
            $sub[] = "Rp. ".number_format($value->pembayaran,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_kesepakatan,2,',','.');
            $sub[] = "Rp. ".number_format($value->total_transaksi,2,',','.');
            $sub[] = $button;
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    } 

    // view detail dan core tandajadi
    public function tanda_jadi()
    {
        $input['id_transaksi'] = $this->input->post('id');
        $input['id_jenis'] = 1;
        $data = $this->Mpembayaran->getHarga($input);
        $output['id'] = $input['id_transaksi'];
        $output['tj'] = $data->total_tagihan;
        return $this->output->set_output(json_encode($output));
        
    }
    public function core_tanda_jadi()
    {
        $this->load->library('form_validation');
        $data = [
            "success" => false,
            'msg' => [],
        ];
        $this->validate(); //fungsi validate ada dibawah
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }else {
            $ttl_tgh = $this->Mpembayaran->getTotalTgh($this->input->post('input_hidden',true));
            $input = [
                'id_jenis'=>1,
                'id'=>$this->input->post('input_hidden',true),
                'bayar'=>$this->input->post('bayar',true),
                'tgl'=>$this->input->post('tgl',true)
            ];
            $input['hutang'] = ($ttl_tgh['total_tagihan'] - $input['bayar']); 
            $config['upload_path'] = './assets/uploads/images/pembayaran/tanda_jadi/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            if ($_FILES['upload']['name'] != "") {
                if ($this->upload->do_upload('upload')) {
                    $img = $this->upload->data();
                    $input['img'] = $img['file_name'];
                    $sql = $this->Mpembayaran->update_tanda_jadi($input);
                    if ($sql) {
                        $this->Mpembayaran->update_transaksi($input['id']);
                    }
                    $data['success'] = true;
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $data['success'] = false;
                }
            } else {
                $input['img'] = "";
                $sql = $this->Mpembayaran->update_tanda_jadi($input);
                if ($sql) {
                    $this->Mpembayaran->update_transaksi($input['id']);
                }
                $data['success'] = true;
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    // view detail dan core uangmuka
    public function kelola_um($id)
    {
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(8); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['um_data'] = $this->Mpembayaran->getData($id);
        $data['um_hutang'] = $this->Mpembayaran->getHutang($id,2);
        $data['um_bayar'] = $this->Mpembayaran->getBayar($id,2);
        $data['data_uang_muka'] = $this->Mpembayaran->getListPembayaran($id,2);
        $this->pages("pembayaran/view_bayar_um",$data);
    }
    public function uang_muka_modal()
    {
        $input = $this->input->post('id');
        $data = $this->Mpembayaran->getModalUm($input);
        $output['id'] = $input;
        $output['um'] = $data['total_tagihan'];
        return $this->output->set_output(json_encode($output));
        
    }
    public function core_uang_muka()
    {
        $this->load->library('form_validation');
        $data = [
            "success" => false,
            'msg' => [],
        ];
        $this->validate(); //fungsi validate ada dibawah
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }else {
            $ttl_tgh = $this->Mpembayaran->getTotalTgh($this->input->post('input_hidden',true));
            $input = [
                'id'=>$this->input->post('input_hidden',true),
                'bayar'=>str_replace('.','',$this->input->post('bayar',true)),
                'tgl'=>$this->input->post('tgl',true)
            ];
            $input['hutang'] = ($ttl_tgh['total_tagihan'] - $input['bayar']); 
            $config['upload_path'] = './assets/uploads/images/pembayaran/uang_muka/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            if ($_FILES['upload']['name'] != "") {
                if ($this->upload->do_upload('upload')) {
                    $img = $this->upload->data();
                    $input['img'] = $img['file_name'];
                    $sql = $this->Mpembayaran->update_uang_muka($input);
                    $data['success'] = true;
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $data['success'] = false;
                }
            } else {
                $input['img'] = "";
                $sql = $this->Mpembayaran->update_uang_muka($input);
                $data['success'] = true;
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    // view detail and core transaksi cicilan
    public function bayar_transaksi($id)
    {
        $active = 'Bayar Transaksi';
        $data['title'] = 'Bayar Transaksi';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(8); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['um_data'] = $this->Mpembayaran->getData($id);
        $data['um_hutang'] = $this->Mpembayaran->getHutang($id,3);
        $data['um_bayar'] = $this->Mpembayaran->getBayar($id,3);
        $data['data_transaksi'] = $this->Mpembayaran->getListPembayaran($id,2);
        $this->pages("pembayaran/view_bayar_transaksi",$data);
    }   
    public function transaksi_modal()
    {
        $input = $this->input->post('id');
        $data = $this->Mpembayaran->getModalUm($input);
        $output['id'] = $input;
        $output['um'] = $data['total_tagihan'];
        return $this->output->set_output(json_encode($output));
    }
    public function core_cicilan()
    {
        $this->load->library('form_validation');
        $data = [
            "success" => false,
            'msg' => [],
        ];
        $this->validate(); //fungsi validate ada dibawah
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }else {
            $ttl_tgh = $this->Mpembayaran->getTotalTgh($this->input->post('input_hidden',true));
            $input = [
                'id'=>$this->input->post('input_hidden',true),
                'bayar'=>str_replace('.','',$this->input->post('bayar',true)),
                'tgl'=>$this->input->post('tgl',true)
            ];
            $input['hutang'] = ($ttl_tgh['total_tagihan'] - $input['bayar']); 
            $config['upload_path'] = './assets/uploads/images/pembayaran/cicilan/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            if ($_FILES['upload']['name'] != "") {
                if ($this->upload->do_upload('upload')) {
                    $img = $this->upload->data();
                    $input['img'] = $img['file_name'];
                    $sql = $this->Mpembayaran->update_uang_muka($input);
                    $data['success'] = true;
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $data['success'] = false;
                }
            } else {
                $input['img'] = "";
                $sql = $this->Mpembayaran->update_uang_muka($input);
                $data['success'] = true;
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    // This function is private. so , anyone cannot to access this function from web based *Private*
    private function pages($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
    private function validate()
    {
        $this->form_validation->set_rules('bayar','Bayar','trim|required');
        $this->form_validation->set_rules('tgl','Tanggal','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
    }
}

/* End of file Controllername.php */
