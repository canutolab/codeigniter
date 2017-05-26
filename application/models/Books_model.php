<?php 
	/**
	* Model to manage the books list from database
	*/
	class Books_model extends CI_Model
	{
		
		function __construct(){
			parent::__construct();
			$this->load->database();
			// var_dump($this->db);
			// var_dump($this->db->conn_id)
		}

		/**
		 * Gets the books. return an array containing a list of books
		 */
		public function getBooks():array{
			
		}

		public function getBooksActiveRecord(){
			// return $this->db->get('livros')->result_array();
			return $this->db->get('livros')->result();
		}

		public function getBooksARQuery(){
			$query = "SELECT 
			CONCAT(a.ultimo_nome, ' ', a.primeiro_nome) AS autor,
			a.data_nascimento,
			n.nome as nacionalidade,
			l.titulo,
			l.isbn,
			l.subtitulo,
			l.data_publicacao,
			l.descricao,
			e.nome AS 'editora'
			FROM
			Biblioteca.autores_has_livros ahl
			INNER JOIN
			biblioteca.autores a
			INNER JOIN
			biblioteca.livros l
			INNER JOIN
			biblioteca.nacionalidades n
			INNER JOIN
			biblioteca.editoras e ON ahl.autores_id = a.id
			AND ahl.livros_id = l.id
			AND l.editoras_id = e.id
			AND n.id= a.nacionalidades_id;";
			// return $this->db->get('livros')->result_array();
			return $this->db->query($query)->result();
		}

		public function getBooksARSimpleQuery(){
			return $this->db->simple_query($query); //devuelve verdadero o falso si ejecuto la query
			
		}

		public function getBooksById($id){
			$sql = "SELECT * FROM livros WHERE id=?";
			return $this->db->query($sql,array($id))->row();
		}

		// public function getBooksARBuilder($id, $title){
		// 	$this->db->where("id",$id);
		// 	$this->db->where("titulo",$title);
		// 	return $this->db->get('livros')->row();
		// }

		public function getBooksARBuilder2($id, $title){
			$this->db->select("titulo, isbn");
			$this->db->from("livros");
			$this->db->where("id",$id);
			$this->db->where("titulo",$title);
			return $this->db->get()->row();
		}

		/**
		 * Gets the books ar builder.
		 *
		 * @return     <type>  The books ar builder.
		 */
		public function getBooksARBuilder(){
			$select = "CONCAT(a.ultimo_nome, '; ', a.primeiro_nome) AS autor,
			a.data_nascimento, n.nome as nacionalidade, l.titulo, l.isbn, l.subtitulo, data_publicacao, l.descricao, e.nome AS 'editora', e.morada AS 'editora_morada'";

			$this->db->select($select)
			->from("Biblioteca.autores_has_livros ahl")
			->join("biblioteca.autores a", "ahl.autores_id = a.id", "inner") //tiene un tercer parametro: inner, left o right
			->join("biblioteca.livros l", "ahl.livros_id = l.id","inner") 
			->join("biblioteca.nacionalidades n", "n.id= a.nacionalidades_id","inner")
			->join("biblioteca.editoras e", "l.editoras_id = e.id","inner");

			return $this->db->get()->result();
		}

		public function getBooksList(array $search = array(), int $offset=0, int $limit=ITEMS_PER_PAGE):array{

			if ($search['title'] ?? false) {
				$this->db->like("titulo",$search['title']);
			}
			if ($search['author'] ?? false) {
				$this->db->having("autor LIKE", "%".$search['author']."%");
						// $this->db->or_like("a.primeiro_nome",$search['author']);
			}

			$select = "CONCAT_WS(', ', a.ultimo_nome, a.primeiro_nome) AS autor,
			a.data_nascimento,
			n.nome as nacionalidade,
			l.titulo,
			l.isbn, 
			l.subtitulo,
			data_publicacao,
			l.descricao,
			e.nome AS 'editora',
			e.morada AS 'editora_morada'";

			$this->db->select($select)
			->from("Biblioteca.autores_has_livros ahl")

			->join("biblioteca.autores a", "ahl.autores_id = a.id") //tiene un tercer parametro: inner, left o right
			->join("biblioteca.livros l", "ahl.livros_id = l.id") 
			->join("biblioteca.nacionalidades n", "n.id= a.nacionalidades_id")
			->join("biblioteca.editoras e", "l.editoras_id = e.id")
			->group_by("l.id")
			->limit($limit,$offset);


			return $this->db->get()->result();
		}

		/**
		 * Gets the books list count.
		 *
		 * @param      array   $search  The search
		 *
		 * @return     <type>  The books list count.
		 */
		public function getBooksListCount(array $search = array()):int{

			if ($search['title'] ?? false) {
				$this->db->like("titulo",$search['title']);
			}
			if ($search['author'] ?? false) {
				$this->db->having("autor LIKE", "%".$search['author']."%");
						// $this->db->or_like("a.primeiro_nome",$search['author']);
			}

			$this->db->from("Biblioteca.autores_has_livros ahl")
			->join("biblioteca.autores a", "ahl.autores_id = a.id") //tiene un tercer parametro: inner, left o right
			->join("biblioteca.livros l", "ahl.livros_id = l.id") 
			->join("biblioteca.nacionalidades n", "n.id= a.nacionalidades_id")
			->join("biblioteca.editoras e", "l.editoras_id = e.id");


			return $this->db->count_all_results();
		}

		public function create($isbn, $titulo, $data, $id_autores, $id_editorial){
			$data = array(
				'isbn' => $isbn,
				'titulo' => $titulo,
				'data_publicacao' => $data,
				'editoras_id' => $id_editorial
				);
			//var_dump($data);

			$this->db->insert('livros',$data);
			$id_livro= $this->db->insert_id();
			//var_dump($id_livro);

			$batch= array();

			foreach ($id_autores as $key => $autor) {
				$batch[] = array(
					'livros_id' => $id_livro,
					 'autores_id' => $autor);
			}

			$result['livro_id'] = $id_livro;
			$result['autores'] = $this->db->insert_batch('autores_has_livros',$batch);
			return $result;

		}

	}
	?>