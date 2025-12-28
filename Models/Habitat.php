<?php 
class Habitat
{
    private int $id;
    private string $name;
    private string $typeClimate;
    private string $description;
    private string $zooZone;
    private static ?PDO $db = null;

    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): void { $this->name = $description; }

    public function getZooZone(): string { return $this->zooZone; }
    public function setZooZone(string $zooZone): void { $this->name = $zooZone; }


    public function getTypeClimate(): string { return $this->typeClimate; }
    public function setTypeClimate(string $typeClimate): void { $this->typeClimate = $typeClimate; }

    public static function getAll(): array{
        return static::getDB()->query("SELECT * FROM habitats", PDO::FETCH_ASSOC)
                        ->fetchAll();
    }
    public static function getHabitat(int $id){
        $stmt = static::getDB()->prepare("SELECT * FROM habitats WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function createHabitat(string $name , string $description, string $zoo_zone): bool {
        $stmt = static::getDB()->prepare("INSERT INTO habitats(name,description,zoo_zone) VALUES (?,?,?)");
        return $stmt->execute([$name, $description, $zoo_zone]);
    }
    public static function updateHabitat(string $name , string $description, string $zoo_zone, int $id): bool {

        $stmt = static::getDB()->prepare("UPDATE habitats SET name = ?, description = ?, zoo_zone = ? WHERE id = ?");
        return $stmt->execute([$name , $description, $zoo_zone, $id]);
    
    }
    public static function deleteHabitat(int $id): bool {
        $stmt = static::getDB()->prepare("DELETE FROM habitats WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function __toString(): string
    {
        return "Habitat[id={$this->id}, name={$this->name}, climate={$this->typeClimate}]";
    }
}

?>