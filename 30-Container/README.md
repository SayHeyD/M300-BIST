# Container

# Docker Befehle

| Docker Befehl| Funktionsbeschreibung |
| ------------- |-----------------------|
| docker ps  | Aktive Container anzeigen |
| docker ps -a  | Alle Container anzeigen |
| docker stop  | Einen oder mehrere Container stoppen  |
| docker stop  | Einen oder mehrere Container stoppen  |
| docker restart  | Einen oder mehrere Container neustarten|
| docker rm | Einen oder mehrere Container löschen|

## MySQL Container mit Docker

### Schritt 1: MySQL Docker Image laden

1. Ziehe ein mysql-Image mit der aktuellsten Version. Es können auch ältere Versionen ausgewählt werden, wenn ```latest``` durch die entsprechende Version ersetzt wird. Eine Übersicht der Versionen sind auf [dieser Seite](https://hub.docker.com/_/mysql)

```
docker pull mysql/mysql-server:latest
```

2. Überprüfen, ob das Images erfolgreich heruntergeladen wurde.

```
docker images
```

### Schritt 2: MySQL Container deployen

1. Nun wird ein container erzeugt. ```[container_name]``` muss durch einen gewünschten Namen ersetzt werden. Die Option ```-d``` weist Docker an, den Container als Dienst im Hintergrund laufen zu lassen. Es kann wieder eine andere Version ausgewählt werden, indem ```latest``` durch die entsprechende Versions-Nummer ersetzt wird.

```
docker run --name=[container_name] -d mysql/mysql-server:latest
```

2. Überprüfen, ob der MySQL Container gestartet ist.

```
docker ps
```

### Schritt 3: Mit MySQL Docker Container verbinden

1. Zuerst muss MySQL client package installiert werden.

```
apt-get install mysql-client
```

2. Dann den MySQL client im Container starten.

```
docker exec -it [container_name] mysql -uroot -p
```

https://phoenixnap.com/kb/mysql-docker-container

## Persönlicher Wissensstand

### Andi

### Moritz

### David
