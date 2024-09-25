#!/bin/bash

# Start a new tmux session named 'NOT-X'
tmux new-session -d -s NOT-X

# Run MySQL command in the first pane
tmux send-keys -t NOT-X 'mysql -u admin -pTeny123!' C-m

# Split the window and run PHP server in the new pane
tmux split-window -h
tmux send-keys -t NOT-X 'php -S localhost:8080' C-m

# Split the window again and run Tailwind CSS in the new pane
tmux split-window -v
tmux send-keys -t NOT-X 'npx tailwindcss -i ./src/input.css -o ./src/output.css --watch' C-m

# Attach to the tmux session
tmux attach -t NOT-X