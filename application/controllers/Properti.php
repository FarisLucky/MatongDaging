<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Properti extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_properti');
    }
    
    public function index()
    {
        $data['title'] = 'Properti';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(5); //Jangan DiUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->page('properti/view_properti',$data);
    }

    public function dataProperti() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*"; //column you want to get
        $tbl = "tbl_properti"; //tbl you want
        $order = "nama_properti"; //colmun you to ordering
        $search = ['nama_properti','status']; //search data
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            $properti = $this->Model_properti->getDataWhere('*','rab_properti',['id_properti'=>$value->id_properti,'type'=>'Properti']);
            $unit = $this->Model_properti->getDataWhere('*','rab_properti',['id_properti'=>$value->id_properti,'type'=>'unit']);
            if ($value->status != 'publish') {
                $this->status = '<a href="'.base_url().'properti/detailproperti/'.$value->id_properti.'" class="btn btn-sm btn-primary mr-1" id="detail_data_properti">Detail</a><button type="button" class="btn btn-sm btn-danger mr-1" id="hapus_data_properti" data-id="'.$value->id_properti.'">Hapus</button><button type="button" class="btn btn-sm btn-warning" id="publish_data_properti" data-id="'.$value->id_properti.'">Publish</button>';
            }else{
                $this->status = '<a href="'.base_url().'properti/detailproperti/'.$value->id_properti.'" class="btn btn-sm btn-primary mr-1" id="detail_data_properti">Detail</a>';
                if ($properti->num_rows() < 1) {
                    $this->status .= '<button type="button" data-id="'.$value->id_properti.'" class="btn btn-sm btn-info mr-1" id="tambah_rab_properti">Tambah RAB Properti</button>';
                }else{
                    $this->status .= '<a href="'.base_url()."rab/properti/".$value->id_properti.'" class="btn btn-sm btn-info mr-1" id="rab_data_properti">RAB Properti</a>';
                }
                if($unit->num_rows() < 1){
                    $this->status .= '<button type="button" data-id="'.$value->id_properti.'" class="btn btn-sm btn-success mr-1" id="tambah_rab_unit">Tambah RAB Unit</button>';
                }
                else{
                    $this->status .= ' <a href="'.base_url()."rab/unit/".$value->id_properti.'" class="btn btn-sm btn-success mr-1" id="rab_data_unit">RAB Unit</button>';
                }
            }
            $sub = array();
            $sub[] = strval($no);
            $sub[] = $value->nama_properti;
            $sub[] = $value->luas_tanah;
            $sub[] = $value->rekening;
            $sub[] = '<img id="foto_properti" width="70px" src="'.base_url().'assets/uploads/images/properti/'.$value->foto_properti.'" class="" alt="">';
            $sub[] = $this->status;
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    public function detailProperti($id)
    {
        $data['menus'] = $this->rolemenu->getMenus();
        $data['title'] = 'Detail';
        $data['js'] = $this->rolemenu->getJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
        $data['properti'] = $this->Model_properti->getDataProperti($id); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->page('properti/view_detail_properti',$data);
    }
    public function update() //Core Tambah
    {
        $data = [
            "success" => false,
            "title" =>'Update Properti',
            'msg' => [],
        ];
        $this->validate(); //fungsi validate ada dibawah
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $id = $this->input->post('txt_id',true);
            $config = $this->uploadImg();
            $input = $this->input();
            $this->load->library('upload', $config);
            $img = $this->reArrayFoto($_FILES['img']);
            if ((!empty($img["foto"]["name"])) || (!empty($img["logo"]["name"]))) {
                foreach ($img as $key => $value) {
                    $_FILES[$key] = $value;
                    if ($this->upload->do_upload($key)){
                        $link = $this->Model_properti->getDataWhere("logo_properti,foto_properti","tbl_properti",["id_properti"=>$id])->row();
                        if ($key == "logo") {
                            if ($link->logo_properti != "default2.jpg") {
                                $coba = $this->unlinkImg($link->logo_properti);
                            }
                            $upload = $this->upload->data();
                            $logo = $upload['file_name'];
                            $input += ["logo_properti"=>$logo];
                        }
                        else if($key == "foto"){
                            if ($link->foto_properti != "default.jpg") {
                                $coba = $this->unlinkImg($link->foto_properti);
                            }
                            $upload = $this->upload->data();
                            $foto = $upload['file_name'];
                            $input += ["foto_properti"=>$foto];
                        }
                        $db = $this->Model_properti->updateData($input,"properti",["id_properti"=>$id]);
                        if ($db) {
                            $data["success"] = true;
                        }
                    }
                    else{
                        $data["error"] = $this->upload->display_errors();
                    }
                }
            }
            else{
                $db = $this->Model_properti->updateData($input,"properti",["id_properti"=>$id]);
                if ($db) {
                    $data['success'] = true;
                }
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    public function tambah()
    {
        $data['menus'] = $this->rolemenu->getMenus();
        $data['title'] = 'Tambah';
        $data['js'] = $this->rolemenu->getJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->page('properti/view_tambah_properti',$data);
    }
    public function core_tambah() //Core Tambah
    {
        $data = [
            "success" => false,
            "title" =>'Tambah Properti',
            'msg' => [],
        ];
        $this->validate(); //fungsi validate ada dibawah
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $id = $this->input->post('txt_id',true);
            $config = $this->uploadImg();
            $input = $this->input();
            $input += ["id_user"=>$this->session->userdata("id_user")];
            $this->load->library('upload', $config);
            $img = $this->reArrayFoto($_FILES['foto']);
            if ((!empty($img["foto"]["name"])) || (!empty($img["logo"]["name"]))) {
                foreach ($img as $key => $value) {
                    $_FILES[$key] = $value;
                    if ($this->upload->do_upload($key)){
                        if ($key == "logo") {
                            $upload = $this->upload->data();
                            $logo = $upload["file_name"];
                            $input += ["logo_properti"=>$logo];
                        }
                        else if($key == "foto"){
                            $upload = $this->upload->data();
                            $foto = $upload["file_name"];
                            $input += ["foto_properti"=>$foto];
                        }
                        $db = $this->Model_properti->insertData($input,"properti");
                        if ($db) {
                            $data['success'] = true;
                        }
                    }else{
                        $data["error"] = $this->upload->display_errors();
                    }
                }
            }else{
                $input += ["logo_properti"=>"default2.jpg","foto_properti"=>"default.jpg"];
                $db = $this->Model_properti->insertData($input,"properti");
                if ($db) {
                    $data['success'] = true;
                }
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    public function hapus()
    {
        $data = [
            "success" => false,
        ];
        $input = $this->input->post('id_properti');
        $link = $this->Model_properti->getImage($input);
        $logo = $link->logo_properti;
        $foto = $link->foto_properti;
        $query = $this->Model_properti->hapusData($input);
        if ($query) {
            unlink("./assets/uploads/images/properti/".$logo);
            unlink("./assets/uploads/images/properti/".$foto);
            $data['success'] = true;
        }else{
            $data['success'] = false;
        }
        $this->output->set_output(json_encode($data));
    }

    public function publish()
    {
        $data = [
            "success" => false,
        ];
        $input = $this->input->post('id_properti');
        $query = $this->Model_properti->publishData($input);
        if ($query) {
            $data['success'] = true;
        }else{
            $data['success'] = false;
        }
        $this->output->set_output(json_encode($data));
    }
    public function rab()
    {
        $data = ['success' =>false];
        date_default_timezone_set('Asia/Jakarta');
        $properti = $this->input->post('id_properti');
        $unit = $this->input->post('id_unit');
        if (!empty($properti)) {
            $input = [
                'nama_rab'=>$this->input->post('nama'),
                'type'=>'properti',
                'tgl_buat'=>date("Y-m-d"),
                'total_anggaran'=>0,
                'id_user'=>$this->session->userdata('id_user'),
                'id_properti'=>$properti
            ];
            $query = $this->Model_properti->naturalInsert("rab_properti",$input);
            if ($query) {
                $data['success'] = true;
                $data['redirect'] = base_url()."rab/properti/".$properti;
            }
        }
        if (!empty($unit)) {
            $input = [
                'nama_rab'=>$this->input->post('nama'),
                'type'=>'unit',
                'tgl_buat'=>date("Y-m-d"),
                'total_anggaran'=>0,
                'id_user'=>$this->session->userdata('id_user'),
                'id_properti'=>$unit
            ];
            $query = $this->Model_properti->naturalInsert("rab_properti",$input);
            if ($query) {
                $data['success'] = true;
                $data['redirect'] = base_url()."rab/unit/".$unit;
            }
        }
        return $this->output->set_output(json_encode($data));
    }
    // function function tambahan
    private function validate()
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_nama','Nama','trim|required');
        $this->form_validation->set_rules('txt_jumlah','Jumlah','trim|required|numeric');
        $this->form_validation->set_rules('txt_luas','Luas Tanah','trim|required');
        $this->form_validation->set_rules('txt_rekening','Rekening','trim|required');
        $this->form_validation->set_rules('txt_status','Status','trim|required');
        $this->form_validation->set_rules('txt_alamat','Alamat','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
    }
    private function input()
    {
        $data = [
            'nama_properti'=>$this->input->post('txt_nama',true),
            'alamat'=>$this->input->post('txt_alamat',true),
            'luas_tanah'=>$this->input->post('txt_luas',true),
            'jumlah_unit'=>$this->input->post('txt_jumlah',true),
            'rekening'=>$this->input->post('txt_rekening',true),
            'status'=>$this->input->post('txt_status',true),
            'setting_spr'=>$this->input->post('txt_spr'),
            'tgl_buat'=>date('Y-m-d')
        ];
        return $data;
    }
    private function reArrayFoto(&$files) {
        $uploads = array();
        foreach($_FILES as $key0=>$FILES) {
            foreach($FILES as $key=>$value) {
                foreach($value as $key2=>$value2) {
                    $uploads[$key2][$key] = $value2;
                }
            }
        }
        $files = $uploads;
        return $uploads; // prevent misuse issue
    }
    private function unlinkImg($link)
    {
        $path = "./assets/uploads/images/properti/".$link;
        if (file_exists($path)) {
            unlink($path);
        }
    }
    private function page($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
    private function uploadImg(){
        $config['upload_path'] = './assets/uploads/images/properti/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        return $config;
    }
}

/* End of file Properti.php */
