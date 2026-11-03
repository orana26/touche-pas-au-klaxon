<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Flash;
use App\Models\Agency;
use App\Models\Trip;
use App\Models\User;

/** Contrôleur du tableau de bord administrateur. */
final class AdminController
{
    private function guard(): void { Auth::requireAdmin(); }

    public function dashboard(): void { $this->guard(); $users=(new User())->all(); $agencies=(new Agency())->all(); $trips=(new Trip())->all(); require dirname(__DIR__).'/Views/admin/dashboard.php'; }
    public function users(): void { $this->guard(); $users=(new User())->all(); require dirname(__DIR__).'/Views/admin/users.php'; }
    public function agencies(): void { $this->guard(); $agencies=(new Agency())->all(); require dirname(__DIR__).'/Views/admin/agencies.php'; }
    public function agencyCreate(): void { $this->guard(); require dirname(__DIR__).'/Views/admin/agency_form.php'; }
    public function agencyStore(): void { $this->guard(); $city=trim($_POST['city']??''); if($city!=='') {(new Agency())->create($city); Flash::add('success','Agence créée avec succès.');} header('Location: /admin/agencies'); exit; }
    public function agencyEdit(string $id): void { $this->guard(); $agency=(new Agency())->find((int)$id); require dirname(__DIR__).'/Views/admin/agency_form.php'; }
    public function agencyUpdate(string $id): void { $this->guard(); $city=trim($_POST['city']??''); if($city!=='') {(new Agency())->update((int)$id,$city); Flash::add('success','Agence modifiée avec succès.');} header('Location: /admin/agencies'); exit; }
    public function agencyDelete(string $id): void { $this->guard(); (new Agency())->delete((int)$id); Flash::add('success','Agence supprimée.'); header('Location: /admin/agencies'); exit; }
    public function trips(): void { $this->guard(); $trips=(new Trip())->all(); require dirname(__DIR__).'/Views/admin/trips.php'; }
}