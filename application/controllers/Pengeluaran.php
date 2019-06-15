<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller 
{
	function __construct(){
		parent::__construct();
		$this->rolemenu->init();
		$this->load->library('form_validation');	
		$this->load->model('M_pengeluaran');
	}
	public function index()
	{
		$data["title"] = "Pengeluaran";
		$data['pengeluaran'] = $this->M_pengeluaran->tampil_data()->result();
        $data['menus'] = $this->rolemenu->getMenus();
        $data['img'] = getCompanyLogo();
        $data['js'] = $this->rolemenu->getJavascript(20); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('pengeluaran/v_pengeluaran',$data);
        $this->load->view('partials/part_footer',$data);
	}
	function tambah(){
		$data["title"] = "Tambah";
		$data['menus'] = $this->rolemenu->getMenus();
        $data['img'] = getCompanyLogo();
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
			'field' => 'bukti_kwitansi',
			'label' => 'Bukti_kwitansi',
			'rules' => 'required'

		)
	);
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run()==TRUE) {
		$nama_pengeluaran = $this->input->post('nama_pengeluaran');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$harga_satuan = $this->input->post('harga_satuan');
		$tgl_buat = date("Y-m-d H:i:s");

		$config['upload_path'] = './assets/uploads/images/profil/user/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['encrypt_name'] = true;
		$config['max_size']  = '2048';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if ($_FILES['bukti_bayar']['name'] != "") {
			if ($this->upload->do_upload('bukti_bayar')) {
				$img = $this->upload->data();
				$input = array(
					'nama_pengeluaran' => $nama_pengeluaran,
					'volume' => $volume,
					'satuan' => $satuan,
					'harga_satuan' => $harga_satuan,
					'tgl_buat' => $tgl_buat,
					'bukti_kwitansi' => $img["file_name"]
					);
				$this->M_pengeluaran->input_data($data,'pengeluaran');
				redirect('pengeluaran');
			} else {
				$data["error"] = "hai";
				$data["title"] = "Tambah";
				$data['menus'] = $this->rolemenu->getMenus();
				$data['img'] = getCompanyLogo();
				$this->load->view('partials/part_navbar',$data);
				$this->load->view('partials/part_sidebar',$data);
				$this->load->view('pengeluaran/v_tambah_pengeluaran',$data);
				$this->load->view('partials/part_footer',$data);
			}
		}
	} else {
		$this->tambah();
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
		$data["title"] = "Edit Pengeluaran";
		$data['menus'] = $this->rolemenu->getMenus();
		$where = array('id_kategori' => $id_kategori);
		$data['kategori_kelompok'] = $this->M_pengeluaran->edit_data($where,'kategori_kelompok')->result();
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
