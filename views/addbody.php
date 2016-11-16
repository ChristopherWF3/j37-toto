
<div class="jumbotron">
<form action="add.php" enctype="multipart/form-data" method="post">
			<h3>Ajouter un nouveau étudiant</h3>
			<input type="text" name="studentName" value="" placeholder="Nom"><br />
			<input type="text" name="studentFirstname" value="" placeholder="Prénom"><br />
			<input type="email" name="studentEmail" value="" placeholder="E-mail"><br />
			<input type="date" name="studentBirhtdate" value="" placeholder="Date de naissance (aaaa-mm-jj)"><br />
			Ville de résidence :<br />
			<select name="cit_id">
				<option value="0">choisissez :</option>
				<?php foreach ($citiesList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />
			Nationalité :<br />
			<select name="cou_id">
				<option value="0">choisissez :</option>
				<?php foreach ($countriesList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />
			Sympathie :<br />
			<select name="stu_friendliness">
				<option value="">choisissez :</option>
				<?php foreach ($sympathieList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />

			<input type="hidden" name="submitFile" value="1" />
			<input type="hidden" name="MAX_FILE_SIZE" value="200000" />
			<span>Photo de l'étudiant<span>
			<input type="file" name="fileForm" id="fileForm" />
			<span>Format jpg, jpeg, gif, svg, png</span>
			<br>
			<input type="submit" value="Valider"><br />
	</form>
</div>