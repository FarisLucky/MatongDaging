<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Properti extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_properti');
        
    }
    

    public function index()
    {
        $active = 'Master Perumahan';
        $data['title'] = 'Properti';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['js'] = $this->rolemenu->getJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
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
            if ($value->status != 'publish') {
                $this->status = '<a href="'.base_url().'properti/detailproperti/'.$value->id_user.'" class="btn btn-sm btn-primary mr-1" id="detail_data_user">Ubah</a><button type="button" class="btn btn-sm btn-danger mr-1" id="hapus_data_properti" data-id="'.$value->id_user.'">Hapus</button><button type="button" class="btn btn-sm btn-warning" id="nonaktif_data_user" data-id="'.$value->id_user.'">Publish</button>';
            }else{
                $this->status = '<a href="'.base_url().'properti/detailproperti/'.$value->id_user.'" class="btn btn-sm btn-primary mr-1" id="detail_data_user">Detail</a>';
            }
            $sub = array();
            $sub[] = strval($no);
            $sub[] = $value->nama_properti;
            $sub[] = $value->luas_tanah;
            $sub[] = $value->rekening;
            $sub[] = ' <img id="foto_properti" width="70px" src="'.base_url().'assets/uploads/images/properti/'.$value->foto_properti.'" class="" alt="">';
            $sub[] = $value->alamat;
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
        $active = 'Master Perumahan';
        $data['title'] = 'Detail';
        $data['menus'] = $this->rolemenu->getMenus($active);
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
            "error",
            'msg' => [],
        ];
        $this->validate(); //fungsi validate ada dibawah
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $config['upload_path'] = './assets/uploads/images/properti/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            $img = $this->reArrayFoto($_FILES['img']);
            if (isset($_FILES['img'])) {
                foreach ($img as $key => $value) {
                    $_FILES[$key] = $value;
                    if ($this->upload->do_upload($key)){
                        $link = $this->Model_properti->getImage($this->input->post('txt_id',true));
                        if ($key == "logo") {
                            $coba = $this->unlinkImg($link->logo_properti);
                            $upload = $this->upload->data();
                            $logo = $upload['file_name'];
                        }
                        else if($key == "foto"){
                            $coba = $this->unlinkImg($link->foto_properti);
                            $upload = $this->upload->data();
                            $foto = $upload['file_name'];
                        }else{
                            $no_data ="Foto Tidak Tersedia";
                        }
                    }
                    else{
                        if ($key == "logo") {
                            $logo = "";
                        }
                        else if($key == "foto"){
                            $foto = "";
                        }else{
                            $logo = "";
                            $foto = "";
                        }
                    }
                }
                $input = $this->input($logo,$foto);
                $db = $this->Model_properti->updateDataProperti($input);
                if ($db) {
                    $data['success'] = true;
                    $data['gambar'] = "Berhasil diubah";
                }else{
                    $data['success'] = false;
                    $data['error'] = "Gagal Menambahkan";
                    $data['gambar'] = "gagal Diubah";
                }
            }
            else{
                $input = $this->input();
                $db = $this->Model_properti->updateDataProperti($input);
                if ($db) {
                    $data['success'] = true;
                    $data['gambar'] = "Tidak diubah input data berhasil";
                }else{
                    $data['success'] = false;
                    $data['error'] = "Gagal Menambahkan";
                    $data['gambar'] = "Tidak Diubah input data gagal";
                }
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    public function tambah()
    {
        $active = 'Master Perumahan';
        $data['title'] = 'Tambah';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['js'] = $this->rolemenu->getJavascript(5); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->page('properti/view_tambah_properti',$data);
    }

    private function validate()
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_nama','Nama','trim|required');
        $this->form_validation->set_rules('txt_jumlah','Jumlah','trim|required|numeric');
        $this->form_validation->set_rules('txt_luas','Luas Tanah','trim|required');
        $this->form_validation->set_rules('txt_rekening','Rekening','trim|required');
        $this->form_validation->set_rules('txt_status','Status','trim|required');
        $this->form_validation->set_rules('txt_alamat','Alamat','trim|required');
        $this->form_validation->set_rules('txt_spr','SPR','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
    }
    private function input($logo = null,$foto=null)
    {
        $data = [
            'id'=>$this->input->post('txt_id',true),
            'nama'=>$this->input->post('txt_nama',true),
            'alamat'=>$this->input->post('txt_alamat',true),
            'luas'=>$this->input->post('txt_luas',true),
            'jumlah'=>$this->input->post('txt_jumlah',true),
            'rekening'=>$this->input->post('txt_rekening',true),
            'status'=>$this->input->post('txt_status',true),
            'spr'=>$this->input->post('txt_spr',true),
            'logo'=>$logo,
            'foto'=>$foto
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
        $path = "./assets/uploads/images/profil/user/".$link;
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
}

/* End of file Properti.php */
