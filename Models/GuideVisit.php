<?php 
class GuideVisit
{
    private int $id;
    private string $title;
    private string $description;
    private string $startDatetime;
    private int $duration;
    private float $price;
    private string $language;
    private int $capacityMax;
    private string $status;
    private int $guideId;

    private static ?PDO $db = null;

    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public static function getAll(): array{
       return static::getDB()->query("SELECT *  FROM guide_visits", PDO::FETCH_ASSOC)
                            ->fetchAll();
    }

    public static function getVisit($id): array{
        $stmt = static::getDB()->prepare("SELECT * FROM guide_visits WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public static function getGuideVisits(int $id_guide): array{
        $stmt = static::getDB()->prepare("SELECT * FROM guide_visits WHERE id_guide = ?");
        $stmt->execute([$id_guide]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createVisit($tour_title, $tour_desc, $tour_date, $tour_duration, $tour_price, $tour_lang, $tour_cap,$id_guide): int {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO guide_visits (title, description, start_datetime, duration, price, language, capacity_max, id_guide) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->execute([$tour_title, $tour_desc, $tour_date, $tour_duration, $tour_price, $tour_lang, $tour_cap, $id_guide]);

        return $db->lastInsertId();
    }

    public function updateVisit(): void {}
    public function deleteVisit(): void {}

    public function __toString(): string
    {
        return "GuideVisit[id={$this->id}, title={$this->title}, price={$this->price}]";
    }
}
?>