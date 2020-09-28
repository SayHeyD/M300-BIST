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