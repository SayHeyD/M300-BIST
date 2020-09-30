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

## Service-Überwachung und Alerts (K4)

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

## Continuous-Integration

Continuous-Integration ist zur Qualitätssicherung von Code gedacht, umganagsprchlich wird auch oft "von einen CI" geredet. Deshalb reden wir ab hier "vom GitHub CI" oder "vom CI".

> Die Repository mit den Workflows findet man [hier](https://github.com/SayHeyD/laravel-phone-book-docker)

Wir haben in GitHub CI 2 verschiedene Worflows eingerichtet. Einmal ein Workflow zum testen ob das Laravel-Projekt erfolgreich gebuildet werden kann und der andere Workflow um zu testen, ob der DOcker Container richtig gebuilded werden kann.

Wir haben uns dazu Entschieden zusätzlich zum Docker Workflow noch einen normalen Laravel Workflow zu machen. Wir haben uns dafür Entschieden um sehen zu können ob nur das Builden des Containers fehlschlägt oder ob das Problem am COde und der konfiguration des Projekts selbst liegt. Dies könnte man zwar auch in den Logs des tests sehen, jedoch haben wir so schneller einen genaueren Anhaltspunkt.

Die Workflows für das GitHub CI werden im Ordner ```.github/workflows``` abgespeichert. Pro Workflow erstellt man eine Datei, in unserem Fall ist das ```laravel.yml``` und ```docker-build.yml```. Pro dtei legt Github einen Workflow an.
Nun sehen wir uns an was genau in diesen Dateien steht.

### Laravel Workflow

Der Laravel Workflow macht ein Setup des Projekts und führt die Feature und Unittest welche vorhanden sind aus. In userem fall haben wir aber für so ein kleines Projekt keine Test gemacht.

In der ersten Zeile eines Workflows steht immer der Name des Workflows. In diesem Fall haben wir _Laravel_ als Name des Workflows genommen.

```yaml
name: Laravel
```

Im nächsten Schritt definieren wir wann der Workflow ausgeführt werden soll. Hier sagen wir bei welcher Aktion auf welchen Branches der Workflow ausgeführt werden soll. In unsren Fall wollen wir den Workflow bei einem erfolgreichen push oder einem erfolgreichen pull request ausführen.

```yaml
on:
  push:
    branches: [ master ]
  pull_request:
    branches: [ master ]
```

Im letzten Teil definieren wir welche Jobs und commands laufen sollen, dies kombiniren wir danach ich ein YAML file und laden das in den oben genannten Ordner hoch.

```yaml
name: Laravel

on:
  push:
    branches: [ master ]
  pull_request:
    branches: [ master ]

jobs:
  laravel-tests:

    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v2
    - name: Copy .env
      run: php -r "file_exists('.env') || copy('.env.example', '.env');"
    - name: Install Dependencies
      run: composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
    - name: Generate key
      run: php artisan key:generate
    - name: Directory Permissions
      run: chmod -R 777 storage bootstrap/cache
    - name: Create Database
      run: |
        mkdir -p database
        touch database/database.sqlite
    - name: Execute tests (Unit and Feature tests) via PHPUnit
      env:
        DB_CONNECTION: sqlite
        DB_DATABASE: database/database.sqlite
      run: vendor/bin/phpunit
```

### Docker Workflow

Der Docker Workflow ist leicht anders aufgebaut um Workflows etwas besser kennenzulernen.

Der Name des Workflows wird gleich definiert, jedoch besthet danach ein Unterschied in den triggerpunkten des Workflows hier definieren wir das nur bei einem Push der Workflow ausgeführt wird. Ebenfalls definieren wir hier das beim Tagging der Repository der Workflow ausgefürt werden soll.

```yaml
on:
  push:
    # Publish `master` as Docker `latest` image.
    branches:
      - master

    # Publish `v1.2.3` tags as releases.
    tags:
      - v*
```

Hier definieren wir ebenfalls das bei egal welcher Art von Pull-Request der Workflow ausgeführt werden soll, hier ist kein branch definiert, was heisst das der Workflow bei einem Pull Request auf allen branches ausgeführt werden soll, das heisst auch bei normalen Merges.

```yaml
on:
  push:
    # Publish `master` as Docker `latest` image.
    branches:
      - master

    # Publish `v1.2.3` tags as releases.
    tags:
      - v*

  # Run tests for any PRs.
  pull_request:
```

Danach definieren wir wie oben die Jobs und COmmands die ausgführt werden soll und kombinieren alles wieder in ein File.

```yaml
name: Docker

on:
  push:
    # Publish `master` as Docker `latest` image.
    branches:
      - master

    # Publish `v1.2.3` tags as releases.
    tags:
      - v*

  # Run tests for any PRs.
  pull_request:

jobs:
  # Run tests.
  # See also https://docs.docker.com/docker-hub/builds/automated-testing/
  test:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v2

      - name: Run tests
        run: |
          if [ -f docker-compose.test.yml ]; then
            docker-compose --file docker-compose.test.yml build
            docker-compose --file docker-compose.test.yml run sut
          else
            docker build . --file Dockerfile
          fi
```