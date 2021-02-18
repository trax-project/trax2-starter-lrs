<?php

namespace Trax\Lrs\BasicClients;

use Illuminate\Support\Facades\DB;
use Trax\Auth\Stores\Clients\ClientRepository;
use Trax\Auth\Stores\Accesses\AccessService;

class BasicClientService extends ClientRepository
{
    /**
     * The accesses repository.
     *
     * @var \Trax\Auth\Stores\Accesses\AccessService
     */
    protected $accesses;


    /**
     * Create the constructor.
     *
     * @param  \Trax\Auth\Stores\Accesses\AccessService  $accesses
     * @return void
     */
    public function __construct(AccessService $accesses)
    {
        parent::__construct();
        $this->accesses = $accesses;
    }

    /**
     * Create a new resource.
     *
     * @param array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $client = parent::create($data);

            $data = $data['access'];
            $data['client_id'] = $client->id;
            $data['type'] = 'basic_http';
            $data['name'] = $client->name;
            $data['cors'] = '*';
            $this->accesses->create($data);

            return $client;
        });
    }

    /**
     * Update an existing resource, given its model and new data.
     *
     * @param \Illuminate\Database\Eloquent\Model  $model
     * @param array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateModel($model, array $data = null)
    {
        return DB::transaction(function () use ($model, $data) {

            $client = parent::updateModel($model, $data);

            $data = $data['access'];
            $data['name'] = $client->name;
            $this->accesses->update($data['id'], $data);

            return $client;
        });
    }
}
