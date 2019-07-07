<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class ApiKonsumen extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        // Load User Model
        $this->load->model('Model_api');
    }

    public function konsumen_get()
    {
        $id = $this->get("id_konsumen");
        if (!empty($id)) {
            $result = $this->Model_api->getData("*","konsumen",["id_konsumen"=>$id,"status_konsumen"=>"konsumen"])->row();
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
                    "message"=>"Data ditemukan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            $result = $this->Model_api->getData("*","konsumen",["status_konsumen"=>"konsumen"])->result();
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
                    "message"=>"Data ditemukan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }
        // Users from a data store e.g. database
    }
    public function calonKonsumen_get()
    {
        $id = $this->get("id_konsumen");
        if (!empty($id)) {
            $result = $this->Model_api->getData("*","konsumen",["id_konsumen"=>$id,"status_konsumen"=>"calon konsumen"])->row();
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
                    "message"=>"Data ditemukan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            $result = $this->Model_api->getData("*","konsumen",["status_konsumen"=>"calon konsumen"])->result();
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
                    "message"=>"Data ditemukan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }
        // Users from a data store e.g. database
    }

    public function typeCard_get()
    {
        $result = $this->Model_api->getData("*","type_id_card")->result();
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
                "message"=>"Data ditemukan"
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
    public function insertKonsumen_post()
    {
        $_POST = $this->security->xss_clean($_POST);
        $inputData = [
            "id_type"=>$this->post("id_type",true),
            "id_card"=>$this->post("id_card",true),
            "nama_lengkap"=>$this->post("nama_lengkap",true),
            "alamat"=>$this->post("alamat",true),
            "telp"=>$this->post("telp",true),
            "email"=>$this->post("email",true),
            "foto_ktp"=>"default.jpg",
            "status_konsumen"=>"calon konsumen",
            "id_user"=>$this->post("id_user",true),
            "tgl_buat"=>date("Y-m-d H:i:s"),
        ];
        if (!empty($inputData)) {
            $query = $this->Model_api->insertData($inputData,"konsumen");
            if ($query) {
                $response = [
                    "error"=>false,
                    "message"=>"Berhasil ditambahkan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_OK);
            }else{
                $response = [
                    "error"=>true,
                    "message"=>"Gagal ditambahkan"
                ];
                return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            $response = [
                "error"=>true,
                "message"=>"Tidak ada Data"
            ];
            return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function updateKonsumen_put()
    {
        $id = $this->put("id",true);
        // $this->set_response($_POST, REST_Controller::HTTP_OK);
        // return;
        if (!empty($id)) {
            $data = [
                "id_type"=>$this->put("id_type",true),
                "id_card"=>$this->put("id_card",true),
                "nama_lengkap"=>$this->put("nama_lengkap",true),
                "alamat"=>$this->put("alamat",true),
                "telp"=>$this->put("telp",true),
                "email"=>$this->put("email",true),
                "foto_ktp"=>$this->put("foto_ktp",true),
                "id_user"=>$this->put("id_user",true)
            ];
            $query = $this->Model_api->updateData($data,"konsumen",["id_konsumen"=>$id]);
            if ($query) {
                $response = [
                    "error"=>false,
                    "message"=>"Berhasil diupdate"
                ];
                return $this->set_response($response, REST_Controller::HTTP_OK);
            }else{
                $response = [
                    "error"=>true,
                    "message"=>"Masukkan Id"
                ];
                return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            $response = [
                "error"=>true,
                "message"=>"Data Kosong"
            ];
            return $this->set_response($response, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function deleteKonsumen_delete()
    {
        $id = (int) $this->delete('id');

        // Validate the id.
        if (!empty($id))
        {
            // Set the response and exit
            $this->Model_api->delete(["id_konsumen"=>$id],"konsumen");
            $response = [
                "error"=>false,
                "message"=>"Berhasil dihapus"
            ];
            return $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                "error"=>true,
                "message"=>"Gagal dihapus"
            ];
            return $this->set_response($response, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }
    }
}