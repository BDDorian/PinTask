<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>

<!-- Comptabilisation des erreurs lors de la création de la liste -->
<?php  if (count($errorsListe) > 0) : ?>
	<div class="error">
		<?php foreach ($errorsListe as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
