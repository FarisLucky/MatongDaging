<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_jenis_pembayaran");
    }

    public function index()
    {
        $active = 'Jenis Pembayaran';
        $data['title'] = 'Jenis Pembayaran';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['jenispembayaran'] = $this->M_jenis_pembayaran->ambildata()->result();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('jenis_pembayaran/v_jenis_pembayaran', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function edit($id) //id itu terserah cuma deklarasi
    {
        $active = 'Edit Jenis Pembayaran';
        $data['title'] = 'Edit Jenis Pembayaran';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['jenispembayaran'] = $this->M_jenis_pembayaran->getSelectionData(['id_jenis', $id]); //id_jenis itu field databasenya trus $id itu yang di deket edit itu, trus jenis_pembayaran itu variabel yang harus sama kaya isi value yang di view
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('jenis_pembayaran/v_edit_jenispembayaran', $data);
        $this->load->view('partials/part_footer', $data);
    }
}
