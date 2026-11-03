<?php require dirname(__DIR__).'/layouts/header.php'; ?><div class="form-card"><h2>Connexion</h2><form method="post" action="/login">
<label>Email</label><input class="form-control mb-3" type="email" name="email" required>
<label>Mot de passe</label><input class="form-control mb-3" type="password" name="password" required>
<button class="btn btn-dark">Connexion</button></form></div><?php require dirname(__DIR__).'/layouts/footer.php'; ?>