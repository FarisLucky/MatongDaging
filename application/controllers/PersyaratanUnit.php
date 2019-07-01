<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PersyaratanUnit extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library("form_validation");
        $this->load->model('Model_crud','Mpersyaratan');
    }
    public function index()
    {
        $data['title'] = 'Persyaratan Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(28); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["persyaratan"] = $this->Mpersyaratan->getData("*","persyaratan_sasaran",["id_kategori_persyaratan"=>2])->result();
        $this->pages("persyaratan/view_syarat_unit",$data);
    }
    public function tambah() {
        $data['title'] = 'Persyaratan Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(28); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $this->pages("persyaratan/tambah_syarat_unit",$data);
    }

    public function coreTambah()
    {
        $config = $this->validate();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $input = [
                "nama_persyaratan"=>$this->input->post("nama",true),
                "poin_penting"=>$this->input->post("poin",true),
                "keterangan"=>$this->input->post("ket",true),
                "id_kategori_persyaratan"=>2
            ];
            $query = $this->Mpersyaratan->insertData($input,"persyaratan_sasaran");
            if ($query) {
                $this->session->set_flashdata('berhasil', ' <i class="fa fa-check"></i> Berhasil ditambahkan');
                redirect('persyaratanunit');
            }
        }
        
    }
    public function ubah($id) {
        $data['title'] = 'Ubah Persyaratan';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(28); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data["persyaratan"] = $this->Mpersyaratan->getData("*","persyaratan_sasaran",["id_sasaran"=>$id])->row();
        $this->pages("persyaratan/edit_syarat_unit",$data);
    }

    public function coreUbah()
    {
        $id = $this->input->post("input_hidden",true);
        $config = $this->validate();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->ubah($id);
        } else {
            $input = [
                "nama_persyaratan"=>$this->input->post("nama",true),
                "poin_penting"=>$this->input->post("poin",true),
                "keterangan"=>$this->input->post("ket",true)
            ];
            $query = $this->Mpersyaratan->updateData($input,"persyaratan_sasaran",["id_sasaran"=>$id]);
            if ($query) {
                $this->session->set_flashdata('berhasil', '<i class="fa fa-refresh"></i> Berhasil diUpdate');
                redirect('persyaratanunit');
            }
        }
        
    }
    public function hapus()
    {
        $data = ["success"=>false];
        $id = $this->input->get("params",true);
        if (!empty($id)) {
            $query = $this->Mpersyaratan->deleteData("persyaratan_sasaran",["id_sasaran"=>$id]);
            if ($query) {
                $data["success"] = true;
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
        $config = array (
            array(
                'field' => 'nama',
                'label' => 'Nama Persyaratan',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'poin',
                'label' => 'Poin Penting',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'ket',
                'label' => 'Keterangan',
                'rules' => 'trim|required'
            )
        );
        return $config;
    }
}

/* End of file Laporan_Keuangan.php */
