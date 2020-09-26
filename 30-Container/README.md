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

## Kubernetes Installieren

Kubernetes kann über snap oder über apt-get isntalliert werden. Hier wird nur die apt-get methode aufgezeigt. beide möglichkeiten können auf der [Website von Kubernetes](https://kubernetes.io/de/docs/tasks/tools/install-kubectl/) eingesehen werden.

Um Kubernets zu isntallieren müssen nur wenige Befehle ausgeführt werden:

```sudo apt-get update && sudo apt-get install -y apt-transport-https````
```curl -s https://packages.cloud.google.com/apt/doc/apt-key.gpg | sudo apt-key add -```
```echo "deb https://apt.kubernetes.io/ kubernetes-xenial main" | sudo tee -a /etc/apt/sources.list.d/kubernetes.list``` sollte ```deb https://apt.kubernetes.io/ kubernetes-xenial main``` ausgeben.
```sudo apt-get update```
```sudo apt-get install -y kubectl```

Nun ist kubectl auf dem aktuellen Server installiert und bereit um verwendet zu werden.

## Docker

### Starten eines Containers

Um einen einfachen Container zu starten können wir einfach den befehl ```docker run -p 0.0.0.0:80:80 -d nginx``` ausführen.

Dieser Befehl startet einen nginx container mit standard-konfiguration. Der Port 80 des Containers wird auf den Port 80 des Hosts gebunden und Exposed. Ebenso wird der Container als deamon gestartet.

Nun shen wir uns an welcher Teil des commands was genau macht.

```docker run``` sagt Docker das wir einen Container starten wollen und jetzt die optinonen für den Start folgen.

```-p 0.0.0.0:80:80``` sagt Docker das der Host Port ```0.0.0.0:80``` auf den Container Port ```80``` gebunden wird. Das bedeutet das alles was im Container auf den Port 80 läuft auch auf den Host-Port ```0.0.0.0:80``` läuft. Der Syntax für das Port-Binding funktioniert also folgendermassen: ```-p [HostIP mit Port]:[Container Port]```

```-d``` sagt docker das man den Container als deamon starten will. Das bededutet das der Server als Dienst läuft und das man nach dem Start die Console-Session normal weiter benutzen kann. Wenn man den Container nicht als Deamon startet kann man die Konsole nicht weiterverwenden bis man den Container wieder mit ```Ctrl+C```beendet.

Nun haben wird einen Nginx Docker Container gestartet und können auf die Website über die Host-IP zugreifen.
Es gibt natürlich noch viele weitere möglichkeiten einen Container zu starten.

### Docker-Commands

#### docker run

```docker run [OPTIONS] IMAGE [COMMAND] [ARG...]``` startet den spezifizierten Container mit den spezifizierten Konfigurationsmöglichkeiten.

Mögliche Argumente.

| Argument | Beschreibung |
| ----- | ----- |
| -d | Startet den Container als deamon |
| -p [HostIP mit Port]:[Container Port] | Exposed und Bindet den COntainer Port auf den Host-Port |
| --hostname [Hostname] oder -h [Hostname] | Setzt den Hostname des Containers |

[Zur offiziellen Dokumentation](https://docs.docker.com/engine/reference/commandline/run/)
## Persönlicher Wissensstand

### Andi

### Moritz

### David

Ich habe schon ein bisschen mit Docker gearbeitet und betreibe einen Mailserver mit [Mailcow](https://mailcow.email/) welcher auf Docker aufbaut. Ebenfalls habe ich schon kleine Services mit Docker und Docker-compose entwickelt und deployed. Diese sind aber nciht mehr im Betrieb.