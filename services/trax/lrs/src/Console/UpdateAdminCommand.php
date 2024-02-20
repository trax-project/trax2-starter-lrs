<?php

namespace Trax\Lrs\Console;

class UpdateAdminCommand extends AdminCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:update {id?} {--l|list}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an existing admin account';
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$id = $this->argument('id')) {
            if (!$id = $this->chooseUser()) {
                return;
            }
        }

        if (!$user = $this->getUser($id)) {
            return;
        }

        $email = $this->ask('Email', $user->email);
        $data = [
            'email' => $email,
            'username' => $email,
            'password' => $this->askUserPassword(),
        ];

        if (empty($data['password'])) {
            unset($data['password']);
        }

        try {
            $user = $this->users->update($id, $data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        $this->line('admin account updated.');
        
        if ($this->option('list')) {
            $users = $this->users->addFilter(['admin' => 1, 'owner_id' => null])->all();
            $this->displayUsers($users);
        } else {
            $this->displayUser($user);
        }
    }
}
