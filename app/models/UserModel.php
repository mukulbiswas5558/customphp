
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
    public function createTable($tableName, $fields) {
        $columns = [];
        
        foreach ($fields as $field) {
            $name = $field['name'] ?? ''; // Use empty string if 'name' doesn't exist
            $type = $field['type'] ?? 'VARCHAR'; // Default to VARCHAR if 'type' is missing
            $size = isset($field['size']) ? (int) $field['size'] : 255; // Default size to 255
            
            // Skip if field name is empty
            if (empty($name)) continue;
    
            $columns[] = "$name $type($size)";
        }
    
        $columnsSQL = implode(", ", $columns);
        $createTableSQL = "CREATE TABLE IF NOT EXISTS $tableName (
            id INT AUTO_INCREMENT PRIMARY KEY, 
            $columnsSQL
        )";
    
        try {
            $this->connection->exec($createTableSQL);
            return "Table '$tableName' created successfully!";
        } catch (PDOException $e) {
            return "Error creating table: " . $e->getMessage();
        }
    }
}
?>