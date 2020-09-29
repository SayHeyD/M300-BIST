# M300 Lippuner, Zellweger, Docampo

Hier ist die Dokumentation für das Modul 300 abgelegt. Alle Aufgaben werden in dieser Repository dokumentiert.

## Inhaltsverzeichnis

* [10 - Toolumgebung](https://github.com/SayHeyD/M300-BIST/tree/master/10-Toolumgebung)
* [20 - Infrastruktur](https://github.com/SayHeyD/M300-BIST/tree/master/20-Infrastruktur)
  * [25 - Sicherheit](https://github.com/SayHeyD/M300-BIST/tree/master/25-Sicherheit)
* [30 - Container](https://github.com/SayHeyD/M300-BIST/tree/master/30-Container)
  * [35 - Sicherheit](https://github.com/SayHeyD/M300-BIST/tree/master/35-Sicherheit)
* [40 - Kubernetes](https://github.com/SayHeyD/M300-BIST/tree/master/40-Kubernetes)

## Server IPs

* Server-David: [10.1.31.7](http://10.1.31.7) | [WireGuard Config](https://github.com/SayHeyD/M300-BIST/blob/master/wireguard_david.conf)
* Server-Moritz: [10.1.31.14](http://10.1.31.14) | [WireGuard Config](https://github.com/SayHeyD/M300-BIST/blob/master/wireguard_moritz.conf)
* Server-Andi: [10.1.31.20](http://10.1.31.20) | [WireGuard Config](https://github.com/SayHeyD/M300-BIST/blob/master/wireguard_andi.conf)

## Persönlicher Wissenstand (K2)

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

Mit Virtualisierung selber habe ich viel Erfahrung. In der Ausbildung als Supporter wuden mehrere VM's benötigt. Auch in der Arbeitswelt benötige ich nebst meiner Linux-Umgebung eine Windows-VM. Diese wird benötigt, wenn bei Kunden, welche meistens mit Windows arbeiten, Probleme auftreten und getestet/überprüft werden müssen. Jedoch habe ich noch nie VM's automatisiert aufgezogen, sondern immer manuell.

Vagrant habe ich bisher nicht gekannt. Somit habe ich noch keinerlei Erfahrung im Umgang mit Vagrant.

Mit Github habe ich bis jetzt nur bestehende Dateien bearbeitet und gepushed. Bis jetzt habe ich noch keine GIT-Umgebung selber aufgezogen und unterhalten.

## Persönliche Lernentwicklung & Reflexion (K5)

### Andi

Nun Verstehe ich den Umgang mit Vagrant und konnte erfolgreich mit "Vagrantfile" VM's erstellen. Bin erstaunt, wie effizient das Tool funktioniert. Jedoch weiss ich nicht, ob ich das Tool in naher Zukunft in meinem Arbeitsumfeld verwenden werde.

Mit Wireguard konnte ich eine Tunnelverbindung zu der TBZ Cloud erstellen. Mit Wireguard hatte
ich zuvor nichts zu tun und bin erstaunt, wie gut das tool funktioniert.

Auf der TBZ Cloud habe ich erfolgreich ein Apache Web-Server erstellt und den Zugriff bis auf ein paar IP Adressen beschränkt.

Überzeugt hat mich Github. Finde es eine sehr gute Methode eine Dokumentation zu führen. Nun benutze ich Github
auch Privat um gewisse Anleitungen zu festzuhalten.

Zusätzlich habe ich gelernt die vorhandene Firewall von Ubuntu zu nutzen und soweit zu konfigurieren, dass von
gewissen IP Adressen zugegriffen werden kann. Ich denke dass kann ich in Zukunft gut gebrauchen.

### Moritz

Vagrant hatte ich in der TBZ schonmal angewendet jedoch wurde mir dan nicht klar wie viel zeit es einem ersparen kann, quasi vorgefertigite VMs zu haben. Ich denke nicht das ich es in naher zukunft in meinem Betrieb anwenden werde, jedoch werde ich sicher mal privat noch damit spielen.

Wieguard kannte ich schon und habe auch schonmal damit ein VPN in mein eigenes Netzwerk aufgesetzt.

Auf Linux habe ich noch nie eine Key authentifizierung verwendet und mir auch nie wirklich gedanken darum gemacht. Wir haben dies auf all unseren Servern in der TBZ-Cloud eingerichtet und da ich sah das es sehr simpel ist werde ich diese Methode auch bei Privaten servern verwenden. Auch das verbieten von IPs in der Ubuntu Firewall werde ich nun anwenden.

Ich bin fan geworden von Github. Finde es sehr schade haben nicht schon andere Lehrer in den letzten 3 Jahren Dokumentationen auf Github verlangt. Ich werde in der Zukunft Github definitiv mehr verwnden für Projekte die eine Zusammen Arbeit benötigen.

### David

Ich habe in diesem Modul zum ersten mal mit Vagrant und der TBZ Cloud gearbeitet. Ebenso habe ich zum ersten mal Wireguard benutzt und bin davon sehr beeindruckt, allerdings habe ich auch nur gutes davon gehört. Das Anlegen von Verbindungen per Wireguard, wird mir denke ich am meisten bringen, da ich nicht denke das ich in Zukunft mit Vagrant abrbeiten werde. Wenn ich etwas von diesem Modul mitnehmen kann, dann wird das wahrscheinlich mit dem Container-Teil kommen, daher ich mir denke, das ich in Zukunft damit in Kontakt kommen werde.

Was ich gelernt habe (nützlichstes oben):

1. Wireguard konfigurieren & installieren
2. Vagrant konfigurieren und handhaben
3. MIt der TBZ Cloud arbeiten
