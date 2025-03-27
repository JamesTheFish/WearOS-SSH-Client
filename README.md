# WearOS SSH Web Interface with Persistent tmux Session

This project is a minimalist, touch-optimized web interface designed for WearOS or small-screen devices. It allows you to send remote SSH commands to a target device using a persistent `tmux` session, maintaining session state across multiple commands.

## Features

- Login screen with prefilled defaults (host, username, password)
- Command dropdown populated from `Befehle.txt`
- Optional custom command input
- Persistent SSH session using `tmux` on the target device
- Real-time command output shown in the interface
- Lightweight logout button that gracefully closes the remote session
- Fully optimized for tiny/touch-based screens like WearOS

## How It Works

Instead of executing each command in an isolated SSH session, the backend connects via SSH and maintains a persistent `tmux` session on the target machine named `wearos_<user>`. Commands are injected into this shell and their output is captured using `tmux capture-pane`. Upon logout, the session is terminated cleanly.

## File Structure

```
.
├── index.html         # Main WearOS-optimized web interface
├── server.php         # Sends SSH commands into tmux via sshpass
├── logout.php         # Terminates the tmux session on logout
├── commands.php       # Reads available commands from Befehle.txt
└── Befehle.txt        # One command per line (e.g. ls, uptime, df -h)
```

## Requirements

- PHP (tested with `php -S 0.0.0.0:8000`)
- `sshpass` installed on the server
- Target device must allow SSH access
- `tmux` must be installed on the target system

## Usage

```bash
php -S 0.0.0.0:8000
```

Then access the web interface via your WearOS browser or smartphone at:

```
http://<your-local-ip>:8000/
```

Log in, select or type commands, and interact with your remote session as if you were using a terminal.

## Security Warning

This is a **local-only tool** intended for secure private networks.  
It uses basic password authentication and should **not be exposed to the public internet** without HTTPS, authentication hardening, and additional security measures.

## License

MIT — free to use, modify, and share.  
You are responsible for your own security and deployment context.
