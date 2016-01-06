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

	protected $batchSize;
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
		$this->batchSize = intval($this->argument('batch-size'));
		$this->info('Batch size is ' . $this->batchSize);
		$this->info('looking for users...');

		$usersToNotify = User::where('user.imported', '=', 1)
			                 ->leftJoin('email_logs', 'email_logs.user_id', '=', 'user.id')
						     ->whereNull('email_logs.id')
						     ->get(['user.id', 'user.username', 'user.email', 'user.imported']);
		$this->info("Found ".$usersToNotify->count(). " users!");

		$batchedUsers = $usersToNotify->take($this->batchSize);
		foreach($batchedUsers as $user) {
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
	protected function getArguments()
	{
		return array(
			array('batch-size', InputArgument::OPTIONAL, 'The batch size of emails to send.', 50),
		);
	}
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
