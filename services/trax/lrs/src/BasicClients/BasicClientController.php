<?php

namespace Trax\Lrs\BasicClients;

use Illuminate\Http\Request;
use Trax\Auth\Controllers\CrudController;
use Trax\Auth\Traits\HasOwner;
use Trax\Repo\CrudRequest;

class BasicClientController extends CrudController
{
    use HasOwner;

    /**
     * The resource parameter name.
     *
     * @var string
     */
    protected $routeParameter = 'basic_client';

    /**
     * The permissions domain.
     *
     * @var string
     */
    protected $permissionsDomain = 'client';

    /**
     * Create the constructor.
     *
     * @param  \Trax\Lrs\BasicClients\BasicClientService  $repository
     * @return void
     */
    public function __construct(BasicClientService $service)
    {
        parent::__construct();
        $this->repository = $service;
    }

    /**
     * Get the validation rules.
     *
     * @param \Illuminate\Http\Request  $request;
     * @return array
     */
    protected function validationRules(Request $request)
    {
        return [
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'access.id' => 'nullable|integer',
            'access.credentials.username' => 'required|alpha_dash',
            'access.credentials.password' => 'required|regex:/^\S*$/u',
        ];
    }

    /**
     * Hook before any request.
     *
     * @param  \Trax\Repo\CrudRequest  $crudRequest
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function beforeRequest(CrudRequest $crudRequest, Request $request)
    {
        $crudRequest->addParam('accessors', ['accesses']);
    }

    /**
     * Hook before a store request.
     *
     * @param  \Trax\Repo\CrudRequest  $crudRequest
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function beforeStore(CrudRequest $crudRequest, Request $request)
    {
        $crudRequest->setContentField('permissions', ['xapi-scope.all']);
        $this->checkOwner($crudRequest);
    }

    /**
     * Hook to change the response model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    protected function responseModel($model)
    {
        $model->access = $model->accesses->first();
        $model->access->credentials->setVisible(['password', 'username']);
        $model->access->setVisible(['id', 'uuid', 'credentials']);
        return $model->setVisible(['id', 'name', 'access']);
    }
}
