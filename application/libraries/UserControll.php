<?php
/*
Author   : Fariz Yoga Syahputra
Facebook : http://www.facebook.com/yoga.aprilio
Github   : http://www.github.com/farizyoga
*/
if ( ! defined('BASEPATH')) exit('No direct access script allowed');

class UserControll {

	private $default_role = null;
	private $system_status = true;
	private $forbidden_controller = 'deny';

	public function init() {

		return $this->isAccessGranted();

	}

	/**
	 * return the ID of logged in user
	 */
	public function getLoggedUser() {

		$CI =& get_instance();
		if ($CI->session->userdata('id_user') != null) {
			return $CI->session->userdata('id_user');
		} else {
			return false;
		}
		
	}

	/**
	 * return the current controller accessed by user
	 */
	public function getController() {

		$CI =& get_instance();
		$controller_uri = $CI->router->fetch_directory() . $CI->router->class;
		return $controller_uri;
	}

	/**
	 * return the role of logged in user
	 */
	public function getUserRole() {

		$CI =& get_instance();
		if ($this->getLoggedUser()) {
		
			$CI->db->select('id_akses');
			$CI->db->where('id_user', $this->getLoggedUser());
			$result = $CI->db->get('user')->row();
			return $result->role;

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
				$CI =& get_instance();
				$CI->db->where(array('id_role' => $this->getUserRole(), 'controller_name' => $this->getController()));
				$query = $CI->db->get('controller_access');
				
				if ($query->num_rows() < 1) {
	
					redirect("home");
	
				} 
			}
		}
	}

}
