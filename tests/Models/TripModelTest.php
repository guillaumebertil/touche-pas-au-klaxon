<?php

use PHPUnit\Framework\TestCase;
use App\Models\TripModel;

class TripModelTest extends TestCase
{
    private \PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Tables nécessaires
        $this->pdo->exec("
            CREATE TABLE users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT,
                prenom TEXT,
                email TEXT,
                telephone TEXT
            )
        ");
        $this->pdo->exec("INSERT INTO users (nom, prenom, email, telephone) VALUES ('Doe','John','john@example.com','0123456789')");

        $this->pdo->exec("CREATE TABLE agences (id INTEGER PRIMARY KEY AUTOINCREMENT, ville TEXT)");
        $this->pdo->exec("INSERT INTO agences (ville) VALUES ('Paris'),('Lyon')");

        $this->pdo->exec("
            CREATE TABLE trajets (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                agence_depart_id INTEGER,
                agence_arrivee_id INTEGER,
                date_depart TEXT,
                date_arrivee TEXT,
                nb_total_places INTEGER,
                nb_total_places_dispo INTEGER
            )
        ");
    }

    public function testCreateTrip(): void
    {
        $model = new TripModel($this->pdo);

        $result = $model->createTrip(1, 1, 2, '2026-03-01 08:00:00', '2026-03-01 12:00:00', 5, 5);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM trajets WHERE user_id = 1");
        $trip = $stmt->fetch(\PDO::FETCH_ASSOC);

        $this->assertIsArray($trip);
        $this->assertEquals(5, $trip['nb_total_places']);
    }

    public function testUpdateTrip(): void
    {
        $model = new TripModel($this->pdo);
        $model->createTrip(1, 1, 2, '2026-03-01 08:00:00', '2026-03-01 12:00:00', 5, 5);

        $stmt = $this->pdo->query("SELECT id FROM trajets WHERE user_id = 1");
        $tripId = $stmt->fetch(\PDO::FETCH_ASSOC)['id'];

        $result = $model->updateTrip(1, 2, '2026-03-01 09:00:00', '2026-03-01 13:00:00', 5, 4, $tripId);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM trajets WHERE id = $tripId");
        $trip = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->assertEquals('2026-03-01 09:00:00', $trip['date_depart']);
        $this->assertEquals(4, $trip['nb_total_places_dispo']);
    }

    public function testDeleteTrip(): void
    {
        $model = new TripModel($this->pdo);
        $model->createTrip(1, 1, 2, '2026-03-01 08:00:00', '2026-03-01 12:00:00', 5, 5);

        $stmt = $this->pdo->query("SELECT id FROM trajets WHERE user_id = 1");
        $tripId = $stmt->fetch(\PDO::FETCH_ASSOC)['id'];

        $result = $model->deleteTrip($tripId);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM trajets WHERE id = $tripId");
        $this->assertFalse($stmt->fetch());
    }
}