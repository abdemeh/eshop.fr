<?php
function verifierConnexion($login, $mot_de_passe) {
    
    include 'bddData.php';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT id, nom, role, verification_date FROM users WHERE email = '$login' AND mdp = '".md5($mot_de_passe)."'");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['verification_date'] === null) {
                // Redirect user to login page with error message
                header("Location: ../login.php?error=Pour accéder à votre compte, veuillez activer votre compte depuis l'email que nous vous avons envoyé.");
                exit;
            }
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    } catch(PDOException $e) {
        header('Location: ../login.php?error='.$e->getMessage());
    }
    $conn->close();
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $mot_de_passe = $_POST["mot_de_passe"];
    if (verifierConnexion($login, $mot_de_passe)) {
        header("Location: ../index.php");
        $conn->close();
        exit;
    } else {
        header('Location: ../login.php?error=Désolé, le login ou le mot de passe est incorrect.');
        $conn->close();
        exit;
    }
}

?>
