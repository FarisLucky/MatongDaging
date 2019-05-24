<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_jenis_pembayaran');
        $this->load->library('session');
    }

    public function index()
    {
        $active = 'Jenis Pembayaran';
        $active_sub_menu = 'tidac tau apa maksud ini';
        $data['title'] = 'Jenis Pembayaran';
        $data['menus'] = $this->rolemenu->getMenus($active, $active_sub_menu);
        $data['jenispembayaran'] = $this->M_jenis_pembayaran->ambildata()->result();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('jenis_pembayaran/v_jenis_pembayaran', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function edit($id) //id itu terserah cuma deklarasi
    {
        $active = 'Edit Jenis Pembayaran';
        $active_sub_menu = 'tidac tau apa maksud ini';
        $data['title'] = 'Edit Jenis Pembayaran';
        $data['menus'] = $this->rolemenu->getMenus($active, $active_sub_menu);
        $data['jenispembayaran'] = $this->M_jenis_pembayaran->getSelectionData($id); //id_jenis itu field databasenya trus $id itu yang di deket edit itu, trus jenispembayaran itu variabel yang harus sama kaya isi value yang di view
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('jenis_pembayaran/v_edit_jenispembayaran', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function coreperbarui()
    {
        $post = [
            'id_jenis' => $this->input->post('edit_id_jenis', true),
            'jenis_pembayaran' => $this->input->post('edit_jenis_pembayaran', true)
        ];
        $this->M_jenis_pembayaran->updateDataProduk($post);
        //alert 
        $this->session->set_flashdata('success', 'Anda Berhasil Mengubah Data');
        redirect('jenis_pembayaran');
    }
}
