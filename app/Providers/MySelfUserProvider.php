<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Auth\EloquentUserProvider;

class MySelfUserProvider extends EloquentUserProvider implements UserProvider
{
    protected $model;
    protected $hasher;
    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $model
     * @return void
     */
    public function __construct(HasherContract $hasher, $model)
    {
        $this->model = $model;
        $this->hasher = $hasher;
    }
    
    public function retrieveById($identifier)
    {
        $model = $this->createModel();
        // if (is_array($model->getAuthIdentifierName())) {
        //     $identifierArray = explode(' ', $identifier);
            
        //     $queryVaule = array_combine($model->getAuthIdentifierName(), $identifierArray);
        // //     $queryVaule = $model->getAuthIdentifierName();
        //     return $model->newQuery()
        //         ->where($queryVaule)
        //         ->first();
        // }
        return $model->newQuery()
            ->where($model->getAuthIdentifierName(), $identifier)
            ->first();
    }
    
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->createModel();
        if (is_array($model->getAuthIdentifierName())) {
            $identifierArray = explode(' ', $identifier);
            $queryVaule = array_combine($model->getAuthIdentifierName(), $identifierArray);
            $model = $model->where($queryVaule)->first();
        } else {
            $model = $model->where($model->getAuthIdentifierName(), $identifier)->first();
        }
        
        if (! $model) {
            return null;
        }
        $rememberToken = $model->getRememberToken();
        return $rememberToken && hash_equals($rememberToken, $token) ? $model : null;
    }
}
