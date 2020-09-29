# Sicherheit

## Apekte der Container absicherung (K4)

| Aspekt | Container | VMs |
| ----- | ----- | ----- |
| Kernel Exploits | Host schwer beeinträchtigt | Host abgeschirmt |
| DoS Angriffe | Host Ressourcen können ohne Ressourcenlimitierung extrem gut exploitet werden | Ressourcen sind immer begrenzt |
| Infected Images | Können das ganze System infizieren | Können ausser bei einem Hypervisor exploit nicht viel ausrichten |

### Kernel exploits

Um Kernel-Exploits vorzubeugen sollte man seinen Host in regelmässigen abständen updaten, dies machen wir in unserem Fall wöchentlich, solange nicht schwerwiegende Fehler in der neusten Version vorliegen, ebenso lohnt es sich bei grösseren Updates etwas zu warten bevor man Sie auf das live-system übernimmt. Hier machen Hotfixes eine Ausnahme, da diese meist extrem schwerwiegende Fehler beheben und in seltensten Fällen mehr schaden anrichten als beheben.

### DoS Angriffe

DoS Angriffe könenn in einer Container umgebung sehr viel schaden anrichten, wenn man die Container ressourcen nicht limitiert. Hier kann auch schlechte Software-Architektur ein problem darstellen, da auch Software ressourcen überbeanspruchte werden können. Hier sollte man auf jeden Fall die Container-ressourcen limitieren und bei kritischen Services die Software genauer unter die Lupe nehmen.

Docker Ressourcen bei ```docker run``` zu limitieren geht mit den verschiedenen Parametern.

* RAM limitieren: ```-m 4m oder --memory=4m```
* CPU limitieren: ```--cpus=1.5```

### Infected Images

infected images sind vor allem ein problem bei images die nicht offiziell und nicht open-source sind. Um infected images aus dem weg zu gehen, empfehlen wir nur Images aus Open-Source quellen mit guter reputation oder von offizieller Quelle zu verwenden.

[Offizielle Docker Images](https://hub.docker.com/search?q=&type=image&image_filter=official)

### Fazit

Auch wenn container unsicherer als VMs wirken, können Sie denncoh gut restriktriert werden und bieten einige Administrationsvorteile gegenüber VMs. Wir denken das je länger desto mehr Container benutzt werden, diese immer etablierter werden und auch ausgereifter. Wir sehen ausser bei Hoch-kritischen Systemen keine Cybersecurity einschrenkungen bei der Verwenung von Containern.

## Service-Überwachung und Alerts

Die Überwachung von Services ist zur Qualitätssicherung extrem wichtig. Da wir nicht immer jemanden haben können, der Überprüft ob unsere Services verfügbar sind, ist hier die Automation sehr von Vorteil. So können wir einen weiteren Deisnt aufsetzen, der Überprüft ob alle unseren anderen Services Verfügbar sind. Dieser eine Service benötigt zwar immer noch eine manuelle Überprüfung jedoch nicht so oft und wie schon gesagt kann dieser Service mehrere Services auf einmal überprüfen.

Es gibt von der Community verschiedene Tools um die [Docker-Events](https://docs.docker.com/engine/reference/commandline/events/) zu überwachen.

Ich ahbe mich in unserem Fall für [docker-events-notifier](https://github.com/hasnat/docker-events-notifier) entschieden, da dieser die Benachrichtigungen auch per E-Mail verschicken kann.

Um [docker-events-notifier](https://github.com/hasnat/docker-events-notifier) verwenden zu können benötigen wir lediglich docker und ein par konfigurationsdataien. Hier empfiehlt es sich auch wieder extra zu starten dieses Containers ein ordner anzulegen.

Die Struktur dieses Ordners sieht wie folgt aus:

```
docker-event-notifier
|— config.yml
|— templates/
 |— email.txt
```

Hier kümmern wir uns also um 2 Dateien:

1. config.yml
2. templates/email.txt

### config.yml

In dieser Datei können wir das verhalten des notifiers an passen, unten ist eine Beispiel-Datei die die container unseres phone-book services überprüft.

```
otifiers:
  email:
    url: "smtp://david@docapo.ch:[PASSWORT]@mail.docampo.ch:587?from=david@docampo.ch&to=david@docampo.ch"
    template: /etc/docker-events-notifier/templates/email.txt

# global filters ( check https://docs.docker.com/engine/reference/commandline/events/#filter-events-by-criteria )
filters:
  event: ["stop", "die", "destroy"]
#  container: ["some_container_name"]
#  image: ["hasnat/docker-events-notifier"]

notifications:
  - title: "Alert me when a container dies with exitCode 1"
    when_regex:
      status: ["(die|destroy)"]
      "Actor.Attributes.image": ["phone-book", "mysql", "reverse-proxy"]
    when:
      "Actor.Attributes.exitCode": ["1"]
    notify:
      - email

  - title: "Alert me when a container dies with exitCode 0"
    when_regex:
      status: ["(die|destroy)"]
      "Actor.Attributes.image": ["phone-book", "mysql", "reverse-proxy"]
    when:
      "Actor.Attributes.exitCode": ["0"]
    notify:
      - email

  - title: "Alert me on anything happening to images"
    when_regex:
      "Actor.Attributes.image": ["phone-book", "mysql", "reverse-proxy"]
    notify:
      - email
```

### templates/email.txt

Im E-Mail template ist beschrieben was an den Empfänger der Benachrichtigung geschickt werden soll, hier ist auch wieder ein Beispiel dieser Datei für unseren Service.

```
From: david@docampo.ch
Subject: Docker Event on {{.dockerHostLabel}}/{{.Actor.Attributes.name}}

This is the email body.
host: {{.dockerHostLabel}}
image: {{.Actor.Attributes.image}}
exitCode: {{.Actor.Attributes.exitCode}}
container_name: {{.Actor.Attributes.name}}
Action: {{.Action}}
status: {{.status}}
time: {{TimeStampFormat .time "Mon Jan _2 15:04:05 MST 2006"}}

All Details
{{ .eventJSON }}
```