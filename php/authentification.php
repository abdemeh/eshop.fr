<?php
function verifierConnexion($login, $mot_de_passe) {
    include 'bddData.php';
    $result = array();

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $hashed_password = md5($mot_de_passe);
       
        $stmt = $conn->prepare("SELECT id, nom, role, verification_date FROM users WHERE email = :login AND mdp = :mdp");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mdp', $hashed_password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['verification_date'] === null) {
                $result['success'] = 0;
                $result['message'] = "Pour accéder à votre compte, veuillez activer votre compte depuis l'email que nous vous avons envoyé.";
            } else {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_role'] = $row['role'];
                if(isset($_POST['se_souvenir'])) {
                    setcookie('user_id', $row['id'], time() + (86400 * 7), "/");
                    setcookie('user_role', $row['role'], time() + (86400 * 7), "/");
                }
                $result['success'] = 1;
                $result['message'] = "Connexion réussie, bienvenue.";
                $result['role'] = $row['role'];
            }
        } else {
            $result['success'] = 0;
            $result['message'] = "Désolé, le login ou le mot de passe est incorrect.";
        }
    } catch(PDOException $e) {
        $result['success'] = 0;
        $result['message'] = "Une erreur s'est produite lors de la connexion: ".$e->getMessage();
    }

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = isset($_POST["login"]) ? trim($_POST["login"]) : "";
    $mot_de_passe = isset($_POST["mot_de_passe"]) ? trim($_POST["mot_de_passe"]) : "";
    
    if (empty($login) || empty($mot_de_passe)) {
        $result['success'] = 0;
        $result['message'] = "Veuillez entrer un email et un mot de passe.";
    } else {
        $result = verifierConnexion($login, $mot_de_passe);
    }
    echo json_encode($result);
}
?>
