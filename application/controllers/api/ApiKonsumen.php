<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class ApiKonsumen extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        $this->load->model('model_api',"mApi");
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    public function konsumen_get()
    {
        $id = $this->input->get("id",true);
        if (empty($id)) {
            $result = $this->mApi->getData("*","konsumen");
        }else{
            $result = $this->mApi->getData("*","konsumen",["id_konsumen"=>$id]);
        }
        if ($result->num_rows() > 0) {
            $data = $result->result();
            $this->response(["status"=>true,"data"=>$data],REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No Konsumen were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    public function tambahKonsumen_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('type_card', 'Pilih Type ', 'trim|required');
        $this->form_validation->set_rules('nama', 'Konsumen', 'trim|required');
        $this->form_validation->set_rules('id_card', 'Id Card', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|numeric|is_unique[konsumen.telp]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[konsumen.email]');
        if ($this->form_validation->run() ==  FALSE) {
            // Form Validation Errors
            $message = array(
                'status' => false,
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors()
            );
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        } else {
            $input = [
                "id_type"=>$this->input->post("type_card",true),
                "id_card"=>$this->input->post("id_card",true),
                "nama_lengkap"=>$this->input->post("nama",true),
                "alamat"=>$this->input->post("alamat",true),
                "telp"=>$this->input->post("no_telp",true),
                "email"=>$this->input->post("email",true),
                "status_konsumen"=>"calon konsumen",
                "tgl_buat"=>$this->input->post('tgl_buat',true),
                "id_user"=>$this->input->post('id_user',true),
            ];

            $query = $this->mApi->insertData($input,"konsumen");
            if ($query) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Data disimpan'
                ], REST_Controller::HTTP_CREATED); // NOT_FOUND (404) being the HTTP response code
            }else{
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Gagal disimpan'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        
        
    }

}
