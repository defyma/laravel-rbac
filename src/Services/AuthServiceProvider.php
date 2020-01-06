<?php

namespace defyma\LaraRbac\Services;

use defyma\LaraRbac\Contracts\{Model as RbacModelContract, User as RbacUserContract};
use defyma\LaraRbac\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Class AuthServiceProvider
 *
 * @package defyma\LaraRbac\Services
 *
 * @author Andrey Girnik <girnikandrey@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerRbacPolicies();
    }

    /**
     * Register Rbac policies.
     */
    public function registerRbacPolicies()
    {
        Gate::define('administrate', function (RbacUserContract $user) {
            return $user->hasAccess([
                Permission::ADMIN_PERMISSION
            ]);
        });

        Gate::define('delete-yourself', function (RbacUserContract $user, int $memberId) {
            return $user->getIdAttribute() != $memberId;
        });

        Gate::define('view-record', function (RbacUserContract $user) {
            return $user->hasAccess([
                'view-record'
            ]);
        });

        Gate::define('create-record', function (RbacUserContract $user) {
            return $user->hasAccess([
                'create-record'
            ]);
        });

        Gate::define('update-record', function (RbacUserContract $user, RbacModelContract $model) {
            return $user->hasAccess([
                'update-record'
            ]) || $user->getIdAttribute() == $model->getAuthorIdAttribute();
        });

        Gate::define('delete-record', function (RbacUserContract $user, RbacModelContract $model) {
            return $user->hasAccess([
                'delete-record'
            ]) || $user->getIdAttribute() == $model->getAuthorIdAttribute();
        });

        Gate::define('publish-record', function (RbacUserContract $user) {
            return $user->hasAccess([
                'publish-record'
            ]) || $user->inRole('editor');
        });
    }
}
