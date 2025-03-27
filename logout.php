<?php
$data = json_decode(file_get_contents("php://input"), true);
$host = escapeshellarg($data["host"]);
$user = escapeshellarg($data["user"]);
$pass = escapeshellarg($data["pass"]);

$sessionName = "wearos_" . preg_replace('/[^a-z0-9]/i', '_', $data["user"]);
$sshPrefix = "sshpass -p $pass ssh -o StrictHostKeyChecking=no $user@$host";

// Session beenden
shell_exec("$sshPrefix 'tmux kill-session -t $sessionName'");

echo "Logout OK";
?>
