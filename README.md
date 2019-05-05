# sd2019a-exam2
Repository for the exam2

# Segundo Examen Parcial  

**Universidad Icesi**  

**Materia:** Sistemas Distribuidos  
**Nombres:** Julián Niño, Santiago Fajardo , Steven Montealegre  
**Código:** A00328080,        ,
**Correos:** juliannino01@hotmail.com   
**URL:** https://github.com/julianNinoo/sd2019a-exam2/NinoBranch


# Descripción:  

En este Segundo Examen Parcial se empleo vagrant y ansible para el aprovisionamiento de las maquinas. En el vagrant se puede observar la creación de los discos de 5 GB  para cada nodo y la configuración de las  caracteristicas de cada maquina. En el ansible se puede  observar la instalación de Docker, Docker-Compose , como tambien la configuración de Docker-Swarm y Gluster para todos los nodos. Es importante destacar que la ejecución del ansible se hace gracias al Vagrantfile.

Para la ejecución de los diferentes playbook , se decidio tener un archivo de configuración para cada tema desarrollado ya que si se ejecuta todo en el mismo playbook se formarán conflictos porque primero se ejecuta el master. Por ejemplo en el caso del gluster al ejecutar el master la instrucción  "gluster volume create swarm-vols replica 4 192.168.56.110:/gluster/data 192.168.56.111:/gluster/data 192.168.56.112:/gluster/data 192.168.56.113:/gluster/data force" , esto no seá posible ya que no existen en cada uno de los nodos las direcciones /gluster/data. Por esta razón en otro archivo en nuestro caso llamado permisos se crean estas rutas en todos los hosts y ahí si en el correspondiente archivo se ejecuta el comando mencionado anteriormente. 

La instrucción para ejecutar desde el Vagrantfile los diferentes playbook se pueden ver en las sigientes lineas: 

config.vm.provision "ansible" do |ansible|
 ansible.inventory_path = 'hosts'
 ansible.playbook = "docker/instalaciondocker/dependenciasdocker.yml"
 end

En "ansible.playbook ="  irá el archivo que queramos ejecutar. En nuestro caso se instaló y se configuró:

# Docker- Docker Compose:

En el archivo dependenciasdocker.yml se descarga e instala docker y docker-compose. Posteriormente se elimina el script de instalación y se pregunta si ya está instaladas estas dependencias en cada nodo para no volverlo a hacer. 

![](Imagenes/ansible.png) 

![](Imagenes/ansible2.png)

# Gluster

Se instaló gluster en el archivo gluster.yml. Posteriormente en el archivo permisos.yml se concedieron unos comandos que más adelante en la sección de problemas encontrados se explicará por qué se insertaron en cada host, en este mismo archivo se crean las carpetas necesarias y se hace la asignación del contenido del disco para la ejecución del gluster. Por último en el archivo montajegluster se añade cada nodo al master.

Captura de la creación de la partición y del montaje swarm de localhost:/swarm-vols /swarm/volumes en todos los nodos 

![](Imagenes/volumes3.png) 


![](Imagenes/volumes.png) 


Captura de la unión de todos los nodos en el gluster.


![](Imagenes/pool.png) 


# Swarm: 

Para conectar el master y los nodos con docker-swarm (Token) se utlizó scp para tomar el token del nodo master. En esta parte se generaron problemas ya que al hacer scp al master se generaba un PERSMISION DENIED. esta problematica se dió por:

1- el archivo txt que contiene el token no tenia los permisos necesarios
2- Habiá problemas de llaves ssh 

Por esta razón en el vagrant se configuraron las llaves para poder hacer el scp y tambien en el archivo de swarm.yml se le dio persmisos al archivo txt que contiene el token. 

En la siguiente imagen se muestra la configuracion de llaves en el Vagrantfile

![](Imagenes/ssh.png)


En la siguiente imagen se muestra el docker swarm configurado:

![](Imagenes/swarm.png)



# Problemas encontrados 

- Al realizar el parcial en una maquina virtual y no tener instalado nada, se presentaban errores por libvirtd, vagrant, ansible y la imagen del centos/7, entonces se debio hacer su debida instalación. 

- La maquina virtual colapsó  ya que a cada nodo tegnia asginado asignando  1 GB de RAM  y la maquina virtual solo tenía dos de RAM. Para solucionar esto se debió poner menos memoria RAM en cada nodo 

- Al trabajar en una maquina virtual con libvirt, presentaba el siguiente error de Dominio: 

![](Imagenes/dominio.png)

Para solucionar esto se debió ingresar el comando virsh list -all y luego destruir el dominio de todas las maquinas de esta lista con:                          virsh destroy nombredemaquina y virsh undefine nombredemaquina 
Despues de esto se debio destruir las maquinas con vagrant destroy y despues vagrant up, en algunas ocasiones tocó eliminar la carpeta .vagrant con rm -rf .vagrant. Cabe aclarar que este problema se presentó porque el proveedor era libvirt.

- En el momento de asignar el contenido de la partición solo se hacia en el worker_3 esto sucedia porque se tenia un problema en un end en el Vagrantfile, este end solo permitia hacer el aprovisionamiento en este worker y no en todos los nodos. 

- Cuando se querian añadir nodos al gluster con sudo gluster peer probe node2 aparecía el error : -transport-endpoint-is-not-connected. Despues de buscar se pudo concluir que el problema era por puertos del firewalld, por es razón se añaden permisos en el archivo permisos.yml de la carpeta gluster.

- Como se mencionó anteriormente en el docker-swarm se presentaba problemas de scp por esa razón se añadio esas lineas en el Vagrantfile.

- Otro problema encontrado fue en el momento de hacer git push desde nuestra maquina, aparecia que la rama estaba actualizada. Por esta razón se debio utilizar el comando git add para añadir los archivos nuevos, por ejemplo, gitadd nombredearchivo


# Referencias 
Para vagrant se utilizó:
https://github.com/ICESI/ds-docker/blob/master/09_docker_swarm/00_nodes_deploy/Vagrantfile
https://github.com/atSistemas/vagrant-docker-swarm-cluster/blob/master/Vagrantfile

Para la instalación de Docker y Docker-Compose se utilizó:
 https://lastviking.eu/install_docker_on_centos_with_ansible.html
 
Para la instalación y configuración del gluster se utilizó:
https://github.com/ICESI/ds-glusterfs/blob/master/00_nodes_deploy/install/glusterfs.sh


