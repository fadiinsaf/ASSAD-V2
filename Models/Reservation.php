<?php 
class Reservation
{
    private int $id;
    private int $visitId;
    private int $visitorId;
    private int $numberOfPeople;
    private string $reservationDate;

    private static ?PDO $db = null;

    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public function getNumberOfPeople(): int { return $this->numberOfPeople; }
    public function setNumberOfPeople(int $number): void { $this->numberOfPeople = $number; }

    public static function createReservation($members, $id_user, $id_visit): bool {

        $stmt = static::getDB()->prepare("INSERT INTO reservation (number_of_people, id_visiter, id_visit) VALUES(?,?,?)");
        return $stmt->execute([$members,$id_user,$id_visit]);

    }
    public function cancelReservation(): void {}

    public function __toString(): string
    {
        return "Reservation[id={$this->id}, people={$this->numberOfPeople}, date={$this->reservationDate}]";
    }
}

?>