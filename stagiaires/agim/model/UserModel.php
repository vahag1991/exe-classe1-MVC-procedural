<?php 
function GetUser(PDO $pdo, string $user, string $pwd): bool {
    $sql = "SELECT password FROM users WHERE username = :user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user' => $user]);

    $row = $stmt->fetch();
    
    if ($row && password_verify($pwd, $row['password'])) {
        return true; 
    }
    
    return false;
}