<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_konsumen',"M_konsumen");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $active = 'Konsumen';
        $data['title'] = 'Data Konsumen';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['konsumen'] = $this->M_konsumen->ambildata()->result();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/view_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function edit($id)
    {
        $active = 'Edit Konsumen';
        $data['title'] = 'Edit Data Konsumen';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['konsumen'] = $this->M_konsumen->getSelectionData($id);
        $data['id_type'] = $this->M_konsumen->getData("type_id_card")->result_array();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/v_edit_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function hapus($id)
    {
        $value = ['id_konsumen' => $id];
        $this->M_konsumen->delete($value);
        //$this->session->set_flashdata('success', '<div class="alert alert-success" style="margin-bottom:0px" role="alert">Data berhasil dihapus :)</div>');
        redirect('konsumen');
    }

    public function tambah()
    {
        $active = 'Tambah Konsumen';
        $data['title'] = 'Tambah Data Konsumen';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['id_type'] = $this->M_konsumen->getData("type_id_card")->result_array();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('konsumen/v_tambah_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function tambah_data()
    {
        $this->form_validation->set_rules('val_id_card', "id card", "trim|required|numeric", ['required' => 'ID Card Tidak Boleh Kosong !!', 'numeric' => 'ID Card hanya boleh di isi dengan angka !!!']);
        $this->form_validation->set_rules('val_nama_konsumen', "Nama Konsumen", "trim|required", ['required' => 'Nama Konsumen tidak boleh kosong!!']);
        $this->form_validation->set_rules('val_alamat', "Alamat", "trim|required", ['required' => 'Alamat tidak boleh kosong!!']);
        $this->form_validation->set_rules('val_nomor_telepon', "nomor telepon", "trim|required|numeric", ['required' => 'Nomor Telepon Tidak Boleh Kosong !!', 'numeric' => 'Nomor Telepon hanya boleh di isi dengan angka !!!']);
        $this->form_validation->set_rules('val_email', "Email", "trim|required", ['required' => 'Email Tidak Boleh Kosong !!']);
        //foto ktp belum
        $this->form_validation->set_rules('val_npwp', "npwp", "trim|required|numeric", ['required' => 'NPWP Tidak Boleh Kosong !!', 'numeric' => 'NPWP hanya boleh di isi dengan angka !!!']);
        $this->form_validation->set_rules('val_pekerjaan', "pekerjaan", "trim|required", ['required' => 'Pekerjaan Tidak Boleh Kosong !!']);
        $this->form_validation->set_rules('val_alamat_kantor', "Alamat Kantor", "trim|required", ['required' => 'Alamat Kantor tidak boleh kosong!!']);
        $this->form_validation->set_rules('val_telepon_kantor', "Nomor telepon kantor", "trim|required|numeric|is_unique[konsumen.telp_kantor]", ['required' => 'Nomor Telepon Kantor Tidak Boleh Kosong !!', 'numeric' => 'Nomor Telepon Kantor hanya boleh di isi dengan angka !!!', 'is_unique' => '{field} sudah ada']);
        $this->form_validation->set_rules('val_status_konsumen', "Status Konsumen", "trim|required", ['required' => 'Status Konsumen tidak boleh kosong!!']);


        if ($this->form_validation->run() == false) {
            $this->tambah();
            return false;
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
                        'foto_ktp' => $img['file_name'],
                        'npwp' => $this->input->post('val_npwp'),
                        'pekerjaan' => $this->input->post('val_pekerjaan'),
                        'alamat_kantor' => $this->input->post('val_alamat_kantor'),
                        'telp_kantor' => $this->input->post('val_telepon_kantor'),
                        'status_konsumen' => "calon konsumen",
                        'id_user' => $this->session->userdata('id_user'),
                        'tgl_buat' => $tgl_buat
                    ];
                    $this->M_konsumen->insertDataKonsumen($post);
                    //$this->session->set_flashdata('success', '<div class=" alert aler t -succes s" style= "margi n -bottom : 0p x" role= "aler t">Data berhasil diubah </div>');
                    redirect('konsumen');
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
                    'foto_ktp' => '',
                    'npwp' => $this->input->post('val_npwp'),
                    'pekerjaan' => $this->input->post('val_pekerjaan'),
                    'alamat_kantor' => $this->input->post('val_alamat_kantor'),
                    'telp_kantor' => $this->input->post('val_telepon_kantor'),
                    'status_konsumen' => "calon konsumen",
                    'id_user' => $this->session->userdata('id_user'),
                    'tgl_buat' => $tgl_buat
                ];
                $this->M_konsumen->insertDataKonsumen($post);
                //$this->session->set_flashdata('success', '<div class=" alert aler t -succes s" style= "margi n -bottom : 0p x" role= "aler t">Data berhasil diubah </div>');
                redirect('konsumen');
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
            $query = $this->M_konsumen->getSelectionData($id);
            $path = "./assets/uploads/images/konsumen/".$query[0]['foto_ktp'];
            if (file_exists($path)) {
                unlink($path);
            }
            if ($this->upload->do_upload('img_foto')) {
                $img = $this->upload->data();
                $post = [
                    'id_type' => $this->input->post('edit_id_type',true), //val_id_type : name yang ada di view
                    'id_card' => $this->input->post('edit_id_card',true),
                    'nama_lengkap' => $this->input->post('edit_nama',true),
                    'alamat' => $this->input->post('edit_alamat',true),
                    'telp' => $this->input->post('edit_telepon',true),
                    'email' => $this->input->post('edit_email',true),
                    'foto_ktp' => $img['file_name'],
                    'npwp' => $this->input->post('edit_npwp',true),
                    'pekerjaan' => $this->input->post('edit_pekerjaan',true),
                    'alamat_kantor' => $this->input->post('edit_alamat_kantor',true),
                    'telp_kantor' => $this->input->post('edit_telepon_kantor',true),
                    'status_konsumen' => "calon konsumen",
                    'id_user' => $this->session->userdata('id_user',true)
                ];
                $this->M_konsumen->updateDataKonsumen($post, $id);
                redirect('konsumen');
            }else {
                $data['error'] = $this->upload->display_errors();
                $data['success'] = false;
            }
        }else{
            $post = [
                'id_type' => $this->input->post('edit_id_type'), //val_id_type : name yang ada di view
                'id_card' => $this->input->post('edit_id_card'),
                'nama_lengkap' => $this->input->post('edit_nama'),
                'alamat' => $this->input->post('edit_alamat'),
                'telp' => $this->input->post('edit_telepon'),
                'email' => $this->input->post('edit_email'),
                'npwp' => $this->input->post('edit_npwp'),
                'pekerjaan' => $this->input->post('edit_pekerjaan'),
                'alamat_kantor' => $this->input->post('edit_alamat_kantor'),
                'telp_kantor' => $this->input->post('edit_telepon_kantor'),
                'status_konsumen' => "calon konsumen",
                'id_user' => $this->session->userdata('id_user')
            ];
            $id = $this->input->post('edit_id_konsumen');
            $this->M_konsumen->updateDataKonsumen($post, $id);
            redirect('konsumen');
        }
    }
}
