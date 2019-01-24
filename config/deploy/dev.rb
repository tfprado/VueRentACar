set :deploy_to, "/var/www/kensingtonCms"

server '10.10.31.222', user: 'thedeployer', roles: %w{web app db}