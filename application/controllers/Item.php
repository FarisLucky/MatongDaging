<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller 
{
	function __construct(){
		parent::__construct();	
		$this->rolemenu->init();
		$this->load->library('form_validation');
		$this->load->model('Model_item',"M_kategori_item");
	}
	public function index()
	{
		$data['title'] = "Kategori";
		$data['kategori_item'] = $this->M_kategori_item->tampil_data('tbl_kelompok_item')->result();
		$data['menus'] = $this->rolemenu->getMenus();
		$this->load->view('partials/part_navbar',$data);
		$this->load->view('partials/part_sidebar',$data);
		$this->load->view('item/v_kategori_item',$data);
		$this->load->view('partials/part_footer',$data);
	}
	function tambah(){
		$data['title'] = "Tambah Kategori";
		$data['menus'] = $this->rolemenu->getMenus();
		$data['kategori'] = $this->M_kategori_item->tampil_data('kategori_kelompok')->result();
		$this->load->view('partials/part_navbar',$data);
		$this->load->view('partials/part_sidebar',$data);
		$this->load->view('item/v_tambah_item',$data);
		$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$config = array (
		array(
			'field' => 'nama_kelompok',
			'label' => 'Nama Kelompok',
			'rules' => 'trim|required'
		),array(
			'field' => 'select_kategori',
			'label' => 'Kategori Kelompok',
			'rules' => 'trim|required'
		));
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run() == true) {
		$nama_kelompok = $this->input->post('nama_kelompok');
		$data = array(
			'nama_kelompok' => $nama_kelompok,
			'id_user' => $this->session->userdata('id_user'),
			'id_kategori' => $this->input->post('select_kategori')
			);
		$this->M_kategori_item->input_data('kelompok_item',$data);
		redirect('item');
	} else {
		$this->tambah();
	}
	}
	function hapus($id_kelompok)
	{
	$where = array('id_kelompok' => $id_kelompok);
	$this->M_kategori_item->hapus_data($where,'kelompok_item');
	redirect('item');
	}
	function edit($id_kelompok)
	{
		$data['menus'] = $this->rolemenu->getMenus();
		$where = array('id_kelompok' => $id_kelompok);
		$data['kategori_item'] = $this->M_kategori_item->edit_data($where,'kelompok_item')->result();
		$data['kategori'] = $this->M_kategori_item->tampil_data('kategori_kelompok')->result();
		$this->load->view('partials/part_navbar',$data);
		$this->load->view('partials/part_sidebar',$data);
		$this->load->view('item/v_edit_item',$data);
		$this->load->view('partials/part_footer',$data);
	}
	function update(){
		$id_kelompok = $this->input->post('id_kelompok');
		$nama_kelompok = $this->input->post('nama_kelompok');
		$select = $this->input->post('select_kategori');
		$data = array(
			'nama_kelompok' => $nama_kelompok,
			'id_kategori' => $select
		);
		$where = array(
			'id_kelompok' => $id_kelompok
		);
	
		$this->M_kategori_item->update_data($where,$data,'kelompok_item');
		redirect('item');
	}
}

