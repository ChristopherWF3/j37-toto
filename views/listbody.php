<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Tous les étudiants</div>
  <div class="panel-body">
  Définir si ce sont tous les étudaints ou ceux d'une session précise
  </div>
  <!-- Table -->
<?php if (isset($etudiantsList) && sizeof($etudiantsList) > 0) : ?>
  <table class="table">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Ville</th>
      <th>Pays</th>
      <th>Sympathie</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($etudiantsList as $currentEtudiant) : ?>
    <tr>
    <td><a href="student.php?id=<?=$currentEtudiant['stu_id']?>"><?=$currentEtudiant['stu_lname']?></a></td>
    <td><?= $currentEtudiant['stu_fname'] ?></td>
    <td><?= $currentEtudiant['cit_name'] ?></td>
    <td><?= $currentEtudiant['cou_name'] ?></td>
    <td><?= $currentEtudiant['stu_friendliness'] ?></td>
     </tr>
<?php endforeach; ?>
<?php else :?>
      <div class="panel-footer">
        Aucun étudiant trouvé
    </div> 
<?php endif; ?>
  </tbody>
  </table>

</div>

<a href ="list.php?page=<?=$page-1?>" class ="btn btn-success">Précédant</a>
<a href ="list.php?page=<?=$page+1?>" class ="btn btn-success">Suivant</a>