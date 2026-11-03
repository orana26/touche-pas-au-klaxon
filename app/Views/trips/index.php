<?php require dirname(__DIR__).'/layouts/header.php'; ?>
<?php if(!\App\Core\Auth::check()): ?><h2>Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</h2><?php else: ?><h2>Trajets proposés</h2><?php endif; ?>
<div class="table-responsive"><table class="table table-striped table-bordered align-middle"><thead><tr>
<th>Départ</th><th>Date</th><th>Heure</th><th>Destination</th><th>Date</th><th>Heure</th><th>Places</th><?php if(\App\Core\Auth::check()): ?><th></th><?php endif; ?>
</tr></thead><tbody>
<?php foreach($trips as $t): ?><tr>
<td><?=htmlspecialchars($t['departure_city'])?></td><td><?=date('d/m/y',strtotime($t['departure_datetime']))?></td><td><?=date('H:i',strtotime($t['departure_datetime']))?></td>
<td><?=htmlspecialchars($t['arrival_city'])?></td><td><?=date('d/m/y',strtotime($t['arrival_datetime']))?></td><td><?=date('H:i',strtotime($t['arrival_datetime']))?></td><td><?=$t['available_seats']?></td>
<?php if(\App\Core\Auth::check()): ?><td class="actions">
<button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#trip<?=$t['id']?>">◉</button>
<?php if((int)$t['contact_user_id']===\App\Core\Auth::id()): ?><a href="/trips/<?=$t['id']?>/edit">✎</a><form class="inline" method="post" action="/trips/<?=$t['id']?>/delete" onsubmit="return confirm('Supprimer ce trajet ?')"><button>♜</button></form><?php endif; ?></td><?php endif; ?>
</tr>
<?php if(\App\Core\Auth::check()): ?><div class="modal fade" id="trip<?=$t['id']?>" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">
<p>Auteur : <strong><?=htmlspecialchars($t['firstname'].' '.$t['lastname'])?></strong></p><p>Téléphone : <strong><?=htmlspecialchars($t['phone']??'')?></strong></p><p>Email : <strong><?=htmlspecialchars($t['email']??'')?></strong></p><p>Nombre total de places : <strong><?=$t['total_seats']?></strong></p>
</div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button></div></div></div></div><?php endif; ?>
<?php endforeach; ?></tbody></table></div><?php require dirname(__DIR__).'/layouts/footer.php'; ?>