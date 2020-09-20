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
| docker inspect | Speicherort des Volumes überprüfen |

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
![rootpw](https://github.com/SayHeyD/M300-BIST/blob/master/images/tempsnip.png)

3. Das root-Passwort angeben.

4. Zum Schluss das root-Passwort ändern. ```[newpassword]``` durch das neue Passwort ersetzen.

```
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY '[newpassword]';
```

### Schritt 4: MySQL Container konfigurieren

Info: Die Konfigurations-Optionen finden sich unter folgenden Pfad:  ```/etc/mysql/my.cnf```.

1. Zuerst ein neuer Pfad für den Container erstellen.

```
mkdir -p /root/docker/[container_name]/conf.d
```

2. Wenn in diesem Verzeichnis Änderungen gemacht wurden, ist es notwendig, den Container zu entfernen und einen neuen zu erstellen. Der neue Container bezieht die konfig-Datei, welche vorher erstellt wurde.

Dazu muss der Container gestartet werden und den volumepfad mit folgenden befehlen gebildet werden.

```
docker run \
--detach \
--name=[container_name]\
--env="MYSQL_ROOT_PASSWORD=[my_password]" \
--publish 6603:3306 \
--volume=/root/docker/[container_name]/conf.d:/etc/mysql/conf.d \
mysql
```

3. Um zu überprüfen, ob der Container die Konfig-Datei vom Host ladet, folgenden Befehl ausführen.

```
mysql -uroot -pmypassword -h127.0.0.1 -P6603 -e 'show global variables like "max_connections"';
```

## Persönlicher Wissensstand

### Andi

Bisher waren mir "Container" oder "Docker" nicht wirklich ein Begriff. In meiner Arbeitsumgebung hatte ich nur mit gewöhnlichen VM's zu tun, welche mit VMWare Player oder Virtualbox erstellt wurden.
Die Möglichkeiten und die Vielzahl an Verwendungszewecken, welche mit Containersystemen bewerkstelligt werden können, sind mir bisher nicht bekannt gewesen.

### Moritz

### David

## Persönliche Lernentwicklung & Reflexion

### Andi

Im Unterricht wurden mir die Verwendungszwecke genauer erklärt und aufgezeigt wie mit Containern gearbeitet werden soll. In der Praxisarbeit habe ich zum ersten Mal ein Container erstellt und den Microservice aufgebaut.

Die Handhabung und das Verständnis wie genau was und wo erstellt werden sollte, schien mir zu Beginn etwas komplex und Umständlich. Zuerst habe ich es nicht wirklich begriffen. Als ich zum 2. Mal ein MySQL Container erstellt hatte, schien es schon etwas besser zu klappen. Als ich dazu dann noch die Doku erstellt habe, wurde mir einiges klar und ich konnte erfolgreich ein Container erstellen und bearbeiten.

Ich denke jedoch, dass das aufziehen und unterhalten einer solchen Conainer-Umgebung, ohne grosse Übung, viel Zeit in Anspruch nimmt. Die Idee finde ich sehr gut, da eine dynamische Arbeitsweise geschaffen werden kann und schnell neue Funktionen und Microservices erstellt und bearbeitet werden können. 

### Moritz

### David
