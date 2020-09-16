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

## mysql in Docker
1. Ziehe ein mysql-Image mit der aktuellsten Version. Es können auch ältere Versionen ausgewählt werden, wenn "latest" durch die entsprechende Version ersetzt wird. Eine Übersicht der Versionen sind auf [dieser Seite](https://hub.docker.com/_/mysql)

```
docker pull mysql/mysql-server:latest
```

2. Überprüfen, ob das Images erfolgreich heruntergeladen wurde.

```
docker images
```

3. Nun wird ein container erzeugt. ```[container_name]``` muss durch einen gewünschten Namen ersetzt werden. Die Option ```-d``` weist Docker an, den Container als Dienst im Hintergrund laufen zu lassen.

```
docker run --name=[container_name] -d mysql/mysql-server:latest
```

4. 



## Persönlicher Wissensstand

### Andi

### Moritz

### David
