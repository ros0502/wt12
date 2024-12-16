<?php
namespace Model;

use JsonSerializable;

class Friend implements JsonSerializable {

    private ?string $username;
    private ?string $status;

    // Konstruktor
    public function __construct(?string $username = null, ?string $status = null) {
        $this->username = $username;
        $this->status = $status;
    }

    // Getter für username
    public function getUsername(): ?string {
        return $this->username;
    }

    // Getter für status
    public function getStatus(): ?string {
        return $this->status;
    }

    // Methode zum Setzen des Status auf "accepted"
    public function accept(): void {
        $this->status = 'accepted';
    }

    // Methode zum Setzen des Status auf "dismissed"
    public function dismiss(): void {
        $this->status = 'dismissed';
    }

    // Implementierung der JsonSerializable-Schnittstelle
    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    // Statische Methode zur Deserialisierung von JSON in eine Friend-Instanz
    public static function fromJson(object $data): Friend {
        $friend = new Friend();
        foreach ($data as $key => $value) {
            $friend->{$key} = $value;
        }
        return $friend;
    }
}
?>
