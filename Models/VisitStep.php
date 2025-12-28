<?php 
class VisitStep
{
    private int $id;
    private string $title;
    private string $description;
    private int $stepOrder;
    private int $visitId;

    private static ?PDO $db = null;

    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public function getStepOrder(): int { return $this->stepOrder; }
    public function setStepOrder(int $stepOrder): void { $this->stepOrder = $stepOrder; }

    public static function getStepsOfVisit(int $id): array { 
        $stmt = static::getDB()->prepare("SELECT * FROM visit_steps WHERE id_visit = ? ORDER BY step_order");
        $stmt->execute([$id]);

        return $stmt->fetchAll();
     }
    
    public static function createVisitStep($step_titles, $step_descs, $step_orders, $tour_id): bool {

        for($i = 0; $i < count($step_titles); $i++){
        $stmt = static::getDB()->prepare("INSERT INTO visit_steps (title, description, step_order, id_visit) VALUES(?,?,?,?)");
        $status = $stmt->execute([$step_titles[$i], $step_descs[$i], $step_orders[$i], $tour_id]);

    }
        return $status;
    }
    public function updateStep(): void {}
    public function deleteStep(): void {}

    public function __toString(): string
    {
        return "VisitStep[id={$this->id}, title={$this->title}, order={$this->stepOrder}]";
    }
}

?>