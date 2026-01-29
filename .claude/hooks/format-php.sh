#!/bin/bash

# Hook Claude Code : Formate automatiquement les fichiers PHP après édition
# Se déclenche sur chaque Edit/Write de fichier PHP

# Récupérer le chemin du fichier modifié depuis l'input du hook
INPUT=$(cat)
FILE_PATH=$(echo "$INPUT" | jq -r '.tool_input.file_path // .tool_input.file_path // empty' 2>/dev/null)

# Vérifier que c'est un fichier PHP
if [[ "$FILE_PATH" == *.php ]]; then
    ./vendor/bin/pint "$FILE_PATH" --quiet 2>/dev/null
fi
