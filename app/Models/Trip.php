<?php
namespace App\Models;

use App\Core\Database;

/** Gestion des trajets et des opérations d'écriture associées. */
final class Trip
{
    public function available(): array
    {
        $sql = "SELECT t.*, d.city departure_city, a.city arrival_city,
                u.firstname, u.lastname
                FROM trips t
                JOIN agencies d ON d.id=t.departure_agency_id
                JOIN agencies a ON a.id=t.arrival_agency_id
                JOIN users u ON u.id=t.contact_user_id
                WHERE t.departure_datetime >= NOW() AND t.available_seats > 0
                ORDER BY t.departure_datetime ASC";
        return Database::getConnection()->query($sql)->fetchAll();
    }

    public function all(): array
    {
        $sql="SELECT t.*, d.city departure_city, a.city arrival_city, u.firstname, u.lastname
              FROM trips t JOIN agencies d ON d.id=t.departure_agency_id
              JOIN agencies a ON a.id=t.arrival_agency_id JOIN users u ON u.id=t.contact_user_id
              ORDER BY t.departure_datetime DESC";
        return Database::getConnection()->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $sql="SELECT t.*, d.city departure_city, a.city arrival_city, u.firstname, u.lastname, u.email, u.phone
              FROM trips t JOIN agencies d ON d.id=t.departure_agency_id
              JOIN agencies a ON a.id=t.arrival_agency_id JOIN users u ON u.id=t.contact_user_id
              WHERE t.id=?";
        $s=Database::getConnection()->prepare($sql); $s->execute([$id]); return $s->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $s=Database::getConnection()->prepare(
            'INSERT INTO trips(departure_agency_id,arrival_agency_id,departure_datetime,arrival_datetime,total_seats,available_seats,contact_user_id) VALUES(?,?,?,?,?,?,?)'
        );
        $s->execute([$data['departure_agency_id'],$data['arrival_agency_id'],$data['departure_datetime'],$data['arrival_datetime'],$data['total_seats'],$data['available_seats'],$data['contact_user_id']]);
        return (int)Database::getConnection()->lastInsertId();
    }

    public function update(int $id,array $data): void
    {
        $s=Database::getConnection()->prepare(
            'UPDATE trips SET departure_agency_id=?,arrival_agency_id=?,departure_datetime=?,arrival_datetime=?,total_seats=?,available_seats=? WHERE id=?'
        );
        $s->execute([$data['departure_agency_id'],$data['arrival_agency_id'],$data['departure_datetime'],$data['arrival_datetime'],$data['total_seats'],$data['available_seats'],$id]);
    }

    public function delete(int $id): void
    {
        $s=Database::getConnection()->prepare('DELETE FROM trips WHERE id=?'); $s->execute([$id]);
    }
}