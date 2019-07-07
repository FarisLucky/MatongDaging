<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class ApiLogin extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        // Load User Model
        $this->load->model('Model_api');
    }

    public function login_post()
    {
        $_POST = $this->security->xss_clean($_POST);
        $input = [
            'username'=>$this->post('username'),
            'password'=>$this->post('password')    
        ];
        $user = $this->Model_api->getData("*","user",["username"=>$input["username"]]);
        if ($user->num_rows() > 0 ) {
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
                    $message = [
                        'error' => FALSE,
                        'data'=>$dataUser,
                        'message' => "Data didapatkan"
                    ];
                    return $this->response($message, REST_Controller::HTTP_OK);
                }else{
                    // Login Error
                    $message = [
                        'error' => TRUE,
                        'message' => "Akun sedang di nonAktifkan"
                    ];
                    return $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            else{
                // Login Error
                $message = [
                    'error' => TRUE,
                    'message' => "Password Tidak Cocok"
                ];
                return $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else{
            // Login Error
            $message = [
                'error' => TRUE,
                'message' => "Username Tidak ditemukan"
            ];
            return $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function dataUser_get()
    {
        $id = $this->get("id_user");
        if (!empty($id)) {
            $result = $this->Model_api->getData("*","user",["id_user"=>$id])->row();
            if ($result) {
                $response = [
                    "error"=>false,
                    "data"=>$result,
                    "message"=>"Data ditemukan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_OK);
            }else{
                $response = [
                    "error"=>true,
                    "message"=>"Data tidak ditemukan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            $response = [
                "error"=>true,
                "message"=>"Masukkan Id"
            ];
            return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
        }
        // Users from a data store e.g. database
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