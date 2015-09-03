set :stage, :production

role :app, %w{
}
role :web, %w{
  web-wpdsvc-gen-001.wpd.bsd.net
  web-wpdsvc-gen-002.wpd.bsd.net
}
role :api, %w{
}
role :worker, %w{
}
role :db,  %w{
}

set :ssh_options, {
  keys: %w(~/.ssh/knife.pem),
  forward_agent: true,
  user: %w(ec2-user)
}

set :deploy_to, '/var/www/sites/packers.wpd.bsd.net'

#set :branch, "master"
ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp