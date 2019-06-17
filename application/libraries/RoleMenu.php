<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RoleMenu
{
    private $CI;
    private $default_role = null;
	private $system_status = true;
	private $forbidden_controller = 'deny';
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    public function getMenus($active_menu = null,$active_sub_menu = null)
    {
        $sql = "select * from tbl_role_menu where id_akses = ?";
        $session = $this->CI->session->userdata('id_akses');
        $val = $this->CI->db->query($sql, $session)->result();
        $html = '';
        foreach ($val as $key => $value) {
            $url = (substr($value->url,0,1) == "#") ? $value->url : base_url($value->url);
            $sub_menu = $this->getSubMenus($value->id_menu,$value->url);
            $html .= '<li class="nav-item">
            <a class="nav-link" '.$sub_menu["collapse"].' href="'.$url.'">
                <i class="'.$value->icon.'"></i>
                <span class="menu-title">'.$value->menu.'</span>';
            $html .= $sub_menu["icons"];
            $html .= '</a>';
            $html .= $sub_menu["html"];
            $html .= '</li>';
        }
        return $html;
    }
    public function getSubMenus($id,$url_menu)
    {
        $data_array = [];
        $val = $this->CI->db->get_where('user_sub_menu', ['id_menu' => $id]);
        if ($val->num_rows() > 0) {
            $collap = ' data-toggle="collapse" aria-expanded="false" aria-controls="ui-basic"';
            $li = '<i class="menu-arrow"></i>';
            $html = '';
            $rows = $val->result();
            $html .= '<div class="collapse" id="' . ltrim($url_menu, "#") . '"> <ul class="nav flex-column sub-menu">';
            foreach ($rows as $key => $value) {
                if (!empty($value->nama_sub)) {
                    $html .= '<li class="nav-item"><a href="'.base_url($value->sub_url).'" class="nav-link" > '.$value->nama_sub.' </a></li>';
                }
            }
            $html .= '</ul>
            </div>';
        } else {
            $html = '';
            $collap = '';
            $li = '';
            $active_sub = '';
        }
        $data_array = ['collapse'=>$collap,'html'=>$html,'icons'=>$li];
        return $data_array;
    }
    public function getJavascript($id)
    {
        $this->CI->db->select('javascript');
        $hasil = $this->CI->db->get_where('user_sub_menu', ["id_sub" => $id]);
        return $hasil->row_array();
    }
    public function getMenuJavascript($id)
    {
        $this->CI->db->select('javascript');
        $hasil = $this->CI->db->get_where('user_menu', ["id_menu" => $id]);
        return $hasil->row_array();
    }


    // User Controller

	public function init() {

		return $this->isAccessGranted();

	}
	/**
	 * return the ID of logged in user
	 */
	public function getLoggedUser() {
		if ($this->CI->session->userdata('id_user') != null) {
			return $this->CI->session->userdata('id_user');
		} else {
			return false;
		}
		
	}

	/**
	 * return the current controller accessed by user
	 */
	public function getController() {
		$controller_uri = $this->CI->router->fetch_directory() . $this->CI->router->class;
		return $controller_uri;
	}

	/**
	 * return the role of logged in user
	 */
	public function getUserRole() {

		if ($this->getLoggedUser()) {
		
			$this->CI->db->select('id_akses');
			$this->CI->db->where('id_user', $this->getLoggedUser());
			$result = $this->CI->db->get('user')->row();
			return $result->id_akses;

		} else {

			return $this->default_role;

		}

	}

	/**
	 * get User Information to check role
	 */
	private function getProperti()
	{
		# code...
	}
	/**
	 * if user doesn't have access to the controller, redirect user to somewhere
	 */
	public function isAccessGranted() {
		
		if ($this->system_status) {
			if (!isset($_SESSION["login"])) {
				redirect("auth");
			}
			elseif ((!isset($_SESSION['id_properti'])) && ($_SESSION['id_akses'] != 1)) {
				redirect("auth/kelompokproperti");
			}else{
				$this->CI =& get_instance();
				$this->CI->db->where(array('id_akses' => $this->getUserRole(), 'controller' => $this->getController()));
				$query = $this->CI->db->get('user_controller');
				
				if ($query->num_rows() < 1) {
	
					redirect("auth/blocked");
	
				} 
			}
		}
	}
}
