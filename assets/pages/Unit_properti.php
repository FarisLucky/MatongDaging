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
        $active = 'Unit Properti';
        $data['title'] = 'Unit Properti';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
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
        $column_where = "id_properti";
        $value_where = "1";
        $search = ['nama_unit','type','luas_tanah','luas_bangunan','harga_unit','status_unit'];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where,$value_where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $value->nama_unit;
            $sub[] = $value->type;
            $sub[] = $value->luas_tanah;
            $sub[] = $value->luas_bangunan;
            $sub[] = $value->harga_unit;
            $sub[] = $value->foto_unit;
            $sub[] = $value->status_unit;
            $sub[] = $value->alamat_unit;
            $sub[] = $value->deskripsi;
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where,$value_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }

    public function tambah() //Menampilkan Form Tambah
    {
        $active = 'Unit Properti';
        $data['title'] = 'Tambah Unit';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $data['blok'] = $this->Munit->getBlok(1); //Jangan DIUbah !!
        $this->pages("unit_properti/view_tambah_unit",$data); 
    }

    public function core_tambah_unit() //Unit Core Tambah
    {
        $data = [
            "success" => false,
            "title" =>'Unit berhasil Ditambah',
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

    // Blok FUnction
    public function core_tambah() //Insert Form Tambah BLOK
    {
        $data = [
            "success" => false,
            "msg"=>[]
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_blok','Blok','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['success'] = false;
                $data['msg'][$key] = form_error($key);
            }
        }else{
            $input = [
                "id_blok"=>$this->input->post('txt_id'),
                "nama"=>$this->input->post('txt_blok'),
                "id_properti"=>1
            ];
            $query = $this->Munit->insertBlok($input);
            if ($query) {
                $data['success'] = true;
                $data['title'] = "Berhasil";
                $data['text'] = "Blok Berhasil ditambah";
                $data['type'] = "success";
            }else{
                $data['success'] = false;
                $data['title'] = "Error";
                $data['text'] = "Blok Gagal ditambah";
                $data['type'] = "error";
            }
            
        }
        $this->output->set_output(json_encode($data));
    }
    public function core_ubah() //Insert Form Tambah BLOK
    {
        $data = [
            "success" => false,
            "msg"=>[]
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_blok','Blok','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['success'] = false;
                $data['msg'][$key] = form_error($key);
            }
        }else{
            $input = [
                "id_blok"=>$this->input->post('txt_id'),
                "nama"=>$this->input->post('txt_blok')
            ];
            $query = $this->Munit->updateBlok($input);
            if ($query) {
                $data['success'] = true;
                $data['title'] = "Berhasil";
                $data['text'] = "Blok Berhasil ditambah";
                $data['type'] = "success";
            }else{
                $data['success'] = false;
                $data['title'] = "Error";
                $data['text'] = "Blok Gagal ditambah";
                $data['type'] = "error";
            }
        }
        $this->output->set_output(json_encode($data));
    }
    public function hapus() //Insert Form Tambah BLOK
    {
        $data = [
            "success" => false
        ];
        $input = [
            "id_blok"=>$this->input->post('txt_id')
        ];
        $query = $this->Munit->deleteBlok($input);
        if ($query) {
            $data['success'] = true;
            $data['title'] = "Berhasil";
            $data['text'] = "Blok Berhasil ditambah";
            $data['type'] = "success";
        }else{
            $data['success'] = false;
            $data['title'] = "Error";
            $data['text'] = "Blok Gagal ditambah";
            $data['type'] = "error";
        }
        $this->output->set_output(json_encode($data));
    }
    public function blok() //BLOK
    {
        $active = 'Unit Properti';
        $data['title'] = 'Blok Unit';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(6); //Jangan DIUbah !!
        $data['img'] = getCompanyLogo();
        $data['blok'] = $this->Munit->getBlok(1); //Jangan DIUbah !!
        $this->pages("unit_properti/view_blok",$data); 
    }
    public function setData()
    {
        $input = $this->input->post('data_id');
        $row = $this->Munit->getBlokWithId($input,1);
        if ($row) {
            $data['success'] = true;
            $data['id_blok'] = $row->id_blok;
            $data['nama_blok'] = $row->nama_blok;
        }
        else{
            $data['success'] = false;
        }
        return $this->output->set_output(json_encode($row));
        
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
