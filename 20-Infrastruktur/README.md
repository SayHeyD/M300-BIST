# Eigene Lernumgebung

# GitHub (K2)

Wir hatten alle schon GitHub-Accounts erstellt. Deshalb mussten wir diese nicht mehr erstellen.

<img src="https://github.com/SayHeyD/M300-BIST/blob/master/images/Bildschirmfoto%202020-08-19%20um%2010.06.45.png" alt="GitHub Profile" width="200px">

Danach haben wir alle in die Repo eingeladen.

<img src="https://github.com/SayHeyD/M300-BIST/blob/master/images/Bildschirmfoto%202020-08-19%20um%2011.38.53.png" alt="GitHub Collaborators" width="600px">

# Benutzen des Git-CLI (K2)

Das git-cli ist für das heruterladen von projekten auf server unabdingbar, da man so einfach und sicher ganze Projekte auf einen Server bekommt ohne das man einen Client dazwischen schalten muss. ebenfalls beitet das CLI eine gute basis für automation, somit kann auch wenn eine neue Instanz erstellt wird direkt die aktuellste Version aus der repo pullen, auch wenn dies in den meisten Fällen nicht erwünschenswert ist.

<img src="https://github.com/SayHeyD/M300-BIST/blob/master/images/Bildschirmfoto%202020-08-19%20um%2011.44.38.png" alt="Git-CLI in use" width="400px">

# Vagrant (K2)

Vagrant ist ein Tool zur Automtisierung für das Aufsetzen von VMs. So kann man zum Beispiel eine VM aufsetzen, auf der direkt Nginx / apache oder andere services installiert werden. Ein Vagrant-File sieht in etwa so aus:

```
Vagrant.configure("2") do |config|
    config.vm.box = "ubuntu/bionic64"

    config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "0.0.0.0"

    config.vm.network "private_network", ip: "192.168.90.2"

    config.vm.synced_folder "./nginx-config", "/etc/nginx"

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "512"
    end

    config.vm.provision "shell", inline: <<-SHELL
        apt-get update
        apt-get install -y nginx
        service nginx restart
    SHELL
end
```

Dieses File setzt einen Nginx Reverse-Proxy auf und verbindet den lokalen ordner "./nginx-config" mit den ordner "./etc/nginx" auf der VM. Somit kann man die konfiguration von nginx bearbeiten uach wenn die VM schon läuft. Die Konfiguration kann nach veränderung mit ```vagrant reload --provision``` aktualisieren.

Auf dem Server ```10.1.31.7``` sind nun ein Nginx Reverse-Proxy und ein Apache Server installiert. Der Host-Port 8080 wird auf Port 80 des Reverse-Proxies weitergeleitet. Ansonsten sind die Nginx und Apache VMs in ihrem eigenen virtuellen Netzwerk.

#### Host-Only Netzwerk

| Bezeichnung | Daten |
|-------------|-------|
| Netz-ID | 192.168.90.0 |
| Subnet | 255.255.255.0 |
| Nginx | 192.168.90.2 |
| Apache | 192.168.90.3 |

In dem Netzwerk ist DHCP deaktiviert und die Adressen sind statisch vergeben.

### Vagrant Befehle (K2)

## Markdown editor (K2)

Wir haben uns beim Markdown editor für Visual Studio Code und die GitHub Weboberfläche entschieden.

VSCode benutzen wir da es eine Vielzahl an Erweiterungen gibt, welche uns auch ermöglichen im gelichen Editor z.B. Vagrant & Docker-Files zu bearbeiten.

<img src="https://github.com/SayHeyD/M300-BIST/blob/master/images/Bildschirmfoto%202020-08-19%20um%2018.09.04.png" alt="VSCode split window" width="600px">

Die Weboberfläche von GitHub wird auch zum schreiben der Markdown dokumentationen oder kurzen änderungen in allen Dateien verwendet, da dort dann auch alles direkt auf der remote origin repo verfügbar ist.

<img src="https://github.com/SayHeyD/M300-BIST/blob/master/images/Bildschirmfoto%202020-08-19%20um%2018.09.04.png" alt="VSCode split window" width="600px">

## Persönlicher Wissensstand (K2)

### David 

Ich habe in der Freizeit seit dem ersten Lehrjahr angefangen Hobby-mässig zu programmieren und habe deshalb seitdem auch oft Kontakt mit Linux (vorallem Ubuntu), mit Git & GitHub und auch mit neueren Technologien wie Docker. Daher ich viel mit Git und GitHub arbeite habe ich auch schon Erfahrung mit Markdown und kann mit einem CheatSheet effizient damit arbeiten (ohne geht auch, wird einfach nicht so schön).

Mit Systemsicherheit habe ich mich erst neulich wirklich befasst da wir mehrere Module und ÜKs zu dem Thema hatten. Hier haben wir die Abhärtung von Systemen, den Angriff von Systemen und den Ablauf der Angriffe angeschaut. Ebenso haben wir uns damit befasst was zu tun ist wenn vorgesetzte Sicherheitsmassnahmen nicht billigen.

Mit Virtualisierung habe ich auch schon einiges gemacht. In der Arbeit haben wir SUpport VMs damit wir ohne Probleme mehrere Versionen der gleichen Software installiert haben können. In den Modulen und ÜKs haben wir auch öfters mit VMs gearbeitet da dies die Installation von Betriebssystemen und Servern vereinfacht. Ebenso habe ich privat einmal [Proxmox](https://www.proxmox.com/de/) aufgesetzt und ausgetestet.

### Moritz

Ich habe Hobby erfahrung mit Linux und auch schon in der Berufsschule einigemale damit gearbeitet. Zuhause lerne ich vorallem mit Raspberry Pis Linux kompetenzen. Mit Git / Github habe ich nur sehr wenig gearbeitet aber habe schon seit längerer Zeit einen Account. 
Vagrant habe ich auch schon in der Berufsschule benüzt für OS-Ticket und auch schon mal sonst testmässig ausprobiert.
Ich habe in der Schule aber auch schon am Arbeitsplatz mit Virtualisierungs Systemen gearbeitet. Verwendet habe ich Proxmox, Hyper-v server(als Windows Server rolle) und einwenig vSphere.
Mit Docker und Containern kenne ich mich bis jezt jedoch nicht gut aus aber habe mich zuvor auch schon etwas darüber informiert.

### Andi

In meinem Arbeitsumfeld wird grundsätzlich nur mit Linux gearbeitet. Alle Technicker nutzen dabei die Linux-Distributionen "Manjaro" und "Ubuntu".

Mit Virtualisierung selber habe ich viel Erfahrung. In der Ausbildung als Supporter wuden mehrere VM's benötigt. Auch in der Arbeitswelt benötige ich nebst meiner Linux-Umgebung eine Windows-VM. Diese wird benötigt, wenn bei Kunden, welche meistens mit Windows arbeiten, Probleme auftreten und getestet/überprüft werden müssen.

Vagrant oder Docker habe ich bisher nicht gekannt. Somit habe ich noch keinerlei Erfahrung mit diesen Programmen.

Mit Github habe ich bis jetzt nur bestehende Dateien bearbeitet und gepushed. Bis jetzt habe ich noch keine GIT-Umgebung selber aufgezogen und unterhalten.
