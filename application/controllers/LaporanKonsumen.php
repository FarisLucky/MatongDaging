<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanKonsumen extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_laporan');
        
    }
    
    public function index()
    {
        redirect('dashboard');
    }

    public function konsumen()
    {
        $data['title'] = 'Laporan';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(18); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['konsumen'] = $this->Model_laporan->getDataWhere("*","tbl_konsumen",["status_konsumen"=>"konsumen"],"id_konsumen","DESC")->result();
        $data['properti'] = $this->Model_laporan->getData("properti")->result();
        $data['persyaratan'] = $this->Model_laporan->getData("persyaratan_sasaran")->result();
        $this->page('laporan/view_konsumen',$data);
    }

    public function dataCalon() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_konsumen";
        $order = "nama_konsumen";
        $column_where = "status_konsumen = 'calon konsumen'";
        $search = ['nama_konsumen',"nama_type","nama_pembuat"];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where);
        $data = array();
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $value->nama_type." - ".$value->id_card;
            $sub[] = $value->nama_konsumen;
            $sub[] = $value->telp;
            $sub[] = $value->email;
            $sub[] = '<img src="'.base_url()."assets/uploads/images/konsumen/".$value->foto_ktp.'" width="50px">';
            $sub[] = $value->tgl_buat;
            $sub[] = $value->nama_pembuat;
            $sub[] = $value->alamat;
            $sub[] = '<button type="button" class="btn btn-info btn-detail" data-id="'.$value->id_konsumen .'">Detail</button><a href="'.base_url()."laporankonsumen/follow/".$value->id_konsumen.'" class="btn btn-danger ml-2">Follow</a><a href="'.base_url()."laporankonsumen/print/".$value->id_konsumen.'" class="btn btn-warning ml-2">Print</a>';
            $data[] = $sub;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order,$column_where)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    public function dataKonsumen() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_konsumen";
        $order = "nama_konsumen";
        $column_where = "status_konsumen = 'konsumen'";
        $search = ['nama_konsumen',"nama_type","nama_pembuat"];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$order,$column_where);
        $data = array();
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $value->nama_type." - ".$value->id_card;
            $sub[] = $value->nama_konsumen;
            $sub[] = $value->telp;
            $sub[] = '<img src="'.base_url()."assets/uploads/images/konsumen/".$value->foto_ktp.'" width="50px">';
            $sub[] = '<div class="badge badge-info">'.$value->nama_pembuat.'</div>';
            $sub[] = $value->tgl_buat;
            $sub[] = $value->email;
            $sub[] = $value->alamat;
            $sub[] = '<a href="'.base_url('laporankonsumen/detailkonsumen/'.$value->id_konsumen).'" class="btn btn-info btn-details" data-id="'.$value->id_konsumen .'">Detail</a><a href="'.base_url()."laporankonsumen/print/".$value->id_konsumen.'" class="btn btn-warning mx-2">Print</a>';
            $data[] = $sub;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl,$column_where)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$order,$column_where)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }
    public function modalKonsumen()
    {
        $data = ["success"=>false];
        $id_konsumen = $this->input->post("id_konsumen");
        $id_calon = $this->input->post("id_calon");
        if (!empty($id_konsumen)) {
            $data["sasaran"] = $this->Model_laporan->getDataWhere("*","persyaratan_kelompok_sasaran",["id_konsumen"=>$id_konsumen])->result();
            $data["detail_kons"] = $this->Model_laporan->getDataWhere("npwp,pekerjaan,alamat_kantor,telp_kantor","tbl_konsumen",["id_konsumen"=>$id_konsumen])->row();
            $data["success"] = true;
        }
        if (!empty($id_calon)) {
            $data["detail_kons"] = $this->Model_laporan->getDataWhere("npwp,pekerjaan,alamat_kantor,telp_kantor","tbl_konsumen",["id_konsumen"=>$id_calon])->row();
            $data["success"] = true;
        }
        $this->output->set_output(json_encode($data));
    }
    public function calon()
    {
        $data['title'] = 'Laporan';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(19); //Jangan DIUbah hanya bisa diganti berdasarkan id_dari sbu/menu ini !!
        $data['img'] = getCompanyLogo();
        $data['konsumen'] = $this->Model_laporan->getDataWhere("*","tbl_konsumen",["status_konsumen"=>"calon konsumen"],"id_konsumen","DESC")->result();
        $this->page('laporan/view_calon',$data);
    }
    public function getUnit()
    {
        $id = $this->input->get('params',true);
        if (!empty($id)) {
            $result = $this->Model_laporan->getDataWhere("id_unit,nama_unit","tbl_unit_properti",["id_properti"=>$id])->result();
            $data["html"] = "<option value=''>-- Pilih Unit --</option>";
            foreach ($result as $key => $value) {
                $data["html"] .= "<option value='".$value->id_unit."'>".$value->nama_unit."</option>";
            }
        }
        $this->output->set_output(json_encode($data));
    }
    public function detailkonsumen()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Detail Konsumen';
        $data['img'] = getCompanyLogo();
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(19); //Jangan DIUbah !!
        $data['konsumen'] = $this->Model_laporan->getDataWhere("*",'konsumen',['id_konsumen' => $id])->result_array();
        $data['persyaratan'] = $this->Model_laporan->getDataWhere("*","persyaratan_sasaran",["id_kategori_persyaratan"=>1])->result_array();
        $data['check_syarat'] = $this->Model_laporan->getDataWhere("*",'persyaratan_kelompok_sasaran',['id_konsumen' => $id])->result_array();
        $data['id_type'] = $this->Model_laporan->getData("type_id_card")->result_array();
        $this->page("laporan/view_detail",$data);
    }
    public function coreEdit()
    {        
        $id = $this->input->post('edit_id_konsumen');
        $persyaratan = $this->input->post('persyaratan');
        date_default_timezone_set('Asia/Jakarta');
        $tgl_buat = date('Y-m-d H:i:s'); //2019-05-16 11:26:56
        $config['upload_path'] = './assets/uploads/images/konsumen/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);
        if ($_FILES['foto_konsumen']['name'] != "") {
            $query = $this->Model_laporan->getDataWhere("*","konsumen",["id_konsumen"=>$id])->row_array();
            $path = "./assets/uploads/images/konsumen/".$query['foto_ktp'];
            if (file_exists($path)) {
                unlink($path);
            }
            if ($this->upload->do_upload('foto_konsumen')) {
                $img = $this->upload->data();
                $post = $this->inputKonsumen();
                $post['foto_ktp'] = $img['file_name'];
                $sql = $this->Model_laporan->updateData($post,"konsumen",["id_konsumen"=> $id]);
                if (!empty($persyaratan)) {
                    foreach ($persyaratan as $key => $value) {
                        $data = ['id_konsumen'=>$id,"id_sasaran"=>$value,"id_user"=>$this->session->userdata("id_user")];
                        $this->M_konsumen->insertData($data,'persyaratan_kelompok_sasaran');
                    }
                }
                $this->session->set_flashdata('edit_success', 'Berhasil Diubah');
                redirect('laporankonsumen/konsumen');
            }else {
                $data['error'] = $this->upload->display_errors();
                $data['success'] = false;
            }
        }else{
            $post = $this->inputKonsumen();
            $this->Model_laporan->updateData($post,"konsumen",["id_konsumen"=>$id]);
            if (!empty($persyaratan)) {
                $this->Model_laporan->deleteData("persyaratan_kelompok_sasaran",["id_konsumen"=>$id]);
                foreach ($persyaratan as $key => $value) {
                    $data = ['id_konsumen'=>$id,"id_sasaran"=>$value,"id_user"=>$this->session->userdata("id_user")];
                    $this->Model_laporan->insertData($data,'persyaratan_kelompok_sasaran');
                }
            }
            $this->session->set_flashdata('edit_success', 'Berhasil Diubah');
            redirect('laporankonsumen/konsumen');
        }
    }
    // Private function 
    private function page($core_page,$data){
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view($core_page,$data);
        $this->load->view('partials/part_footer',$data);
    }
    
    private function inputKonsumen(){
        return [
            'id_type' => $this->input->post('detail_id_type'), //val_id_type : name yang ada di view
            'id_card' => $this->input->post('detail_id_card'),
            'nama_lengkap' => $this->input->post('detail_nama'),
            'alamat' => $this->input->post('detail_alamat'),
            'telp' => $this->input->post('detail_telepon'),
            'email' => $this->input->post('detail_email'),
            'npwp' => $this->input->post('detail_npwp'),
            'pekerjaan' => $this->input->post('detail_pekerjaan'),
            'alamat_kantor' => $this->input->post('detail_alamat_kantor'),
            'telp_kantor' => $this->input->post('detail_telp_kantor'),
            'id_user' => $this->session->userdata('id_user')
        ];
    }
}

/* End of file Laporan_cuy.php */
