<?php 
	/**
	* Model to manage the books list from database
	*/
	class Editora_model extends CI_Model
	{
		
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		

		// public function create($primeiro_nome, $ultimo_nome, $data_nascimento, $id_pais){
		// 	$data = array(
		// 		'ultimo_nome' => $ultimo_nome,
		// 		'primeiro_nome' => $primeiro_nome,
		// 		'data_nascimento' => $data_nascimento,
		// 		'nacionalidades_id' => $id_pais
		// 	 );

		// 	return $this->db->insert('autores',$data);
		// }

		// public function createBatch(array $authors){//creo que no funciona porque es un array de arrays de arrays en lugar de un array de arrays
		// 	foreach ($authors as $key => $author) {
		// 		$data[$key] = array(
		// 		'ultimo_nome' => $author['ultimo_nome'],
		// 		'primeiro_nome' => $author['primeiro_nome'],
		// 		'data_nascimento' => $author['data_nascimento'],
		// 		'nacionalidades_id' => $author['id_pais']
		// 	 );

		// 	}
			
		// 	return $this->db->insert_batch('autores',$data);
		// }

		// public function createWithSet($primeiro_nome, $ultimo_nome, $data_nascimento, $id_pais){
		// 	$this->db->set("ultimo_nome", $ultimo_nome);
		// 	$this->db->set("primeiro_nome", $primeiro_nome);
		// 	$this->db->set("data_nascimento", $data_nascimento);
		// 	$this->db->set("nacionalidades_id", $id_pais);

		// 	$this->db->insert('autores');
		// 	return $this->db->insert_id();
		// }

		// /*------------------------------------------------Update------------------------------------------------*/
		// public function updateAuthor($id,$data){
		// 	$this->db->where('id',$id);
		// 	$this->db->update('autores',$data);
		// 	return $this->db->affected_rows();
		// }

		// public function updateAuthorBatch($ref_column, $data){
		// 	$this->db->update_batch('autores',$data, $ref_column);
		// 	return $this->db->affected_rows();
		// }

		// /*------------------------------------------------Remove------------------------------------------------*/
		// public function removeAuthor(int $id){
		// 	$this->db->delete('autores', array('id'=>$id));
		// }

		public function getAll(){
			$this->db->select("id, nome as editora, nif, morada");
			$this->db->from("biblioteca.editoras e");
			// $this->db->where("a.nacionalidades_id",$country);
			// $this->db->like("a.primeiro_nome", "o", "both");//tem o no primeiro nome e coisas a volta desse o
			// $this->db->not_like("a.primeiro_nome", "x", "both");//nao tem x no nome
			$this->db->order_by("editora");
			// $this->db->limit(2,0);//limit ofset

			return $this->db->get()->result();
		}
	}
?>