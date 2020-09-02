# Sicherheit

Hier ist alles zur absicherung der Lernumgebung dokumentiert. Dazu gehören Reverse-Proxy konfiguration, Firewallkonfiguration, Benutzer & Rechte sowie der Netzwerkplan.

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
