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