<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->join('tbl_akses', 'tbl_dpt.nim=tbl_akses.nim', 'INNER')->get_where('tbl_dpt', ['tbl_dpt.nim' => $this->session->userdata('nim')])->row_array();
        $data['paslon'] = $this->db->order_by('no_urut', 'ASC')->get('data_paslon')->result_array();
        $this->form_validation->set_rules('nomor_paslon', 'Pilihan', 'required|trim', ['required' => '%s wajib diisi']);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            date_default_timezone_set('Asia/jakarta');
            $waktu = date('H:i:sa');
            $nim = $this->session->userdata('nim');
            $nomor_paslon = $this->input->post('nomor_paslon');

            $cek = $this->db->query("SELECT * FROM tbl_paslon WHERE nim='$nim'")->num_rows();
            if ($cek > 0) {
                $this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'Anda Sudah Memilih!',
					message: 'Anda tidak bisa melakukan voting lagi',
					position: 'topRight'
				  });</script>");
                redirect('user');
            } else {
                $this->db->query("UPDATE tbl_dpt SET status='Sudah Memilih', waktu='$waktu' WHERE nim='$nim'");
                $this->db->query("INSERT INTO tbl_paslon(nim, nomor_paslon) VALUES ('$nim','$nomor_paslon')");
                $this->session->set_flashdata('toast', "<script>iziToast.success({
					title: 'Berhasil!',
					message: 'Voting Berhasil',
					position: 'topRight'
				  });</script>");
                redirect('user');
            }
        }
    }
    public function modal()
    {
        $userid = $this->input->post('userid');
        $row = $this->db->get_where('data_paslon', ['id' => $userid])->result();
        foreach ($row as $r) {
            echo "<table border='0' width='100%'>
                    <tr>
                        <td><h6 class='text-center'>VISI</h6></td>
                    </tr>
		            <tr>
                        <td>$r->visi</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><h6 class='text-center'>MISI</h6></td>
                    </tr>
                    <tr>
                        <td>$r->misi</td>
                    </tr>
		        </table>";
        }
    }
}
