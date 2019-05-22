<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_properti extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_unit_properti',"Munit");
        checkSession();
    }
    
    public function index()
    {
        $data['menus'] = $this->rolemenu->getMenus();
        $data['title'] = 'Unit Properti';
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
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
        $search = ['nama_unit','type','luas_tanah','luas_bangunan','harga_unit','status_unit'];
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
            $sub[] = "Rp. ".number_format($value->harga_unit,2,',','.');
            $sub[] = '<small class="badge '.$badge.'">'.$value->status_unit.'</small>';
            $sub[] = '<img id="foto_properti" width="250px" src="'.base_url().'assets/uploads/images/unit_properti/'.$value->foto_unit.'" class="img-thumbnail" alt="">';
            $sub[] = $value->alamat_unit;
            $sub[] = $value->luas_tanah;
            $sub[] = $value->luas_bangunan;
            $sub[] = $value->deskripsi;
            $sub[] = '<a href="'.base_url().'unit_properti/detail_unit/'.$value->id_unit.'" class="btn btn-sm btn-primary mr-1" id="detail_data_unit">Detail</a><button type="button" class="btn btn-sm btn-danger mr-1" id="hapus_data_unit" data-id="'.$value->id_unit.'">Hapus</button>';
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

    public function tambah() //Menampilkan Form Tambah
    {
        $data['title'] = 'Tambah Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $this->pages("unit_properti/view_tambah_unit",$data); 
    }
    public function detail_unit($id) //Menampilkan Form Tambah
    {
        $data['title'] = 'Detail Unit';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $data['unit'] = $this->Munit->getUnitWithId($id);
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
                $data['success'] = false;
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
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
                $config['upload_path'] = './assets/uploads/images/unit_properti';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name'] = true;
                $config['max_size']  = '2048';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $this->load->library('upload', $config);
                if ($_FILES['foto']['name'] != "") {
                    if ($this->upload->do_upload('foto')){
                        $img = $this->upload->data();
                        $input = $this->input( $img['file_name']);
                        $this->Munit->insertUnit($input);
                        $data['success'] = true;
                        $data['title'] = "Berhasil";
                        $data['text'] = "Unit Properti berhasil ditambah";
                        $data['type'] = "success";
                    }
                    else {
                        $data['error'] = $this->upload->display_errors();
                        $data['success'] = false;
                    }
                }
                else{
                    $input = $this->input("");
                    $act = $this->Munit->insertUnit($input);
                    if ($act) {
                        $data['success'] = true;
                        $data['title'] = "Berhasil ";
                        $data['text'] = "Unit Properti berhasil ditambah";
                        $data['type'] = "success";
                    }
                    else{
                        $data['success'] = false;
                        $data['title'] = "Gagal";
                        $data['text'] = "Gagal Menambahkan";
                        $data['type'] = "error";
                    }
                }
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
            $config['upload_path'] = './assets/uploads/images/unit_properti';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $data['id'] = $this->input("");
            $this->load->library('upload', $config);
            if ($_FILES['foto']['name'] != "") {
                if ($this->upload->do_upload('foto')){
                    $link = $this->Munit->getImage($this->input->post('txt_id'));
                    $path = "./assets/uploads/images/unit_properti/".$link->foto_unit;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    else{
                        $data['error'] = "tidak ditemukan";
                    }
                    $img = $this->upload->data();
                    $input = $this->input($img['file_name'],$this->input->post('txt_id')); 
                    $this->Munit->updateUnit($input);
                    $data['success'] = true;
                }
                else {
                    $data['error'] = $this->upload->display_errors();
                    $data['success'] = false;
                }
            }
            else{
                $input = $this->input("",$this->input->post('txt_id')); 
                $act = $this->Munit->updateUnit($input);
                if ($act) {
                    $data['success'] = true;
                    $data['act'] = $act;
                }
                else{
                    $data['success'] = false;
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
        $input = $this->input->post('id_unit');
        $query = $this->Munit->hapusData($input);
        if ($query) {
            $link = $this->Munit->getImage($input);
            if ($link ['foto_unit'] != "") 
            {
                $rows = $link['foto_unit'];
            }else{
                $rows ="as";
            }
            $path = "./assets/uploads/images/unit_properti/".$rows;
            if (file_exists($path)) {
                unlink($path);
            }
        }else{
            $data['success'] = false;
        }
        $this->output->set_output(json_encode($data));
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
    private function input($img)
    {
        return [
            'id'=>$this->input->post('txt_id',true),
            'nama'=>$this->input->post('txt_nama',true),
            'type'=>$this->input->post('txt_type',true),
            'tanah'=>$this->input->post('txt_tanah',true),
            'bangunan'=>$this->input->post('txt_bangunan',true),
            'harga'=>$this->input->post('txt_harga',true),
            'alamat'=>$this->input->post('txt_alamat',true),
            'deskripsi'=>$this->input->post('txt_desc',true),
            'img' => $img
        ];
    }
}

/* End of file Unit_properti.php */
