<?php
namespace Model;

use JsonSerializable;

class User implements JsonSerializable
{
    private $username;
    //Profilinformationen in Einstellungen
    public $firstname;
    public $surname;
    public $beverage;
    public $comment;
    public $layout;
    public $history;
    public function __construct($username = null)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    //Getter für Profilinfos
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getBeverage()
    {
        return $this->beverage;
    }
    public function getComment()
    {
        return $this->comment;
    }
    public function getLayout()
    {
        return $this->layout;
    }
    public function getHistory()
    {
        return $this->history;
    }
    
    //Setter für Profilinfos
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setBeverage($beverage)
    {
        $this->surname = $beverage;
    }
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function setHistory($history)
    {
        $this->history = $history;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
    static function fromJson($data)
    {
        $user = new User();
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }
        return $user;
    }
}