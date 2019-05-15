<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_perusahaan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->model('Model_profil_perusahaan','Mperusahaan');
        checkSession();
    }
    
    public function index()
    {
        $active = 'Profil Perusahaan';
        $data['title'] = 'Profil';
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getJavascript(2);
        $data['perusahaan'] = $this->Mperusahaan->getPerusahaan();
        $data['img'] = getCompanyLogo();
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('profil_perusahaan/view_profil',$data);
        $this->load->view('partials/part_footer',$data);
    }
    public function update()
    {
        
        $data = [
            "success" => false,
            "title" =>'Profil Perusahaan berhasil Diubah',
            'msg' => [],
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_siup','SIUP','trim|required');
        $this->form_validation->set_rules('txt_tdp','TDP','trim|required');
        $this->form_validation->set_rules('txt_namaperusahaan','Nama','trim|required');
        $this->form_validation->set_rules('txt_email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('txt_telp','Telp','trim|required');
        $this->form_validation->set_rules('txt_alamat','Alamat','trim|required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">','</div>');        
        if ($this->form_validation->run() == false) {
            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        }
        else{
            $config['upload_path'] = './assets/uploads/images/properti/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload', $config);
            if ($_FILES['image']['name'] != "") {
                if ($this->upload->do_upload('image')){
                    $link = $this->Mperusahaan->getLogo(3);
                    $path = "./assets/uploads/images/properti/".$link[0]['logo_perusahaan'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    else{
                        $data['error'] = "tidak ditemukan";
                    }
                    $img = $this->upload->data();
                    $data_id = $this->input->post('txt_id');
                    $where = $this->encryption->decrypt($data_id);
                    $input = [
                        'siup'=>$this->input->post('txt_siup',true),
                        'tdp'=>$this->input->post('txt_tdp',true),
                        'nama'=>$this->input->post('txt_namaperusahaan',true),
                        'email'=>$this->input->post('txt_email',true),
                        'telp'=>$this->input->post('txt_telp',true),
                        'alamat'=>$this->input->post('txt_alamat'),
                        'img' => $img['file_name']
                    ];
                    $this->Mperusahaan->updateData($input,$where);
                    $data['success'] = true;
                }
                else {
                    $data['error'] = $this->upload->display_errors();
                }
            }
            else{
                    $input = [
                        'siup'=>$this->input->post('txt_siup',true),
                        'tdp'=>$this->input->post('txt_tdp',true),
                        'nama'=>$this->input->post('txt_namaperusahaan',true),
                        'email'=>$this->input->post('txt_email',true),
                        'telp'=>$this->input->post('txt_telp',true),
                        'alamat'=>$this->input->post('txt_alamat'),
                        'img'=>''
                    ];
                    $data_id = $this->input->post('txt_id');
                    $where = $this->encryption->decrypt($data_id);
                    $this->Mperusahaan->updateData($input,$where);
                    $data['success'] = true;
            }
        }
        echo json_encode($data);
    }
}

/* End of file ProfilPerumahan.php */
