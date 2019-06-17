<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersyaratanSasaran extends CI_Controller 
{
	function __construct(){
	parent::__construct();	
	$this->load->library('form_validation');
	$this->load->model('M_persyaratan_sasaran');	
}
	public function index()
	{
	$active = "persyaratan_sasaran";
	$data['persyaratan_sasaran'] = $this->M_persyaratan_sasaran->tampil_data()->result();
    $data['menus'] = $this->rolemenu->getMenus($active);
    // $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
    $this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('persyaratan_sasaran/v_persyaratan_sasaran',$data);
    $this->load->view('partials/part_footer',$data);
       	
	}
	function tambah(){
	$active = "persyaratan_sasaran";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('persyaratan_sasaran/v_tambah_persyaratan');
	$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$config = array (
		array(
			'field' => 'nama_persyaratan',
			'label' => 'Nama Persyaratan',
			'rules' => 'required'
		),
		array(
			'field' => 'poin_penting',
			'label' => 'Poin Penting',
			'rules' => 'required'
		),
		array(
			'field' => 'keterangan',
			'label' => 'Keterangan',
			'rules' => 'required'
		)

	);
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run()==TRUE) {
	$nama_persyaratan = $this->input->post('nama_persyaratan');
	$poin_penting = $this->input->post('poin_penting');
	$keterangan = $this->input->post('keterangan');
	$data = array(
		'nama_persyaratan' => $nama_persyaratan,
		'poin_penting' => $poin_penting,
		'keterangan' => $keterangan
		);
	$this->M_persyaratan_sasaran->input_data($data,'persyaratan_sasaran');
	redirect('persyaratan_sasaran/index');
	} else {
	$active = "persyaratan_sasaran";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('persyaratan_sasaran/v_tambah_persyaratan');
	$this->load->view('partials/part_footer',$data);
	}
	}
	function hapus($id_sasaran)
	{
	$where = array('id_sasaran' => $id_sasaran);
	$this->M_persyaratan_sasaran->hapus_data($where,'persyaratan_sasaran');
	redirect('persyaratan_sasaran/index');
	}
	function edit($id_sasaran)
	{
	$active = "persyaratan_sasaran";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$where = array('id_sasaran' => $id_sasaran);
	$data['persyaratan_sasaran'] = $this->M_persyaratan_sasaran->edit_data($where,'persyaratan_sasaran')->result();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('persyaratan_sasaran/v_edit_persyaratan',$data);
	$this->load->view('partials/part_footer',$data);
	}
	function update(){
	$id_sasaran = $this->input->post('id_sasaran');
	$nama_persyaratan = $this->input->post('nama_persyaratan');
	$poin_penting = $this->input->post('poin_penting');
	$keterangan = $this->input->post('keterangan');
	$data = array(
		'id_sasaran' => $id_sasaran,
		'nama_persyaratan' => $nama_persyaratan,
		'poin_penting' => $poin_penting,
		'keterangan' => $keterangan
	);
 
	$where = array(
		'id_sasaran' => $id_sasaran
	);
 
	$this->M_persyaratan_sasaran->update_data($where,$data,'persyaratan_sasaran');
	redirect('persyaratan_sasaran/index');
}
}

