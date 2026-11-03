<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Flash;
use App\Models\Agency;
use App\Models\Trip;

/** Contrôleur des trajets pour les utilisateurs et visiteurs. */
final class TripController
{
    public function index(): void
    {
        $trips=(new Trip())->available();
        require dirname(__DIR__).'/Views/trips/index.php';
    }

    public function createForm(): void
    {
        Auth::requireLogin(); $agencies=(new Agency())->all(); $user=Auth::user();
        require dirname(__DIR__).'/Views/trips/create.php';
    }

    public function create(): void
    {
        Auth::requireLogin(); $data=$this->validate();
        if (!$data) { header('Location: /trips/create'); exit; }
        $data['contact_user_id']=Auth::id(); $data['available_seats']=$data['total_seats'];
        (new Trip())->create($data);
        Flash::add('success','Le trajet a été créé avec succès.');
        header('Location: /'); exit;
    }

    public function editForm(string $id): void
    {
        Auth::requireLogin(); $trip=(new Trip())->find((int)$id);
        if (!$trip || ($trip['contact_user_id'] !== Auth::id() && !Auth::isAdmin())) { http_response_code(403); exit('Accès interdit.'); }
        $agencies=(new Agency())->all(); require dirname(__DIR__).'/Views/trips/edit.php';
    }

    public function update(string $id): void
    {
        Auth::requireLogin(); $trip=(new Trip())->find((int)$id);
        if (!$trip || ($trip['contact_user_id'] !== Auth::id() && !Auth::isAdmin())) { http_response_code(403); exit('Accès interdit.'); }
        $data=$this->validate();
        if (!$data) { header('Location: /trips/'.$id.'/edit'); exit; }
        (new Trip())->update((int)$id,$data);
        Flash::add('success','Le trajet a été modifié avec succès.');
        header('Location: /'); exit;
    }

    public function delete(string $id): void
    {
        Auth::requireLogin(); $trip=(new Trip())->find((int)$id);
        if (!$trip || ($trip['contact_user_id'] !== Auth::id() && !Auth::isAdmin())) { http_response_code(403); exit('Accès interdit.'); }
        (new Trip())->delete((int)$id); Flash::add('success','Le trajet a été supprimé.'); header('Location: /'); exit;
    }

    private function validate(): ?array
    {
        $dep=(int)($_POST['departure_agency_id']??0); $arr=(int)($_POST['arrival_agency_id']??0);
        $departure=str_replace('T',' ',trim($_POST['departure_datetime']??''));
        $arrival=str_replace('T',' ',trim($_POST['arrival_datetime']??''));
        $seats=(int)($_POST['total_seats']??0); $available=(int)($_POST['available_seats']??$seats);
        if (!$dep || !$arr || $dep===$arr || !$departure || !$arrival || strtotime($arrival)<strtotime($departure) || $seats<1 || $available<0 || $available>$seats) {
            Flash::add('danger','Veuillez vérifier les informations du trajet.');
            return null;
        }
        return [
    'departure_agency_id' => $dep,
    'arrival_agency_id' => $arr,
    'departure_datetime' => $departure,
    'arrival_datetime' => $arrival,
    'total_seats' => $seats,
    'available_seats' => $available,
];
    }
}