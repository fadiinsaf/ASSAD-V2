<?php 
class Animal
{
    private int $id;
    private string $name;
    private string $species;
    private string $dietType;
    private string $image;
    private string $countryOrigin;
    private string $shortDescription;
    private int $habitatId;

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

    public function getSpecies(): string { return $this->species; }
    public function setSpecies(string $species): void { $this->species = $species; }

    public function getDietType(): string { return $this->dietType; }
    public function setDietType(string $dietType): void { $this->dietType = $dietType; }

    public function getHabitatId(): int { return $this->habitatId; }
    public function setHabitatId(int $habitatId): void { $this->habitatId = $habitatId; }


    public static function getAll(): array{
        return static::getDB()->query("SELECT a.name AS animal_name, h.name AS habitat_name , a.diet_type , a.image, a.id FROM animals a INNER JOIN habitats h ON h.id = a.id_habitat", PDO::FETCH_ASSOC)
                        ->fetchAll();
    }
    public static function getAllWithHabitats(): array{
        return static::getDB()->query("SELECT * ,a.id AS animal_id ,h.name AS habitat_name FROM animals a INNER JOIN habitats h ON a.id_habitat = h.id")
                        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAnimal($id){
        $stmt =  static::getDB()->prepare("SELECT * FROM animals WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function getAnimalWithHabitat($id){
        $stmt =  static::getDB()->prepare("SELECT *, a.name AS animal_name ,h.name AS habitat_name FROM animals a INNER JOIN habitats h ON a.id_habitat = h.id WHERE a.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    public static function createAnimal($file, $name, $species, $diet_type, $description, $idhab): bool {
        $db = static::getDB();
        $current_time = new DateTime();
        $image_name =  $current_time->getTimestamp() . "_" . $file["name"];
        move_uploaded_file($file["tmp_name"], __DIR__ . "/../assets/images/$image_name");

        $stmt = $db->prepare("INSERT INTO animals(name, species, diet_type, image, short_description, id_habitat) VALUES(?,?,?,?,?,?)");
        return $stmt->execute([$name, $species, $diet_type, $image_name, $description, $idhab]);
    }

    public static function updateAnimal($id, $name, $diet_type, $short_description, $id_habitat, $file, $species): bool {
        $db = static::getDB();

        $stmt = $db->prepare("SELECT image FROM animals WHERE id = ?");
        $stmt->execute([$id]);

        $image = $stmt->fetchColumn();

        if(file_exists(__DIR__ . "/../assets/images/$image")){
            unlink(__DIR__ . "/../assets/images/$image");
        }

        $current_time = new DateTime();
        $image_name =  $current_time->getTimestamp() . "_" . $file["name"];
        move_uploaded_file($file["tmp_name"], __DIR__ . "/../assets/images/$image_name");

        $stmt = $db->prepare("UPDATE animals SET name = ?, diet_type = ?, short_description = ?, id_habitat = ?, image = ?, species = ? WHERE id = ?");
        return $stmt->execute([$name, $diet_type, $short_description, $id_habitat, $image_name, $species, $id]);
    }

    public static function deleteAnimal($id): bool {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT IMAGE FROM animals WHERE id = ?");
        $stmt->execute([$id]);

        $image = $stmt->fetchColumn();

        unlink(__DIR__ . "/../assets/$image");

        $stmt = $db->prepare("DELETE FROM animals WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function __toString(): string
    {
        return "Animal[id={$this->id}, name={$this->name}, species={$this->species}]";
    }
}
