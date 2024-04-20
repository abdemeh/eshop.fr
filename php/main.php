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
    
?>