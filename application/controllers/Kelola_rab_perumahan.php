<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelola_rab_perumahan extends CI_Controller 
{
	function __construct(){
	parent::__construct();
	$this->load->library('form_validation');	
	$this->load->model('M_rab_perumahan');	
}
	public function index()
	{
		$data['rab_properti'] = $this->M_rab_perumahan->get();
		$active = "kelola_rab_perumahan";
		$data['kelola_rab_perumahan'] = $this->M_rab_perumahan->tampil_data()->result();
        $data['menus'] = $this->rolemenu->getMenus($active);
        // $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('kelola_rab_perumahan/v_rab_perumahan',$data);
        $this->load->view('partials/part_footer',$data);
       	
	}
	function tambah(){
	$active = "kelola_rab_perumahan";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$data['kategori'] = $this->M_rab_perumahan->tampil_data_kategori();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kelola_rab_perumahan/v_tambah_perumahan');
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
	$data = array(
		'nama_detail' => $nama_detail,
		'id_rab'=> 2,
		'volume' => $volume,
		'satuan' => $satuan,
		'harga_satuan' => $harga_satuan
		);
	$this->M_rab_perumahan->input_data($data,'detail_rab');
	redirect('kelola_rab_perumahan/index');
	} else {
	$active = "kelola_rab_perumahan";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('kelola_rab_perumahan/v_tambah_perumahan');
	$this->load->view('partials/part_footer',$data);
	}
	}
	function hapus($id_detail)
	{
	$where = array('id_detail' => $id_detail);
	$this->M_rab_perumahan->hapus_data($where,'detail_rab');
	redirect('kelola_rab_perumahan/index');
	}
	function edit($id_detail)
	{
	$active = "kelola_rab_perumahan";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$where = array('id_detail' => $id_detail);
	$data['kelola_rab_perumahan'] = $this->M_rab_perumahan->edit_data($where,'detail_rab')->result();
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
	$this->load->view('kelola_rab_perumahan/v_edit_perumahan',$data);
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
	);
 
	$where = array(
		'id_detail' => $id_detail
	);
 
	$this->M_rab_perumahan->update_data($where,$data,'detail_rab');
	redirect('kelola_rab_perumahan/index');
}

}
