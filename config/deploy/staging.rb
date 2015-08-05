role :app, %w{}
role :web, %w{
  web-ee-001.dev.bsd.net
  web-ee-002.dev.bsd.net
}
role :db,  %w{}

set :ssh_options, {
  keys: %w(~/.ssh/knife.pem),
  forward_agent: true,
  user: %w(ec2-user)
}

set :deploy_to, '/var/www/sites/packers-staging.ee.bsd.net'

#set :branch, "master"
ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp