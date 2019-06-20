<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller 
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
		$data["title"] = "Pemasukan";
		$data['pemasukan'] = $this->M_pengeluaran->getDataWhere("*","tbl_pemasukan",["id_properti"=>$_SESSION["id_properti"]])->result();
		$data['menus'] = $this->rolemenu->getMenus();
		$data['img'] = getCompanyLogo();
        $data['js'] = $this->rolemenu->getJavascript(26); //Jangan DIUbah !!
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view('pemasukan/view_pemasukan',$data);
        $this->load->view('partials/part_footer',$data);
	}
	function tambah($params = null)
	{
		$data["title"] = "Tambah Pemasukan";
		$data['menus'] = $this->rolemenu->getMenus();
		$data['img'] = getCompanyLogo();
		$data["kelompok"] = $this->M_pengeluaran->edit_data(['id_kategori'=>2,"status"=>"aktif"],"kelompok_item")->result();
		$data["error"] = $params;
		$this->load->view('partials/part_navbar',$data);
		$this->load->view('partials/part_sidebar',$data);
		$this->load->view('pemasukan/tambah_pemasukan',$data);
		$this->load->view('partials/part_footer',$data);
	}
	function coreTambah()
	{
		$this->validate();
		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$nama_pemasukan = $this->input->post('nama_pemasukan',true);
			$volume = $this->input->post('volume',true);
			$satuan = $this->input->post('satuan',true);
			$harga_satuan = $this->input->post('harga_satuan',true);
			$tgl_buat = date("Y-m-d");
			$kelompok = $this->input->post('kelompok_item',true);
			$total = $volume * $harga_satuan;
			$config['upload_path'] = './assets/uploads/images/pemasukan';
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
						'nama_pemasukan' => $nama_pemasukan,
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
					$this->M_pengeluaran->input_data($data,'pemasukan');
					redirect("pemasukan");
				}
				else{
					$error = $this->upload->display_errors();
					$this->tambah($error);
					return true;
				}
			}else{
				$data = array(
					'nama_pemasukan' => $nama_pemasukan,
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
				$this->M_pengeluaran->input_data($data,'pemasukan');
				redirect("pemasukan");
			}
		}
	}
	function hapus()
	{
		$data = ["success"=>false];
		$id = $this->input->get('params',true);
		if (!empty($id)) {
			$foto = $this->M_pengeluaran->edit_data(["id_pemasukan"=>$id],"pemasukan")->row_array();
			$path = FCPATH."assets/uploads/images/pemasukan/".$foto["bukti_kwitansi"];
			if (file_exists($path)) {
				unlink($path);
			}
			$query = $this->M_pengeluaran->hapus_data(["id_pemasukan"=>$id],'pemasukan');
			if ($query) {
				$data["success"] = true;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	function edit($id,$params = null)
	{
		$id_pemasukan = $id;
		$data["title"]= "Edit Pemasukan";
		$data['menus'] = $this->rolemenu->getMenus();
		$data['img'] = getCompanyLogo();
		$where = array('id_pemasukan' => $id_pemasukan);
		$data["kelompok"] = $this->M_pengeluaran->edit_data(['id_kategori'=>2,"status"=>"aktif"],"kelompok_item")->result();
		$data['pemasukan'] = $this->M_pengeluaran->edit_data($where,'pemasukan')->row();
		$data["error"] = $params;
		$this->load->view('partials/part_navbar',$data);
		$this->load->view('partials/part_sidebar',$data);
		$this->load->view('pemasukan/edit_pemasukan',$data);
		$this->load->view('partials/part_footer',$data);
	}
	function update()
	{
		$id_pemasukan = $this->input->post('id_pemasukan');
		$this->validate();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id_pemasukan);
		} else {
			$nama_pemasukan = $this->input->post('nama_pemasukan',true);
			$volume = $this->input->post('volume',true);
			$satuan = $this->input->post('satuan',true);
			$harga_satuan = $this->input->post('harga_satuan',true);
			$gambar = $this->input->post('bukti_kwitansi',true);
			$kelompok = $this->input->post('kelompok_item',true);
			$total = $volume * $harga_satuan;
			$config['upload_path'] = './assets/uploads/images/pemasukan';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['encrypt_name'] = true;
			$config['max_size']  = '2048';
			$config['max_width']  = '1024';
			$config['max_height']  = '1024';
			$this->load->library('upload', $config);
			if ($_FILES['bukti_kwitansi']['name'] != "") {
				if ($this->upload->do_upload('bukti_kwitansi')) {
					$result = $this->M_pengeluaran->edit_data(["id_pemasukan"=>$id_pemasukan],"pemasukan")->row();
					$path = "./assets/uploads/images/pemasukan/".$result->bukti_kwitansi;
					if (!is_dir($path)) {
						if (file_exists($path)) {
							unlink($path);
						}
					}
					$img = $this->upload->data();
					$gambar = $img['file_name'];
					$data = array(
						'nama_pemasukan' => $nama_pemasukan,
						'volume' => $volume,
						'satuan' => $satuan,
						'harga_satuan' => $harga_satuan,
						'total_harga' => $total,
						'bukti_kwitansi' => $gambar,
						'id_kelompok'=>$kelompok
					);
					$this->M_pengeluaran->update_data(["id_pemasukan"=>$id_pemasukan],$data,'pemasukan');
					redirect('pemasukan');
				}
				else{
					$error = $this->upload->display_errors();
					$this->edit($id_pemasukan,$error);
					return true;
				}
			}else{
				$data = array(
					'nama_pemasukan' => $nama_pemasukan,
					'volume' => $volume,
					'satuan' => $satuan,
					'harga_satuan' => $harga_satuan,
					'total_harga' => $total,
					'id_kelompok'=>$kelompok
				);
				$this->M_pengeluaran->update_data(["id_pemasukan"=>$id_pemasukan],$data,'pemasukan');
				redirect('pemasukan');
			}
		}
	}

	private function validate()
	{
		$this->form_validation->set_rules('nama_pemasukan', 'Nama', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('volume', 'Jumlah', 'trim|required|numeric');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('harga_satuan', 'Harga', 'trim|required|numeric');
		$this->form_validation->set_rules('kelompok_item', 'Kelompok Pemasukan', 'trim|required');
	}
}
