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

}

/* End of file Auth.php */
