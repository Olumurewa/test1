<?php 

class User {
    protected $name;
    protected $email;
    protected $isVerified = 0;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}

?>
