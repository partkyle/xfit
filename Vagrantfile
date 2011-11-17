Vagrant::Config.run do |config|
  # All Vagrant configuration is done here. For a detailed explanation
  # and listing of configuration options, please view the documentation
  # online.

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "base"

  config.vm.customize do |vm|
    vm.memory_size = 2048
    vm.cpu_count = 4
    vm.name = "xfit"
  end

  config.vm.provision :chef_solo do |chef|
    chef.cookbooks_path = "cookbooks"

    chef.add_recipe('vagrant_main')

    chef.json.merge!({
      :mysql => {
          :server_root_password => "root"
      }
    })
  end
  config.vm.forward_port("web", 80, 8080)
end
