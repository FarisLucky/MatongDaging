<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_item extends CI_Controller 
{
	function __construct(){
	parent::__construct();		
	$this->load->model('M_kategori_item');	
}
		public function index()
	{
	$active = "kategori_item";
	$data['kategori_item'] = $this->M_kategori_item->tampil_data()->result();
    $data['menus'] = $this->rolemenu->getMenus($active);
    // $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
    $this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('Kategori_item/v_kategori_item',$data);
    $this->load->view('partials/part_footer',$data);
       	
	}
	function tambah(){
	$active = "kategori_item";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kategori_item/v_tambah_item');
	$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$nama_kelompok = $this->input->post('nama_kelompok');
	$data = array(
		'nama_kelompok' => $nama_kelompok,
		'id_user' => 1,
		'id_kategori' => 3
		);
	$this->M_kategori_item->input_data($data,'kelompok_item');
	redirect('kategori_item/index');
	}
	function hapus($id_kelompok)
	{
	$where = array('id_kelompok' => $id_kelompok);
	$this->M_kategori_item->hapus_data($where,'kelompok_item');
	redirect('kategori_item/index');
	}
	function edit($id_kelompok)
	{
	$active = "kategori_item";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$where = array('id_kelompok' => $id_kelompok);
	$data['kategori_item'] = $this->M_kategori_item->edit_data($where,'kelompok_item')->result();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('kategori_item/v_edit_item',$data);
	$this->load->view('partials/part_footer',$data);
	}
	function update(){
	$id_kelompok = $this->input->post('id_kelompok');
	$nama_kelompok = $this->input->post('nama_kelompok');
	$data = array(
		'nama_kelompok' => $nama_kelompok,
	);
 
	$where = array(
		'id_kelompok' => $id_kelompok
	);
 
	$this->M_kategori_item->update_data($where,$data,'kelompok_item');
	redirect('kategori_item/index');
}
}
