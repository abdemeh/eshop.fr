<?php
function verifierConnexion($login, $mot_de_passe) {
    
    include 'bddData.php';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT id, nom, role, verification_date FROM users WHERE email = :login AND mdp = :mdp");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mdp', md5($mot_de_passe));
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['verification_date'] === null) {
                header("Location: ../login.php?error=Pour accéder à votre compte, veuillez activer votre compte depuis l'email que nous vous avons envoyé.");
                exit;
            }
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_role'] = $row['role'];
            if(isset($_POST['se_souvenir'])) {
                setcookie('user_id', $row['id'], time() + (86400 * 7), "/");
                setcookie('user_role', $row['role'], time() + (86400 * 7), "/");
            }
            return true;
        } else {
            return false;
        }
    } catch(PDOException $e) {
        header('Location: ../login.php?error='.$e->getMessage());
    }
    $conn = null;
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = isset($_POST["login"]) ? trim($_POST["login"]) : ""; // Trim the login input
    $mot_de_passe = isset($_POST["mot_de_passe"]) ? trim($_POST["mot_de_passe"]) : ""; // Trim the password input
    
    // Check if login or password is empty
    if (empty($login)) {
        header("Location: ../login.php?error=Veuillez entrer un email.");
        exit;
    }elseif(empty($mot_de_passe)) {
        header("Location: ../login.php?error=Veuillez entrer un mot de passe.");
        exit;
    }
    
    if (verifierConnexion($login, $mot_de_passe)) {
        if ($_SESSION['user_role'] == "admin") {
            header("Location: ../admin.php");
            exit;
        } else {
            header("Location: ../index.php");
            exit;
        }
    } else {
        header('Location: ../login.php?error=Désolé, le login ou le mot de passe est incorrect.');
        exit;
    }
}

?>
