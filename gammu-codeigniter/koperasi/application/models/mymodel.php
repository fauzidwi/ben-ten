<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mymodel extends CI_Model {

	public function login($index1,$index2){
		$index1=$this->db->escape($index1);
		$index2=$this->db->escape($index2);
		$salt="K0p3R45I@";
		$key=$this->db->escape($salt);
        $query = "SELECT * FROM login WHERE type =".$index2."AND pass=aes_encrypt(".$index2.",".$key.")";
        $data=$this->db->query($query);

		//$data = $this->db->query('select id from login where type = "'.$index1.'" and pass = "'.$index2.'"');
		$x = $data->result_array();
		$data=$x;
		$x=(int)count($x);
		if ($x==0) {
			return "fail";
		} else {
			return "success";
		}
	}

	public function cekpass($index){
		$index=$this->db->escape($index);
		$salt="K0p3R45I@";
		$key=$this->db->escape($salt);
        $query="SELECT id FROM login WHERE pass=aes_encrypt(".$index.",".$key.")";
        $data=$this->db->query($query);
        $data=$data->result_array();
        if($data['0']['id']=='1'){
        	return 'success';
        }
        else {
        	return 'fail';
        }
	}

	public function edit_pass($index1,$index2){
		$index1=$this->db->escape($index1);
		$index2=$this->db->escape($index2);
		$salt="K0p3R45I@";
		$key=$this->db->escape($salt);
        $query = "UPDATE login SET pass=aes_encrypt(".$index2.",".$key."), type = ".$index1." WHERE id = '1'";
        $data=$this->db->query($query);
        return $data;
	}

	public function delete($table,$index){
		$res=$this->db->delete($table,$index);
		return $res;
	}

	public function InsertNew($tabel,$data){
		$res=$this->db->insert($tabel,$data);
		return $res;
	}

	public function get_inbox(){
		$data=$this->db->query("select count(status) as count from inbox where status='0'");
		return $data->result_array();
	}

	public function inbox(){
		$data=$this->db->query("select * from inbox");
		return $data->result_array();
	}

	public function specific_inbox($index){
		$data=$this->db->query("select * from inbox where ID=".$index."");
		return $data->result_array();
	}

	public function sentitems(){
		$data=$this->db->query("select * from sentitems");
		return $data->result_array();
	}

	public function phone_member(){
		$data=$this->db->query("select no_telp,id from member");
		return $data->result_array();
	}

	public function broadcast($index){
		$data=$this->db->query("select no_telp from member");
		$data=$data->result_array();
		$sql="INSERT INTO outbox (DestinationNumber, TextDecoded, SenderID, CreatorID) VALUES ";
		foreach ($data as $key) {
			$sql .= "('".$key['no_telp']."','".$index."','phone1','Gammu 1.33.0'),";
		}
		$sql=rtrim($sql, ',');
		$res=$this->db->query($sql);
		return $res;

	}

	public function getnasabah(){
		$data=$this->db->query("select * from member");
		return $data->result_array();
	}

	public function get_nasabah($index){
		$data=$this->db->query("select * from member where id='".$index."'");
		return $data->result_array();
	}

	public function editmember($tabel,$data,$where){
		$res=$this->db->update($tabel,$data,$where);
		return $res;
	}

	public function update_status(){
		$res=$this->db->query("update inbox set status='1' where status='0'");
		return $res;
	}
}