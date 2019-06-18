<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_dashboard');
        $session = $this->session->userdata('id_user');
        if (empty($session)) {
            redirect('auth');
        }
    }
    public function index()
    {
        if ($this->session->userdata('login') == null) {
            redirect('auth');
        }else{
            $id_user = $this->session->userdata('id_user');
            $query = $this->Model_dashboard->getDataWhere('user',['id_user'=>$id_user])->row();
            if ($query->id_akses == 1) {
                redirect('dashboard/owner');
            }elseif ($query->id_akses == 2) {
                redirect('dashboard/manager');
            }elseif ($query->id_akses == 3) {
                redirect('dashboard/sekretaris');
            }elseif ($query->id_akses == 4) {
                redirect('dashboard/marketing');
            }else{
                redirect('dashboard/bendahara');
            }
        }
    }
    public function owner()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->Model_dashboard->getDataWhere('user',['id_user'=>$id_user])->row();
        if ($query->id_akses != 1) {
            redirect('auth/blocked');
        }
        else{
            $data['title'] = "Dashboard";
            $data['menus'] = $this->rolemenu->getMenus();
            $data['js'] = $this->rolemenu->getMenuJavascript(1);
            $this->load->view('partials/part_navbar',$data);
            $this->load->view('partials/part_sidebar',$data);
            $this->load->view('view_dashboard',$data);
            $this->load->view('partials/part_footer',$data);
        }
    }
    public function manager()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->Model_dashboard->getDataWhere('user',['id_user'=>$id_user])->row();
        if ($query->id_akses != 2) {
            redirect('auth/blocked');
        }else{
            $data['title'] = "Manager Dashboard";
            $data['menus'] = $this->rolemenu->getMenus();
            $data['js'] = $this->rolemenu->getMenuJavascript(1);
            $this->load->view('partials/part_navbar',$data);
            $this->load->view('partials/part_sidebar',$data);
            $this->load->view('view_dashboard',$data);
            $this->load->view('partials/part_footer',$data);
        }
    }
    public function marketing()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->Model_dashboard->getDataWhere('user',['id_user'=>$id_user])->row();
        if ($query->id_akses != 4) {
            redirect('auth/blocked');
        }else{
            $data['title'] = "Marketing Dashboard";
            $data['menus'] = $this->rolemenu->getMenus();
            $data['js'] = $this->rolemenu->getMenuJavascript(1);
            $this->load->view('partials/part_navbar',$data);
            $this->load->view('partials/part_sidebar',$data);
            $this->load->view('view_dashboard',$data);
            $this->load->view('partials/part_footer',$data);
        }
        
    }
    public function bendahara()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->Model_dashboard->getDataWhere('user',['id_user'=>$id_user])->row();
        if ($query->id_akses != 5) {
            redirect('auth/blocked');
        }else{
            $data['title'] = "Bendahara Dashboard";
            $data['menus'] = $this->rolemenu->getMenus();
            $data['js'] = $this->rolemenu->getMenuJavascript(1);
            $this->load->view('partials/part_navbar',$data);
            $this->load->view('partials/part_sidebar',$data);
            $this->load->view('view_dashboard',$data);
            $this->load->view('partials/part_footer',$data);
        }
    }
    public function sekretaris()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->Model_dashboard->getDataWhere('user',['id_user'=>$id_user])->row();
        if ($query->id_akses != 3) {
            redirect('auth/blocked');
        }else{
            $data['title'] = "Sekretaris Dashboard";
            $data['menus'] = $this->rolemenu->getMenus();
            $data['js'] = $this->rolemenu->getMenuJavascript(1);
            $this->load->view('partials/part_navbar',$data);
            $this->load->view('partials/part_sidebar',$data);
            $this->load->view('view_dashboard',$data);
            $this->load->view('partials/part_footer',$data);
        }
    }

}

/* End of file Controllername.php */

