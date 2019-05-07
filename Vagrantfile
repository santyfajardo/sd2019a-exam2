VAGRANTFILE_API_VERSION = "2"
  vm_box = 'centos/7'
  tamaniodisco_multiplicacion = '5 * 1024'
  ip_master = '192.168.56.110'
  ip_worker1 = '192.168.56.111'
  ip_worker2 = '192.168.56.112'
  ip_worker3 = '192.168.56.113'
firstDisk = './firstDisk.vdi'
secondDisk = './secondDisk.vdi'
thirdDisk = './thirdDisk.vdi'
fourthDisk = './fourthDisk.vdi'
Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.ssh.insert_key = false
  config.vm.define :master do |master|
    master.vm.box = vm_box
    master.vm.network :private_network, ip: ip_master
    master.vm.provider :virtualbox do |vb|
      vb.customize ["modifyvm", :id, "--memory", "1024","--cpus", "1", "--name", "master" ]
      unless File.exist?(firstDisk)
        vb.customize ['createhd', '--filename', firstDisk, '--variant', 'Fixed', '--size', 5 * 1024 ]
      end
      vb.customize ['storageattach', :id,  '--storagectl', 'IDE', '--port', 1, '--device', 0, '--type', 'hdd', '--medium', firstDisk]
    end
#  master.vm.provision "ansible" do |ansible|
 #    ansible.inventory_path = 'hosts'
  #    ansible.playbook = "playbook.yml"
   # end
  end
 config.vm.define :worker_1 do |n1|
     n1.vm.box = vm_box
     n1.vm.network :private_network, ip: ip_worker1
     n1.vm.provider :virtualbox do |vb|
       vb.customize ["modifyvm", :id, "--memory", "512","--cpus", "1", "--name", "worker_1" ]
       unless File.exist?(secondDisk)
         vb.customize ['createhd', '--filename', secondDisk, '--variant', 'Fixed', '--size', 5 * 1024]
       end
       vb.customize ['storageattach', :id,  '--storagectl', 'IDE', '--port', 1, '--device', 0, '--type', 'hdd', '--medium', secondDisk]
     end
# n1.vm.provision "ansible" do |ansible|
 #     ansible.inventory_path = 'hosts'
  #     ansible.playbook = "playbook.yml"
   #   end
   end
  config.vm.define :worker_2 do |n2|
     n2.vm.box = vm_box
     n2.vm.network :private_network, ip: ip_worker2
     n2.vm.provider :virtualbox do |vb|
       vb.customize ["modifyvm", :id, "--memory", "512","--cpus", "1", "--name", "worker_2" ]
       unless File.exist?(thirdDisk)
         vb.customize ['createhd', '--filename', thirdDisk, '--variant', 'Fixed', '--size', 5 * 1024]
       end
       vb.customize ['storageattach', :id,  '--storagectl', 'IDE', '--port', 1, '--device', 0, '--type', 'hdd', '--medium', thirdDisk]
     end
# n2.vm.provision "ansible" do |ansible|
 #      ansible.inventory_path = 'hosts'
  #     ansible.playbook = "playbook.yml"
   #   end
   end
   config.vm.define :worker_3 do |n3|
     n3.vm.box = vm_box
     n3.vm.network :private_network, ip:  ip_worker3
     n3.vm.provider :virtualbox do |vb|
       vb.customize ["modifyvm", :id, "--memory", "512","--cpus", "1", "--name", "worker_3" ]
       unless File.exist?(fourthDisk)
         vb.customize ['createhd', '--filename', fourthDisk, '--variant', 'Fixed', '--size', 5 * 1024]
       end
       vb.customize ['storageattach', :id,  '--storagectl', 'IDE', '--port', 1, '--device', 0, '--type', 'hdd', '--medium', fourthDisk]
     end
end  

#config.vm.provision "ansible" do |ansible|
 #      ansible.inventory_path = 'hosts'
  #    ansible.playbook = "docker/instalaciondocker/dependenciasdocker.yml"
#	end

#config.vm.provision "ansible" do |ansible|
 #      ansible.inventory_path = 'hosts'
  #     ansible.playbook = "gluster/gluster.yml"
   #    end


#config.vm.provision "ansible" do |ansible|
 #      ansible.inventory_path = 'hosts'
  #     ansible.playbook = "gluster/permisos.yml"
#     end


#config.vm.provision "ansible" do |ansible|
 #     ansible.inventory_path = 'hosts'
  #     ansible.playbook = "gluster/montajegluster.yml"
   #     end

#config.vm.provision "ansible" do |ansible|
 #      ansible.inventory_path = 'hosts'
  #     ansible.limit = "all,localhost"
   #    ansible.playbook = "swarm/swarmmaster.yml"
    #   end

#config.vm.provision "ansible" do |ansible|
 #    ansible.inventory_path = 'hosts'
  #   ansible.limit = "all,localhost"
   #   ansible.playbook = "swarm/swarmworkers.yml"
    #   end

config.vm.provision "ansible" do |ansible|
     ansible.inventory_path = 'hosts'
     ansible.limit = "all,localhost"
       ansible.playbook = "conexion.yml"
      end


#end

config.vm.provision "file", source: "/root/.ssh/id_rsa", destination: "/home/vagrant/.ssh/id_rsa"
  public_key = File.read("/root/.ssh/id_rsa.pub")
  config.vm.provision :shell, :inline =>"
      echo 'Copying ansible-vm public SSH Keys to the VM'
      mkdir -p /home/vagrant/.ssh
      chmod 700 /home/vagrant/.ssh
      echo '#{public_key}' >> /home/vagrant/.ssh/authorized_keys
      chmod -R 600 /home/vagrant/.ssh/authorized_keys
      echo 'Host 192.168.*.*' >> /home/vagrant/.ssh/config
      echo 'StrictHostKeyChecking no' >> /home/vagrant/.ssh/config
      echo 'UserKnownHostsFile /dev/null' >> /home/vagrant/.ssh/config
      chmod -R 600 /home/vagrant/.ssh/config
      ", privileged: false

      end


