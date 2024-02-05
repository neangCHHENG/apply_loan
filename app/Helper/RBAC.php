<?php

namespace App\Helper;

use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RBAC
{
    public static function isAccessible($permision)
    {
        $userid = PersonalAccessToken::findToken(session('AuthToken'))->tokenable->id;

        $isAdmin = DB::select('SELECT R.* FROM users U INNER JOIN role_user RU
        ON U.id=RU.user_id
        INNER JOIN roles R ON R.id=RU.role_id
        WHERE U.id=? AND R.isAdmin;', [$userid]);

        if (!$isAdmin == null) {
            return true;
        }

        $data = DB::select('SELECT P.* FROM users U INNER JOIN role_user RU ON U.id=RU.user_id
        INNER JOIN roles R ON R.id=RU.role_id
        INNER JOIN role_permission RP ON R.id=RP.role_id
        INNER JOIN permissions P ON P.id=RP.permission_id
        WHERE U.id=? AND P.name=?;', [$userid, $permision]);

        if ($data == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function isAccessibleAPI($permision, $AuthToken)
    {
        $userid = PersonalAccessToken::findToken($AuthToken)->tokenable->id;

        $isAdmin = DB::select('SELECT R.* FROM users U INNER JOIN role_user RU
        ON U.id=RU.user_id
        INNER JOIN roles R ON R.id=RU.role_id
        WHERE U.id=? AND R.isAdmin;', [$userid]);

        if (!$isAdmin == null) {
            return true;
        }

        $data = DB::select('SELECT P.* FROM users U INNER JOIN role_user RU ON U.id=RU.user_id
        INNER JOIN roles R ON R.id=RU.role_id
        INNER JOIN role_permission RP ON R.id=RP.role_id
        INNER JOIN permissions P ON P.id=RP.permission_id
        WHERE U.id=? AND P.name=?;', [$userid, $permision]);

        if ($data == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function getPermissionName()
    {
        $permissions = array();
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $value) {
            array_push($permissions, $value->action);
        }
        return $permissions;
    }
}
