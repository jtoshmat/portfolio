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
set :hipchat_token, "35e01bf391d31ea25e1125e3dfba2a"
set :hipchat_room_name, "738858"
set :hipchat_announce, true

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
