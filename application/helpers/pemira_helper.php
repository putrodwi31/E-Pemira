<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('nim') && !$ci->session->userdata('token')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> Silahkan masuk terlebih dahulu!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth');
    } else {
        $level = $ci->session->userdata('level');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['nama_menu' => $menu])->row_array();
        $id_menu = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', ['level' => $level, 'id_menu' => $id_menu]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
