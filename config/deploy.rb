# config valid only for Capistrano 3.11
# require 'capistrano/ext/multistage'
lock '3.11.0'

set :stages, ["dev"]
set :default_stage, "dev"
set :ssh_options, {:forward_agent => true}

set :application, 'kensingtoncms'
set :repo_url, 'https://github.com/tfprado/KensingtonCMS.git' 
set :branch, ENV["CAP_BRANCH"] || "capistrano"

set :format_options, log_file: "octobercms/storage/logs/capistrano.log"

namespace :deploy do

    desc 'Copying root .env and docker-compose files, then start project with right permissions'
    task :start_docker do
        on roles(:web) do
            within release_path do
                execute :cp, "/var/www/kensingtonCms/secret/.env-root #{release_path}/.env"
                execute :cp, "/var/www/kensingtonCms/secret/.env-october #{release_path}/octobercms/.env"
                # execute :cp, "/var/www/kensingtonCms/secret/system.log #{release_path}/octobercms/storage/logs/system.log"
                # execute :cp, "/var/www/kensingtonCms/secret/capistrano.log #{release_path}/octobercms/storage/logs/capistrano.log"
                execute :cp, "/var/www/kensingtonCms/secret/.env-laravel #{release_path}/api/.env"
                execute :cp, "/var/www/kensingtonCms/secret/docker-compose.yml #{release_path}/docker-compose.yml"
                execute 'sudo', 'chown', '-R', 'thedeployer:nginx', '/var/www/kensingtonCms/'
                execute 'sudo', 'chmod', '-R', '775', '/var/www/kensingtonCms/'
                execute 'sudo', 'docker-compose', 'up', '-d', '--build'
            end
        end
    end

    desc 'install laravel app'
    task :laravel_install do
        on roles(:web) do
            within release_path do
                execute 'sudo','docker-compose', 'exec', '-w', '/var/www/html/api', '-T', 'php', 'composer', 'install'
                execute 'sudo','docker-compose', 'exec', '-w', '/var/www/html/api', '-T', 'php', 'php', 'artisan', 'migrate'
            end
        end
    end

    desc 'october install, fixing permissions and updating/seeding databases'
    task :october_install do
        on roles(:web) do
            within release_path do
                execute 'sudo','docker-compose', 'exec', '-w', '/var/www/html/octobercms', '-T', 'php', 'composer', 'install'
                execute 'sudo','docker-compose', 'exec', '-w', '/var/www/html/octobercms', '-T', 'php', 'php', 'artisan', 'october:up'
                execute 'sudo','docker-compose', 'exec', '-w', '/var/www/html/octobercms', '-T', 'php', 'php', 'artisan', 'october:update'
                execute 'sudo','docker-compose', 'exec', '-w', '/var/www/html/octobercms', '-T', 'php', 'chown', '-R', 'www-data:www-data', 'storage'
            end
        end
    end

    desc 'Print The Server Name'
    task :print_server_name do
      on roles(:app), in: :groups, limit:1 do
        execute "hostname"
      end
    end
end

after "deploy:updated", "deploy:print_server_name"
after "deploy:updated", 'deploy:start_docker'
after "deploy:updated", 'deploy:laravel_install'
after "deploy:updated", 'deploy:october_install'



