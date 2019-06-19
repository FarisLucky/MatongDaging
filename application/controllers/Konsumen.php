<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_konsumen',"M_konsumen");
        $this->load->library('form_validation');
    }

    public function index()
    {
        redirect('konsumen/calonkonsumen');
    }
    public function calonkonsumen()
    {
        $data['title'] = 'Calon Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(13); //Jangan DIUbah !!
        $data['konsumen'] = $this->M_konsumen->getSelectionData('tbl_konsumen',['status_konsumen'=>'calon konsumen','id_user'=>$this->session->userdata('id_user')])->result();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/view_calon', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function datakonsumen()
    {
        $data['title'] = 'Data Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(14); //Jangan DIUbah !!
        $data['konsumen'] = $this->M_konsumen->getSelectionData('tbl_konsumen',['status_konsumen'=>'konsumen','id_user'=>$this->session->userdata('id_user')])->result();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/view_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }
    public function detailkonsumen($id)
    {
        $data['title'] = 'Detail Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(14); //Jangan DIUbah !!
        $data['konsumen'] = $this->M_konsumen->getSelectionData('konsumen',['id_konsumen' => $id])->result_array();
        $data['persyaratan'] = $this->M_konsumen->getSelectionData("persyaratan_sasaran",["id_kategori_persyaratan"=>1])->result_array();
        $data['check_syarat'] = $this->M_konsumen->getSelectionData('persyaratan_kelompok_sasaran',['id_konsumen' => $id])->result_array();
        $data['id_type'] = $this->M_konsumen->getData("type_id_card")->result_array();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/view_detail', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Konsumen';
        $data['js'] = $this->rolemenu->getJavascript(13); //Jangan DIUbah !!
        $data['menus'] = $this->rolemenu->getMenus();
        $data['konsumen'] = $this->M_konsumen->getSelectionData("konsumen",['id_konsumen'=>$id])->result_array();
        $data['id_type'] = $this->M_konsumen->getData("type_id_card")->result_array();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/v_edit_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function hapus($id)
    {
        $value = ['id_konsumen' => $id];
        $this->M_konsumen->delete("konsumen",$value);
        redirect('konsumen');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(13); //Jangan DIUbah !!
        $data['id_type'] = $this->M_konsumen->getData("type_id_card")->result_array();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/view_tambah_calon', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function tambah_data()
    {
        $this->form_validation->set_rules('val_id_type', "Type Card", "trim|required|numeric");
        $this->form_validation->set_rules('val_id_card', "id card", "trim|required|numeric");
        $this->form_validation->set_rules('val_nama_konsumen', "Nama Konsumen", "trim|required");
        $this->form_validation->set_rules('val_alamat', "Alamat", "trim|required");
        $this->form_validation->set_rules('val_nomor_telepon', "nomor telepon", "trim|required|numeric");
        $this->form_validation->set_rules('val_email', "Email", "trim|required|valid_email");

        if ($this->form_validation->run() == false) {
            $this->tambah();
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $tgl_buat = date('Y-m-d H:i:s'); //2019-05-16 11:26:56
            $config['upload_path'] = './assets/uploads/images/konsumen/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            if ($_FILES['val_foto']['name'] != "") {
                if ($this->upload->do_upload('val_foto')) {
                    $img = $this->upload->data();
                    $post = [
                        'id_type' => $this->input->post('val_id_type'), //val_id_type : name yang ada di view
                        'id_card' => $this->input->post('val_id_card'),
                        'nama_lengkap' => $this->input->post('val_nama_konsumen'),
                        'alamat' => $this->input->post('val_alamat'),
                        'telp' => $this->input->post('val_nomor_telepon'),
                        'email' => $this->input->post('val_email'),
                        'npwp' => $this->input->post('val_npwp'),
                        'status_konsumen' => "calon konsumen",
                        'foto_ktp' => $img['file_name'],
                        'pekerjaan' => $this->input->post('val_pekerjaan'),
                        'alamat_kantor' => $this->input->post('val_alamat_kantor'),
                        'telp_kantor' => $this->input->post('val_telepon_kantor'),
                        'tgl_buat'=>$tgl_buat,
                        'id_user' => $this->session->userdata('id_user')
                    ];
                    $this->M_konsumen->insertDataKonsumen("konsumen",$post);
                    redirect('konsumen/calonkonsumen');
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $data['success'] = false;
                }
            }else{
                $post = [
                    'id_type' => $this->input->post('val_id_type'), //val_id_type : name yang ada di view
                    'id_card' => $this->input->post('val_id_card'),
                    'nama_lengkap' => $this->input->post('val_nama_konsumen'),
                    'alamat' => $this->input->post('val_alamat'),
                    'telp' => $this->input->post('val_nomor_telepon'),
                    'email' => $this->input->post('val_email'),
                    'npwp' => $this->input->post('val_npwp'),
                    'pekerjaan' => $this->input->post('val_pekerjaan'),
                    'alamat_kantor' => $this->input->post('val_alamat_kantor'),
                    'telp_kantor' => $this->input->post('val_telepon_kantor'),
                    'status_konsumen'=>"calon konsumen",
                    'tgl_buat'=>$tgl_buat,
                    'id_user' => $this->session->userdata('id_user')
                ];
                $this->M_konsumen->insertDataKonsumen("konsumen",$post);
                redirect('konsumen/calonkonsumen');
            }
        }
    }
    
    public function corePerbarui()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_buat = date('Y-m-d H:i:s'); //2019-05-16 11:26:56
        $config['upload_path'] = './assets/uploads/images/konsumen/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);
        if ($_FILES['img_foto']['name'] != "") {
            $id = $this->input->post('edit_id_konsumen');
            $query = $this->M_konsumen->getSelectionData("konsumen",["id_konsumen"=>$id])->result_array();
            $path = "./assets/uploads/images/konsumen/".$query[0]['foto_ktp'];
            if (file_exists($path)) {
                unlink($path);
            }
            if ($this->upload->do_upload('img_foto')) {
                $img = $this->upload->data();
                $post = $this->input();
                $post['foto_ktp'] = $img['file_name'];
                $this->M_konsumen->updateDataKonsumen($post, $id);
                redirect('konsumen/calonkonsumen');
            }else {
                $data['error'] = $this->upload->display_errors();
                $data['success'] = false;
            }
        }else{
            $post = $this->input();
            $id = $this->input->post('edit_id_konsumen');
            $this->M_konsumen->updateDataKonsumen($post, $id);
            redirect('konsumen/calonkonsumen');
        }
    }
    public function coreEditKonsumen()
    {        
        $id = $this->input->post('edit_id_konsumen');
        $persyaratan = $this->input->post('persyaratan');
        date_default_timezone_set('Asia/Jakarta');
        $tgl_buat = date('Y-m-d H:i:s'); //2019-05-16 11:26:56
        $config['upload_path'] = './assets/uploads/images/konsumen/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);
        if ($_FILES['foto_konsumen']['name'] != "") {
            $query = $this->M_konsumen->getSelectionData("konsumen",["id_konsumen"=>$id])->result_array();
            $path = "./assets/uploads/images/konsumen/".$query[0]['foto_ktp'];
            if (file_exists($path)) {
                unlink($path);
            }
            if ($this->upload->do_upload('foto_konsumen')) {
                $img = $this->upload->data();
                $post = $this->inputKonsumen();
                $post['foto_ktp'] = $img['file_name'];
                $sql = $this->M_konsumen->updateDataKonsumen($post, $id);
                if (!empty($persyaratan)) {
                    foreach ($persyaratan as $key => $value) {
                        $data = ['id_konsumen'=>$id,"id_sasaran"=>$value,"id_user"=>$this->session->userdata("id_user")];
                        $this->M_konsumen->insertDataKonsumen('persyaratan_kelompok_sasaran',$data);
                    }
                }
                $this->session->set_flashdata('edit_success', 'Berhasil Diubah');
                redirect('konsumen/datakonsumen');
            }else {
                $data['error'] = $this->upload->display_errors();
                $data['success'] = false;
            }
        }else{
            $post = $this->inputKonsumen();
            $this->M_konsumen->updateDataKonsumen($post, $id);
            $where = ['id_konsumen' =>$id];
            if (!empty($persyaratan)) {
                $this->M_konsumen->delete("persyaratan_kelompok_sasaran",$where);
                foreach ($persyaratan as $key => $value) {
                    $data = ['id_konsumen'=>$id,"id_sasaran"=>$value,"id_user"=>$this->session->userdata("id_user")];
                    $this->M_konsumen->insertDataKonsumen('persyaratan_kelompok_sasaran',$data);
                }
            }
            $this->session->set_flashdata('edit_success', 'Berhasil Diubah');
            redirect('konsumen/datakonsumen');
        }
    }

    private function input(){
        return [
            'id_type' => $this->input->post('edit_id_type'), //val_id_type : name yang ada di view
            'id_card' => $this->input->post('edit_id_card'),
            'nama_lengkap' => $this->input->post('edit_nama'),
            'alamat' => $this->input->post('edit_alamat'),
            'telp' => $this->input->post('edit_telepon'),
            'email' => $this->input->post('edit_email'),
            'npwp' => $this->input->post('edit_npwp'),
            'pekerjaan' => $this->input->post('edit_pekerjaan'),
            'alamat_kantor' => $this->input->post('edit_alamat_kantor'),
            'telp_kantor' => $this->input->post('edit_telp_kantor'),
            'id_user' => $this->session->userdata('id_user')
        ];
    }
    private function inputKonsumen(){
        return [
            'id_type' => $this->input->post('detail_id_type'), //val_id_type : name yang ada di view
            'id_card' => $this->input->post('detail_id_card'),
            'nama_lengkap' => $this->input->post('detail_nama'),
            'alamat' => $this->input->post('detail_alamat'),
            'telp' => $this->input->post('detail_telepon'),
            'email' => $this->input->post('detail_email'),
            'npwp' => $this->input->post('detail_npwp'),
            'pekerjaan' => $this->input->post('detail_pekerjaan'),
            'alamat_kantor' => $this->input->post('detail_alamat_kantor'),
            'telp_kantor' => $this->input->post('detail_telp_kantor'),
            'id_user' => $this->session->userdata('id_user')
        ];
    }
}
