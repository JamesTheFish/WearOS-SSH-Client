<?php
$data = json_decode(file_get_contents("php://input"), true);
$host = escapeshellarg($data["host"]);
$user = escapeshellarg($data["user"]);
$pass = escapeshellarg($data["pass"]);
$cmd  = escapeshellcmd($data["cmd"]);

$sessionName = "wearos_" . preg_replace('/[^a-z0-9]/i', '_', $data["user"]);
$sshPrefix = "sshpass -p $pass ssh -o StrictHostKeyChecking=no $user@$host";

// Prüfe ob Session läuft, wenn nicht: starte sie
$checkSession = "$sshPrefix 'tmux has-session -t $sessionName 2>/dev/null || tmux new-session -d -s $sessionName'";
shell_exec($checkSession);

// Sende Befehl an tmux
shell_exec("$sshPrefix 'tmux send-keys -t $sessionName \"$cmd\" Enter'");

// Kurze Wartezeit, damit Befehl ausgeführt wird
usleep(300000);

// Ausgabe holen
$output = shell_exec("$sshPrefix 'tmux capture-pane -pt $sessionName'");

echo $output ?: "Keine Antwort.";
?>
