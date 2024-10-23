<?php
function sanitize($data, $allowed_tags = '') {
    if (is_array($data)) {
        // Recursively sanitize each element in the array
        return array_map(function ($item) use ($allowed_tags) {
            return sanitize($item, $allowed_tags);
        }, $data);
    } else {
        $data = trim($data);                          // Remove unnecessary whitespace
        $data = stripslashes($data);                  // Remove backslashes (\)
        $data = strip_tags($data, $allowed_tags);      // Allow only certain HTML tags
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Prevent XSS
        $data = escapeshellcmd($data);                // Escape shell commands
        return addslashes($data);                     // Prevent SQL injection
    }
}
?>