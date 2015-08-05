# Laravel Install || Update
# lib/capistrano/tasks/laravel.cap
namespace :laravel do

	desc 'Setup hook task'
	task :setup do
		on roles(:web, :api, :worker) do
		end
	end

	desc "Setup Laravel log file"
	task :setup_log do
		on roles(:web, :api, :worker) do
			within release_path do
				execute :touch, "app/storage/logs/laravel.log"
			end
		end
	end

	desc "Setup Laravel folder permissions"
	task :set_permissions do
		on roles(:web, :app) do
			within release_path do
				execute :chmod, "u+x artisan"
				execute :sudo, :chmod, "-R 2777 app/storage/cache"
				execute :sudo, :chmod, "-R o+w  app/storage/logs"
				execute :sudo, :chmod, "-R 2777 app/storage/meta"
				execute :sudo, :chmod, "-R 2777 app/storage/sessions"
				execute :sudo, :chmod, "-R 2777 app/storage/views"
				execute :sudo, :chown, "--recursive ec2-user:nobody public/uploads/"
				execute :sudo, :chown, "--recursive ec2-user:nobody app/storage"
			end
		end
	end

	after :setup, :setup_log
	after :setup_log, :set_permissions

end # End of Laravel namespace