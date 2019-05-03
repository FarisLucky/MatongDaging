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
            $row = $CI->db->get_where('user_sub_menu',['sub_url'=>$menu]);
            $get_sub = $row->row();
            $get = $get_sub->id_menu;

            $query = $CI->db->query("select * from tbl_role_menu where id_akses = ? AND id_menu = ?",[$session,$get]);

            if ($query->num_rows() < 1) {
                if ($CI->uri->segment(1) == $get_sub->sub_url) {
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
