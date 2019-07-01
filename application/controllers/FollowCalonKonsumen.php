<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FollowCalonKonsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_follow_calon_konsumen');
        $this->load->library('form_validation');
        $this->rolemenu->init();
    }

    public function index()
    {
        $data['title'] = 'Follow Calon Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(30); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['follow_calon_konsumen'] = $this->M_follow_calon_konsumen->getAll();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('follow_calon_konsumen/v_follow_calon_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function hapus($id)
    {
        $value = ['id_follow' => $id];
        $this->M_follow_calon_konsumen->delete($value);
        //$this->session->set_flashdata('success', '<div class="alert alert-success" style="margin-bottom:0px" role="alert">Data berhasil dihapus :)</div>');
        redirect('follow_calon_konsumen');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Follow Calon Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(30); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['id_konsumen'] = $this->M_follow_calon_konsumen->getData("konsumen");
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('follow_calon_konsumen/v_tambah_follow_calon_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function tambah_data()
    {
        $this->form_validation->set_rules('val_nama_konsumen', "Nama Konsumen", "required", ['required' => 'Nama Konsumen tidak boleh kosong!!']);

        $this->form_validation->set_rules('val_media', "Media", "required", ['required' => 'Media tidak boleh kosong!!']);

        $this->form_validation->set_rules('val_keterangan', "keterangan", "trim|required", ['required' => 'Keterangan Tidak Boleh Kosong !!']);

        $this->form_validation->set_rules('val_hasil', "hasil", "required", ['required' => 'Hasil Tidak Boleh Kosong !!']);

        if ($this->form_validation->run() == false) {
            $this->tambah();
            return false;
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $tgl_follow = date('Y-m-d'); //2019-05-16 11:26:56
            $post = [
                'id_konsumen' => $this->input->post('val_nama_konsumen', true),
                'tgl_follow' => $tgl_follow,
                'media' => $this->input->post('val_media', true),
                'keterangan' => $this->input->post('val_keterangan', true),
                'hasil_follow' => $this->input->post('val_hasil', true),
                'id_user' => $this->session->userdata('id_user'),
            ];
            $this->M_follow_calon_konsumen->insertDataFollow($post);

            redirect('followcalonkonsumen');
        }
    }
    public function edit($id)
    {
        $where = array('id_follow' => $id);
        $data['title'] = 'Edit Follow Calon Konsumen';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(30); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sub/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['follow_calon_konsumen'] = $this->M_follow_calon_konsumen->getSelectionData($where);
        $data['media'] = ['Whatsapp', 'Facebook', 'Instagram'];
        $data['konsumen'] = $this->M_follow_calon_konsumen->getData();
        $data['hasil'] = ['Setuju', 'Tidak Setuju'];
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('follow_calon_konsumen/v_edit_follow_calon_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function corePerbarui()
    {
        $this->form_validation->set_rules('edit_nama_konsumen', "Nama Konsumen", "required", ['required' => 'Nama Konsumen tidak boleh kosong!!']);

        $this->form_validation->set_rules('edit_media', "Media", "required", ['required' => 'Media tidak boleh kosong!!']);

        $this->form_validation->set_rules('edit_keterangan', "keterangan", "trim|required", ['required' => 'Keterangan Tidak Boleh Kosong !!']);

        $this->form_validation->set_rules('edit_hasil', "hasil", "required", ['required' => 'Hasil Tidak Boleh Kosong !!']);

        if ($this->form_validation->run() == false) {
            $this->edit('');
            return false;
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $tgl_follow = date('Y-m-d'); //2019-05-16 11:26:56
            $post = [
                'id_konsumen' => $this->input->post('edit_nama_konsumen', true),
                'tgl_follow' => $tgl_follow,
                'media' => $this->input->post('edit_media', true),
                'keterangan' => $this->input->post('edit_keterangan', true),
                'hasil_follow' => $this->input->post('edit_hasil', true),
                'id_user' => $this->session->userdata('id_user'),
            ];
            $this->M_follow_calon_konsumen->updateDatafollow($post);

            redirect('followcalonkonsumen');
        }
    }
}
