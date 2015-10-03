# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

$install = <<SCRIPT
#!/bin/bash

if [ -z /mapasculturais/Vagrantfile ]; then

	git clone https://github.com/hacklabr/mapasculturais /mapasculturais

fi

cd /mapasculturais/scripts/
./install_vagrant.sh

SCRIPT
#!/bin/bash

$configure = <<SCRIPT

cd /mapasculturais/scripts/
./configure_vagrant.sh
    
SCRIPT

$serviceup = <<SCRIPT

    echo "Starting service..."

    php -S 0.0.0.0:8000 -t /mapasculturais/src /mapasculturais/src/router.php &

    echo "All done! Call http://127.0.0.1:8000 in your browser and be happy."

SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    # Every Vagrant virtual environment requires a box to build off of.
    config.vm.box = "ubuntu/trusty64"
    config.vm.network "forwarded_port", guest: 8000, host: 8000

    # config.ssh.username = "mapas"

    config.vm.provision "shell", inline: $install

    config.vm.provision "shell", inline: $configure,
            privileged: false

    config.vm.provision "shell", inline: $serviceup,
            run: "always",
            privileged: false
	
    config.vm.synced_folder "../mapasculturais", 
    	"/mapasculturais", create: true

    #config.vm.provider :virtualbox do |vb|
    #  vb.gui = true
    #end
end
