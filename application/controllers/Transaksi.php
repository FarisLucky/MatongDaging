<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_transaksi',"Mtransaksi");
    }
    
    public function index()
    {
        $params = ['id_user'=>$this->session->userdata('id_user'),'id_properti'=>$this->session->userdata('id_properti')];
        $data['title'] = 'Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getMenuJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['list_transaksi'] = $this->Mtransaksi->getListTransaksi($params);
        $data['list_unlock'] = $this->Mtransaksi->getDataWhere("id_transaksi,no_ppjb,nama_lengkap,nama_unit,type_pembayaran,total_transaksi,tgl_transaksi","tbl_transaksi",["kunci"=>"unlock","id_user"=>$_SESSION['id_user']])->result();
        $this->pages("transaksi/view_list_transaksi",$data);
    }
    public function tambah()
    {
        $data['title'] = 'Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getMenuJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['konsumen'] = $this->Mtransaksi->getKonsumen();
        $data['unit'] = $this->Mtransaksi->getUnit($this->session->userdata('id_properti'));
        $data['type'] = $this->Mtransaksi->getType();
        $this->pages("transaksi/view_transaksi",$data);
    }
    public function detail($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getMenuJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['transaksi'] = $this->Mtransaksi->getDetail($id);
        $id_transaksi = $data['transaksi']->id_transaksi;
        $id_konsumen = $data['transaksi']->id_konsumen;
        $id_unit = $data['transaksi']->id_unit;
        $data['konsumen'] = $this->Mtransaksi->getKonsumenId($id_konsumen)->row();
        $data['unit'] = $this->Mtransaksi->getUnitId($id_unit)->row();
        $data['detail_transaksi'] = $this->Mtransaksi->getDetailId($id_transaksi)->result();
        $this->pages("transaksi/view_detail",$data);
    }
    public function edit($id)
    {
        $data['title'] = 'Edit Transaksi';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getMenuJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['transaksi'] = $this->Mtransaksi->getDetail($id);
        $id_transaksi = $data['transaksi']->id_transaksi;
        $id_konsumen = $data['transaksi']->id_konsumen;
        $id_unit = $data['transaksi']->id_unit;
        $data['konsumen'] = $this->Mtransaksi->getKonsumen();
        $data['unit'] = $this->Mtransaksi->getUnit($this->session->userdata('id_properti'));
        $data['detail_konsumen'] = $this->Mtransaksi->getKonsumenId($id_konsumen)->row();
        $data['detail_unit'] = $this->Mtransaksi->getUnitId($id_unit)->row();
        $data['detail_transaksi'] = $this->Mtransaksi->getDetailId($id_transaksi)->result();
        $data['type'] = $this->Mtransaksi->getType();
        $this->pages("transaksi/view_edit",$data);
    }

    public function dataKonsumen()
    {
        $data = ['success'=>false];
        $input = $this->input->post('id_kons');
        $val = $this->Mtransaksi->getKonsumenId($input);
        if ($val) {
            $data['success'] = true;
            $data['obj'] = $val->row();
        }
        else{
            $data['success'] = false;
        }
        $this->output->set_output(json_encode($data));
    }
    public function dataUnit()
    {
        $data = ['success'=>false];
        $input = $this->input->post('id_unit');
        $val = $this->Mtransaksi->getUnitId($input);
        if ($val) {
            $data['success'] = true;
            $data['obj'] = $val->row();
            $data['harga'] = number_format($data['obj']->harga_unit,2,',','.');
        }
        else{
            $data['success'] = false;
        }
        $this->output->set_output(json_encode($data));
    }
    public function getHarga()
    {
        $data = ['success'=>false];
        $input = $this->input->post('kesepakatan');
        $data['ttl_harga'] = $input;
        return $this->output->set_output(json_encode($data));
        
    }
    public function total_transaksi()
    {
        $data = ['success'=>false];
        $check_tj = $this->input->post('t_j');
        $val_tj = $this->input->post('val_tj');
        $ttl_sementara = $this->input->post('sementara');
        if ($check_tj == "tidak_masuk_harga_jual") {
            $data['success'] = true;
            $data['hasil'] = $ttl_sementara;
        }
        else{
            $data['success'] = true;
            $data['hasil'] = $ttl_sementara - $val_tj ;
        }
        return $this->output->set_output(json_encode($data));
    }

    // Insert Transaksi
    public function insertTransaksi()
    {
        $data = [
            'success'=>false,
            'msg'=>[]
        ];
        $this->validate();
        if ($this->form_validation->run() ==  false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }else{
            $input = $this->inputData();
            $angsuran = $this->input->post('txt_angsuran',true);
            $tanda_jadi = $this->input->post('txt_tanda_jadi',true);
            $type = $this->input->post('txt_type_pembayaran',true);
            $nama_type = $this->Mtransaksi->getDataWhere("type_bayar","type_bayar",["id_type_bayar"=>$type])->row();
            if ($input['id_type_bayar'] == 2) {
                $input['bayar_periode'] = 1;
                $input['pembayaran'] = str_replace('.','',$this->input->post('txt_ttl_akhir'));
            }
            $query = $this->Mtransaksi->insertData($input,"transaksi_unit");
            if ($query) {
                $id_insert = $this->db->insert_id();
                $detail = [$this->input->post('txt_nama_tambah'),$this->input->post('txt_volume_tambah'),$this->input->post('txt_satuan_tambah'),$this->input->post('txt_harga_tambah')];
                $data['detail'] = $this->reArray($detail);
                // Detail Transaksi
                if (!empty($data['detail'])) {
                    $detail_transaksi = [];
                    foreach ($data['detail'] as $key => $value) {
                        if (!empty($key)) {
                            $detail_transaksi['penambahan'] = $value[0]; 
                            $detail_transaksi['volume'] = $value[1]; 
                            $detail_transaksi['satuan'] = $value[2]; 
                            $detail_transaksi['total'] = $value[3]; 
                            $detail_transaksi['transaksi'] = $id_insert; 
                            $this->Mtransaksi->insertDetail($detail_transaksi);
                        }
                    }
                    $data['success'] = true;
                }
                // Uang Muka Angsuran 
                if (!empty($angsuran)) {
                    $data_angsuran = [];
                    $no= 1;
                    foreach ($angsuran as $key => $value) {
                        $date = new DateTime($this->input->post('tgl_uang_muka'));
                        addmonths($date,$no);
                        $data_angsuran['id_transaksi'] = $id_insert;
                        $data_angsuran['nama_pembayaran'] = 'Angsuran '.$no;
                        $data_angsuran['total_tagihan'] = $value;
                        $data_angsuran['total_bayar'] = 0;
                        $data_angsuran['tgl_jatuh_tempo'] = $date->format("Y-m-d");
                        $data_angsuran['hutang'] = $value;
                        $data_angsuran['status'] = 'belum bayar';
                        $data_angsuran['id_user'] = $this->session->userdata('id_user');
                        $data_angsuran['id_jenis'] = 2;
                        $this->Mtransaksi->insertAngsuranUangMuka($data_angsuran);
                        $no++;
                    }
                    $data['success'] = true;
                }

                // Uang Tanda Jadi 
                if (!empty($tanda_jadi)) {
                    $data_tj = [];
                    $unit = $this->Mtransaksi->getNameUnit($this->input->post('select_unit'));
                    $nama_unit = $unit->nama_unit;
                    $data_tj['id_transaksi'] = $id_insert;
                    $data_tj['nama_pembayaran'] = 'Tanda Jadi Unit '.$nama_unit;
                    $data_tj['total_tagihan'] = $input["tanda_jadi"];
                    $data_tj['total_bayar'] = 0;
                    $data_tj['tgl_jatuh_tempo'] = $this->input->post('tgl_tanda_jadi');
                    $data_tj['hutang'] = $input["tanda_jadi"];
                    $data_tj['status'] = 'belum bayar';
                    $data_tj['id_user'] = $this->session->userdata('id_user');
                    $data_tj['id_jenis'] = 1;
                    $this->Mtransaksi->insertAngsuranUangMuka($data_tj);
                    $data['success'] = true;
                }

                //  Periode pembayaran
                if (!empty($type)) {
                    if ($type == 1) {
                        $data_pembayaran = [];
                        $periode = $input["bayar_periode"];
                        $total_bayar = str_replace(".","",$this->input->post('total_bayar_periode'));
                        $no= 1;
                        for($i = 1; $i <= $periode; $i++) {
                            $date = new DateTime( $this->input->post('tgl_pembayaran'));
                            addmonths($date,$i);
                            $data_pembayaran['id_transaksi'] = $id_insert;
                            $data_pembayaran['nama_pembayaran'] = 'Cicilan '.$no;
                            $data_pembayaran['total_tagihan'] = $input["pembayaran"];
                            $data_pembayaran['total_bayar'] = 0;
                            $data_pembayaran['tgl_jatuh_tempo'] = $date->format("Y-m-d");
                            $data_pembayaran['hutang'] = $input["pembayaran"];
                            $data_pembayaran['status'] = 'belum bayar';
                            $data_pembayaran['id_user'] = $this->session->userdata('id_user');
                            $data_pembayaran['id_type_bayar'] = $input["id_type_bayar"];
                            $data_pembayaran['id_jenis'] = 3;
                            $this->Mtransaksi->insertPembayaranTransaksi($data_pembayaran);
                            $no++;
                        }
                    }
                    else{
                        $data_pembayaran = [];
                        $periode = 1;
                        $total_bayar = str_replace(".","",$this->input->post('txt_ttl_akhir'));
                        for($i = 1; $i <= $periode; $i++) {
                            $data_pembayaran['id_transaksi'] = $id_insert;
                            $data_pembayaran['nama_pembayaran'] = $nama_type->type_bayar;
                            $data_pembayaran['total_tagihan'] = $input["total_akhir"];
                            $data_pembayaran['total_bayar'] = 0;
                            $data_pembayaran['tgl_jatuh_tempo'] = $this->input->post('tgl_pembayaran');
                            $data_pembayaran['hutang'] = $input["total_akhir"];
                            $data_pembayaran['status'] = 'belum bayar';
                            $data_pembayaran['id_user'] = $this->session->userdata('id_user');
                            $data_pembayaran['id_type_bayar'] = $this->input->post('txt_type_pembayaran');
                            $data_pembayaran['id_jenis'] = 3;
                            $this->Mtransaksi->insertPembayaranTransaksi($data_pembayaran);
                        }
                    }
                    $data['success'] = true;
                }
            }
        }
        $this->output->set_output(json_encode($data));
    }
    
    // Ubah Transaksi
    public function core_ubah_transaksi()
    {
        $data = [
            'success'=>false,
            'msg'=>[]
        ];
        $this->validate();
        if ($this->form_validation->run() ==  false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }else{
            $id = $this->input->post('transaksi_id',true);
            $input = $this->inputData();
            $angsuran = $this->input->post('txt_angsuran',true);
            $tanda_jadi = $this->input->post('txt_tanda_jadi',true);
            $type = $this->input->post('txt_type_pembayaran',true);
            $nama_type = $this->Mtransaksi->getDataWhere("type_bayar","type_bayar",["id_type_bayar"=>$type])->row();
            if ($input['id_type_bayar'] == 2) {
                $input['bayar_periode'] = 1;
                $input['pembayaran'] = str_replace('.','',$this->input->post('txt_ttl_akhir'));
            }
            $query = $this->Mtransaksi->updateData($input,"transaksi_unit",["id_transaksi"=>$id]);
            if ($query) {
                $detail = [$this->input->post('txt_nama_tambah',true),$this->input->post('txt_volume_tambah',true),$this->input->post('txt_satuan_tambah',true),$this->input->post('txt_harga_tambah',true)];
                $data['detail'] = $this->reArray($detail);
                $this->Mtransaksi->deleteData('detail_transaksi',['id_transaksi'=>$id]);
                $this->Mtransaksi->deleteData('pembayaran_transaksi',['id_transaksi'=>$id,]);
                // Detail Transaksi
                if (!empty($data['detail'])) {
                    $detail_transaksi = [];
                    foreach ($data['detail'] as $key => $value) {
                        if (!empty($key)) {
                            $detail_transaksi['penambahan'] = $value[0]; 
                            $detail_transaksi['volume'] = $value[1]; 
                            $detail_transaksi['satuan'] = $value[2]; 
                            $detail_transaksi['total'] = $value[3]; 
                            $this->Mtransaksi->insertDetail($detail_transaksi);
                        }
                    }
                    $data['success'] = true;
                }
                // Uang Muka Angsuran 
                if (!empty($angsuran)) {
                    $angsuran = $this->input->post('txt_angsuran');
                    $data_angsuran = [];
                    $no= 1;
                    foreach ($angsuran as $key => $value) {
                        $date = new DateTime($this->input->post('tgl_uang_muka'));
                        addmonths($date,$no);
                        $data_angsuran['id_transaksi'] = $id;
                        $data_angsuran['nama_pembayaran'] = 'Angsuran '.$no;
                        $data_angsuran['total_tagihan'] = $value;
                        $data_angsuran['total_bayar'] = 0;
                        $data_angsuran['tgl_jatuh_tempo'] = $date->format("Y-m-d");
                        $data_angsuran['hutang'] = $value;
                        $data_angsuran['status'] = 'belum bayar';
                        $data_angsuran['id_user'] = $this->session->userdata('id_user');
                        $data_angsuran['id_jenis'] = 2;
                        $this->Mtransaksi->insertAngsuranUangMuka($data_angsuran);
                        $no++;
                    }
                    $data['success'] = true;
                }

                // Uang Tanda Jadi 
                if (!empty($tanda_jadi)) {
                    $data_tj = [];
                    $unit = $this->Mtransaksi->getNameUnit($this->input->post('select_unit'));
                    $nama_unit = $unit->nama_unit;
                    $data_tj['id_transaksi'] = $id;
                    $data_tj['nama_pembayaran'] = 'Tanda Jadi Unit '.$nama_unit;
                    $data_tj['total_tagihan'] = $input["tanda_jadi"];
                    $data_tj['total_bayar'] = 0;
                    $data_tj['tgl_jatuh_tempo'] = $this->input->post('tgl_tanda_jadi');
                    $data_tj['hutang'] = $input["tanda_jadi"];
                    $data_tj['status'] = 'belum bayar';
                    $data_tj['id_user'] = $this->session->userdata('id_user');
                    $data_tj['id_jenis'] = 1;
                    $this->Mtransaksi->insertAngsuranUangMuka($data_tj);
                    $data['success'] = true;
                }

                //  Periode pembayaran
                if (!empty($type)) {
                    $type = $this->input->post('txt_type_pembayaran');
                    if ($type == 1) {
                        $data_pembayaran = [];
                        $periode = $input["bayar_periode"];
                        $no= 1;
                        for($i = 1; $i <= $periode; $i++) {
                            $date = new DateTime( $this->input->post('tgl_pembayaran'));
                            addmonths($date,$i);
                            $data_pembayaran['id_transaksi'] = $id;
                            $data_pembayaran['nama_pembayaran'] = 'Cicilan '.$no;
                            $data_pembayaran['total_tagihan'] = $input["pembayaran"];
                            $data_pembayaran['total_bayar'] = 0;
                            $data_pembayaran['tgl_jatuh_tempo'] = $date->format("Y-m-d");
                            $data_pembayaran['hutang'] = $input["pembayaran"];
                            $data_pembayaran['status'] = 'belum bayar';
                            $data_pembayaran['id_user'] = $this->session->userdata('id_user');
                            $data_pembayaran['id_type_bayar'] = $this->input->post('txt_type_pembayaran');
                            $data_pembayaran['id_jenis'] = 3;
                            $this->Mtransaksi->insertPembayaranTransaksi($data_pembayaran);
                            $no++;
                        }
                    }
                    else{
                        $data_pembayaran = [];
                        $periode = 1;
                        for($i = 1; $i <= $periode; $i++) {
                            $data_pembayaran['id_transaksi'] = $id;
                            $data_pembayaran['nama_pembayaran'] = $nama_type->type_bayar;
                            $data_pembayaran['total_tagihan'] = $input["total_akhir"];
                            $data_pembayaran['total_bayar'] = 0;
                            $data_pembayaran['tgl_jatuh_tempo'] = $this->input->post('tgl_pembayaran');
                            $data_pembayaran['hutang'] = $input["total_akhir"];
                            $data_pembayaran['status'] = 'belum bayar';
                            $data_pembayaran['id_user'] = $this->session->userdata('id_user');
                            $data_pembayaran['id_type_bayar'] = $input["id_type_bayar"];
                            $data_pembayaran['id_jenis'] = 3;
                            $this->Mtransaksi->insertPembayaranTransaksi($data_pembayaran);
                        }
                    }
                    $data['success'] = true;
                }
            }
        }
        $this->output->set_output(json_encode($data));
    }
    public function lock()
    {
        $data = ["success"=>false];
        $id = $this->input->post('id_transaksi');
        $status = $this->Mtransaksi->getDataWhere("status_transaksi","tbl_transaksi",["id_transaksi"=>$id])->row_array();
        if ($status["status_transaksi"] == "sementara") {
            $query = $this->Mtransaksi->updateData(["status_transaksi"=>"progress","kunci"=>"lock"],"transaksi_unit",["id_transaksi"=>$id]);       
            $data['success'] = true;
        }else{
            $query = $this->Mtransaksi->updateData(["kunci"=>"lock"],"transaksi_unit",["id_transaksi"=>$id]);       
            $data['success'] = true;
        }
        $this->output->set_output(json_encode($data));
    }
    
    // Hapus Transaksi
    public function delete($params)
    {
        $data = ['success'=>false];
        if (intval($params)) {
            $query = $this->Mtransaksi->deleteData("pembayaran_transaksi",["id_transaksi"=>$params]);
            if ($query) {
                $this->Mtransaksi->deleteData("transaksi_unit",["id_transaksi"=>$params]);
                $data['success'] = true;
            }
        }
        return $this->output->set_output(json_encode($data));
        
    }
    public function printSpr()
    {
        $this->load->library('Pdf');
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $session = $this->session->userdata('id_properti');
            $where = ['id_transaksi'=>$id];
            $getData = $this->Mtransaksi->getDataWhere("id_konsumen,id_unit","tbl_transaksi",$where)->row();
            $data["konsumen"] = $this->Mtransaksi->getDataWhere("*","tbl_konsumen",["id_konsumen"=>$getData->id_konsumen])->row();
            $data["unit"] = $this->Mtransaksi->getDataWhere("*","tbl_unit_properti",["id_unit"=>$getData->id_unit])->row();
            $data['spr'] = $this->Mtransaksi->getDataWhere("setting_spr","tbl_properti",['id_properti'=>$session])->row();
            // $this->load->view('print/print_spr',$data);
            $this->pdf->load_view('Surat SPR','print/print_spr',$data);
        }
    }
      // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
    private function validate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_ppjb','No PPJB','trim|required');
        $this->form_validation->set_rules('select_konsumen','Nama Unit','trim|required');
        $this->form_validation->set_rules('select_unit','select_unit','trim|required');
        $this->form_validation->set_rules('txt_kesepakatan','Kesepakatan','trim|required');
        $this->form_validation->set_rules('txt_tanda_jadi','Tanda Jadi','trim|required');
        $this->form_validation->set_rules('txt_type_pembayaran','Total Transaksi','trim|required');
        $this->form_validation->set_rules('tgl_tanda_jadi','Tanggal Tanda Jadi','trim|required');
        $this->form_validation->set_rules('tgl_pembayaran','Tanggal Pembayaran','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
    }
    private function inputData()
    {
        return [
            'no_ppjb'=>$this->input->post('txt_ppjb',true),
            'id_konsumen'=>$this->input->post('select_konsumen',true),
            'id_unit'=>$this->input->post('select_unit',true),
            'total_transaksi'=>str_replace('.','',$this->input->post('txt_ttl_transaksi',true)),
            'total_kesepakatan'=>str_replace('.','',$this->input->post('txt_kesepakatan',true)),
            'total_akhir'=>str_replace('.','',$this->input->post('txt_ttl_akhir',true)),
            'tanda_jadi'=>str_replace('.','',$this->input->post('txt_tanda_jadi',true)),
            'uang_muka'=>str_replace('.','',$this->input->post('txt_uang_muka',true)),
            'periode_uang_muka'=>$this->input->post('periode_Um',true),
            'id_type_bayar'=>$this->input->post('txt_type_pembayaran',true),
            'bayar_periode'=>$this->input->post('periode_bayar',true),
            'pembayaran'=>str_replace('.','',$this->input->post('total_bayar_periode',true)),
            'status_transaksi'=>'sementara',
            'kunci'=>'default',
            'tempo_tanda_jadi'=>$this->input->post('tgl_tanda_jadi',true),
            'tempo_uang_muka'=>$this->input->post('tgl_uang_muka',true),
            'tempo_bayar'=>$this->input->post('tgl_pembayaran',true),
            'total_tambahan'=>str_replace('.','',$this->input->post('txt_total_tambahan',true)),
            'id_user'=>$this->session->userdata('id_user'),
            "tgl_transaksi"=>date("Y-m-d")
        ];
    }
    private function reArray($data) {
        $uploads = array();
        foreach($data as $key0=>$value0) {
            foreach($value0 as $key=>$value) {
                    $uploads[$key][$key0] = $value;
            }
        }
        // $files = $uploads;
        return $uploads; // prevent misuse issue
    }
}

/* End of file Controllername.php */
