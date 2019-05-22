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
	$active = "pengeluaran";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('pengeluaran/v_tambah_pengeluaran');
	$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi(){
	$config = array (
		array(
			'field' => 'nama_pengeluaran',
			'label' => 'Nama pengeluaran',
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
			'label' => 'Harga_satuan',
			'rules' => 'required'

		),
		array(
			'field' => 'tgl_buat',
			'label' => 'Tgl_buat',
			'rules' => 'required'

		),
		array(
			'field' => 'bukti_kwitansi',
			'label' => 'Bukti_kwitansi',
			'rules' => 'required'

		),
		array(
			'field' => 'id_user',
			'label' => 'Id_user',
			'rules' => 'required'

		),
		array(
			'field' => 'id_properti',
			'label' => 'Id_properti',
			'rules' => 'required'

		),
		array(
			'field' => 'id_kelompok',
			'label' => 'Id_kelompok',
			'rules' => 'required'

		),
	);
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run()==TRUE) {
	$nama_pengeluaran = $this->input->post('nama_pengeluaran');
	$volume = $this->input->post('volume');
	$satuan = $this->input->post('satuan');
	$harga_satuan = $this->input->post('harga_satuan');
	$tgl_buat = $this->input->post('tgl_buat');
	$bukti_kwitansi = $this->input->post('bukti_kwitansi');
	$id_user = $this->input->post('id_user');
	$id_properti = $this->input->post('id_properti');
	$id_kelompok = $this->input->post('id_kelompok');
	$data = array(
		'nama_pengeluaran' => $nama_pengeluaran,
		'volume' => $volume,
		'satuan' => $satuan,
		'harga_satuan' => $harga_satuan,
		'tgl_buat' => $tgl_buat,
		'bukti_kwitansi' => $bukti_kwitansi,
		'id_user' => $id_user,
		'id_properti' => $id_properti,
		'id_kelompok' => $id_kelompok
		);
	$this->M_pengeluaran->input_data($data,'pengeluaran');
	redirect('pengeluaran/index');
	} else {
	$active = "pengeluaran";
	$data['menus'] = $this->rolemenu->getMenus($active);
	$this->load->view('partials/part_navbar',$data);
    $this->load->view('partials/part_sidebar',$data);
    $this->load->view('pengeluaran/v_tambah_pengeluaran');
	$this->load->view('partials/part_footer',$data);
	}
	}
	function hapus($id_pengeluaran)
	{
	$where = array('id_pengeluaran' => $id_pengeluaran);
	$this->M_pengeluaran->hapus_data($where,'pengeluaran');
	redirect('pengeluaran/index');
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
