<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_rab extends CI_Controller 
{
	function __construct(){
	parent::__construct();
	$this->load->library('form_validation');	
	$this->load->model('M_kelola_rab');	
}
		public function index()
	{
		$active = "kelola_rab";
		$data['kelola_rab'] = $this->M_kelola_rab->tampil_data()->result();
        $data['menus'] = $this->rolemenu->getMenus($active);
        // $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('kelola_rab/v_kelola_rab',$data);
        $this->load->view('partials/part_footer',$data);
       	
	}
	function tambah(){
	$active = "kelola_rab";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kelola_rab/v_tambah_rab');
	$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$config = array (
		array(
			'field' => 'nama_kelompok',
			'label' => 'Nama kelompok',
			'rules' => 'required'
		)

	);
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run()==TRUE) {
	$nama_kelompok = $this->input->post('nama_kelompok');
	$data = array(
		'nama_kelompok' => $nama_kelompok,
		'id_kategori' => 1,
		);
	$this->M_kelola_rab->input_data($data,'kelompok_item');
	redirect('kelola_rab/index');
	} else {
	$active = "kelola_rab";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kelola_rab/v_tambah_rab');
	$this->load->view('partials/part_footer',$data);
	}
	}
	function hapus($id_kelompok)
	{
	$where = array('id_kelompok' => $id_kelompok);
	$this->M_kelola_rab->hapus_data($where,'kelompok_item');
	redirect('kelola_rab/index');
	}
	function edit($id_kelompok)
	{
	$active = "kelola_rab";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$where = array('id_kelompok' => $id_kelompok);
	$data['kelola_rab'] = $this->M_kelola_rab->edit_data($where,'kelompok_item')->result();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('kelola_rab/v_edit_rab',$data);
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
 
	$this->M_kelola_rab->update_data($where,$data,'kelompok_item');
	redirect('kelola_rab/index');
}

}
