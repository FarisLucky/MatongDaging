<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller 
{
	function __construct(){
		parent::__construct();
		$this->rolemenu->init();
		$this->load->library('form_validation');
		$this->load->model('M_pengeluaran');
		$this->load->helper('date');
	}
	public function index()
	{
		$data["title"] = "Pengeluaran";
		$data['pengeluaran'] = $this->M_pengeluaran->getDataWhere("*","tbl_pengeluaran",["id_properti"=>$_SESSION["id_properti"]])->result();
		$data['menus'] = $this->rolemenu->getMenus();
		$data['img'] = getCompanyLogo();
        $data['js'] = $this->rolemenu->getJavascript(20); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('pengeluaran/v_pengeluaran',$data);
        $this->load->view('partials/part_footer',$data);
	}
	function tambah($params = null)
	{
		$active = "Tambah";
		$data['menus'] = $this->rolemenu->getMenus();
		$data['img'] = getCompanyLogo();
		$data["kelompok"] = $this->M_pengeluaran->edit_data(['id_kategori'=>3,"status"=>"aktif"],"kelompok_item")->result();
		$data["error"] = $params;
		$this->load->view('partials/part_navbar',$data);
	    $this->load->view('partials/part_sidebar',$data);
	    $this->load->view('pengeluaran/v_tambah_pengeluaran');
		$this->load->view('partials/part_footer',$data);
	}
	function tambah_aksi()
	{
		$this->validate();
		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$nama_pengeluaran = $this->input->post('nama_pengeluaran',true);
			$volume = $this->input->post('volume',true);
			$satuan = $this->input->post('satuan',true);
			$harga_satuan = $this->input->post('harga_satuan',true);
			$tgl_buat = date("Y-m-d");
			$kelompok = $this->input->post('kelompok',true);
			$total = $volume * $harga_satuan;
			$config['upload_path'] = './assets/uploads/images/pengeluaran';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['encrypt_name'] = true;
			$config['max_size']  = '2048';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$this->load->library('upload', $config);
			if ($_FILES['bukti_kwitansi']['name'] != "") {
				if ($this->upload->do_upload('bukti_kwitansi')) {
					$img = $this->upload->data();
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
					redirect("pengeluaran");
				}
				else{
					$error = $this->upload->display_errors();
					$this->tambah($error);
					return true;
				}
			}else{
				$data = array(
					'nama_pengeluaran' => $nama_pengeluaran,
					'volume' => $volume,
					'satuan' => $satuan,
					'harga_satuan' => $harga_satuan,
					'total_harga' => $total,
					'created_at' => $tgl_buat,
					'status_manager' => "pending",
					'bukti_kwitansi' => "",
					'id_user'=>$this->session->userdata("id_user"),
					'id_properti'=>$this->session->userdata('id_properti'),
					'id_kelompok'=>$kelompok
				);
				$this->M_pengeluaran->input_data($data,'pengeluaran');
				redirect("pengeluaran");
			}
		}
	}
	function hapus()
	{
		$data = ["success"=>false];
		$id = $this->input->get('params',true);
		if (!empty($id)) {
			$foto = $this->M_pengeluaran->edit_data(["id_pengeluaran"=>$id],"pengeluaran")->row_array();
			$path = FCPATH."assets/uploads/images/pengeluaran/".$foto["bukti_kwitansi"];
			if (file_exists($path)) {
				unlink($path);
			}
			$query = $this->M_pengeluaran->hapus_data(["id_pengeluaran"=>$id],'pengeluaran');
			if ($query) {
				$data["success"] = true;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	function edit($id_pengeluaran,$params = null)
	{
		$active = "pengeluaran";
		$data['menus'] = $this->rolemenu->getMenus($active);
		$where = array('id_pengeluaran' => $id_pengeluaran);
		$data['img'] = getCompanyLogo();
		$data["kelompok"] = $this->M_pengeluaran->edit_data(['id_kategori'=>3,"status"=>"aktif"],"kelompok_item")->result();
		$data['pengeluaran'] = $this->M_pengeluaran->edit_data($where,'pengeluaran')->result();
		$data["error"] = $params;
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
		$kelompok = $this->input->post('kelompok_item');
		$total = $volume * $harga_satuan;
		$config['upload_path'] = './assets/uploads/images/pengeluaran';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['encrypt_name'] = true;
		$config['max_size']  = '2048';
		$config['max_width']  = '1024';
		$config['max_height']  = '1024';
		$this->load->library('upload', $config);
		if ($_FILES['bukti_kwitansi']['name'] != "") {
			if ($this->upload->do_upload('bukti_kwitansi')) {
				$result = $this->M_pengeluaran->edit_data(["id_pengeluaran"=>$id_pengeluaran],"pengeluaran")->row();
				$path = "./assets/uploads/images/pengeluaran/".$result->bukti_kwitansi;
				if (file_exists($path)) {
					unlink($path);
				}
				$img = $this->upload->data();
				$gambar = $img['file_name'];
				$data = array(
					'nama_pengeluaran' => $nama_pengeluaran,
					'volume' => $volume,
					'satuan' => $satuan,
					'harga_satuan' => $harga_satuan,
					'total_harga' => $total,
					'bukti_kwitansi' => $gambar,
					'id_kelompok'=>$kelompok
					);
				$this->M_pengeluaran->update_data(["id_pengeluaran"=>$id_pengeluaran],$data,'pengeluaran');
				redirect('pengeluaran');
			}
			else{
				$error = $this->upload->display_errors();
				$this->edit($id_pengeluaran,$error);
				return true;
			}
		}else{
			$data = array(
				'nama_pengeluaran' => $nama_pengeluaran,
				'volume' => $volume,
				'satuan' => $satuan,
				'harga_satuan' => $harga_satuan,
				'total_harga' => $total,
				'id_kelompok'=>$kelompok
				);
			$this->M_pengeluaran->update_data(["id_pengeluaran"=>$id_pengeluaran],$data,'pengeluaran');
			redirect('pengeluaran');
		}
	}

	private function validate()
	{
		$this->form_validation->set_rules('nama_pengeluaran', 'Nama', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('volume', 'Jumlah', 'trim|required|numeric');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('harga_satuan', 'Harga', 'trim|required|numeric');
		$this->form_validation->set_rules('kelompok', 'Kelompok Pengeluaran', 'trim|required');
	}
}
