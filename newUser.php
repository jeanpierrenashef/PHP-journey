<?php

class User {
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        if (!self::validate_email($email)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email']);
        }
        if (!self::check_password($password)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid password. Your password must be at least 12 characters, include 1 uppercase, 1 lowercase, & 1 special character.']);
        }
        $this->name =$name;
        $this->email =$email;
        $this->password =$password;
    }
    public static function check_password($password) 
    {
        $hasUppercase = preg_match('/[A-Z]/',$password);
        $hasLowercase = preg_match('/[a-z]/',$password);
        $hasSpecial = preg_match('/[\W_]/', $password); 

        $minLength = strlen($password)>=12;

        return $hasUppercase&& $hasLowercase&& $hasSpecial&& $minLength;
    }

    public static function validate_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }


    public function copy_with($name =null,$email =null,$password =null) {
        $newName = $name ?? $this->name;
        $newEmail = $email ?? $this->email;
        $newPassword = $password ?? $this->password;

        if ($email !== null && !self::validate_email($email)) {
            echo json_encode
            ([
                'status' => 'error',
                'message' => 'Invalid email']);

        }
        if ($password !== null && !self::check_password($password)) {
            echo json_encode
            ([
                'status' => 'error',
                'message' => 'Invalid password. Must be at least 12 characters, include 1 uppercase, 1 lowercase, and 1 special character.']);
        }

        return new self($newName,$newEmail,$newPassword);
    }
    public function toArray() {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
    
}
    
$users = [];

$user1 = new User("ahmad", "ahmad@gmail.com", "oRd@177234FF");
$users[] = $user1;

$newUser = $user1->copy_with(email: "bob@hotmail.com");
$users[] = $newUser;

$updatedUser = $newUser->copy_with(password: "8888DDd@5678");
$users[] = $updatedUser; 

$userArray = array_map(function($user) {
    return $user->toArray();
}, $users);


echo json_encode([
    'status' => 'success',
    'users' => $userArray
]);