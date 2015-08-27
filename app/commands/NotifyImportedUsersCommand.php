<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class NotifyImportedUsersCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'email:imported_users';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sends notification email to all imported users';

	protected $mailer;

	protected $emails_sent = 0;

	protected $emails_skipped = 0;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->mailer = new \Packers\Services\Mailers\UserImportMailer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info('looking for users...');

		$usersToNotify = User::where('imported', '=', 1)->get();
		$this->info("Found ".$usersToNotify->count(). " users!");

		foreach($usersToNotify as $user) {
			try {
				$log = EmailLog::where('user_id', '=', $user->id)
					           ->where('type', '=', 'email.import.notification')
							   ->firstOrFail();
				$this->emails_skipped++;
			}
 			catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
				$this->mailer->run($user, 'email.import.notification');
				$this->info('email sent to ' . $user->email);
				$this->emails_sent++;
			}
		}

		$this->info('Finished! ' . $this->emails_sent . ' emails sent | ' . $this->emails_skipped . ' emails skipped.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
//	protected function getArguments()
//	{
//		return array(
//			array('example', InputArgument::REQUIRED, 'An example argument.'),
//		);
//	}
//
//	/**
//	 * Get the console command options.
//	 *
//	 * @return array
//	 */
//	protected function getOptions()
//	{
//		return array(
//			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
//		);
//	}

}
