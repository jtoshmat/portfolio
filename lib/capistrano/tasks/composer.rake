# Composer Install || Update
# lib/capistrano/tasks/composer.cap
namespace :composer do

	desc 'Install hook task'
	task :install do
		on roles(:web, :api, :worker) do
		end
	end

	desc 'Run Update or install Composer on Server'
	task :self_update do
		on roles(:web, :api, :worker) do
			within release_path do
				if test "[", "-e", "composer", "]"
					execute "composer self-update"
				else
					execute :curl, "-sS", "https://getcomposer.org/installer", "|", :php
					execute :sudo, "mv composer.phar /usr/local/bin/composer"
				end
			end
		end
	end
	
	desc "Running libraries with Composer task"
	task :update_dependencies do
		on roles(:web, :api, :worker) do
			within release_path do
				execute "cd #{release_path} && composer update --no-dev --verbose --prefer-dist --optimize-autoloader"
			end
		end
	end

	desc "Installing dependencies from composer.lock"
	task :install_dependencies do
		on roles(:web, :api, :worker) do
			within release_path do
				execute "cd #{release_path} && composer install --no-dev --verbose"
			end
		end
	end

	after :install, :self_update
	after :self_update, :install_dependencies


	desc "Running Composer Dump Autoload"
	task :reload do
		on roles(:web, :api, :worker) do
			within release_path do
				execute :composer, "dump-autoload -o"
			end
		end
	end

end # End compose namespace