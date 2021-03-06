<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KelolaUsers extends CI_Controller
{

    private $status;
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->model('Model_kelola_user', 'Muser');
    }

    public function index()
    {
        $data['title'] = 'User';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $data['user'] = $this->Muser->getUser();
        $data['img'] = getCompanyLogo();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('kelola_user/view_kelola_user', $data);
        $this->load->view('partials/part_footer', $data);
    }

    public function tambah() //Menampilkan Form Tambah
    {
        $data['title'] = 'Tambah User';
        $data['menus'] = $this->rolemenu->getMenus();
        $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $data['akses'] = $this->Muser->getAkses(); //Mengambil data role akses
        $data['img'] = getCompanyLogo();
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('kelola_user/view_tambah_user',$data);
        $this->load->view('partials/part_footer',$data);
    }
    public function core_tambah() //Core Tambah
    {
        $data = [
            "success" => false,
            'msg' => [],
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_nama_user','Nama','trim|required');
        $this->form_validation->set_rules('txt_alamat_user','Alamat','trim|required');
        $this->form_validation->set_rules('txt_akses_user','Hak Akses','trim|required');
        $this->form_validation->set_rules('txt_email_user','Email','trim|required|valid_email|is_unique[user.Email]');
        $this->form_validation->set_rules('txt_telp_user','Telp','trim|required|max_length[13]|min_length[10]|greater_than[0]|is_unique[user.no_hp]');
        $this->form_validation->set_rules('txt_username_user','Username','trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('txt_status_user','Status','trim|required');
        $this->form_validation->set_rules('txt_password_user','Password','trim|required');
        $this->form_validation->set_rules('txt_retype_password','Password','trim|required|matches[txt_password_user]');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else {
            $password = password_hash($this->input->post('txt_password_user', true), PASSWORD_DEFAULT);
            $input = [
                'nama_lengkap' => $this->input->post('txt_nama_user', true),
                'alamat' => $this->input->post('txt_alamat_user', true),
                'id_akses' => $this->input->post('txt_akses_user', true),
                'email' => $this->input->post('txt_email_user', true),
                'no_hp' => $this->input->post('txt_telp_user', true),
                'jenis_kelamin' => $this->input->post('radio_jk', true),
                'username' => $this->input->post('txt_username_user', true),
                'status_user' => $this->input->post('txt_status_user', true),
                'password' => $password
            ];
            $config['upload_path'] = './assets/uploads/images/profil/user/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            if ($_FILES['txt_foto_user']['name'] != "") {
                if ($this->upload->do_upload('txt_foto_user')) {
                    $img = $this->upload->data();
                    $input += ["foto_user"=>$img["file_name"]];
                    $this->Muser->insertData($input,"user");
                    $data['success'] = true;
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $data['success'] = false;
                }
            } else {
                $input += ["foto_user"=>"default.jpg"];
                $act = $this->Muser->insertData($input,"user");
                if ($act) {
                    $data['success'] = true;
                    $data['act'] = $act;
                } else {
                    $data['success'] = false;
                    $data['act'] = $act;
                }
            }
        }
        return $this->output->set_output(json_encode($data));
    }
    public function dataUsers() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side', 'ssd');
        $column = "*";
        $tbl = "tbl_users";
        $nama = "akses";
        $search = ['nama_lengkap', 'email', 'no_hp', 'status_user', 'akses'];
        $fetch_values = $this->ssd->makeDataTables($column, $tbl, $search, $nama);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            if ($value->akses != 'owner') {
                $this->status = '<a href="' . base_url() . 'kelolausers/detailuser/' . $value->id_user . '" class="btn btn-sm btn-primary mx-2" id="detail_data_user">Detail</a><button type="button" class="btn btn-sm btn-danger" id="hapus_data_user" data-id="' . $value->id_user . '">Hapus</button>';
                if ($value->status_user == 'aktif') {
                    $this->status .= '<button type="button" class="btn btn-sm btn-warning mx-2" id="nonaktif_data_user" data-id="' . $value->id_user . '">Nonaktif</button>';
                } else {
                    $this->status .= '<button type="button" class="btn btn-sm btn-warning mx-2" id="aktif_data_user" data-id="' . $value->id_user . '">Aktifkan</button>';
                }
                $this->status .= '<button class="btn btn-sm btn-success btn-change" data-id="'.$value->id_user.'">Change Password</button>';
            } else {
                $this->status = '-';
            }
            $sub = array();
            $sub[] = strval($no);
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->Email;
            $sub[] = $value->no_hp;
            $sub[] = '<small class="badge badge-primary">' . $value->akses . '</small>';
            $sub[] = '<small class="badge badge-info">' . $value->status_user . '</small>';
            $sub[] = $this->status;
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($this->ssd->get_all_datas($tbl)),
            'recordsFiltered' => intval($this->ssd->get_filtered_datas($column, $tbl, $search, $nama)),
            'data' => $data
        );
        return $this->output->set_output(json_encode($output));
    }

    public function userStatus() //Fungsi Mengubah status User
    {
        $input = [
            'where' => $this->input->post('id_user', true),
            'values' => $this->input->post('status')
        ];
        $get = $this->Muser->userStatus($input);
        if ($get) {
            $data['success'] = "sukses";
        } else {
            $data['success'] = "gagal";
        }
        return $this->output->set_output(json_encode($data));
    }

    public function detailUser($id) //FUngsi menampilkan form detail
    {
        $active = 'Detail User';
        $data['title'] = 'Detail User';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $data['users'] = $this->Muser->getUserWhereId($id);
        $data['properti'] = $this->Muser->getDataWhere("id_properti,nama_properti,foto_properti","tbl_properti",["status"=>"publish"])->result();
        $data['img'] = getCompanyLogo();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('kelola_user/view_detail_user', $data);
        $this->load->view('partials/part_footer', $data);
    }
    public function userProperti() //Menambahkan user assign properti
    {
        $send = [
            'success'=>false
        ];
        $id = $this->input->post('txt_id');
        $properti = $this->input->post('user_properti');
        if (isset($properti)) {
            $query1 = $this->Muser->deleteAssignProperti($id);
            foreach ($properti as $key => $value) {
                $query1 = $this->Muser->getAssignProperti($id,$value);
                if ($query1 < 1 ) {
                    $send['success'] = true;
                    $get = $this->Muser->insertUserProperti($id,$value);
                }else{
                    $send['success'] = false;
                }
            }
        }else{
            $query1 = $this->Muser->deleteAssignProperti($id);
            $send['success'] = true;
        }
        return $this->output->set_output(json_encode($send));
    }
    public function hapus($id) //Menghapus User
    {
        $foto = $this->Muser->getDataWhere("foto_user","user",["id_user"=>$id])->row_array();
        if ($foto["foto_user"] != "default.jpg") {
            $path = "./assets/uploads/images/profil/user/".$foto["foto_user"];
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $hapus = $this->Muser->hapus($id);
        if ($hapus) {
            $data['success'] = true;
        } else {
            $data['success'] = false;
        }
        return $this->output->set_output(json_encode($data));
    }
    public function changePassword()
    {
        $this->load->library('form_validation');
        $data = ["success"=>false];
        $this->form_validation->set_rules('pw_baru', 'Password Baru', 'trim|required');
        $this->form_validation->set_rules('confirm_pw_baru', 'Confirm Password', 'trim|required|matches[pw_baru]');
        if ($this->form_validation->run() == FALSE) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else{
            $id = $this->input->post('input_hidden',true);
            $new_pass = $this->input->post("pw_baru",true);
            $password = password_hash($new_pass, PASSWORD_DEFAULT);
            $change = $this->Muser->updateData(["password"=>$password],"user",["id_user"=>$id]);
            if ($change) {
                $data["success"] = true;
            }
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}

/* End of file Controllername.php */
