<?php 
    function getUserData($userId, $conn) {
        $stmt = $conn->prepare("SELECT nom, prenom, email, genre, date_naissance, metier_id, role FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result_users = $stmt->get_result();

        if ($result_users->num_rows > 0) {
            $userData = $result_users->fetch_assoc();
            return $userData;
        } else {
            return [];
        }
    }

    function getMetiers($conn) {
        try {

            $sql = "SELECT * FROM metier";
            $result = $conn->query($sql);
    
            $metierData = [];
    
            while ($row = $result->fetch_assoc()) {
                $metierData[] = $row;
            }
    
            return $metierData;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    function getSettings() {
        $settings_file = 'settings.json';
    
        $default_settings = [
            'devise' => '€',
            'tva' => 20,
            'livraison' => 19.99,
            'facebook_url' => '#',
            'instagram_url' => '#',
            'x_url' => '#',
            'phone' => '',
            'admin_contact_email' => ''
        ];
    
        // Check if the settings file exists
        if (file_exists($settings_file)) {
            // Load existing settings from the file
            $existing_settings_json = file_get_contents($settings_file);
            $existing_settings = json_decode($existing_settings_json, true);
    
            // Merge default settings with existing settings, overwriting existing keys
            $merged_settings = array_merge($default_settings, $existing_settings);
        } else {
            // If file doesn't exist, use default settings
            $merged_settings = $default_settings;
    
            // Save default settings to file
            $updated_settings_json = json_encode($default_settings, JSON_PRETTY_PRINT);
            file_put_contents($settings_file, $updated_settings_json);
        }
    
        // Return the merged settings
        return $merged_settings;
    }
    
?>

