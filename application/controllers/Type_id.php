<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_id extends CI_Controller 
{
	function __construct(){
		parent::__construct();	
		$this->rolemenu->init();
		$this->load->library('form_validation');	
		$this->load->model('M_type_id');	
	}
	public function index()
	{
		$active = "type_id_card";
		$data['type_id_card'] = $this->M_type_id->tampil_data()->result();
        $data['menus'] = $this->rolemenu->getMenus($active);
        // $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('type_id_card/v_type',$data);
        $this->load->view('partials/part_footer',$data);
	}
	function tambah(){
	$active = "type_id_card";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('type_id_card/v_tambah_type');
	$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$config = array (
		array(
			'field' => 'nama_type',
			'label' => 'Nama type',
			'rules' => 'required'
		));
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run()==TRUE) {
	$nama_type = $this->input->post('nama_type');
	$data = array(
		'nama_type' => $nama_type
		);
	$this->M_type_id->input_data($data,'type_id_card');
	redirect('type_id/index');
	} else {
	$active = "type_id_card";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('type_id_card/v_tambah_type');
	$this->load->view('partials/part_footer',$data);
	}
	}
	function hapus($id_type)
	{
	$where = array('id_type' => $id_type);
	$this->M_type_id->hapus_data($where,'type_id_card');
	redirect('type_id/index');
	}
	function edit($id_type)
	{
	$active = "type_id_card";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$where = array('id_type' => $id_type);
	$data['type_id_card'] = $this->M_type_id->edit_data($where,'type_id_card')->result();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('type_id_card/v_edit_type',$data);
	$this->load->view('partials/part_footer',$data);
	}
	function update(){
	$id_type = $this->input->post('id_type');
	$nama_type = $this->input->post('nama_type');
	$data = array(
		'nama_type' => $nama_type,
	);
 
	$where = array(
		'id_type' => $id_type
	);
 
	$this->M_type_id->update_data($where,$data,'type_id_card');
	redirect('type_id/index');
}

}
