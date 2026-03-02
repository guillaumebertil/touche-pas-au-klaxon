<?php

use PHPUnit\Framework\TestCase;
use App\Models\AgenceModel;

class AgenceModelTest extends TestCase
{
    private \PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Crée la table agences
        $this->pdo->exec("
            CREATE TABLE agences (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ville TEXT UNIQUE
            )
        ");
    }

    public function testCreateAgence(): void
    {
        $model = new AgenceModel($this->pdo);

        $result = $model->createAgence('Paris');
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM agences WHERE ville = 'Paris'");
        $agence = $stmt->fetch(\PDO::FETCH_ASSOC);

        $this->assertIsArray($agence);
        $this->assertEquals('Paris', $agence['ville']);
    }

    public function testUpdateAgence(): void
    {
        $model = new AgenceModel($this->pdo);
        $model->createAgence('Lyon');

        $stmt = $this->pdo->query("SELECT id FROM agences WHERE ville = 'Lyon'");
        $agenceId = $stmt->fetch(\PDO::FETCH_ASSOC)['id'];

        $result = $model->updateAgence('Marseille', $agenceId);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM agences WHERE id = $agenceId");
        $agence = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->assertEquals('Marseille', $agence['ville']);
    }

    public function testDeleteAgence(): void
    {
        $model = new AgenceModel($this->pdo);
        $model->createAgence('Nice');

        $stmt = $this->pdo->query("SELECT id FROM agences WHERE ville = 'Nice'");
        $agenceId = $stmt->fetch(\PDO::FETCH_ASSOC)['id'];

        $result = $model->deleteAgence($agenceId);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM agences WHERE id = $agenceId");
        $this->assertFalse($stmt->fetch());
    }
}