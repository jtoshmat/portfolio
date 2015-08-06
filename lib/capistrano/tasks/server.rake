# lib/capistrano/tasks/server.cap
namespace :server do

	desc 'Install (task to chain npm/gulp tasks)'
	task :install do
		on roles(:web) do
		end
	end

	desc 'npm install'
	task :npm_install do
		on roles(:web) do
		    within release_path do
			    execute "cd #{release_path} && npm install"
			end
		end
	end

	desc 'install gulp'
	task :install_gulp do
		on roles(:web) do
		    within release_path do
			    execute "cd #{release_path} && sudo npm install -g gulp"
			end
		end
	end

	desc 'gulp build'
	task :gulp_build do
		on roles(:web) do
		    within release_path do
			    execute "cd #{release_path} && gulp build"
			end
		end
	end

	after :install, :install_gulp
	after :install_gulp, :npm_install
	after :npm_install, :gulp_build

end #end of server namespace

