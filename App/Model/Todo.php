<?php

namespace App\Model;

use PDO;

class Todo
{
    protected ?int $id;
    protected string $description;
    protected bool $done;
    protected int $rank;

    public function __construct(?int $id = null, string $description = '', int $rank = 0, bool $done = false)
    {
        $this->id = $id;
        $this->description = $description;
        $this->done = $done;
        $this->rank = $rank;
    }

    static public function createInstance(...$params)
    {
        return new Todo(...$params);
    }

    static public function findAllOrderedByRank(): array
    {
        // Réutilise l'instance de base de données définie globalement
        global $databaseHandler;
        // Récupère la liste des tâches à faire en base de données
        $statement = $databaseHandler->query('SELECT * FROM `todos` ORDER BY `rank`');
        return $statement->fetchAll(PDO::FETCH_FUNC, [static::class, 'createInstance']);        
    }

    static public function findById(int $id)
    {
        // Réutilise l'instance de base de données définie globalement
        global $databaseHandler;
        // Récupère l'enregistrement déjà existant
        $statement = $databaseHandler->prepare('SELECT * FROM `todos` WHERE `id` = :id');
        $statement->execute([ ':id' => $id ]);
        return $statement->fetchAll(PDO::FETCH_FUNC, [static::class, 'createInstance'])[0];
    }

    static public function findWhereRankAbove(int $rank)
    {
        // Réutilise l'instance de base de données définie globalement
        global $databaseHandler;

        $statement = $databaseHandler->prepare('SELECT * FROM `todos` WHERE `rank` > :rank');
        $statement->execute([ ':rank' => $rank ]);
        return $statement->fetchAll(PDO::FETCH_FUNC, [static::class, 'createInstance']);
    }

    static public function countAll(): int
    {
        // Réutilise l'instance de base de données définie globalement
        global $databaseHandler;
        // Envoie une requête permettant de compter le nombre de tâches existantes
        $statement = $databaseHandler->query('SELECT COUNT(*) FROM `todos`');
        $result = $statement->fetchAll();
        return intval($result[0][0]);
    }

    public function insert(): void
    {
        // Réutilise l'instance de base de données définie globalement
        global $databaseHandler;

        // Crée une requête préparée et l'exécute en lui passant les valeurs adéquates
        $statement = $databaseHandler->prepare('
            INSERT INTO `todos`
            (`description`, `done`, `rank`)
            VALUES (:description, :done, :rank)
        ');
        $statement->execute([
            ':description' => $this->description,
            ':done' => $this->done,
            ':rank' => $this->rank,
        ]);
    }

    public function update(): void
    {
        // Réutilise l'instance de base de données définie globalement
        global $databaseHandler;

        // Crée une requête pour modifier l'enregistrement existant en base de données
        $statement = $databaseHandler->prepare('
            UPDATE `todos`
            SET
                `description` = :description,
                `rank` = :rank,
                `done` = CAST( :done as UNSIGNED )
            WHERE `id` = :id
        ');
        $statement->execute([
            ':description' => $this->description,
            ':rank' => $this->rank,
            ':done' => $this->done,
            ':id' => $this->id
        ]);

    }

    public function delete(): void
    {
        // Réutilise l'instance de base de données définie globalement
        global $databaseHandler;

        $statement = $databaseHandler->prepare('DELETE FROM `todos` WHERE `id` = :id');
        $statement->execute([ ':id' => $this->id ]);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of done
     */ 
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set the value of done
     *
     * @return  self
     */ 
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get the value of rank
     */ 
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set the value of rank
     *
     * @return  self
     */ 
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }
}
