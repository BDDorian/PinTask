<? php include('server.php');
?>
<!-- Comptabilisation des erreurs lors de la création de l'utilisateur -->
<?php  if (count($errorsLogin) > 0) : ?>
	<div class="error">
		<?php foreach ($errorsLogin as $error) : ?>
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
<!-- Comptabilisation des erreurs lors de la création de l'utilisateur pour la vérification des doublons -->
<?php  if (count($errorsInsert) > 0) : ?>
	<div class="error">
		<?php foreach ($errorsInsert as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>