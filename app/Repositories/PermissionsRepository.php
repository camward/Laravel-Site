<?php

namespace Corp\Repositories;

use Corp\Permission;
use Gate;

class PermissionsRepository extends Repository {


    public function __construct(Permission $permission) {
        $this->model = $permission;
    }

    public function changePermissions ($request) {

        if(Gate::denies('change', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token');

        $roles = $this->rol_rep->get();



        foreach($roles as $value) {
            if(isset($data[$value->id])) {
                $value->savePermissions($data[$value->id]);
            }

            else {
                $value->savePermissions([]);
            }
        }

        return ['status' => 'Права обновлены'];
    }
}

?>