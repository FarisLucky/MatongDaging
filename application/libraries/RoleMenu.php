<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class RoleMenu
{
    private $CI;
    
    public function __construct()
    {
        $this->CI=& get_instance();
    }
    public function getMenus($active_menu = null,$active_sub_menu = null)
    {
        $sql = "select * from tbl_role_menu where id_akses = ?";
        $session = $this->CI->session->userdata('id_akses');
        $val = $this->CI->db->query($sql,$session)->result();
        $html='';
        foreach ($val as $key => $value) {
            $active = ($active_menu == $value->menu) ? $active_menu="active" : $active_menu="";
            $url = (substr($value->url,0,1) == "#")?$value->url:base_url($value->url);
            $sub_menu = $this->getSubMenus($value->id_menu,$active_sub_menu,$value->url);
            $html .= '<li class="nav-item '.$active.'">
            <a class="nav-link" '.$sub_menu["collapse"].' href="'.$url.'">
                <i class="'.$value->icon.'"></i>
                <span class="menu-title">'.$value->menu.'</span>';
            $html .= $sub_menu["icons"];
            $html .='</a>';
            $html .= $sub_menu["html"];
            $html .='</li>';
        }
        return $html;
    }
    public function getSubMenus($id,$active_menu,$url_menu)
    {
        $data_array=[];
        $val = $this->CI->db->get_where('user_sub_menu',['id_menu'=>$id]);
        if ($val->num_rows() > 0) {
            $collap =' data-toggle="collapse" aria-expanded="false" aria-controls="ui-basic"';
            $li = '<i class="menu-arrow"></i>';
            $html = '';
            $rows = $val->result();
            $html .= '<div class="collapse" id="'.ltrim($url_menu,"#").'">
            <ul class="nav flex-column sub-menu">';
            foreach ($rows as $key => $value) {
                $active_sub = ($value->nama_sub == $active_menu) ? $active_menu = 'active': $active_menu='';
                $html .= '<li class="nav-item"><a class="nav-link '.$active_sub.'" href="'.base_url($value->sub_url).'"> '.$value->nama_sub.' </a>
                    </li>';
            }
            $html .= '</ul>
            </div>';
        }
        else {
            $html = '';$collap='';$li='';$active_sub='';
        }
        $data_array = ['collapse'=>$collap,'html'=>$html,'icons'=>$li,'active_sub'=>$active_sub];
        return $data_array;
    }
    public function getJavascript($id)
    {
        $this->CI->db->select('javascript');
        $hasil = $this->CI->db->get_where('user_sub_menu',["id_sub"=>$id]);
        return $hasil->result_array();
    }
    public function getMenuJavascript($id)
    {
        $this->CI->db->select('javascript');
        $hasil = $this->CI->db->get_where('user_menu',["id_menu"=>$id]);
        return $hasil->result_array();
    }
}
