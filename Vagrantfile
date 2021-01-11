# -*- mode: ruby -*-
# vi: set ft=ruby ts=2 sw=2 expandtab :

UID = Process.euid
PROJECT="teacher_backend"
LOCAL_HOST_PORT="8582"

app_vars = {
  'HOST_USER_UID' => UID,

  'TEACHR_DB_NAME' => 'vagrant',
  'TEACHR_DB_USER' => 'vagrant',
  'TEACHR_DB_PASSWORD' => 'vagrant',
  'TEACHR_DB_HOST' => 'db',

  'TEACHR_SECRET' => 'tooeasy',
}

# to avoid typing --provider docker --no-parallel
# at every vagrant up
ENV['VAGRANT_NO_PARALLEL'] = 'yes'
ENV['VAGRANT_DEFAULT_PROVIDER'] = 'docker'
Vagrant.configure(2) do |config|

  config.vm.define "db" do |app|
    app.vm.provider "docker" do |d|
      d.force_host_vm = false
      d.image = "postgis/postgis"
      d.name = "#{PROJECT}_db"
      d.env = {
        'POSTGRES_USER' => app_vars['TEACHR_DB_USER'],
        'POSTGRES_PASSWORD' => app_vars['TEACHR_DB_PASSWORD'],
      }
    end
  end


  config.vm.define "fpm" do |app|
    app.vm.provider "docker" do |d|
      d.force_host_vm = false
      d.image = "allansimon/php7-fpm-postgresql"
      d.name="#{PROJECT}_fpm"
      d.link "#{PROJECT}_db:#{app_vars['TEACHR_DB_HOST']}"
      d.env = app_vars
      d.volumes = [
        "#{ENV['PWD']}:/var/www/symfony4",
      ]
    end
  end

  config.vm.define "nginx" do |app|
    app.vm.provider "docker" do |d|
      d.force_host_vm = false
      d.image = "nginx"
      d.name="#{PROJECT}_nginx"
      d.link "#{PROJECT}_fpm:phpfpm" # required by nginx box
      d.volumes = [
        "#{ENV['PWD']}/conf/nginx:/etc/nginx/conf.d",
        "#{ENV['PWD']}:/var/www/symfony4",
      ]
      d.ports = ["0.0.0.0:8582:80"]
    end
  end

  config.vm.define "dev", primary: true do |app|

    app.vm.provider "docker" do |d|
      d.force_host_vm = false
      d.image = "allansimon/docker-devbox-php"
      d.name = "#{PROJECT}_dev"
      d.link "#{PROJECT}_db:#{app_vars['TEACHR_DB_HOST']}"
      d.volumes =  [
        "#{ENV['HOME']}/.ssh:/home/vagrant/.ssh",
      ]
      d.env = app_vars
      d.has_ssh = true
    end

    # so that we can git push from within the container
    app.vm.provision "file", source: "~/.gitconfig", destination: ".gitconfig"

    app.vm.provision :shell, privileged: false, env: app_vars,  :inline => <<-END
      set -e
      echo "cd /vagrant/" >> /home/vagrant/.zshrc;
      echo "export PATH=/vagrant/bin:$PATH" >> /home/vagrant/.zshrc;
      cd /vagrant;
      composer install;
      bin/console doctrine:migrations:migrate  --no-interaction;
    END

    app.vm.provision "print_help", type: "shell" do |s|
      s.inline = "
        echo 'done, you can now run `vagrant ssh` to connect to the service'
        echo 'echo \"open the website: $fg[green]http://127.0.0.1:8582/index.php$fg[white]\"' >> /home/vagrant/.zshrc
        chown vagrant:vagrant /home/vagrant/.zshrc
      "
    end

    app.ssh.username = "vagrant"
    app.ssh.password = ""

  end
end
