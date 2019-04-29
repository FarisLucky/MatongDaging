<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_users extends CI_Controller {

    private $status;    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_kelola_user','Muser');
        
    }
    
    public function index()
    {
        $active = 'Kelola User';
        $data['title'] = 'User';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $data['user'] = $this->Muser->getUser();
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('kelola_user/view_kelola_user',$data);
        $this->load->view('partials/part_footer',$data);
    }
    
    public function tambah() //Menampilkan Form Tambah
    {
        $active = 'Kelola User';
        $data['title'] = 'Tambah User';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $data['akses'] = $this->Muser->getAkses(); //Mengambil data role akses 
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('kelola_user/view_tambah_user',$data);
        $this->load->view('partials/part_footer',$data);
    }
    public function core_tambah() //Core Tambah
    {
        $data = [
            "success" => false,
            "title" =>'User berhasil Ditambah',
            'msg' => [],
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_nama_user','Nama','trim|required');
        $this->form_validation->set_rules('txt_alamat_user','Alamat','trim|required');
        $this->form_validation->set_rules('txt_akses_user','Hak Akses','trim|required');
        $this->form_validation->set_rules('txt_email_user','Email','trim|required|valid_email');
        $this->form_validation->set_rules('txt_telp_user','Telp','trim|required');
        $this->form_validation->set_rules('txt_username_user','Username','trim|required');
        $this->form_validation->set_rules('txt_password_user','Password','trim|required');
        $this->form_validation->set_rules('txt_retype_password','Password','trim|required|matches[txt_password_user]');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $password = password_hash($this->input->post('txt_password_user',true),PASSWORD_DEFAULT);
            $config['upload_path'] = './assets/uploads/images/profil/user/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            if ($_FILES['txt_foto_user']['name'] != "") {
                if ($this->upload->do_upload('txt_foto_user')){
                    $img = $this->upload->data();
                    $input = [
                        'nama'=>$this->input->post('txt_nama_user',true),
                        'alamat'=>$this->input->post('txt_alamat_user',true),
                        'akses'=>$this->input->post('txt_akses_user',true),
                        'email'=>$this->input->post('txt_email_user',true),
                        'telp'=>$this->input->post('txt_telp_user',true),
                        'jk'=>$this->input->post('radio_jk',true),
                        'username'=>$this->input->post('txt_username_user',true),
                        'password'=>$password,
                        'img' => $img['file_name']
                    ];
                    $this->Muser->insertUser($input);
                    $data['success'] = true;
                }
                else {
                    $data['error'] = $this->upload->display_errors();
                    $data['success'] = false;
                }
            }
            else{
                $input = [
                    'nama'=>$this->input->post('txt_nama_user',true),
                    'alamat'=>$this->input->post('txt_alamat_user',true),
                    'akses'=>$this->input->post('txt_akses_user',true),
                    'email'=>$this->input->post('txt_email_user',true),
                    'telp'=>$this->input->post('txt_telp_user',true),
                    'username'=>$this->input->post('txt_username_user',true),
                    'password'=>$password,
                    'img' => $img['file_name']
                ];
                $this->Muser->insertUser($input);
                $data['success'] = true;
            }
        }
        return $this->output->set_output(json_encode($data));
        
    }
    public function dataUsers() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side','ssd');
        $column = "*";
        $tbl = "tbl_users";
        $nama = "nama_lengkap";
        $search = ['nama_lengkap','email','no_hp','status_user','akses'];
        $fetch_values = $this->ssd->makeDataTables($column,$tbl,$search,$nama);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            if ($value->akses != 'owner') {
                if ($value->status_user == 'aktif') {
                    $this->status = '<a href="'.base_url().'setting/detailuser/'.$value->id_user.'" class="btn btn-sm btn-primary mr-1" id="detail_data_user">Detail</a><button type="button" class="btn btn-sm btn-danger mr-1" id="hapus_data_user" data-id="'.$value->id_user.'">Hapus</button><button type="button" class="btn btn-sm btn-warning" id="nonaktif_data_user" data-id="'.$value->id_user.'">Nonaktif</button>';
                }
                else{
                    $this->status = '<a href="'.base_url().'setting/detailuser/'.$value->id_user.'" class="btn btn-sm btn-primary mr-1" id="detail_data_user">Detail</a><button type="button" class="btn btn-sm btn-danger mr-1" id="hapus_data_user" data-id="'.$value->id_user.'">Hapus</button><button type="button" class="btn btn-sm btn-warning" id="aktif_data_user" data-id="'.$value->id_user.'">Aktifkan</button>';
                }
            }else{
                $this->status = '-';
            }
            $sub = array();
            $sub[] = strval($no);
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->Email;
            $sub[] = $value->no_hp;
            $sub[] = '<small class="badge badge-primary">'.$value->akses.'</small>';
            $sub[] = '<small class="badge badge-info">'.$value->status_user.'</small>';
            $sub[] = $this->status;
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw'=>intval($this->input->post('draw')),
            'recordsTotal'=>intval($this->ssd->get_all_datas($tbl)),
            'recordsFiltered'=>intval($this->ssd->get_filtered_datas($column,$tbl,$search,$nama)),
            'data'=> $data
        );
        return $this->output->set_output(json_encode($output));
    }

    public function userStatus() //Fungsi Mengubah status User
    {
        $input = [
            'where'=>$this->input->post('id_user',true),
            'values'=>$this->input->post('status')
        ];
        $get = $this->Muser->userStatus($input);
        if ($get) {
            $data['success'] = "sukses";
        }
        else{
            $data['success'] = "gagal";
        }
        return $this->output->set_output(json_encode($data));
        
    }

    public function detailUser($id) //FUngsi menampilkan form detail
    {
        $active = 'Detail User';
        $data['title'] = 'Detail User';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $data['users'] = $this->Muser->getUserWhereId($id);
        $data['properti'] = $this->Muser->getProperti($id);
        $data['user_properti'] = $this->Muser->getUserProperti($id);
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('kelola_user/view_detail_user',$data);
        $this->load->view('partials/part_footer',$data);
    }
    public function userProperti() //Menambahkan user assign properti
    {
        $data = [
            'id_user' => $this->input->post('id_user'),
            'id_properti' => $this->input->post('id_properti')
            
        ];
        $get = $this->Muser->insertUserProperti($data);
        if ($get > 0) {
            $success = true;
        }
        else{
            $success = false;
        }
        $this->output->set_output(json_encode($success));
    }
    public function hapus($id) //Menghapus User
    {
        $hapus = $this->Muser->hapus($id);
        if ($hapus) {
            $data['success'] = true;
        }
        else{
            $data['success'] = false;
        }
        return $this->output->set_output(json_encode($data));
        
    }
}

/* End of file Controllername.php */
