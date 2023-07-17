<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;




class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPermissionGroups()
    {
        $permission_groups = DB::table('permissions')->select('group_name')->
                  groupBy('group_name')->get();

                  return $permission_groups;
    }

    
    public static function getpermissionByGroupName($group_name)
    {

        $permissions = DB::table('permissions')->select('name','id')->where('group_name', $group_name)
                         ->get();
        return $permissions;
    }

    
    public static function roleHasPermission($role, $permissions)
    {
        $hasPermission = true;
        foreach($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
            }
            return $hasPermission;
        }

    }


        public static function getDoctorsByRole($role)
    {
        $doctors = DB::table('users')
            ->select('name', 'id')
            ->whereRaw("LOWER(role) = LOWER(?)", [$role])
            ->get();
        
        return $doctors;
    }

    public static function getParentsByRole($role)
    {
        $parents = DB::table('users')
            ->select('name', 'id' , 'email','phone_number')
            ->whereRaw("LOWER(role) = LOWER(?)", [$role])
            ->get();
        
        return $parents;
    }

    public function infants()
    {
        return $this->hasMany(Infant::class, 'parent_id');
    }

    

    
    
}
