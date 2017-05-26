<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Books_model');//como segundo parametro podemos pasar el nombre con el queremos hacer referencia
		$this->load->model('Author_model');//como segundo parametro podemos pasar el nombre con el queremos hacer referencia
		$this->load->model('Editora_model');//como segundo parametro podemos pasar el nombre con el queremos hacer referencia
	}

	public function index(){
		$this->load->helper('form');
		$offset = $this->input->get("page")??0;

		$search = array();

		$search['title'] = $this->input->get('title')??"";
		$search['autor'] = $this->input->get('author')??"";
		// var_dump($search['title']);
		/*----------------------------Pagination----------------------------*/
		$this->load->library('pagination'); //trae las configuraciones de pagination

		
		$data_modal['autores'] = $this->Author_model->getAll();
		$data_modal['editoras'] = $this->Editora_model->getAll();
		$data['create_modal']= $this->load->view('books/create',$data_modal,TRUE);

		$form_url= "books/index";
		if (count($search) > 0) {
			$form_url .= '?' . http_build_query($search,'','&');
		}
		

		$config['base_url'] = base_url("$form_url");//redefinimos valores de config
		$config['page_query_string'] = true;//redefinimos valores de config
		$config['enable_query_strings'] = TRUE;//redefinimos valores de config
		$config['total_rows'] = $this->Books_model->getBooksListCount($search);//redefinimos valores de config
		$config['per_page'] = ITEMS_PER_PAGE;//redefinimos valores de config

		$this->pagination->initialize($config);//aplicamos los cambios sobre las variables de configuracion.
		/*---------------------------/Pagination----------------------------*/
		$data['pagination'] = $this->pagination->create_links();

		$data['quantidade_resultados_pesquisa'] = $config['total_rows'];
		$data['livros'] = $this->Books_model->getBooksList($search, $offset);
		$data['content'] = "books/index";
		$data['active_menu'] = "books";
		$data['resultados_atuais'] = $offset;
		$data['title'] = $this->input->get('title')??"";
		$data['author'] = $this->input->get('author')??"";
		$this->load->view('init', $data);
	}

	public function create(){
		//var_dump($this->input->post('autor')??"");
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning" alert-dismissable>  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		$listValidIdAutors= "a,b"; 
		// $this->Author_model->getListValidId();
		$config = array(
			array('field' => "title", 
				'label' => 'Titulo do livro',
				'rules' => 'required',
				'errors' => array(
					'required' => 'o campo %s é obrigatorio',
					// 'alpha_dash' => '%s contém carateres invalidos',
					// 'max_length' => '%s supera o limite de carateres'
					)
				),
			array('field' => "isbn", 
				'label' => 'ISBN',
				'rules' => 'required|exact_length[13]|alpha_dash|is_unique[livros.isbn]',
				'errors' => array(
					'required' => 'o campo %s é obrigatorio',
					'alpha_dash' => '%s contém carateres invalidos',
					'is_unique' => 'Este livro ja se encontra na base de dados',
					)
				),
			array('field' => "data_publicacao", 
				'label' => 'Data de publicacao',
				'rules' => 'required|exact_length[10]|regex_match[/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/]',
				'errors' => array(
					'required' => 'o campo %s é obrigatorio',
					'alpha_dash' => '%s contém carateres invalidos',
					'regex_match' => 'O formato da %s não é válido'
					)
				),
			array('field' => "autor[]", 
				'label' => 'Autor da obra',
				'rules' => "required", //in_list[$listValidIdAutors]
				'errors' => array(
					'required' => 'o campo %s é obrigatorio'
					// 'in_list' => 'Ocorreu um erro com a base de dados',
					)
				)
			);

		$this->form_validation->set_rules($config);



//-------------------------------------------------------

//-------------------------------------------------------
		$gRecaptchaResponse = 
		$remoteIp = 

		$this->load->library('recaptchaResponse');
		$this->load->library('recaptcha');

		$this->recaptcha->init("6LecCSMUAAAAALH7sOUGR66ZYeCwRgMCXnOfwbMz");

		$resp = $this->recaptcha->verify($gRecaptchaResponse, $remoteIp);
// if ($resp->isSuccess()) {
//     echo "Nao e uma maquina";
// } else {
// 	echo "es una maquina";
//     // $errors = $resp->getErrorCodes();
// }




		if ($this->form_validation->run() === FALSE && !$resp->isSuccess()) {
			//echo "hay un error";
			$data['editoras'] = $this->Editora_model->getAll(); 
			$data['autores'] =$this->Author_model->getAll();
			$data['active_menu'] = "books";
			$data['content'] = "books/create";
			$this->load->view('init', $data);	
		//show create view
		}else{
			//echo "entra aqui porque no hay error";
			$this->Books_model->create($this->input->post('isbn'), $this->input->post('title'), $this->input->post('data_publicacao'),$this->input->post('autor'),$this->input->post('editora'));

			$data['active_menu'] = 'books';
			$data['content']     = 'books/create_success';
			$this->load->view('init',$data);
		}
	}


	public function createAjax(){
		//var_dump($this->input->post('autor')??"");
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning" alert-dismissable>  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
		$listValidIdAutors= "a,b"; 
		// $this->Author_model->getListValidId();
		$config = array(
			array('field' => "title", 
				'label' => 'Titulo do livro',
				'rules' => 'required',
				'errors' => array(
					'required' => 'o campo %s é obrigatorio',
					// 'alpha_dash' => '%s contém carateres invalidos',
					// 'max_length' => '%s supera o limite de carateres'
					)
				),
			array('field' => "isbn", 
				'label' => 'ISBN',
				'rules' => 'required|exact_length[13]|alpha_dash|is_unique[livros.isbn]',
				'errors' => array(
					'required' => 'o campo %s é obrigatorio',
					'alpha_dash' => '%s contém carateres invalidos',
					'is_unique' => 'Este livro ja se encontra na base de dados',
					)
				),
			array('field' => "data_publicacao", 
				'label' => 'Data de publicacao',
				'rules' => 'required|exact_length[10]|regex_match[/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/]',
				'errors' => array(
					'required' => 'o campo %s é obrigatorio',
					'alpha_dash' => '%s contém carateres invalidos',
					'regex_match' => 'O formato da %s não é válido'
					)
				),
			array('field' => "autor[]", 
				'label' => 'Autor da obra',
				'rules' => "required", //in_list[$listValidIdAutors]
				'errors' => array(
					'required' => 'o campo %s é obrigatorio'
					// 'in_list' => 'Ocorreu um erro com a base de dados',
					)
				)
			);


		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			//Show create view
			//	$data = array();
			$data['editoras'] = $this->Editora_model->getAll(); 
			$data['autores'] =$this->Author_model->getAll();

			$form_status = false;
			$html_result = $this->load->view('books/create',$data,TRUE);
		}else{
			//Add book to databse
			$form_status = true;
			$this->Books_model->create($this->input->post('isbn'), $this->input->post('title'), $this->input->post('data_publicacao'),$this->input->post('autor'),$this->input->post('editora'));
			$html_result = $this->load->view('books/create_success',array(),TRUE);
		}

		$output = new stdClass();
		$output->success = $form_status;
		$output->html = $html_result;
		$this->output->set_content_type('application/json')
		->set_output(json_encode($output));

	}
}

?>

