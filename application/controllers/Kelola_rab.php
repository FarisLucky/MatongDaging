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
		$data['rab_properti'] = $this->M_kelola_rab->get();
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
	$data['kategori'] = $this->M_kelola_rab->tampil_data_kategori();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kelola_rab/v_tambah_rab');
	$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$config = array (
		array(
			'field' => 'nama_detail',
			'label' => 'Nama Detail',
			'rules' => 'required'
		),
		array(
			'field' => 'volume',
			'label' => 'Volume',
			'rules' => 'required'
		),
		array(
			'field' => 'satuan',
			'label' => 'Satuan',
			'rules' => 'required'
		),
		array(
			'field' => 'harga_satuan',
			'label' => 'Harga Satuan',
			'rules' => 'required'
		),
		array(
			'field' => 'id_kelompok',
			'label' => 'Id Kelompok',
			'rules' => 'required'
		)
	);
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run()==TRUE) {
	$nama_detail = $this->input->post('nama_detail');
	$volume = $this->input->post('volume');
	$satuan = $this->input->post('satuan');
	$harga_satuan = $this->input->post('harga_satuan');
	$id_kelompok = $this->input->post('id_kelompok');
	$data = array(
		'nama_detail' => $nama_detail,
		'id_rab'=>1,
		'volume' => $volume,
		'satuan' => $satuan,
		'harga_satuan' => $harga_satuan,
		'id_kelompok' => $id_kelompok
		);
	$this->M_kelola_rab->input_data($data,'detail_rab');
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
	function hapus($id_detail)
	{
	$where = array('id_detail' => $id_detail);
	$this->M_kelola_rab->hapus_data($where,'detail_rab');
	redirect('kelola_rab/index');
	}
	function edit($id_detail)
	{
	$active = "kelola_rab";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$where = array('id_detail' => $id_detail);
	$data['kelola_rab'] = $this->M_kelola_rab->edit_data($where,'detail_rab')->result();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('kelola_rab/v_edit_rab',$data);
	$this->load->view('partials/part_footer',$data);
	}
	function update(){
	$id_detail = $this->input->post('id_detail');
	$nama_detail = $this->input->post('nama_detail');
	$volume = $this->input->post('volume');
	$satuan = $this->input->post('satuan');
	$harga_satuan = $this->input->post('harga_satuan');
	$data = array(
		'nama_detail' => $nama_detail,
		'volume' => $volume,
		'satuan' => $satuan,
		'harga_satuan' => $harga_satuan,
		'id_kelompok' => $id_kelompok
	);
 
	$where = array(
		'id_detail' => $id_detail
	);
 
	$this->M_kelola_rab->update_data($where,$data,'detail_rab');
	redirect('kelola_rab/index');
}

}
