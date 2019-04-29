<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_jenis_pembayaran");
    }

    public function tampil()
    {
        $data['jenispembayaran'] = $this->M_jenis_pembayaran->ambildata()->result(); //barang itu bukan db melainkan array 
        $this->load->view('v_jenis_pembayaran', $data);
    }

    public function edit()
    {
        $this->load->view('v_edit_jenispembayaran');
    }
    /*public function edit($id_jns = '')
    {
        $value = ['id_jenis' => $id_jns];
        $data['select_barang'] = $this->m_jenis_pembayaran->getSelectionData($value);
        $this->load->view('v_edit_jenispembayaran', $data);
    }
    public function corePerbarui()
    {
        $post = [
            'kode_barang' => $this->input->post('edit_kd_barang', true), //edit_kode_barang itu name di view editnya
            'id_jenis' => $this->input->post('edit_nama_barang', true),
            'jenis_pembayaran' => $this->input->post('edit_deskripsi_barang', true),
            'stok_barang' => $this->input->post('edit_stok_barang', true),
            'harga_barang' => $this->input->post('edit_harga_barang', true),
        ];
        $this->Barang_model->updateDataProduk($post);
        $this->session->set_flashdata('success', '<div class="alert alert-success" style="margin-bottom:0px" role="alert">Data berhasil diubah :)</div>');
        redirect('admin/barang/tampil');
    }*/
}
