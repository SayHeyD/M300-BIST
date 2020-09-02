# Sicherheit

Hier ist alles zur absicherung der Lernumgebung dokumentiert. Dazu gehören Reverse-Proxy konfiguration, Firewallkonfiguration, Benutzer & Rechte sowie der Netzwerkplan.


## Benutzer und Rechtvergabe

| Benutzer | verwendung|
|   ------ |------- |
| root | Linux System administrator/Superuser|
| ubuntu | Ubuntu default user|
|www-data| Apache Webserver|

Die Rechte der Benutzer werden ihnen mit einer Gruppenangehörigkeit zugeteilt. Jeder Benutzer is mindestens einer Gruppe zugeteilt kann aber auch in mehren sein, so können verschiedene services oder aktionen für einen Benutzer erlaubt oder verboten werden. 
Die oben aufgelisteten User sind alle Systenbenutzer und nicht benutzerkonten für reale Personen werden jedoch von realen personen verwendet. 

Benutzer befinden sich in der Datei /etc/passwd und die Gruppen in der Datei /etc/groups .


rwx: Rechte des Eigentümers
rws: Rechte der Gruppe
r-x: Recht von allen anderen (others)
Die Bedeutung der Buchstaben sind wie folgt:

r - Lesen (read):
Erlaubt lesenden Zugriff auf die Datei. Bei einem Verzeichnis können damit die Namen der enthaltenen Dateien und Ordner abgerufen werden (nicht jedoch deren weitere Daten wie z.B. Berechtigungen, Besitzer, Änderungszeitpunkt, Dateiinhalt etc.).
w - Schreiben (write):
Erlaubt schreibenden Zugriff auf eine Datei. Für ein Verzeichnis gesetzt, können Dateien oder Unterverzeichnisse angelegt oder gelöscht werden, sowie die Eigenschaften der enthaltenen Dateien bzw, Verzeichnisse verändert werden.
x - Ausführen (execute):
Erlaubt das Ausführen einer Datei, wie das Starten eines Programms. Bei einem Verzeichnis ermöglicht dieses Recht, in diesen Ordner zu wechseln und weitere Attribute zu den enthaltenen Dateien abzurufen (sofern man die Dateinamen kennt ist dies unabhängig vom Leserecht auf diesen Ordner). Statt x kann auch ein Sonderrecht angeführt sein.
s -Set-UID-Recht (SUID-Bit):
Das Set-UID-Recht ("Set User ID" bzw. "Setze Benutzerkennung") sorgt bei einer Datei mit Ausführungsrechten dafür, dass dieses Programm immer mit den Rechten des Dateibesitzers läuft. Bei Ordnern ist dieses Bit ohne Bedeutung.
s (S) Set-GID-Recht (SGID-Bit):
Das Set-GID-Recht ("Set Group ID" bzw. "Setze Gruppenkennung") sorgt bei einer Datei mit Ausführungsrechten dafür, dass dieses Programm immer mit den Rechten der Dateigruppe läuft. Bei einem Ordner sorgt es dafür, dass die Gruppe an Unterordner und Dateien vererbt wird, die in diesem Ordner neu erstellt werden.
t (T) Sticky-Bit:
Das Sticky-Bit hat auf modernen Systemen nur noch eine einzige Funktion: Wird es auf einen Ordner angewandt, so können darin erstellte Dateien oder Verzeichnisse nur vom Dateibesitzer gelöscht oder umbenannt werden. Verwendet wird dies z.B. für /tmp.

## SSH (Secure Shell) 
SSH wird für die Sichere textbasierte verbindung zu geräten verrwendet und ist bestandteil von allen Linux Distributionen und ist der häufigste weg Linuxsystem ohne Grafische obefläche zu bedienen.

Hauptgrund der Verwendung:
Die Daten übertragung zwischen Server und Client sind verschlüsselt(Ablösung zu früherem protkoll Telnet das unverschlüsselte verbindung aufbaut). 
Daten werden nichtt manipuliert zwischen Geräten.

Für zusätzliche sicherheit können auch anstatt Passwörter Public-Keys verwendet werden um sich am Server zu Authentifizieren.
So können die rechte für die verbinddung schnell entzogen werden im falle das jemand diese nicht mehr haben sollte ohne das das Passwort geändert wird und neu abgelegt werden muss. 



## Firewall

Als Software für die Server-Firewalls verwenden wir ufw, da dies einfach zu benutzen ist und schon auf ubuntu vorinstalliert ist.

* [Firewall von 10.1.31.7]()
* [Firewall von 10.1.31.14]()
* [Firewall von 10.1.31.20]()
* [Firewall von apache2-web auf 10.1.31.7]()
* [Firewall von nginx-reverse-proxy auf 10.1.31.7]()
* [Firewall von apache2-web auf 10.1.31.20]()

### Firewall von 10.1.31.7

*Status*: aktiv
*Logging*: on(low)
*Default*: deny (incoming), allow (outgoing), disabled (routed)

| Port | Action | From |
| ----- | ----- | ----- |
| 22 | ALLOW | 10.1.31.37 |
| 22 | ALLOW | 10.1.31.50 |
| 22 | ALLOW | 10.1.31.44 |
| 80 | ALLOW | ANY |
| 8080 | ALLOW | ANY |
| 8081 | ALLOW | ANY |

### Firewall von 10.1.31.14

### Firewall von 10.1.31.20

### Firewall von apache2-web auf 10.1.31.7

*Status*: aktiv
*Logging*: on(low)
*Default*: deny (incoming), allow (outgoing), disabled (routed)

| Port | Action | From |
| ----- | ----- | ----- |
| 80 | ALLOW | 192.168.90.2 |
| 22 | ALLOW | 10.0.2.2 |

### Firewall von nginx-reverse-proxy auf 10.1.31.7

*Status*: aktiv
*Logging*: on(low)
*Default*: deny (incoming), allow (outgoing), disabled (routed)

| Port | Action | From |
| ----- | ----- | ----- |
| 22 | ALLOW | 10.0.2.2 |
| 80 | ALLOW | ANY |

### Firewall von apache2-web auf 10.1.31.20

