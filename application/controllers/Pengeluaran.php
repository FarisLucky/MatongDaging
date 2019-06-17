<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller 
{
	function __construct(){
	parent::__construct();
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
	function tambah()
	{
		$active = "pengeluaran";
		$data['menus'] = $this->rolemenu->getMenus($active);
		$this->load->view('partials/part_navbar',$data);
	    $this->load->view('partials/part_sidebar',$data);
	    $this->load->view('pengeluaran/v_tambah_pengeluaran');
		$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi()
	{
		$active = "pengeluaran";
		$data['menus'] = $this->rolemenu->getMenus($active);
		$this->load->view('partials/part_navbar',$data);
		$this->load->view('partials/part_sidebar',$data);
		$this->load->view('pengeluaran/v_tambah_pengeluaran');
		$this->load->view('partials/part_footer',$data);
		$config['uploads_path'] = './upload/foto/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = true;
		$config['file_name'] = $_FILES['bukti_kwitansi']['name'];
		$config['max_size'] = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$nama_pengeluaran = $this->input->post('nama_pengeluaran');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$harga_satuan = $this->input->post('harga_satuan');
		$tgl_buat = date("Y-m-d H:i:s");
		$file = $this->upload->data();
		$gambar = $file['file_name'];
		$data = array(
			'nama_pengeluaran' => $nama_pengeluaran,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $harga_satuan,
			'tgl_buat' => $tgl_buat,
			'bukti_kwitansi' => $gambar
			);
		$this->M_pengeluaran->input_data($data,'pengeluaran');
		redirect('pengeluaran/index');
	}
	function hapus($id_pengeluaran)
	{
		$where = array('id_pengeluaran' => $id_pengeluaran);
		$this->M_pengeluaran->hapus_data($where,'pengeluaran');
		redirect('pengeluaran/index');
	}
	function edit($id_pengeluaran)
	{
		$active = "pengeluaran";
		$data['menus'] = $this->rolemenu->getMenus($active);
		$where = array('id_pengeluaran' => $id_pengeluaran);
		$data['pengeluaran'] = $this->M_pengeluaran->edit_data($where,'pengeluaran')->result();
		$this->load->view('partials/part_navbar',$data);
	    $this->load->view('partials/part_sidebar',$data);
		$this->load->view('pengeluaran/v_edit_pengeluaran',$data);
		$this->load->view('partials/part_footer',$data);
	}
	function update()
	{
		$id_pengeluaran = $this->input->post('id_pengeluaran');
		$nama_pengeluaran = $this->input->post('nama_pengeluaran');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$harga_satuan = $this->input->post('harga_satuan');
		$gambar = $this->input->post('bukti_kwitansi');
		$data = array
		(
			'nama_pengeluaran' => $nama_pengeluaran,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $harga_satuan,
			'bukti_kwitansi' => $gambar
		);
		$where = array
		(
			'id_pengeluaran' => $id_pengeluaran
		);
 
	$this->M_pengeluaran->update_data($where,$data,'pengeluaran');
	redirect('pengeluaran/index');
}
}
