<?php 
	/**
	* Model to manage the books list from database
	*/
	class User_model extends CI_Model
	{
		
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function getAll(){
			$this->db->select("id, username, password");
			$this->db->from("biblioteca.users u");
			// $this->db->where("a.nacionalidades_id",$country);
			// $this->db->like("a.primeiro_nome", "o", "both");//tem o no primeiro nome e coisas a volta desse o
			// $this->db->not_like("a.primeiro_nome", "x", "both");//nao tem x no nome
			// $this->db->order_by("editora");
			// $this->db->limit(2,0);//limit ofset
			return $this->db->get()->result();
		}

		public function login($username, $password):bool{
			$record = $this->db->get_where("users", array('user' =>$username))->row();

			if ($record && password_verify($password,$row->password)) {
				return true;
			}else{
				return false;
			}
		}
	}
?>