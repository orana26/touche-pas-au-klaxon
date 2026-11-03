<?php use App\Core\Auth; use App\Core\Flash; ?>
<!doctype html><html lang="fr"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Touche pas au klaxon</title><link rel="stylesheet" href="/assets/css/app.css">
</head><body>
<div class="container py-3">
<header class="site-header mb-4">
<a class="brand" href="<?= Auth::isAdmin()?'/admin':'/' ?>">Touche pas au klaxon</a>
<nav class="d-flex align-items-center gap-2">
<?php if(!Auth::check()): ?><a class="btn btn-dark" href="/login">Connexion</a>
<?php elseif(Auth::isAdmin()): ?>
<a class="btn btn-secondary" href="/admin/users">Utilisateurs</a><a class="btn btn-secondary" href="/admin/agencies">Agences</a><a class="btn btn-secondary" href="/admin/trips">Trajets</a>
<span>Bonjour <?= htmlspecialchars(Auth::user()['firstname'].' '.Auth::user()['lastname']) ?></span>
<form method="post" action="/logout"><button class="btn btn-dark">Déconnexion</button></form>
<?php else: ?>
<a class="btn btn-dark" href="/trips/create">Créer un trajet</a><span>Bonjour <?= htmlspecialchars(Auth::user()['firstname'].' '.Auth::user()['lastname']) ?></span>
<form method="post" action="/logout"><button class="btn btn-dark">Déconnexion</button></form>
<?php endif; ?></nav></header>
<?php foreach(Flash::consume() as $f): ?><div class="alert alert-<?= htmlspecialchars($f['type']) ?>"><?= htmlspecialchars($f['message']) ?></div><?php endforeach; ?>