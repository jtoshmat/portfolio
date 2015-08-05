# lib/capistrano/tasks/server.cap
namespace :server do

	desc 'npm install'
	task :npm_install do
		on roles(:web) do
		    within release_path do
			    execute "npm install"
			end
		end
	end

	desc 'gulp build'
	task :gulp_build do
		on roles(:web) do
		    within release_path do
			    execute "gulp build"
			end
		end
	end
end