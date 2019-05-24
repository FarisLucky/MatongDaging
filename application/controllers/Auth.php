<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_auth');
        // checkSession();
        
    }
    
    public function index()
    {
        if ($this->session->userdata('login') == true) {
            redirect('dashboard');
        }
        $this->load->view('auth_login/view_auth');
    }
    public function core_login()
    {
        $data = [
            "success" => false,
            'msg' => [],
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('auth_user','Username','trim|required');
        $this->form_validation->set_rules('auth_pass','Password','trim|required');
        // $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $input = [
                'username'=>$this->input->post('auth_user',true),
                'password'=>$this->input->post('auth_pass',true)    
            ];
            $user = $this->Model_auth->getUser($input);
            if ($user->num_rows() >0 ) {
                $rows = $user->row();
                if (password_verify($input['password'],$rows->password)) {
                    if ($rows->status_user === 'aktif') {
                        $data['auth'] = "Berhasil Login";
                        $data['success'] = true;
                        $data['redirect'] = "dashboard";
                        
                        $session=[
                            'id_user'=> $rows->id_user,
                            'username'=> $rows->username,
                            'id_akses'=> $rows->id_akses,
                            'login' => true
                        ];
                        $this->session->set_userdata($session);
                        if ($rows->id_akses != 1) {
                            $data['redirect'] =  'auth/kelompokproperti';
                        }
                    }else{
                        
                        $data['auth'] = "Akun Anda sedang diNonaktifkan";
                        $data['success'] = false;
                    }
                }
                else{
                    $data['auth'] = "Password tidak Cocok";
                    $data['success'] = false;
                }
            }
            else{
                $data['auth'] = "User tidak ditemukan";
                $data['success'] = false;
            }
        }
        return $this->output->set_output(json_encode($data));
        
    }

    public function logout()
    {
        // session_destroy();
        $this->session->sess_destroy();
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('errors/custom_error_access');
    }
    public function core_auth_properti()
    {
        $id = $this->input->post('value');
        $array = array(
            'id_properti' => $id
        );
        $this->session->set_userdata( $array );
        $data['success'] = true;
        $data['link'] = 'dashboard';
        $this->output->set_output(json_encode($data));
        
    }
    public function auth_properti()
    {
        if (empty($_SESSION['id_properti'])) {
            $id_user = $this->session->userdata('id_user');
            $getUser = $this->Model_auth->getPropertiAssign($id_user);
            if ($getUser->num_rows() > 0) {
                $result = $getUser->result();
                $query_result = [];
                foreach ($result as $key => $value) {
                    $id_properti = $value->id_properti;
                    $properti = $this->Model_auth->getPropertiWithId($id_properti);
                    $array = [];
                    $array['id'] = $properti->id_properti;
                    $array['nama'] = $properti->nama_properti;
                    $array['foto'] = $properti->foto_properti;
                    $query_result[] = $array;
                }
            }else{
                $query_result = null;
            }
            $data['properti_user'] = $query_result;
            $this->load->view('auth_login/view_auth_properti',$data);
        }
        else{
            redirect('dashboard');
        }
    }

}

/* End of file Auth.php */
