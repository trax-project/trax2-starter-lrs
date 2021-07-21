<?php

namespace Trax\Lrs\Console;

class CreateAdminCommand extends AdminCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--l|list}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin account';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->ask('Email', 'admin@traxlrs.com');
        $data = [
            'email' => $email,
            'username' => $email,
            'firstname' => 'Unknown',
            'lastname' => 'Unknown',
            'password' => $this->askUserPassword(true),
            'admin' => true,
        ];
    
        try {
            $user = $this->users->create($data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        $this->line('Admin account created.');

        if ($this->option('list')) {
            $users = $this->users->addFilter(['admin' => 1, 'owner_id' => null])->all();
            $this->displayUsers($users);
        } else {
            $this->displayUser($user);
        }
    }
}
