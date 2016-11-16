<div class="jumbotron">
	  <h1>Hey! Salut mon ami !!!</h1>
	  <p> Tou aimes les pôtates ?</p>
	  <p><a class="btn btn-primary btn-lg" href="https://www.youtube.com/watch?v=hJgQCbRsq-I" target="_blank" role="button">Learn more</a></p>
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Toutes les formations </div>
  <div class="panel-body">
	Lister ici les sessions de formation webforce3 par date pour Esch
  </div>
  <!-- Table -->
<?php if (isset($trainingList) && sizeof($trainingList) > 0) : ?>
  <table class="table">
  <thead>
  	<tr>
  		<th>ID</th>
  		<th>Date-Début</th>
  		<th>Date-Fin</th>
      <th>Effectif</th>
  	</tr>
  </thead>
  <tbody>
<?php foreach ($trainingList as $currentTraining) : ?>
  	<tr>
  		<td><a href="list.php?id=<?= $currentTraining['tra_id'] ?>"><?= $currentTraining['tra_id'] ?></a></td>
  		<td><?= $currentTraining['tra_start_date'] ?></td>
  		<td><?= $currentTraining['tra_end_date'] ?></td>
      <td><?= $currentTraining['Effectif'] ?></td>
  	</tr>
<?php endforeach; ?>
<?php else :?>
   <div class="panel-footer">
         Aucune Session trouvée
    </div> 
<?php endif; ?>
  </tbody>
  </table>
</div>
