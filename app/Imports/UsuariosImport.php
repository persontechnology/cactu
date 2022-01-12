<?php

namespace cactu\Imports;

use cactu\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user=User::where('email',$row[1])->first();
        
        if(!$user){
            $user= new User([
                'name'     => $row[0],
               'email'    => $row[1], 
               'identificacion'    => $row[2], 
               'password' => Hash::make($row[3]),
            ]);            
            $rol=Role::where('name',$row[4])->first();
            if($rol){
                $user->assignRole($rol);
            }
        }

        return $user;
    }
    
}
