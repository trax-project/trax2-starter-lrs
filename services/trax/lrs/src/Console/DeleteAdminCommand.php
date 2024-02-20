<?php

namespace Trax\Lrs\Console;

class DeleteAdminCommand extends AdminCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:delete {id?} {--l|list}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an existing admin account';

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

        $this->line('');
        if (!$this->confirm('Are you sure you want to delete this account?')) {
            return;
        }
        
        try {
            $this->users->delete($id);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        $this->line('Account deleted.');
                
        if ($this->option('list')) {
            $users = $this->users->addFilter(['admin' => 1, 'owner_id' => null])->all();
            $this->displayUsers($users);
        }
    }
}
