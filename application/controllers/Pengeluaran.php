<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller 
{
	function __construct(){
	parent::__construct();
	$this->load->model('M_pengeluaran');	
	$this->load->library('form_validation');
	
	$this->load->helper('date');
	
}
	public function index()
	{
		$data["title"] = "Pengeluaran";
		$data['pengeluaran'] = $this->M_pengeluaran->tampil_data()->result();
		$data['menus'] = $this->rolemenu->getMenus();
		$data['img'] = getCompanyLogo();
        // $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('pengeluaran/v_pengeluaran',$data);
        $this->load->view('partials/part_footer',$data);
       	
	}
	function tambah()
	{
		$active = "Tambah";
		$data['menus'] = $this->rolemenu->getMenus();
		$data['img'] = getCompanyLogo();
		$data["kelompok"] = $this->m_pengeluaran->edit_data("kelompok_item",['id_kategori'=>3])->result();
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
		$config['upload_path'] = './assets/uploads/images/pengeluaran';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['encrypt_name'] = true;
		$config['max_size']  = '2048';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('bukti_kwitansi')) {
			$img = $this->upload->data();
		}
		else{
			$data["error"] = $this->upload->display_errors();
		}
		$nama_pengeluaran = $this->input->post('nama_pengeluaran',true);
		$volume = $this->input->post('volume',true);
		$satuan = $this->input->post('satuan',true);
		$harga_satuan = $this->input->post('harga_satuan',true);
		$tgl_buat = date("Y-m-d");
		$kelompok = $this->input->post('kelompok',true);
		$total = $volume * $harga_satuan;
		$file = $this->upload->data();
		$gambar = $img['file_name'];
		$data = array(
			'nama_pengeluaran' => $nama_pengeluaran,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $harga_satuan,
			'total_harga' => $total,
			'created_at' => $tgl_buat,
			'status_manager' => "pending",
			'bukti_kwitansi' => $gambar,
			'id_user'=>$this->session->userdata("id_user"),
			'id_properti'=>$this->session->userdata('id_properti'),
			'id_kelompok'=>$kelompok
			);
		$this->M_pengeluaran->input_data($data,'pengeluaran');
		redirect('pengeluaran');
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
