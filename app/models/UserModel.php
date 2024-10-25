
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
    public function formSubmit($formTitle, $formFields) {
        try {
            // Start a transaction to ensure data integrity
            $this->connection->beginTransaction();
    
            // Insert the form title and the creator into the forms table
            $sql = "INSERT INTO forms (title, created_by) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$formTitle, 1]); // Assuming '1' as the user_id (static for now)
    
            // Get the last inserted form ID to associate fields with this form
            $formId = $this->connection->lastInsertId();
    
            // Prepare the SQL for inserting fields into the form_fields table
            $sql = "INSERT INTO form_fields (form_id, field_name, field_type) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
    
            // Loop through each field and save it to the form_fields table
            foreach ($formFields as $field) {
                $fieldName = $field['name'] ?? null;
                $fieldType = $field['type'] ?? null;
    
                // Check if field name and type are provided
                if ($fieldName && $fieldType) {
                    $stmt->execute([$formId, $fieldName, $fieldType]);
                }
            }
    
            // Commit the transaction after all queries have been executed
            $this->connection->commit();
    
            // Return success response
            return ['success' => true, 'message' => 'Form and fields saved successfully!'];
        } catch (PDOException $e) {
            // Roll back the transaction if any error occurs
            $this->connection->rollBack();
            // Return error response with a message
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    public function getFormDetails($formId) {
        try {
            // Fetch the form details
            $sql = "SELECT title FROM forms WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$formId]);
            $form = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Fetch associated fields for the form
            $sql = "SELECT field_name, field_type FROM form_fields WHERE form_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$formId]);
            $fields = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Combine form and fields
            return [
                'form' => $form,
                'fields' => $fields
            ];
        } catch (PDOException $e) {
            return ['error' => 'Error fetching form details: ' . $e->getMessage()];
        }
    }
    
    
}
?>