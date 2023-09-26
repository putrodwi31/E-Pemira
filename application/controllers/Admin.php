<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends CI_Controller
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
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{
		$data['user'] = $this->db->join('tbl_akses', 'tbl_dpt.nim=tbl_akses.nim', 'INNER')->get_where('tbl_dpt', ['tbl_dpt.nim' => $this->session->userdata('nim')])->row_array();
		$data['paslon'] = $this->db->order_by('no_urut', 'ASC')->get('data_paslon')->result_array();
		$data['title'] = 'Beranda';
		$this->form_validation->set_rules('nomor_paslon', 'Pilihan', 'required|trim', ['required' => '%s wajib diisi']);
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('admin/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			date_default_timezone_set('Asia/jakarta');
			$waktu = date('h:i:s A, d F Y');
			$nim = $this->session->userdata('nim');
			$nomor_paslon = $this->input->post('nomor_paslon');

			$cek = $this->db->query("SELECT * FROM tbl_paslon WHERE nim='$nim'")->num_rows();
			if ($cek > 0) {
				$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'Anda Sudah Memilih!',
					message: 'Anda tidak bisa melakukan voting lagi',
					position: 'topRight'
				  });</script>");
				redirect('admin');
			} else {
				$this->db->query("UPDATE tbl_dpt SET status='Sudah Memilih', waktu='$waktu' WHERE nim='$nim'");
				$this->db->query("INSERT INTO tbl_paslon(nim, nomor_paslon) VALUES ('$nim','$nomor_paslon')");
				$this->session->set_flashdata('toast', "<script>iziToast.success({
					title: 'Berhasil!',
					message: 'Voting Berhasil',
					position: 'topRight'
				  });</script>");
				redirect('admin');
			}
		}
	}
	public function data_paslon()
	{
		$data['title'] = 'Input Data Paslon';
		$data['user'] = $this->db->join('tbl_akses', 'tbl_dpt.nim=tbl_akses.nim', 'INNER')->get_where('tbl_dpt', ['tbl_dpt.nim' => $this->session->userdata('nim')])->row_array();
		$data['paslon'] = $this->db->order_by('id', 'DESC')->get('data_paslon')->result_array();
		$this->form_validation->set_rules('nim_ketua', 'NIM Calon Ketua', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('nm_paslon_ketua', 'Nama Calon Ketua', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('nim_wakil', 'NIM Calon Wakil', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('nm_paslon_wakil', 'Nama Calon Wakil', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('no_urut', 'No Urut', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('visi', 'Visi', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('misi', 'Misi', 'required|trim', ['required' => '%s wajib diisi']);
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('admin/data_paslon', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$nim_ketua = $this->input->post('nim_ketua');
			$nm_paslon_ketua = $this->input->post('nm_paslon_ketua');
			$nim_wakil = $this->input->post('nim_wakil');
			$nm_paslon_wakil = $this->input->post('nm_paslon_wakil');
			$no_urut = $this->input->post('no_urut');
			$visi = $this->input->post('visi');
			$misi = $this->input->post('misi');

			//proses input data disini
			$upload_image = $_FILES['gambar1']['name'];
			$upload_image2 = $_FILES['gambar2']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '4096';
				$config['upload_path'] = './assets/foto/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('gambar1')) {
					$gambar1 = $this->upload->data('file_name');
				} else {
					$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'Gambar tidak valid!',
					message: 'Gambar calon ketua tidak sesuai!',
					position: 'topRight'
				  });</script>");
					redirect('admin/data_paslon');
					die;
				}
			}
			if ($upload_image2) {
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '4096';
				$config['upload_path'] = './assets/foto/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('gambar2')) {
					$gambar2 = $this->upload->data('file_name');
				} else {
					$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'Gambar tidak valid!',
					message: 'Gambar calon wakil tidak sesuai',
					position: 'topRight'
				  });</script>");
					redirect('admin/data_paslon');
					die;
				}
			}
			$this->db->query("INSERT INTO data_paslon(id, nim_ketua, nm_paslon_ketua, gambar1, nim_wakil, nm_paslon_wakil, gambar2, no_urut,visi,misi) VALUES ('','$nim_ketua','$nm_paslon_ketua','$gambar1','$nim_wakil','$nm_paslon_wakil','$gambar2','$no_urut','$visi','$misi')");
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('toast', "<script>iziToast.success({
					title: 'Berhasil!',
					message: 'Berhasil input data paslon',
					position: 'topRight'
				  });</script>");
				redirect('admin/data_paslon');
			} else {
				$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'Gagal!',
					message: 'Gagal input data paslon',
					position: 'topRight'
				  });</script>");
				redirect('admin/data_paslon');
			}
		}
	}
	public function hapus_datapaslon($no_urut)
	{
		$data = $this->db->query("SELECT * FROM data_paslon WHERE no_urut='$no_urut'")->row_array();
		$gambar1 = $data['gambar1'];
		$gambar2 = $data['gambar2'];
		unlink(FCPATH . '/assets/foto/' . $gambar1);
		unlink(FCPATH . '/assets/foto/' . $gambar2);
		$this->db->query("DELETE FROM data_paslon WHERE no_urut='$no_urut'");
		$this->session->set_flashdata('toast', "<script>iziToast.success({
			title: 'Berhasil!',
			message: 'Data Paslon no urut $no_urut berhasil dihapus',
			position: 'topRight'
		  });</script>");
		redirect('admin/data_paslon');
	}
	public function dpt()
	{
		$data['user'] = $this->db->join('tbl_akses', 'tbl_dpt.nim=tbl_akses.nim', 'INNER')->get_where('tbl_dpt', ['tbl_dpt.nim' => $this->session->userdata('nim')])->row_array();
		$data['dpt'] = $this->db->query("SELECT * FROM tbl_dpt WHERE status='Sudah memilih'")->result_array();
		$data['title'] = 'Upload DPT';
		$this->form_validation->set_rules('q', 'Keyword', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('column', 'Pilihan', 'required|trim', ['required' => '%s wajib diisi']);
		if ($this->form_validation->run() == false) {
			$data['dptn'] = $this->db->query("SELECT * FROM tbl_dpt WHERE status='Belum memilih'")->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('admin/dpt', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$q = $this->input->post('q');
			$column = $this->input->post('column');

			if ($column == "nim") {
				$column = "nim";
				$sql = $this->db->query("SELECT * FROM tbl_dpt WHERE $column LIKE '%$q%' AND status='Belum Memilih'");
				if ($sql->num_rows() > 0) {
					$data['dptn'] = $sql->result_array();
				} else {
					$data['dptn'] = $this->db->query("SELECT * FROM tbl_dpt WHERE nama_mhs LIKE '%qqqqq%'")->result_array();
				}
			} else if ($column == "nama_mhs") {
				$column = "nama_mhs";
				$sql = $this->db->query("SELECT * FROM tbl_dpt WHERE $column LIKE '%$q%' AND status='Belum Memilih'");
				if ($sql->num_rows() > 0) {
					$data['dptn'] = $sql->result_array();
				} else {
					$data['dptn'] = $this->db->query("SELECT * FROM tbl_dpt WHERE nama_mhs LIKE '%qqqqq%'")->result_array();
				}
			} else if ($q == '' || $column == '') {
				$data['dptn'] = $this->db->query("SELECT * FROM tbl_dpt WHERE status='Belum memilih'")->result_array();
			}
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('admin/dpt', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	public function tambah_tdpt()
	{
		$this->form_validation->set_rules('nama', 'Keyword', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('nim', 'Keyword', 'required|trim', ['required' => '%s wajib diisi']);
		$this->form_validation->set_rules('email', 'Keyword', 'required|trim', ['required' => '%s wajib diisi']);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('toast', "<script>iziToast.error({
				title: 'Gagal!',
				message: 'DPT Gagal ditambahkan',
				position: 'topRight'
			  });</script>");
			redirect('admin/dpt');
		} else {
			$dataIn = [
				'nama_mhs' => $this->input->post('nama', true),
				'nim' => $this->input->post('nim', true),
				'email' => $this->input->post('email', true),
				'status' => 'Belum Memilih',
				'waktu' => '-'
			];
			$this->db->insert('tbl_dpt', $dataIn);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('toast', "<script>iziToast.success({
					title: 'Berhasil!',
					message: 'DPT berhasil ditambahkan',
					position: 'topRight'
				  });</script>");
				redirect('admin/dpt');
			} else {
				$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'Gagal!',
					message: 'DPT Gagal ditambahkan',
					position: 'topRight'
				  });</script>");
				redirect('admin/dpt');
			}
		}
	}
	public function tambah_dpt()
	{
		$tgl_sekarang = date('YmdHis'); // Ini akan mengambil waktu sekarang dengan format yyyymmddHHiiss
		$nama_file_baru = 'data' . $tgl_sekarang . '.xlsx';
		$file_dpt = $_FILES['file_dpt']['name'];
		if ($file_dpt) {
			$config['allowed_types'] = 'xlsx';
			$config['max_size'] = '40960';
			$config['upload_path'] = './assets/dpt/';
			$config['file_name'] = $nama_file_baru;

			$this->load->library('upload', $config);
			if (is_file(FCPATH . '/assets/dpt/' . $nama_file_baru)) {
				unlink(FCPATH . '/assets/dpt/' . $nama_file_baru);
			}
			if ($this->upload->do_upload('file_dpt')) {
				$data_dpt = $this->upload->data('file_name');
			} else {
				$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'File tidak valid!',
					message: 'File excel tidak sesuai!',
					position: 'topRight'
				  });</script>");
				redirect('admin/data_paslon');
				die;
			}
		}
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load(FCPATH . '/assets/dpt/' . $data_dpt); // Load file yang tadi diupload ke folder tmp
		$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$numrow = 1;
		$berhasil = 0;
		foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
			// Ambil data pada excel sesuai Kolom
			$nim = $row['A']; // Ambil data NIM
			$nama_mhs = $row['B']; // Ambil data nama
			$email = $row['C']; // Ambil data email
			// Cek jika semua data tidak diisi
			if ($numrow != 1) {
				if ($nim != "" && $nama_mhs != "" && $email != "") {
					// input data ke database (table tbl_dpt)
					$this->db->query("INSERT INTO tbl_dpt values('$nim','$nama_mhs','Belum Memilih','$email','-')");
					$berhasil++;
				}
			}
			$numrow++; // Tambah 1 setiap kali looping
		}
		unlink(FCPATH . '/assets/dpt/' . $data_dpt);
		$this->session->set_flashdata('toast', "<script>iziToast.success({
			title: 'Berhasil!',
			message: '$berhasil DPT berhasil ditambahkan',
			position: 'topRight'
		  });</script>");
		redirect('admin/dpt');
	}
	public function hapus_dpt($nim)
	{
		$this->db->query("DELETE FROM tbl_dpt WHERE nim='$nim'");
		$this->session->set_flashdata('toast', "<script>iziToast.success({
			title: 'Berhasil!',
			message: 'Data DPT $nim berhasil dihapus',
			position: 'topRight'
		  });</script>");
		redirect('admin/dpt');
	}
	public function hasil()
	{
		$data['user'] = $this->db->join('tbl_akses', 'tbl_dpt.nim=tbl_akses.nim', 'INNER')->get_where('tbl_dpt', ['tbl_dpt.nim' => $this->session->userdata('nim')])->row_array();
		$data['title'] = 'Hasil Suara';
		$data['paslon1'] = $this->db->query("SELECT * FROM tbl_paslon WHERE nomor_paslon='1'")->num_rows();
		$data['paslon2'] = $this->db->query("SELECT * FROM tbl_paslon WHERE nomor_paslon='2'")->num_rows();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/hasil', $data);
		$this->load->view('templates/footer', $data);
	}
	public function akses()
	{
		$data['user'] = $this->db->join('tbl_akses', 'tbl_dpt.nim=tbl_akses.nim', 'INNER')->get_where('tbl_dpt', ['tbl_dpt.nim' => $this->session->userdata('nim')])->row_array();
		$data['title'] = 'Buat Akses';
		$this->form_validation->set_rules('nim', 'NIM', 'required|trim', ['required' => '%s wajib diisi']);
		if ($this->form_validation->run() == false) {
			$data['nim'] = '';
			$data['email'] = '';
			$data['hasil'] = '';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('admin/akses', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$data['nim'] = $this->input->post('nim');
			$data['hasil'] = $this->_getCode(6);
			$nim = $data['nim'];
			$query = $this->db->query("SELECT email FROM tbl_dpt WHERE nim='$nim'");
			if ($query->num_rows() > 0) {
				$dati = $query->row_array();
				$data['email'] = $dati['email'];
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('admin/akses', $data);
				$this->load->view('templates/footer', $data);
			} else {
				$data['nim'] = '';
				$data['email'] = '';
				$data['hasil'] = '';
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('admin/akses', $data);
				$this->load->view('templates/footer', $data);
				$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'NIM tidak ditemukan!',
					message: 'Perhatikan penulisan NIM!',
					position: 'topRight'
				  });</script>");
				redirect('admin/akses');
			}
		}
	}
	public function buat_akses()
	{

		$this->form_validation->set_rules('nim', 'NIM', 'required|trim', ['required' => '%s wajib diisi']);

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('toast', "<script>iziToast.error({
				title: 'Gagal!',
				message: 'Silahkan filter data terlebih dahulu',
				position: 'topRight'
			  });</script>");
			redirect('admin/akses');
		} else {
			$nim = $this->input->post('nim');
			$kode_akses = $this->input->post('kode_akses');

			$cek = $this->db->query("SELECT * FROM tbl_akses WHERE nim='$nim'")->num_rows();
			if ($cek > 0) {
				$this->session->set_flashdata('toast', "<script>iziToast.error({
				title: 'NIM Sudah terdaftar!',
				message: 'NIM sudah memilik akses!',
				position: 'topRight'
			  });</script>");
				redirect('admin/akses');
			} else {

				$mail = new PHPMailer(true);
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      			//Enable verbose debug output
				$mail->isSMTP();                                            			//Send using SMTP
				$mail->Host       = $_ENV['SMTP_HOST'];                     				//Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   			//Enable SMTP authentication
				$mail->Username   = $_ENV['SMTP_EMAIL'];                	     		//SMTP username
				$mail->Password   = $_ENV['SMTP_PASS'];                               	//SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            			//Enable implicit TLS encryption
				$mail->Port       = intval($_ENV['SMTP_PORT']); 												//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
				$this->db->query("INSERT INTO tbl_akses(nim, kode_akses, level) VALUES ('$nim','$kode_akses','user')");
				if ($this->db->affected_rows() > 0) {
					$query = $this->db->query("SELECT email, kode_akses FROM tbl_dpt INNER JOIN tbl_akses ON tbl_dpt.nim=tbl_akses.nim WHERE tbl_dpt.nim='$nim'")->row_array();
					$email = $query['email'];
					$kode_akses2 = $query['kode_akses'];

					$mail->setFrom($_ENV['SMTP_EMAIL'], 'BEM BIU'); 					//Add a recipient
					$mail->addAddress($email);											//Set email receipt
					$mail->isHTML(true);                                  				//Set email format to HTML

					$mail->Subject = "BEM BIU (KODE AKSES - E-PEMIRA)";
					$body2 = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
				<div style="margin:50px auto;width:70%;padding:20px 0">
				  <div style="border-bottom:1px solid #eee">
					<a href="" style="font-size:1.4em;color: #093D77;text-decoration:none;font-weight:600">E-Pemira</a>
				  </div>
				  <p style="font-size:1.1em">Hi BiU Friends,</p>
				  <p>Ini kode aktivasi email kamu ya!. Jangan sampai lupa apalagi tertinggal. Jangan sampai golput ya teman teman.</p>
				  <h2 style="background: #093D77;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $kode_akses2 . '</h2>
				  <p>Silahkan login menggunakan NIM : <b>' . $nim . '</b></p>
				  <p style="font-size:0.9em;">Terimakasih!,<br />E-Pemira</p>
				  <hr style="border:none;border-top:1px solid #eee" />
				  <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
					<p>E-Pemira</p>
					<p>Badan Eksekutif Mahasiswa</p>
					<p>Universitas Bina Insani</p>
				  </div>
				</div>
			  </div>';
					$body1 = '<br><b>Hi BiU Friends</b></br>
 
			  <br>Ini kode aktivasi email kamu ya!<br>
			  <br>jangan sampai lupa apalagi tertinggal.<br>
			  <br>Jangan sampai golput ya teman teman.<br>

			  <br>NIM : <b>' . $nim . '</b></br>
			  <br>Kode Akses : <b>' . $kode_akses2 . '</b><br>

			  <br>Terimakasih!<br>';
					$mail->Body    = "$body2";
					if ($mail->send()) {
						$this->session->set_flashdata('toast', "<script>iziToast.success({
						title: 'Email berhasil terkirim!',
						message: 'Email kode akses terkirim ke $email!',
						position: 'topRight'
					  });</script>");
						redirect('admin/akses');
					} else {
						$this->session->set_flashdata('toast', "<script>iziToast.success({
						title: 'Gagal mengirim Email!',
						message: 'Silahkan cek kembali email $email!',
						position: 'topRight'
					  });</script>");
						redirect('admin/akses');
					}
				} else {
					$this->session->set_flashdata('toast', "<script>iziToast.error({
					title: 'Gagal Input!',
					message: 'gagal melakukan input ke database!',
					position: 'topRight'
				  });</script>");
					redirect('admin/akses');
				}
			}
		}
	}
	public function modal()
	{
		$userid = $this->input->post('userid');
		$row = $this->db->get_where('data_paslon', ['id' => $userid])->result();
		foreach ($row as $r) {
			echo "
		<table border='0' width='100%'>
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
		</table>
		";
		}
	}
	private function _getCode($panjang)
	{
		$kode_akses = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
		$string = '';
		for ($i = 0; $i < $panjang; $i++) {
			$pos = rand(0, strlen($kode_akses) - 1);
			$string .= $kode_akses[$pos];
		}
		return $string;
	}
}
