
<div class="container-fluid">
	<div class="row">
		<div class="panel">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 text-center">

					<?php echo form_open('books',array('class' => 'form-inline', 'method' => 'get'));
					echo form_label('Pesquisar por titulo ', 'title', array('class' => "control-label"));;
					$attributes = array(
						'placeholder' => 'titulo do livro', 
						'class' => 'form-control', 
						'id' => 'title',
						'value' => $title
						);
					echo form_input("title", $title, $attributes);

					$attributes = array(
						'placeholder' => 'nome do autor', 
						'class' => 'form-control', 
						'id' => 'autor', 

						'value' => $author);
					echo form_label('Pesquisar por autor ', 'autor', array('class' => "control-label"));
					echo form_input("autor", $author, $attributes);
					echo form_submit('submit', 'submit', array("class" => "btn btn-primary"));
					echo form_close(); ?>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-xs-offset-3">

			<h3>Lista de livros 

				<a href="<?php echo base_url('books/create') ?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Inserir livro</a>

				<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-book"><span class="glyphicon glyphicon-plus-sign"></span> Inserir livro Modal</a>

			</h3>

			<!-- echo ($resultados_atuais+1)."-".(ITEMS_PER_PAGE+$resultados_atuais)  -->
			<!-- (<?php echo $resultados_atuais+ITEMS_PER_PAGE?> de <?php echo $quantidade_resultados_pesquisa ?>)  -->
			<ul class="list-group">
				<?php foreach ($livros as $key => $livro): ?>
					
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $livro->titulo ?></h3>
						</div>
						<div class="panel-body">

							<h6>ISBN: <?php echo $livro->isbn ?></h6>
							<h6>Autor: <a href="#" class="label label-primary"><?php echo $livro->autor ?></a> <!-- (<?php echo $livro->nacionalidade ?>) --></h6>
							<h6>Editorial: <?php echo $livro->editora ?> (<?php echo $livro->editora_morada ?>)</h6>
							<h6>Titulo: <?php echo $livro->titulo ?></h6>
							<h6>Subtitulo: <?php echo $livro->subtitulo ?></h6>
							<h6>publicação: <?php echo $livro->data_publicacao ?></h6>
							<h6>Descrição: <?php echo $livro->descricao ?></h6>

						</div>
						<div class="panel-footer text-center">
							<a href="#" class="btn btn-sm btn-info"><span class="glyphicon glyphicon glyphicon-info-sign"></span> Mais informação</a>
							<a href="#" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span> Editar informação do livro</a>
							<a href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Apagar livro</a>
						</div>
					</div>
					
				<?php endforeach ?>
			</ul>
			<div class="text-center">
				<?php echo $pagination ?>
			</div>
		</div>
	</div>
</div>

<div id="create-book" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-scroll">
					<div class="container-fluid">
						<?php echo $create_modal ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
