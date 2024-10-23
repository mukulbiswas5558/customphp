
<?php
require_once 'BaseModel.php';

class UserModel extends BaseModel {
    public function __construct() {
        parent::__construct('users'); // Set the table name as 'users'
    }
    public function getUser($username) {
        // Normally, you'd fetch this data from a database
        return [
            'name' => $username,
            'email' => "{$username}@example.com"
        ];
    }
}
?>