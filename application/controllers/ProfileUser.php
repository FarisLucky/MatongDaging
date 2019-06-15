<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilUser extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    
    public function index()
    {
        
    }

    public function user()
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
}

/* End of file Controllername.php */
