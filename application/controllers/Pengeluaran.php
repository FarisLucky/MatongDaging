<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller 
{
	function __construct(){
	parent::__construct();
	$this->load->library('form_validation');	
	$this->load->model('M_pengeluaran');	
}
		public function index()
	{
		$active = "pengeluaran";
		$data['pengeluaran'] = $this->M_pengeluaran->tampil_data()->result();
        $data['menus'] = $this->rolemenu->getMenus($active);
        // $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('pengeluaran/v_pengeluaran',$data);
        $this->load->view('partials/part_footer',$data);
       	
	}
	function tambah(){
	$active = "kategori_kelompok";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kategori_kelompok/v_tambah_kategori');
	$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$config = array (
		array(
			'field' => 'nama_kategori',
			'label' => 'Nama Ketegori',
			'rules' => 'required'
		));
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run()==TRUE) {
	$nama_kategori = $this->input->post('nama_kategori');
	$data = array(
		'nama_kategori' => $nama_kategori
		);
	$this->M_kategori_kelompok->input_data($data,'kategori_kelompok');
	redirect('kategori_kelompok/index');
	} else {
	$active = "kategori_kelompok";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kategori_kelompok/v_tambah_kategori');
	$this->load->view('partials/part_footer',$data);
	}
	}
	function hapus($id_kategori)
	{
	$where = array('id_kategori' => $id_kategori);
	$this->M_kategori_kelompok->hapus_data($where,'kategori_kelompok');
	redirect('kategori_kelompok/index');
	}
	function edit($id_kategori)
	{
	$active = "kategori_kelompok";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$where = array('id_kategori' => $id_kategori);
	$data['kategori_kelompok'] = $this->M_kategori_kelompok->edit_data($where,'kategori_kelompok')->result();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('kategori_kelompok/v_edit_kategori',$data);
	$this->load->view('partials/part_footer',$data);
	}
	function update(){
	$id_kategori = $this->input->post('id_kategori');
	$nama_kategori = $this->input->post('nama_kategori');
	$data = array(
		'nama_kategori' => $nama_kategori,
	);
 
	$where = array(
		'id_kategori' => $id_kategori
	);
 
	$this->M_kategori_kelompok->update_data($where,$data,'kategori_kelompok');
	redirect('kategori_kelompok/index');
}

}
