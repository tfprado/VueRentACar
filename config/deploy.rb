# config valid only for Capistrano 3.11
# require 'capistrano/ext/multistage'
lock '3.11.0'

set :stages, ["dev"]
set :default_stage, "dev"
set :ssh_options, {:forward_agent => true}

set :application, 'kensingtoncms'
set :repo_url, 'https://github.com/tfprado/OctoberCMS.git' 
set :branch, ENV["branch"] || "master"

set :format_options, log_file: "octobercms/storage/logs/capistrano.log"

namespace :deploy do

    desc 'composer and october install, fixing permissions and updating/seeding databases'
    task :october_install do
        on roles(:web) do
            within release_path do
                execute :cp, "/var/www/octobercms/secret/.env #{release_path}/.env"
                #execute 'composer', 'install', '--no-dev', '--optimize-autoloader'
                execute 'sudo', 'chown', '-R', 'thedeployer:nginx', '/var/www/octobercms/releases/'
                execute 'sudo', 'chmod', '-R', '775', '/var/www/octobercms/releases/'
                execute 'sudo','docker-compose', '-f', '.docker/docker-compose-dev.yml', 'up', '-d', '--build'
                execute 'sudo','docker-compose', '-f', '.docker/docker-compose-dev.yml', 'exec', '-T', 'php', 'composer', 'install'
                execute 'sudo','docker-compose', '-f', '.docker/docker-compose-dev.yml', 'exec', '-T', 'php', 'php', 'artisan', 'october:update'
                execute 'sudo','docker-compose', '-f', '.docker/docker-compose-dev.yml', 'exec', '-T', 'php', 'chown', '-R', 'www-data:www-data', '/var/www'
            end
        end
    end
    
    after "deploy:updated", 'deploy:october_install'

    desc 'Print The Server Name'
    task :print_server_name do
      on roles(:app), in: :groups, limit:1 do
        execute "hostname"
      end
    end
end

after "deploy:updated", "deploy:print_server_name"



