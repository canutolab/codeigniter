<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<?php echo form_open("books/create", ["class" => "form-horizontal","id" => "form-new-book"]) ?>
		<?php echo validation_errors() ?>
		<fieldset>
			<legend>Criar livro</legend>
			<div class="form-group">
				<label for="isbn" class="col-lg-2 control-label">ISBN</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="isbn" name="isbn" placeholder="Identificador do livro" value="<?php echo set_value('isbn') ?>">
					<?php echo form_error('isbn'); ?>
				</div>
			</div>

			<div class="form-group">
				<label for="title" class="col-lg-2 control-label">Nome do livro</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Nome do livro" value="<?php echo set_value('title') ?>">
					<?php echo form_error('title'); ?>
				</div>
			</div>

			<div class="form-group">
				<label for="data_publicacao" class="col-lg-2 control-label">Data de publicacap</label>
				<div class="col-lg-10">
					<input class="form-control" id="data_publicacao" name="data_publicacao" placeholder="Data da publicacao da obra" type="date" value="<?php echo set_value('data_publicacao') ?>"/>
					<?php echo form_error('data_publicacao'); ?>
				</div>
			</div>

			<div class="form-group">
				<label for="autor" class="col-lg-2 control-label">Seleccione o autor</label>
				<div class="col-lg-10">
					<select multiple class="form-control" id="autor" name="autor[]">
						<?php foreach ($autores as $key => $autor): ?>
							<option <?php echo set_select('autor[]', $autor->id); ?> value="<?php echo $autor->id ?>"><?php echo $autor->autor ?></option>
						<?php endforeach ?>
						<?php echo form_error('autor'); ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="editora" class="col-lg-2 control-label">Seleccione a editora</label>
				<div class="col-lg-10">
					<select class="form-control" id="editora" name="editora">
						<?php foreach ($editoras as $key => $editora): ?>
							<option <?php echo set_select('editora', $editora->id); ?> value="<?php echo $editora->id ?>"><?php echo $editora->editora ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<?php echo form_error('editora'); ?>
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-default">Cancel</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
</div>

<script>
	$( function(){

		$('#form-new-book').submit(function(e) {
			e.preventDefault(); 
			var formDataa = new FormData($('#form-new-book'));
			$.ajax({
				type : "POST",
				dataType:'json',
				data : $( "#form-new-book" ).serialize(),
				url: '<?php echo base_url("books/createAjax/")?>', 
				cache : false,
				success : function(response){
					if(!response.success){
						$("#create-book .modal-body").html(response.html);
					}else{
						$('#create-book').modal('toggle');
						$('#form-new-book').trigger('reset');
					}
				}
			});        
			return false; 
		}); 
	});
</script>