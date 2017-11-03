<?php

if(!isset($_SESSION)){
    session_start();
}
?>
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
<!-- Comptabilisation des erreurs lors de la création d'une tâche -->

<?php  if (count($errorsTache) > 0) : ?>
	<div class="error">
		<?php foreach ($errorsTache as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>