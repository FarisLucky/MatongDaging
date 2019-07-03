<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class ApiLogin extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        // Load User Model
        $this->load->model('Model_auth');
    }

    public function login_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        if ($this->form_validation->run() == false) {
            $message = array(
                'status' => false,
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors()
            );

            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
        else{
            $input = [
                'username'=>$this->input->post('username',true),
                'password'=>$this->input->post('password',true)    
            ];
            $user = $this->Model_auth->getUser($input);
            if ($user->num_rows() >0 ) {
                $rows = $user->row();
                if (password_verify($input['password'],$rows->password)) {
                    if ($rows->status_user === 'aktif') {
                        $data['auth'] = "Berhasil Login";
                        $data['success'] = true;
                        $data['redirect'] = "dashboard";
                        $token = [];
                        $token["user"] = $rows->username;
                        $token["id_akses"] = $rows->id_akses;
                        $encrypt = AUTHORIZATION::generateToken($token);
                        $dataUser=[
                            'id_user'=> $rows->id_user,
                            'username'=> $rows->username,
                            'id_akses'=> $rows->id_akses,
                            'token' => $encrypt
                        ];
                        $this->set_response($dataUser, REST_Controller::HTTP_OK);
                    }else{
                        // Login Error
                        $message = [
                            'status' => FALSE,
                            'message' => "Akun sedang di nonAktifkan"
                        ];
                        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                    }
                }
                else{
                    // Login Error
                    $message = [
                        'status' => FALSE,
                        'message' => "Password Tidak Cocok"
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else{
                // Login Error
                $message = [
                    'status' => FALSE,
                    'message' => "Username Tidak ditemukan"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
    // public function token_post()
    // {
    //     $headers = $this->input->request_headers();

    //     if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
    //         $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
    //         if ($decodedToken != false) {
    //             $this->set_response($decodedToken, REST_Controller::HTTP_OK);
    //             return;
    //         }
    //     }

    //     $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    // }
}