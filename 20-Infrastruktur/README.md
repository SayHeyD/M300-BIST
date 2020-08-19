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

    config.vm.synced_folder "./nginx-config", "/etc/nginx"

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "512"
    end

    config.vm.provision "shell", inline: <<-SHELL
        apt-get update
        apt-get install -y nginx
    SHELL
end
```

## Persönlicher Wissensstand


