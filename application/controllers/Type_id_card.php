<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Type_id_card extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->load->model("Type_id_card");
    }


    public function edit()
    {
        $this->load->view('v_edit_type_id_card');
    }

    function tambah(){
        $this->load->view('v_input');
        $active = 'Type Id Card';
        $data['title'] = 'Tambah Type Id Card';
        $data['menus'] = $this->rolemenu->getMenus($active);
        $data['js'] = $this->rolemenu->getJavascript(4); //Jangan DIUbah !!
        $data['akses'] = $this->Muser->getAkses(); //Mengambil data role akses 
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('kelola_user/view_tambah_type id card',$data);
        $this->load->view('partials/part_footer',$data);
    }
 
    function tambah_aksi(){
        $id_type = $this->input->post('id_type');
        $nama_type = $this->input->post('nama_type');
        
        $data = array(
            'id_type' => $id_type,
            'nama_type' => $nama_type,
            );
        $this->m_data->input_data($data,'user');
        redirect('crud/index');
    }


    
    public function index()
    {
        $active = 'Type_id_card';
        $data['title'] = "Type_id_card";
        $data['menus'] = $this->rolemenu->getMenus($active);
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('type_id_card/v_type_id_card',$data);
        $this->load->view('partials/part_footer',$data);
        
    }


}

/* End of file Controllername.php */

