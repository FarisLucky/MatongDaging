<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Follow_calon_konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_follow_calon_konsumen');
        //$this->load->library('form_validation');
    }

    public function index()
    {
        $active = 'Follow Calon Konsumen';
        $active_sub_menu = 'tidak tau apa maksud ini';
        $data['title'] = 'Follow Calon Konsumen';
        $data['menus'] = $this->rolemenu->getMenus($active, $active_sub_menu);
        $data['follow_calon_konsumen'] = $this->M_follow_calon_konsumen->ambildata()->result();
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
        $active = 'Follow Calon Konsumen';
        $active_sub_menu = 'tidak tau apa maksud ini';
        $data['title'] = 'Follow Calon Konsumen';
        $data['menus'] = $this->rolemenu->getMenus($active, $active_sub_menu);
        $data['follow_calon_konsumen'] = $this->M_follow_calon_konsumen->ambildata()->result();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('follow_calon_konsumen/v_tambah_follow_calon_konsumen', $data);
        $this->load->view('partials/part_footer', $data);
    }
}
