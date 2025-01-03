<?php
namespace Model;

require ("start.php");

use JsonSerializable;

class Friend implements JsonSerializable {

    private $username;
    private $status;

    public function __construct($username = null) {
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getStatus(){
        return $this->status;
    }

    public function accept(){

        $service->acceptFriend($this->username);
        $this->status = 'accepted';
    }
    
    public function dismiss(){

        $service->dismissFriend($this->username);
        $this->status = 'dismissed';
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public static function fromJson(object $data): Friend {
        $friend = new Friend();
        foreach ($data as $key => $value) {
            $friend->{$key} = $value;
        }
        return $friend;
    }
}
?>
