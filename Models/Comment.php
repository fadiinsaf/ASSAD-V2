<?php 
class Comment
{
    private int $id;
    private int $visitId;
    private int $visitorId;
    private int $rating;
    private string $commentText;
    private string $commentDate;

    private static ?PDO $db = null;
    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public function getRating(): int { return $this->rating; }
    public function setRating(int $rating): void { $this->rating = $rating; }

    public static function getUsersComments(int $id_visit): array { 

        $stmt = static::getDB()->prepare("SELECT * FROM comments c INNER JOIN users u ON c.id_visiter = u.id WHERE c.id_visit = ?");
        
        $stmt->execute([$id_visit]);
        return $stmt->fetchAll();

     }

    public function createComment(): void {}
    public function deleteComment(): void {}

    public function __toString(): string
    {
        return "Comment[id={$this->id}, rating={$this->rating}]";
    }
}

?>