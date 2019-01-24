set :deploy_to, "/var/www/octobercms"

server '10.10.31.222', user: 'thedeployer', roles: %w{web app db}