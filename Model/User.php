<?php

namespace Model;

use JsonSerializable;


class User implements JsonSerializable{
    public ?string $username;

    // Konstruktor, der den optionalen Parameter username entgegennimmt
    public function __construct(?string $username = null)
    {
        $this->username = $username;
    }

    // Getter für den Benutzernamen
    public function getUsername(): ?string
    {
        return $this->username;
    }

    // Implementierung der jsonSerialize-Methode für die JSON-Serialisierung
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this); // Gibt die Attribute der Klasse zurück
    }

    // Statische Methode zur Erstellung eines User-Objekts aus JSON-Daten
    public static function fromJson(object $data): User {
        $user = new self(); // Neue Instanz der User-Klasse

        // Iteriere durch das übergebene JSON-Objekt und weise die Werte den Attributen zu
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }

        return $user;
    }
}



class Friend implements JsonSerializable
{
    private ?string $username;
    private ?string $status;

    // Konstruktor, der den optionalen Parameter username entgegennimmt
    public function __construct(?string $username = null, ?string $status = null)
    {
        $this->username = $username;
        $this->status = $status ?? 'pending'; // Standardstatus ist 'pending', falls nichts angegeben
    }

    // Getter für den Benutzernamen
    public function getUsername(): ?string
    {
        return $this->username;
    }

    // Getter für den Status
    public function getStatus(): ?string
    {
        return $this->status;
    }

    // Implementierung der jsonSerialize-Methode für die JSON-Serialisierung
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this); // Gibt die Attribute der Klasse zurück
    }

    // Statische Methode zur Erstellung eines Friend-Objekts aus JSON-Daten
    public static function fromJson(object $data): Friend
    {
        $friend = new self(); // Neue Instanz der Friend-Klasse

        // Iteriere durch das übergebene JSON-Objekt und weise die Werte den Attributen zu
        foreach ($data as $key => $value) {
            $friend->{$key} = $value;
        }

        return $friend;
    }

    // Methode, die den Status auf 'accepted' setzt
    public function accept(): void
    {
        $this->status = 'accepted';
    }

    // Methode, die den Status auf 'dismissed' setzt
    public function dismiss(): void
    {
        $this->status = 'dismissed';
    }
}
