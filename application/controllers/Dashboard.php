<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        checkSession(); //Check Session 
    }
    
    public function index()
    {
        $active = 'Dashboard';
        $data['title'] = "Dashboard";
        $data['menus'] = $this->rolemenu->getMenus(null,$active);
        $data['js'] = $this->rolemenu->getMenuJavascript(1);
        $this->load->view('partials/part_navbar',$data);
        $this->load->view('partials/part_sidebar',$data);
        $this->load->view('view_dashboard',$data);
        $this->load->view('partials/part_footer',$data);
        $this->output->delete_cache("setting/profilperumahan");
        
    }

}

/* End of file Controllername.php */

