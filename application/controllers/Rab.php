<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rab extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->rolemenu->init();
		$this->load->library('form_validation');	
		$this->load->model("Model_rab",'M_kelola_rab');
	}
	public function index()
	{
		redirect('dashboard');
	}
	public function properti($id)
	{
		$where = ["id_properti"=>$id,"type"=>"properti"];
		$data['title']= "Kelola RAB";
		$data['rab_properti'] = $this->M_kelola_rab->getDataWhere("rab_properti",$where)->row();
		$where = ["id_rab"=>$data['rab_properti']->id_rab];
		$data['kelola_rab'] = $this->M_kelola_rab->getDataWhere("tbl_rab",$where)->result();
        $data['menus'] = $this->rolemenu->getMenus();
		$data['js'] = $this->rolemenu->getJavascript(16); //Jangan DIUbah !!
		$this->pages('kelola_rab/v_kelola_rab',$data);
	}
	public function unit($id)
	{
		$where = ["id_properti"=>$id,"type"=>"unit"];
		$data['title']= "Kelola RAB Unit";
		$data['rab_unit'] = $this->M_kelola_rab->getDataWhere("rab_properti",$where)->row();
		$where = ["id_rab"=>$data['rab_unit']->id_rab];
		$data['kelola_rab'] = $this->M_kelola_rab->getDataWhere("tbl_rab",$where)->result();
        $data['menus'] = $this->rolemenu->getMenus();
		$data['js'] = $this->rolemenu->getJavascript(16); //Jangan DIUbah !!
		$this->pages('kelola_rab/view_rab_unit',$data);
	}
	public function tambah($id){
		$data['title']= "Tambah RAB";
		$data['data_id']= $id;
		$getProperti = $this->M_kelola_rab->getDataWhere('rab_properti',['id_rab'=>$id])->row();
		$data['kembali'] = $getProperti->id_properti;
		$data['menus'] = $this->rolemenu->getMenus();
		$data['js'] = $this->rolemenu->getJavascript(16); //Jangan DIUbah !!
		$data['kelompok_rab'] = $this->M_kelola_rab->getDataWhere('kelompok_item',['id_kategori'=> 4,"status"=>"aktif"])->result();
		$this->pages('kelola_rab/v_tambah_rab',$data);
	}
	public function tambahUnit($id)
	{
		$data['title']= "Tambah RAB";
		$data['data_id']= $id;
		$getProperti = $this->M_kelola_rab->getDataWhere('rab_properti',['id_rab'=>$id])->row();
		$data['kembali'] = $getProperti->id_properti;
		$data['menus'] = $this->rolemenu->getMenus();
		$data['js'] = $this->rolemenu->getJavascript(16); //Jangan DIUbah !!
		$data['kelompok_rab'] = $this->M_kelola_rab->getDataWhere('kelompok_item',['id_kategori'=> 1,"status"=>"aktif"])->result();
		$this->pages('kelola_rab/view_tambah_rab_unit',$data);
	}
	public function tambah_aksi(){
		$config = $this->validate();
		$this->form_validation->set_rules($config);
		$id_rab =  $this->input->post('txt_hidden');
		if ($this->form_validation->run() == true ) {
			$nama_detail = $this->input->post('nama_detail');
			$volume = $this->input->post('volume');
			$satuan = $this->input->post('satuan');
			$harga_satuan = $this->input->post('harga_satuan');
			$id_kelompok = $this->input->post('select_kelompok');
			$ttl_harga = $volume * $harga_satuan ;
			$data = array(
				'nama_detail' => $nama_detail,
				'id_rab'=> $id_rab,
				'volume' => $volume,
				'satuan' => $satuan,
				'harga_satuan' => $harga_satuan,
				'total_harga' => $ttl_harga,
				'id_kelompok' => $id_kelompok
				);
			$query = $this->M_kelola_rab->insert_data('detail_rab',$data);
			if ($query) {
				$sql = $this->M_kelola_rab->getTotalSum('total_harga',['id_rab'=>$id_rab],'detail_rab')->row();
				$query = $this->M_kelola_rab->update_data('rab_properti',['total_anggaran'=>$sql->total_harga],['id_rab'=>$id_rab]);
				;
			}
			$properti = $this->M_kelola_rab->getDataWhere("rab_properti",['id_rab'=>$id_rab])->row();
			redirect('rab/properti/'.$properti->id_properti);
		} else {
			$this->tambah($id_rab);
		}
	}
	public function core_tambah_unit(){
		$config = $this->validate();
		$this->form_validation->set_rules($config);
		$id_rab =  $this->input->post('id_rab');
		if ($this->form_validation->run() == true) {
			$nama_detail = $this->input->post('nama_detail');
			$volume = $this->input->post('volume');
			$satuan = $this->input->post('satuan');
			$harga_satuan = $this->input->post('harga_satuan');
			$id_kelompok = $this->input->post('select_kelompok');
			$ttl_harga = $volume * $harga_satuan ;
			$data = array(
				'nama_detail' => $nama_detail,
				'id_rab' => $id_rab,
				'volume' => $volume,
				'satuan' => $satuan,
				'harga_satuan' => $harga_satuan,
				'total_harga' => $ttl_harga,
				'id_kelompok' => $id_kelompok
				);
			$query = $this->M_kelola_rab->insert_data('detail_rab',$data);
			if ($query) {
				$sql = $this->M_kelola_rab->getTotalSum('total_harga',['id_rab'=>$id_rab],'detail_rab')->row();
				$query = $this->M_kelola_rab->update_data('rab_properti',['total_anggaran'=>$sql->total_harga],['id_rab'=>$id_rab]);
				;
			}
			$properti = $this->M_kelola_rab->getDataWhere("rab_properti",['id_rab'=>$id_rab])->row();
			redirect('rab/unit/'.$properti->id_properti);
		} else {
			$this->tambahUnit($id_rab);
		}
	}
	public function hapus($id_detail)
	{
		$data = ['success' => false];
		$where = array('id_detail' => $id_detail);
		$getIdRab = $this->M_kelola_rab->getDataWhere('detail_rab',$where)->row();
		$id_rab = $getIdRab->id_rab;
		$query = $this->M_kelola_rab->hapus_data($where,'detail_rab');
		if ($query) {
			$sql = $this->M_kelola_rab->getTotalSum('total_harga',['id_rab'=>$id_rab],'detail_rab')->row();
			$total = $sql->total_harga;
			$query = $this->M_kelola_rab->update_data('rab_properti',['total_anggaran'=>$total],['id_rab'=>$id_rab]);
			;
		}
		$data['success'] = true;
		return $this->output->set_output(json_encode($data));
		
	}
	public function hapusUnit($id_detail)
	{
		$data = ['success' => false];
		$where = array('id_detail' => $id_detail);
		$getIdRab = $this->M_kelola_rab->getDataWhere('detail_rab',$where)->row();
		$id_rab = $getIdRab->id_rab;
		$query = $this->M_kelola_rab->hapus_data($where,'detail_rab');
		if ($query) {
			$sql = $this->M_kelola_rab->getTotalSum('total_harga',['id_rab'=>$id_rab],'detail_rab')->row();
			$total = $sql->total_harga;
			$query = $this->M_kelola_rab->update_data('rab_properti',['total_anggaran'=>$total],['id_rab'=>$id_rab]);
			;
		}
		$data['success'] = true;
		return $this->output->set_output(json_encode($data));
	}
	public function edit($id_detail)
	{
		$data['title']= "Ubah RAB";
		$data['menus'] = $this->rolemenu->getMenus();
		$where = array('id_detail' => $id_detail);
		$data['js'] = $this->rolemenu->getJavascript(16); //Jangan DIUbah !!
		$data['k'] = $this->M_kelola_rab->getDataWhere('detail_rab',$where)->row();
		$getProperti = $this->M_kelola_rab->getDataWhere('rab_properti',['id_rab'=>$data['k']->id_rab])->row();
		$data['kembali'] = $getProperti->id_properti;
		$data['kelompok_rab'] = $this->M_kelola_rab->getDataWhere('kelompok_item',['id_kategori'=> 4,"status"=>"aktif"])->result();
		$this->pages('kelola_rab/v_edit_rab',$data);
	}
	public function editUnit($id_detail)
	{
		$data['title']= "Ubah RAB";
		$data['menus'] = $this->rolemenu->getMenus();
		$where = array('id_detail' => $id_detail);
		$data['js'] = $this->rolemenu->getJavascript(16); //Jangan DIUbah !!
		$data['k'] = $this->M_kelola_rab->getDataWhere('detail_rab',$where)->row();
		$getProperti = $this->M_kelola_rab->getDataWhere('rab_properti',['id_rab'=>$data['k']->id_rab])->row();
		$data['kembali'] = $getProperti->id_properti;
		$data['kelompok_rab'] = $this->M_kelola_rab->getDataWhere('kelompok_item',['id_kategori'=> 1,"status"=>"aktif"])->result();
		$this->pages('kelola_rab/view_edit_rab_unit',$data);
	}
	function update(){
		$id_detail = $this->input->post('id_detail',true);
		$nama_detail = $this->input->post('nama_detail',true);
		$volume = $this->input->post('volume',true);
		$satuan = $this->input->post('satuan',true);
		$harga_satuan = $this->input->post('harga_satuan',true);
		$id_kelompok = $this->input->post('select_kelompok',true);
		$ttl_harga = $volume * $harga_satuan ;
		$data = array(
			'nama_detail' => $nama_detail,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $harga_satuan,
			'total_harga' => $ttl_harga,
			'id_kelompok' => $id_kelompok
		);
		$where = array(
			'id_detail' => $id_detail
		);
		$query = $this->M_kelola_rab->update_data('detail_rab',$data,$where);
		$getIdRab = $this->M_kelola_rab->getDataWhere('detail_rab',$where)->row();
		$id_rab = $getIdRab->id_rab;
		if ($id_rab) {
			$sql = $this->M_kelola_rab->getTotalSum('total_harga',['id_rab'=>$id_rab],'detail_rab')->row();
			$total = $sql->total_harga;
			$query = $this->M_kelola_rab->update_data('rab_properti',['total_anggaran'=>$total],['id_rab'=>$id_rab]);
			;
		}
		$properti = $this->M_kelola_rab->getDataWhere("rab_properti",['id_rab'=>$id_rab])->row();
		redirect('rab/properti/'.$properti->id_properti);
	}
	function core_update_unit(){
		$id_detail = $this->input->post('id_detail',true);
		$nama_detail = $this->input->post('nama_detail',true);
		$volume = $this->input->post('volume',true);
		$satuan = $this->input->post('satuan',true);
		$harga_satuan = $this->input->post('harga_satuan',true);
		$id_kelompok = $this->input->post('select_kelompok',true);
		$ttl_harga = $volume * $harga_satuan ;
		$data = array(
			'nama_detail' => $nama_detail,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $harga_satuan,
			'total_harga' => $ttl_harga,
			'id_kelompok' => $id_kelompok
		);
		$where = array(
			'id_detail' => $id_detail
		);
	
		$this->M_kelola_rab->update_data('detail_rab',$data,$where);
		$getIdRab = $this->M_kelola_rab->getDataWhere('detail_rab',$where)->row();
		$id_rab = $getIdRab->id_rab;
		if ($id_rab) {
			$sql = $this->M_kelola_rab->getTotalSum('total_harga',['id_rab'=>$id_rab],'detail_rab')->row();
			$total = $sql->total_harga;
			$query = $this->M_kelola_rab->update_data('rab_properti',['total_anggaran'=>$total],['id_rab'=>$id_rab]);
			;
		}
		$properti = $this->M_kelola_rab->getDataWhere("rab_properti",['id_rab'=>$id_rab])->row();
		redirect('rab/unit/'.$properti->id_properti);
	}
	
	private function pages($page,$data)
	{
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
		$this->load->view($page,$data);
        $this->load->view('partials/part_footer',$data);
	}
	private function validate()
	{
        return array (
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
				'field' => 'select_kelompok',
				'label' => 'Id Kelompok',
				'rules' => 'required'
			)
		);
	}

}
