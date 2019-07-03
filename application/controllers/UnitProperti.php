<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitProperti extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_unit_properti',"Munit");
    }
    
    public function index()
    {
        $data['menus'] = $this->rolemenu->getMenus();
        $data['title'] = 'Unit Properti';
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["site_plan"] = $this->Munit->getData("foto_properti","properti",["id_properti"=>$_SESSION["id_properti"]])->row_array();
        $data["list_unit"] = $this->Munit->getData("nama_unit,status_unit","unit_properti",["id_properti"=>$_SESSION["id_properti"]])->result();
        $this->pages("unit_properti/view_unit",$data);
    }

    public function dataUnit() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "unit_properti";
        $order = "nama_unit";
        $id_properti = $this->session->userdata('id_properti');
        $column_where = ["id_properti"=>$id_properti];
        $search = ['nama_unit',"type","harga_unit"];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            if ($value->status_unit == "sudah terjual") {
                $badge = "badge-success";
            }else{
                $badge = "badge-primary";
            }
            $sub = array();
            $sub[] = $value->nama_unit;
            $sub[] = $value->type;
            $sub[] = $value->luas_tanah;
            $sub[] = $value->luas_bangunan;
            $sub[] = "Rp. ".number_format($value->harga_unit,2,',','.');
            $sub[] = '<small class="badge '.$badge.'">'.$value->status_unit.'</small>';
            $sub[] = '<img id="foto_properti" width="250px" src="'.base_url().'assets/uploads/images/unit_properti/'.$value->foto_unit.'" class="img-thumbnail" alt="">';
            $sub[] = '<a href="'.base_url().'unitproperti/detail_unit/'.$value->id_unit.'" class="btn btn-sm btn-primary mr-1" id="detail_data_unit">Detail</a><button type="button" class="btn btn-sm btn-danger mr-1" id="hapus_data_unit" data-id="'.$value->id_unit.'">Hapus</button>';
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order,$column_where)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }

    public function tambah() //Menampilkan Form Tambah
    {
        $data['title'] = 'Tambah Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $this->pages("unit_properti/view_tambah_unit",$data); 
    }
    public function multiTambah() //Menampilkan Form Tambah
    {
        $data['title'] = 'Tambah Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $this->pages("unit_properti/view_tambah_multiunit",$data); 
    }
    public function detail_unit($id) //Menampilkan Form Tambah
    {
        $data['title'] = 'Detail Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $data['unit'] = $this->Munit->getData("*","tbl_unit_properti",["id_unit"=>$id])->row();
        $this->pages("unit_properti/view_detail_unit",$data); 
    }

    public function core_tambah_unit() //Unit Core Tambah
    {
        $data = [
            "success" => false,
            'msg' => [],
        ];
        $this->validate();
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $inputData = $this->inputData();
            $id_properti = $this->session->userdata('id_properti');
            $jml_unit = $this->Munit->getJumlahUnit($id_properti); 
            $jml_properti = $this->Munit->getJumlahProperti($id_properti);
            $rows_unit = $jml_unit->jumlah;
            $rows_properti = $jml_properti->jumlah;
            if ($rows_unit >= $rows_properti)
            {
                $data['success'] = false;
                $data['error'] = "mencapai maksimum";
                $data['title'] = "Gagal";
                $data['text'] = "Unit Properti sudah mencapai batas yang ditentukan";
                $data['type'] = "error";
            }else{
                $config = $this->imageInit('./assets/uploads/images/unit_properti/');
                $this->load->library('upload', $config);
                if ($_FILES['foto']['name'] != "") {
                    if ($this->upload->do_upload('foto')){
                        $img = $this->upload->data();
                        $inputData += ["foto_unit"=>$img['file_name']];
                        $query = $this->Munit->insertData($inputData,"unit_properti");
                        if ($query) {
                            $data['success'] = true;
                            $data['title'] = "Berhasil";
                            $data['text'] = "Unit Properti berhasil ditambah";
                            $data['type'] = "success";
                        }
                    }
                    else {
                        $data['error'] = $this->upload->display_errors();
                        $data['title'] = "Gagal";
                        $data['text'] = "Unit Properti berhasil ditambah";
                        $data['type'] = "error";
                    }
                }
                else{
                    $inputData += ["foto_unit"=>"default.jpg"];
                    $act = $this->Munit->insertData($inputData,"unit_properti");
                    if ($act) {
                        $data['success'] = true;
                        $data['title'] = "Berhasil ";
                        $data['text'] = "Unit Properti berhasil ditambah";
                        $data['type'] = "success";
                    }
                    else{
                        $data['title'] = "Gagal";
                        $data['text'] = "Gagal Menambahkan";
                        $data['type'] = "error";
                    }
                }
            }
        }
        return $this->output->set_output(json_encode($data));
    }
    public function coreMultiTambah() //Unit Core Tambah
    {
        $data = [
            "success" => false,
            'msg' => [],
        ];
        $this->validate();
        $this->form_validation->set_rules('txt_blok_awal','Blok Awal','trim|required|numeric|max_length[11]');
        $this->form_validation->set_rules('txt_jumlah_blok','Blok Akhir','trim|required|numeric|max_length[11]');
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $awal = (int) $this->input->post("txt_blok_awal",true);
            $jumlah = (int) $this->input->post("txt_jumlah_blok",true);
            $id_properti = $this->session->userdata("id_properti");
            $query = $this->Munit->getData("jumlah_unit","tbl_properti",["id_properti"=>$id_properti])->row();
            $query_unit = $this->Munit->getData("COUNT(id_unit) as jumlah_unit","tbl_unit_properti",["id_properti"=>$id_properti])->row();
            if ($jumlah > 0) {
                if ($query_unit->jumlah_unit < $query->jumlah_unit) {
                    $sisa = ($query->jumlah_unit - $query_unit->jumlah_unit);
                    if ($jumlah > $sisa) {
                        $data["error"] = "Jumlah Terlalu Banyak";
                    }else{
                        $nama = $this->input->post("txt_nama",true);
                        $input = [
                            "nama_unit"=> $this->input->post("txt_nama",true),
                            "id_properti"=> $id_properti,
                            'type'=>$this->input->post('txt_type',true),
                            'luas_tanah'=>$this->input->post('txt_tanah',true),
                            'luas_bangunan'=>$this->input->post('txt_bangunan',true),
                            'harga_unit'=>$this->input->post('txt_harga',true),
                            'alamat_unit'=>$this->input->post('txt_alamat',true),
                            'tgl_insert'=>date("Y-m-d"),
                            'status_unit'=>"belum terjual",
                            'deskripsi'=>$this->input->post('txt_desc',true),
                            'foto_unit' => "default.jpg",
                            'id_user' => $this->session->userdata("id_user")
                        ];
                        $total = $awal + $jumlah;
                        for($i = $awal ; $i < $total ; $i++) {
                            $input["nama_unit"] = $nama.$i;
                            $this->Munit->insertData($input,"unit_properti");
                        }
                        $data["success"] = true;
                        $data["url"] = base_url("unitproperti");
                    }
                }else{
                    $data["error"] = "Unit Sudah FUll";
                }
            }else{
                $data["error"] = "Jumlah harus lebih dari 0";
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    public function core_detail_unit() //Unit Core Tambah
    {
        $data = [
            "success" => false,
            "title" =>'Unit berhasil DiUbah',
            'msg' => [],
        ];
        $this->validate();
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $id = $this->input->post("txt_id",true);
            $inputData = $this->inputData();
            $config = $this->imageInit("./assets/uploads/images/unit_properti/");
            $this->load->library('upload', $config);
            if ($_FILES['foto']['name'] != "") {
                if ($this->upload->do_upload('foto')){
                    $link = $this->Munit->getData("foto_unit","unit_properti",["id_unit"=>$id])->row();
                    $path = base_url("assets/uploads/images/unit_properti/".$link->foto_unit);
                    if (file_exists($path)) {
                        if ($link != "default.jpg") {
                            unlink($path);
                        }
                    }
                    $img = $this->upload->data();
                    $inputData += ["foto_unit"=>$img["file_name"]];
                    $query = $this->Munit->updateData($inputData,"unit_properti",["id_unit"=>$id]);
                    if ($query) {
                        $data['success'] = true;
                    }
                }
                else {
                    $data['error'] = $this->upload->display_errors();
                }
            }
            else{ 
                $act = $this->Munit->updateData($inputData,"unit_properti",["id_unit"=>$id]);
                if ($act) {
                    $data['success'] = true;
                    $data['act'] = $act;
                }
            }
        }
        return $this->output->set_output(json_encode($data));
    }

    public function core_hapus()
    {
        $data = [
            "success" => false,
        ];
        $input = $this->input->post('id_unit',true);
        $image = $this->Munit->getData("foto_unit","unit_properti",["id_unit"=>$input])->row_array();
        if ($image["foto_unit"] != null) {
            if ($image['foto_unit'] != "default.jpg") 
            {
                $path = "./assets/uploads/images/unit_properti/".$image["foto_unit"];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
        $query = $this->Munit->deleteData("unit_properti",["id_unit"=>$input]);
        if ($query) {
            $data["success"] = true;
        }else{
            $data["error"] = true;
        }
        $this->output->set_output(json_encode($data));
    }
    public function getJumlahData()
    {
        $data = ["success"=>false,"jumlah"=>"bf"]; // f1 ="Unit Sudah Full" AND f2 = "Jumlah Unit Yang mau dibuat kebanyakan" AND bf = "BELUM FULL";
        $jumlah = (int) $this->input->post("jumlah",true);
        $id = $this->session->userdata("id_properti");
        if ($jumlah != null) {
            $query = $this->Munit->getData("jumlah_unit","tbl_properti",["id_properti"=>$id])->row();
            $query_unit = $this->Munit->getData("COUNT(id_unit) as jumlah_unit","tbl_unit_properti",["id_properti"=>$id])->row();
            if ($query_unit->jumlah_unit < $query->jumlah_unit) {
                $sisa = ($query->jumlah_unit - $query_unit->jumlah_unit);
                if ($jumlah > $sisa) {
                    $data["success"] = true;
                    $data["jumlah"] = "f2";
                }
            }else{
                $data["success"] = true;
                $data["jumlah"] = "f1";
            }
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
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
        $this->form_validation->set_rules('txt_nama','Nama Unit','trim|required');
        $this->form_validation->set_rules('txt_type','Type','trim|required');
        $this->form_validation->set_rules('txt_tanah','Luas Tanah','trim|required');
        $this->form_validation->set_rules('txt_bangunan','Luas Bangunan','trim|required');
        $this->form_validation->set_rules('txt_harga','Harga','trim|required|numeric');
        $this->form_validation->set_rules('txt_alamat','Alamat','trim|required');
        $this->form_validation->set_rules('txt_desc','Deskripsi','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
    }
    private function inputData()
    {
        $input = [
            "nama_unit"=> $this->input->post("txt_nama",true),
            "id_properti"=> $this->session->userdata("id_properti"),
            'type'=>$this->input->post('txt_type',true),
            'luas_tanah'=>$this->input->post('txt_tanah',true),
            'luas_bangunan'=>$this->input->post('txt_bangunan',true),
            'harga_unit'=>$this->input->post('txt_harga',true),
            'alamat_unit'=>$this->input->post('txt_alamat',true),
            'tgl_insert'=>date("Y-m-d"),
            'status_unit'=>"belum terjual",
            'deskripsi'=>$this->input->post('txt_desc',true),
            'id_user' => $this->session->userdata("id_user")
        ];
        return $input;
    }
    private function imageInit($path)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        return $config;
    }
}

/* End of file Unit_properti.php */
