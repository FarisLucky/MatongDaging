<?php

function checkSession()
{ 
    $CI =& get_instance();
    $menu = $CI->uri->segment(1);
    if (!isset($_SESSION["login"])) {
        redirect("auth");
    }
    elseif (empty($menu)) {
        redirect('dashboard');
    }
    else{
        $session =  $CI->session->userdata('id_akses');
        // $menu = $CI->uri->segment(1);
        $rows = $CI->db->get_where('user_menu',['url'=>$menu]);
        if ($rows->num_rows() < 1) {
            $row = $CI->db->get_where('user_sub_menu',['controller'=>$menu]);
            $get_sub = $row->row();
            $get = $get_sub->id_menu;

            $query = $CI->db->query("select * from tbl_role_menu where id_akses = ? AND id_menu = ?",[$session,$get]);

            if ($query->num_rows() < 1) {
                if ($CI->uri->segment(1) == $get_sub->controller) {
                    redirect("auth/blocked");
                    return false;
                }
            }
        }
        else{
            $getId = $rows->row();
            $id_menu = $getId->id_menu;
            $query = $CI->db->query("select * from tbl_role_menu where id_akses = ? AND id_menu = ?",[$session,$id_menu]);
            if ($query->num_rows() < 1) {
                if ($CI->uri->segment(1) == $getId->url) {
                    redirect("auth/blocked");
                }
            }
        }
        // $sub_menu_query = ""; 
        // if(){

        // }
        
    }
}

function getCompanyLogo()
{
    $CI =& get_instance();
    $CI->db->select('logo_perusahaan');
    $get = $CI->db->get('data_perusahaan',1)->row();
    return $get;
}

function getProperti($properti,$id)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('user_assign_properti',['id_properti'=>"$properti",'id_user'=>$id]);
    if ($query->num_rows() > 0) {
        $value = "checked";
    }else{
        $value = "";
    }
    return $value;
}
