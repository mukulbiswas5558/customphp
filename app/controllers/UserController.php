<?php
require_once 'app/models/UserModel.php';

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel(); // Initialize UserModel
    }
    public function index() {
        $this->loadView('user', ['title' => 'Welcome to the User Page!']);
    }

    public function profile() {
        $userModel = new UserModel();
        $user = $userModel->getUser('JohnDoe');
        $this->loadView('profile', ['title' => 'User Profile', 'user' => $user]);
    }

    private function loadView($viewName, $data = []) {
        extract($data);
        require_once "views/{$viewName}.php";
    }

    // public function createUser() {
    //     // Ensure POST data is retrieved correctly
    //     $name = $_POST['name'] ?? 'Unknown';
    //     echo "User $name has been created!";
    // }

    // public function updateUser() {
    //     parse_str(file_get_contents("php://input"), $_PUT);
    //     $name = $_PUT['name'] ?? 'Unknown';
    //     echo "User $name has been updated!";
    // }

    // public function deleteUser() {
    //     parse_str(file_get_contents("php://input"), $_DELETE);
    //     $name = $_DELETE['name'] ?? 'Unknown';
    //     echo "User $name has been deleted!";
    // }

    public function createUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = sanitize($data['name'] ?? '');
        if($name == '') {
            echo json_encode(["message" => "Please enter a name!"]);
            return;
        }
        $this->userModel->insert(['name' => $name]);
        echo json_encode(["message" => "User $name has been created!"]);
    }

    public function updateUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'] ?? 'Unknown';
        $id = $data['id'] ?? 0; 
        $this->userModel->update($id, ['name' => $name]);
        echo json_encode(["message" => "User $name has been updated!"]);
    }

    public function deleteUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'] ?? 0; 
        $this->userModel->delete($id);
        echo json_encode(["message" => "User with ID $id has been deleted!"]);
    }
}
?>
