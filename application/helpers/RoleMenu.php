<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class RoleMenu
{
    private $CI;
    
    public function __construct()
    {
        $this->$CI=& get_instance();
    }
    
    public function getMenu()
    {
        $val = $this->CI->db->get('user_menu');
        return $val->result();
    }
}
