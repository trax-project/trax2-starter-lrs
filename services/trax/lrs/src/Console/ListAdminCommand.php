<?php

namespace Trax\Lrs\Console;

class ListAdminCommand extends AdminCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List the existing admin accounts';
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->users->addFilter(['admin' => 1, 'owner_id' => null])->all();
        $this->displayUsers($users);
    }
}
