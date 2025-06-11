<?php
function authenticateUser(PDO $pdo, string $user, string $pwd): bool
{
    $sql = "SELECT iduser, userpwd FROM user WHERE login = :user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user' => $user]);
    $row = $stmt->fetch();

    if (!$row) {
        return false;
    }

    if (!password_verify($pwd, $row['userpwd'])) {
        return false;
    }

    // Sécuriser la session
    session_start();
    session_regenerate_id(true);
    $_SESSION['user_id'] = $row['iduser'];

    return true;
}


function registerUser(PDO $pdo, string $user, string $userName, string $mail, string $pwd): bool
{
    $cleanUser = trim(strip_tags($user));
    $cleanUserName = trim(strip_tags($userName));
    $cleanMail = trim(strip_tags($mail));

    if ($cleanUser === "" || $cleanUserName === "" || $cleanMail === "" || $pwd === "") {
        return false;
    }

    $securPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (login, username, usermail, userpwd) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        return $stmt->execute([$cleanUser, $cleanUserName, $cleanMail, $securPwd]);
    } catch (PDOException $e) {
        // Log erreur si besoin
        return false;
    }
}
