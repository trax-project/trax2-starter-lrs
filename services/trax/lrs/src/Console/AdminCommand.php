<?php

namespace Trax\Lrs\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Trax\Auth\Stores\Users\UserRepository;
use Trax\Auth\Stores\Users\User;
use Trax\Auth\Password;

class AdminCommand extends Command
{
    /**
     * The users repository.
     *
     * @var \Trax\Auth\Stores\Users\UserRepository
     */
    protected $users;

    /**
     * Create a new command instance.
     *
     * @param  \Trax\Auth\Stores\Users\UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    /**
     * Get a user given its ID.
     *
     * @param int  $id
     * @return \Trax\Auth\Stores\Users\User|false
     */
    protected function getUser(int $id)
    {
        try {
            $user = $this->users->findOrFail($id);
        } catch (\Exception $e) {
            $this->error("There is no admin account with this id [$id].");
            $this->info('');
            return false;
        }
        return $user;
    }

    /**
     * Prompt the user password.
     *
     * @param  bool  $required
     * @return string
     */
    protected function askUserPassword(bool $required = false)
    {
        $default = $required ? Password::random() : '';
        while (1) {
            $password = $this->ask('Password', $default);
            if (!$required && empty($password)) {
                break;
            }
            if (Password::validate($password)) {
                break;
            }
            $this->error('This password does not comply with the password security rules.');
            $this->info(Password::notice($password));
        }
        return $password;
    }

    /**
     * Prompt the user choice.
     *
     * @param bool  $allOption
     * @return int|string|false  User ID | 'all' | false
     */
    protected function chooseUser(bool $allOption = false)
    {
        $users = $this->users->addFilter(['admin' => 1, 'owner_id' => null])->all()
            ->pluck('username', 'id')->toArray();

        if (empty($users)) {
            $this->warn("There is currently no admin account defined. 
You should define one with 'php artisan admin:create'.");
            $this->info('');
            return false;
        }
        
        if ($allOption) {
            $users['a'] = 'All users';
        }
        $users['x'] = 'Cancel';
    
        $id = $this->choice("Choose an admin account", $users);

        switch ($id) {
            case 'a':
                return 'a';
            case 'x':
                return false;
            default:
                return intval($id);
        }
    }

    /**
     * Display a list of users.
     *
     * @param \Illuminate\Support\Collection  $users
     * @return void
     */
    protected function displayUsers(Collection $users): void
    {
        $headers = [
            'ID',
            'Email',
        ];

        $data = $users->map(function (User $user) {
            return [
                $user->id,
                $user->email,
            ];
        });
        
        if ($data->isEmpty()) {
            $this->info("There is currently no admin account defined. 
You should define one with 'php artisan admin:create'.");
        } else {
            $this->table($headers, $data);
        }
        $this->info('');
    }

    /**
     * Display a user.
     *
     * @param \Trax\Auth\Stores\Users\User  $user
     * @return void
     */
    protected function displayUser(User $user): void
    {
        $this->displayUsers(collect([$user]));
    }
}
