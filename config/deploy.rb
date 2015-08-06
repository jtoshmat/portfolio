# config valid only for current version of Capistrano
lock '3.2.1'

set :application, 'packers-webapp'
set :repo_url, 'git@github.com:bsd/packers-webapp-v2.git'

# Default branch is :master
ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app_name
set :deploy_to, '/var/www/sites/packers.wpd.bsd.net'

set :scm, :git
set :format, :pretty
set :log_level, :debug
set :keep_releases, 5

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# set :linked_files, fetch(:linked_files, []).push('config/database.yml', 'config/secrets.yml')

# Default value for linked_dirs is []
set :linked_dirs, %w{
  app/storage/cache
  app/storage/logs
  app/storage/meta
  app/storage/sessions
  app/storage/views
  vendor
}

# Hipchat notifications
set :hipchat_token, "avUjmMaUjZ7pU8R9DLWH0vFfvXt0wQI4D5S7tM5m"
set :hipchat_room_name, "wpd: Packers"
set :hipchat_announce, true
set :hipchat_color, 'blue' #normal message color
set :hipchat_success_color, 'green' #finished deployment message color
set :hipchat_failed_color, 'red' #cancelled deployment message color
set :hipchat_message_format, 'html'
set :hipchat_options, {
  :api_version  => "v2" # Set "v2" to send messages with API v2
}

# set :default_env, { path: "/opt/ruby/bin:$PATH" }

namespace :deploy do

  task :bootstrap do
    on roles(:web,:worker) do
      execute "/usr/bin/sudo mkdir -p #{deploy_to} && /usr/bin/sudo chown ec2-user:ec2-user #{deploy_to}"
    end
  end

  before :check, :bootstrap

  after :updated, "composer:install"
  after :updated, "laravel:setup"
  after :publishing, "server:install"

end
