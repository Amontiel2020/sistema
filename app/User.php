<?php

namespace App;
use \Illuminate\Foundation\Auth\User as Authenticatable ;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{

	
    protected $fillable = [
        'name', 'last_name','email','user','password','type','active','address'
    ];

    protected $hidden=[
           'password','remember_token'
    ];


    public function roles()
    {   
     return $this        
     ->belongsToMany('App\Role')        
     ->withTimestamps();
 }

 public function authorizeRoles($roles)
 {    
 	if ($this->hasAnyRole($roles)) 
 		{        
 			return true;    
 		}    
 		abort(401, 'Esta acción no está autorizada.');
 	}
 	public function hasAnyRole($roles)
 	{    
 		if (is_array($roles)) 
 			{        
 				foreach ($roles as $role) 
 					{            
 						if ($this->hasRole($role)) 
 							{                
 								return true;            
 							}        
 						}    
 					} 
 					else 
 						{        
 							if ($this->hasRole($roles)) 
 								{            
 									return true;        
 								}    
 							}    
 							return false;
 						}


 	public function hasRole($role)
 	{    
 		if ($this->roles()->where('name', $role)->first()) 
 			{        
 				return true;    
 			}    
 			return false;
 		}
}
