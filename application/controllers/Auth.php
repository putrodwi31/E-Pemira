<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        //Cek Apakah User Sudah Login
        if ($this->session->userdata('nim') && $this->session->userdata('token')) {
            $result = $this->db->query("SELECT token FROM user_token where nim='" . $this->session->userdata('nim') . "'");
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $token = $row['token'];
                if ($this->session->userdata('token') == $token) {
                    redirect($this->session->userdata('level') == 'admin' ? 'admin' : 'user');
                }
            }
        }
        $this->form_validation->set_rules('nim', 'Nomor Induk Mahasiswa', 'required|trim', ['required' => '%s wajib diisi']);
        $this->form_validation->set_rules('kode_akses', 'Kode Akses', 'required|trim', ['required' => '%s wajib diisi']);
        $this->form_validation->set_rules('captcha', 'Kode Captcha', 'required|trim', ['required' => '%s wajib diisi']);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Masuk';
            $this->load->view('auth/login', $data);
        } else {
            // validasinya Success
            $this->_login();
        }
    }
    // membuat token
    private function _getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }
    private function _login()
    {

        $ip_address = $this->input->ip_address();
        $time = time() - 30; //30 detik  
        $check_attmp = $this->db->query("SELECT COUNT(*) AS total_count FROM attempt_count WHERE time_count>$time AND ip_address='$ip_address'")->row_array();
        $total_count = $check_attmp['total_count'];
        $captcha = $this->input->post('captcha');

        if ($total_count == 3) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> Anda Mencoba Terlalu Banyak Tunggu 30 Detik!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('auth');
        } elseif ($this->session->userdata('captcha') == $captcha) {

            $kode_aksess = $this->input->post('kode_akses');
            $nimk = $this->input->post('nim');
            $data_akses = $this->db->query("SELECT * FROM tbl_akses INNER JOIN tbl_dpt ON tbl_akses.nim = tbl_dpt.nim WHERE kode_akses='$kode_aksess' AND tbl_akses.nim ='$nimk'");
            $r = $data_akses->row_array();

            $nim = $r['nim'];
            $kode_akses = $r['kode_akses'];
            $nama_mhs = $r['nama_mhs'];
            $level = $r['level'];
            if ($total_count == 3) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> Anda Mencoba Terlalu Banyak Tunggu 30 Detik!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('auth');
            } else if ($data_akses->num_rows() == 1) {
                $data = [
                    'nama_mhs' => $nama_mhs,
                    'nim' => $nim,
                    'kode_akses' => $kode_akses,
                    'level' => $level
                ];
                $this->session->set_userdata($data);

                $sql_query = "SELECT count(*) AS cntUser FROM tbl_akses WHERE nim='" . $nimk . "' AND kode_akses='" . $kode_aksess . "'";
                $result = $this->db->query($sql_query);
                $row = $result->row_array();
                $count = $row['cntUser'];

                if ($count > 0) {
                    $token = $this->_getToken(10);
                    $data = [
                        'nim' => $nimk,
                        'token' => $token
                    ];
                    $this->session->set_userdata($data);
                    // Update user token 
                    $result_token = $this->db->query("SELECT count(*) AS allcount FROM user_token WHERE nim='" . $nimk . "' ");
                    $row_token = $result_token->row_array();
                    if ($row_token['allcount'] > 0) {
                        $this->db->query("UPDATE user_token set token='" . $token . "' where nim='" . $nimk . "'");
                    } else {
                        $this->db->query("INSERT into user_token(nim,token) values('" . $nimk . "','" . $token . "')");
                    }
                    $this->session->set_flashdata('toast', "<script>iziToast.success({
                        title: 'Berhasil!',
                        message: 'Masuk Berhasil',
                        position: 'topRight'
                      });</script>");
                    redirect($level == 'admin' ? 'admin' : 'user');
                }
                $this->db->query("DELETE from attempt_count where ip_address='$ip_address'");
            } else {
                $total_count++;
                $time_remain = 3 - $total_count;
                $time = time();
                if ($time_remain == 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> Anda Mencoba Terlalu Banyak Tunggu 30 Detik!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> <strong>NIM Atau Kode Akses Salah.</strong><br>' . $time_remain . ' Percobaan Tersisa!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
                $this->db->query("INSERT INTO `attempt_count`(`ip_address`, `time_count`) VALUES ('$ip_address','$time')");
                redirect('auth');
            }
        } else {
            $total_count++;
            $time_remain = 3 - $total_count;
            $time = time();
            if ($time_remain == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> Anda Mencoba Terlalu Banyak Tunggu 30 Detik!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> <strong>Kode Captcha Salah.</strong><br>' . $time_remain . ' Percobaan Tersisa!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            $this->db->query("INSERT INTO `attempt_count`(`ip_address`, `time_count`) VALUES ('$ip_address','$time')");
            redirect('auth');
        }
    }
    public function captcha()
    {
        $rand_num = rand(11111, 99999);
        $data = [
            'captcha' => $rand_num
        ];
        $this->session->set_userdata($data);
        $layer = imagecreatetruecolor(60, 30);
        $captcha_bg = imagecolorallocate($layer, 255, 160, 120);
        imagefill($layer, 0, 0, $captcha_bg);
        $captcha_text_color = imagecolorallocate($layer, 0, 0, 0);
        imagestring($layer, 5, 5, 5, $rand_num, $captcha_text_color);
        header('Content-Type:image/jpeg');
        imagejpeg($layer);
    }
    public function logout()
    {
        $array_items = array('nim', 'nama_mhs', 'token', 'level', 'kode_akses');
        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle"></i> Berhasil keluar!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
    public function notfound()
    {
        $this->load->view('auth/notfound');
    }
}
