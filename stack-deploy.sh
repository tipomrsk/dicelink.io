#!/bin/bash

# TESTANDO COISAS DIFERENTES AQUI
echo "----------------------------"
echo "-- Atualizando o ambiente --"
echo "----------------------------"
apt update -y
apt install -y nano git zip unzip jq

echo "-------------------------"
echo "-- Instalando o docker --"
echo "-------------------------"
curl -fsSL https://get.docker.com/ | bash

# DOCKER COMPOSE - UBUNTU X86
echo "--------------------------------"
echo "-- Instalado o docker compose --"
echo "--------------------------------"
curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose
ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

# REMOVE TODAS AS IMAGENS E CONTAINERS DA VM
echo "------------------------------------"
echo "-- Removendo resíduos de serviços --"
echo "------------------------------------"
docker system prune -a -f