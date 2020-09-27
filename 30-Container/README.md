# Container

## Docker Installation

Dieser Teil der Dokumentation ist hinzugefügt worden, da der TBZ-Cloud server abgestürtzt ist.

Um Docker auf Ubuntu zu installieren gibt es eine Anleitung von [Docker](https://docs.docker.com/engine/install/ubuntu/) selbst.

Um Docker neu zu installieren führt man die folgende Befehle aus:

Update der repositories: ```sudo apt-get update```

Zusätzlich benötigte programme installieren:
```
sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common
```

Docker GPG Key hinzufügen:
```
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
```

Um den Key zu überprüfen: ```sudo apt-key fingerprint 0EBFCD88```

Der Key sollte folgendes Ausgeben:
```
pub   rsa4096 2017-02-22 [SCEA]
      9DC8 5822 9FC7 DD38 854A  E2D8 8D81 803C 0EBF CD88
uid           [ unknown] Docker Release (CE deb) <docker@docker.com>
sub   rsa4096 2017-02-22 [S]
```

Nun kann man die DOcker repository hinzufügen:
```
sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"
```

Danach kann man docker über apt-get isntallieren:
```sudo apt-get update```  
```sudo apt-get install docker-ce docker-ce-cli containerd.io```

Nun sollte man mit dem Befehl ```docker -v``` die aktuelle installierte Dockerversion sehen.

## Docker

### MySQL Container mit Docker

#### Schritt 1: MySQL Docker Image laden

1. Ziehe ein mysql-Image mit der aktuellsten Version. Es können auch ältere Versionen ausgewählt werden, wenn ```latest``` durch die entsprechende Version ersetzt wird. Eine Übersicht der Versionen sind auf [dieser Seite](https://hub.docker.com/_/mysql)

```
docker pull mysql/mysql-server:latest
```

2. Überprüfen, ob das Images erfolgreich heruntergeladen wurde.

```
docker images
```

#### Schritt 2: MySQL Container deployen

1. Nun wird ein container erzeugt. ```[container_name]``` muss durch einen gewünschten Namen ersetzt werden. Die Option ```-d``` weist Docker an, den Container als Dienst im Hintergrund laufen zu lassen. Es kann wieder eine andere Version ausgewählt werden, indem ```latest``` durch die entsprechende Versions-Nummer ersetzt wird.

```
docker run --name=[container_name] -d mysql/mysql-server:latest
```

2. Überprüfen, ob der MySQL Container gestartet ist.

```
docker ps
```

#### Schritt 3: Mit MySQL Docker Container verbinden

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

#### Schritt 4: MySQL Container konfigurieren

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

### Starten eines Nginx Containers

Um einen einfachen Container zu starten können wir einfach den befehl ```docker run -p 0.0.0.0:80:80 -d nginx``` ausführen.

Dieser Befehl startet einen nginx container mit standard-konfiguration. Der Port 80 des Containers wird auf den Port 80 des Hosts gebunden und Exposed. Ebenso wird der Container als deamon gestartet.

Nun shen wir uns an welcher Teil des commands was genau macht.

```docker run``` sagt Docker das wir einen Container starten wollen und jetzt die Optionen für den Start folgen.

```-p 0.0.0.0:80:80``` sagt Docker das der Host Port ```0.0.0.0:80``` auf den Container Port ```80``` gebunden wird. Das bedeutet das alles was im Container auf den Port 80 läuft auch auf den Host-Port ```0.0.0.0:80``` läuft. Der Syntax für das Port-Binding funktioniert also folgendermassen: ```-p [HostIP mit Port]:[Container Port]```

```-d``` sagt docker das man den Container als deamon starten will. Das bededutet das der Server als Dienst läuft und das man nach dem Start die Console-Session normal weiter benutzen kann. Wenn man den Container nicht als Deamon startet kann man die Konsole nicht weiterverwenden bis man den Container wieder mit ```Ctrl+C```beendet.

Nun haben wird einen Nginx Docker Container gestartet und können auf die Website über die Host-IP zugreifen.
Es gibt natürlich noch viele weitere möglichkeiten einen Container zu starten.

### Docker-Commands

| Docker Befehl| Funktionsbeschreibung |
| ------------- |-----------------------|
| docker run | Container starten |
| docker ps  | Aktive Container anzeigen |
| docker stop  | Einen oder mehrere Container stoppen  |
| docker restart  | Einen oder mehrere Container neustarten|
| docker rm | Einen oder mehrere Container löschen|
| docker inspect | Speicherort des Volumes überprüfen |

#### docker run

```docker run [OPTIONS] IMAGE [COMMAND] [ARG...]``` startet den spezifizierten Container mit den spezifizierten Konfigurationsmöglichkeiten.

Mögliche Argumente.

| Option | Beschreibung |
| ----- | ----- |
| -d | Startet den Container als deamon |
| -p [HostIP mit Port]:[Container Port] | Exposed und Bindet den COntainer Port auf den Host-Port |
| --hostname [Hostname] oder -h [Hostname] | Setzt den Hostname des Containers |

[Zur offiziellen Dokumentation](https://docs.docker.com/engine/reference/commandline/run/)

#### docker ps

```docker ps [OPTIONS]``` listet Container auf. Ohne angegebene Optionen listet der COmmand alle laufenden Container auf.

| Option | Beschreibung |
| ----- | ----- |
| -a | Listet alle Contaienr auf die laufen und gelaufen sind |
| -s | Zeigt die Festplattenbelegung pro Container an |
| --format "[Format String]" | Formatiert den Output des Befehls. Die Keys zur Formatierung können [hier eingesehen werden](https://docs.docker.com/engine/reference/commandline/ps/#formatting) |

[Zur offiziellen Dokumentation](https://docs.docker.com/engine/reference/commandline/ps/)

## Container für Eigenen Service

Als Vorbereitung für unseren eigenen Service müssen wir einige Container erstellen.

User Service soll eine eigens für dieses Modul erstellte Web-App sein. Die Webapp wurde mit [Laravel](https://laravel.com/) erstellt. Laravel ist ein PHP-Framework. Unsere WEb-App ist ein kleines Telefonbuch in dem wir KOntakte speichern können. Damit alles richtig funktioniert, brauchen wir einen Nginx-Webserver auf welchem unsere Apllikationsdateien liegen, einen MySQL-Datenbank Server auf welchem usnere Daten liegen, einen php-fpm server um unsere PHP-Scripts auszuführen und einen Reverse-Proxy.

Benötigte Container:
* php7.4-fpm mit php-extensions
* nginx webserver mit applikationsdateien
* mysql datenbankserver
* ngninx reverse-proxy

### PHP-FPM Container

Für den php7.4-fpm server gitb es bereits ein [docker-image](https://hub.docker.com/_/php), jedoch sind dort noch nicht alle php-extension installiert welche wir für das betreiben der Web-App benötigen. Man könnte diese extensions in einem Dockerfile alle manuell installieren, allerdings gibt es bereits ein script welches einen grossteil der Installation für einen übernimmt, wir müssen zwar immer noch ein eigenes [Dockerfile](https://github.com/SayHeyD/M300-BIST/blob/master/docker-files/php-fpm/Dockerfile) für den Container erstellen, jedoch geht das mit dem [```install-php-extensions``` script](https://github.com/mlocati/docker-php-extension-installer) einiges schneller.

Nachdem wir das [Dockerfile](https://github.com/SayHeyD/M300-BIST/blob/master/docker-files/php-fpm/Dockerfile) angelegt haben, können wir das image builden:

1. In den selber Ordner wie das Dockerfile navigieren
2. ```docker build -t php7.4-fpm-with-extensions .``` ausführen
3. Mit ```docker images``` überprüfen ob ein image mit dem Namen *php7.4-fpm-with-extensions* vorhanden ist.

## Persönlicher Wissensstand

### Andi

Bisher waren mir "Container" oder "Docker" nicht wirklich ein Begriff. In meiner Arbeitsumgebung hatte ich nur mit gewöhnlichen VM's zu tun, welche mit VMWare Player oder Virtualbox erstellt wurden.
Die Möglichkeiten und die Vielzahl an Verwendungszewecken, welche mit Containersystemen bewerkstelligt werden können, sind mir bisher nicht bekannt gewesen.

### Moritz

### David

Ich habe schon ein bisschen mit Docker gearbeitet und betreibe einen Mailserver mit [Mailcow](https://mailcow.email/) welcher auf Docker aufbaut. Ebenfalls habe ich schon kleine Services mit Docker und Docker-compose entwickelt und deployed. Diese sind aber nciht mehr im Betrieb.

## Persönliche Lernentwicklung & Reflexion

### Andi

Im Unterricht wurden mir die Verwendungszwecke genauer erklärt und aufgezeigt wie mit Containern gearbeitet werden soll. In der Praxisarbeit habe ich zum ersten Mal ein Container erstellt und den Microservice aufgebaut.

Die Handhabung und das Verständnis wie genau was und wo erstellt werden sollte, schien mir zu Beginn etwas komplex und Umständlich. Zuerst habe ich es nicht wirklich begriffen. Als ich zum 2. Mal ein MySQL Container erstellt hatte, schien es schon etwas besser zu klappen. Als ich dazu dann noch die Doku erstellt habe, wurde mir einiges klar und ich konnte erfolgreich ein Container erstellen und bearbeiten.

Ich denke jedoch, dass das aufziehen und unterhalten einer solchen Conainer-Umgebung, ohne grosse Übung, viel Zeit in Anspruch nimmt. Die Idee finde ich sehr gut, da eine dynamische Arbeitsweise geschaffen werden kann und schnell neue Funktionen und Microservices erstellt und bearbeitet werden können. 

### Moritz

### David

