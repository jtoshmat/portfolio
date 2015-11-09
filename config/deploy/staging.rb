role :app, %w{}
role :web, %w{
  web-wpdsvc-002.dev.bsd.net
  web-wpdsvc-003.dev.bsd.net
}
role :db,  %w{}

set :ssh_options, {
  keys: %w(~/.ssh/knife.pem),
  forward_agent: true,
  user: %w(ec2-user)
}

set :deploy_to, '/var/www/sites/packers.dev.bsd.net'

#set :branch, "master"
ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp