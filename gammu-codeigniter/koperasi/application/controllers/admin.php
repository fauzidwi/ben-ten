<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
	
		$this->load->library('session');
	}


	//LOGIN SISTEM
	
	public function admin_login(){ 
		$nama=$_POST['form-username'];
		$pass=$_POST['form-password'];
		$x=$this->mymodel->login($nama,$pass);
			if($x=='fail'){
				$this->load->view('login_failure');
			}else {
				if($x=='success'){
				$this->session->set_userdata('loggedin', true);
				$this->load->view('panel');
			}
		}
	}

	public function dashboard(){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$this->load->view('panel');
		}
	}

	public function logout() {
		$this->session->unset_userdata('loggedin');
		redirect('welcome');
	}

	public function edit_user() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$this->load->view('edit_user');
		}
	}

	public function edit_user_fail() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$this->load->view('edit_user_fail');
		}
	}

	public function inbox() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$res=$this->mymodel->update_status();
			if($res>=1){
					$data['data']=$this->mymodel->inbox();
					$this->load->view('inbox',$data);
			}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("UPDATE GAGAL")'; 
					echo '</script>'; 
			}
		}
	}

	public function outbox() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$data['data']=$this->mymodel->sentitems();
			$this->load->view('outbox',$data);
		}
	}

	public function send() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$data['data']=$this->mymodel->phone_member();
			$this->load->view('send',$data);
		}
	}

	public function nasabah() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$data['data']=$this->mymodel->getnasabah();
			$this->load->view('data',$data);
		}
	}

	public function broadcast() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$this->load->view('broadcast');
		}
	}

	public function user_update(){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$temp=$this->mymodel->cekpass($_POST['form-oldpassword']);
			if($temp=='success'){
				$res=$this->mymodel->edit_pass($_POST['form-username'],$_POST['form-newpassword']);
				if($res>=1){
					redirect('admin/dashboard');
				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("UPDATE GAGAL")'; 
					echo '</script>'; 
				}
			}
			else {
				redirect('admin/edit_user_fail');
			}
		}
	}

	public function get_inbox() {
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
		$data=$this->mymodel->get_inbox();
		$data=$data[0]['count'];
		echo json_encode($data);
		}
	}

	public function delete_inbox($index){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$res=$this->mymodel->delete('inbox','ID = '.$index);
			if($res>=1){
					redirect('admin/inbox');
				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("DELETE GAGAL")'; 
					echo '</script>'; 
			}
		}	
	}

	public function reply_inbox($index){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$res=$this->mymodel->specific_inbox($index);
			$data['result']=$res[0]['SenderNumber'];
			$this->load->view('reply',$data);
		}
	}

	public function reply(){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$no=$_POST['NoTujuan'];
			$msg=$_POST['pesan'];
			$data_insert=$this->mymodel->InsertNew('outbox',array(
				  'DestinationNumber' => $no,
				  'TextDecoded' => $msg,
				  'SenderID' => 'phone1',
				  'CreatorID' => 'Gammu 1.33.0',
				)
			);
			if($data_insert>=1){
				redirect('admin/inbox');
			}else{
				echo '<script type="text/javascript">'; 
				echo 'alert("INSERT GAGAL")'; 
				echo '</script>'; 
			}
		}	
	}

	public function delete_outbox($index){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$res=$this->mymodel->delete('sentitems','ID = '.$index);
			if($res>=1){
					redirect('admin/outbox');
				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("DELETE GAGAL")'; 
					echo '</script>'; 
			}
		}	
	}

	public function send_all(){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$msg=$_POST['pesan'];
			$data_insert=$this->mymodel->broadcast($msg);
			if($data_insert>=1){
				redirect('admin/outbox');
			}else{
				echo '<script type="text/javascript">'; 
				echo 'alert("INSERT GAGAL")'; 
				echo '</script>'; 
			}
		}	
	}

	public function add_member(){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$nama=$_POST['inputNama'];
			$tgl=$_POST['bday'];
			$alamat=$_POST['inputAlamat'];
			$telp=$_POST['inputTelp'];
			$saldo=$_POST['inputSaldo'];
			$data_insert=$this->mymodel->InsertNew('member',array(
				  'nama' => $nama,
				  'tgl_lahir' => $tgl,
				  'alamat' => $alamat,
				  'no_telp' => $telp,
				  'saldo' => $saldo
				)
			);
			if($data_insert>=1){
				redirect('admin/nasabah');
			}else{
				echo '<script type="text/javascript">'; 
				echo 'alert("INSERT GAGAL")'; 
				echo '</script>'; 
			}
		}
	}

	public function delete_member($index){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$res=$this->mymodel->delete('member','ID = '.$index);
			if($res>=1){
					redirect('admin/nasabah');
				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("DELETE GAGAL")'; 
					echo '</script>'; 
			}
		}

	}

	public function edit_member($index){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$data=$this->mymodel->get_nasabah($index);
			$this->load->view('edit_member',array('data'=>$data[0]));
		}

	}

	public function update_member(){
		if (!$this->session->userdata('loggedin'))
		{
			redirect('welcome');
		}
		else {
			$nama=$_GET['inputNama'];
			$tgl=$_GET['bday'];
			$alamat=$_GET['inputAlamat'];
			$telp=$_GET['inputTelp'];
			$saldo=$_GET['inputSaldo'];
			$id=$_GET['hidden-id'];
			$data_insert=$this->mymodel->editmember('member',array(
				  'nama' => $nama,
				  'tgl_lahir' => $tgl,
				  'alamat' => $alamat,
				  'no_telp' => $telp,
				  'saldo' => $saldo
				),'id = '.$id
			);
			if($data_insert>=1){
				redirect('admin/nasabah');
			}else{
				echo '<script type="text/javascript">'; 
				echo 'alert("UPDATE GAGAL")'; 
				echo '</script>'; 
			}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */