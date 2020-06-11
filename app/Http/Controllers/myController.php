<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\categorie;
use App\plat;
use App\Commande;
use App\LineOfCommande;
use Illuminate\Support\Facades\DB;

class myController extends Controller
{
    public function profile($email)
    {
        return  User::where('email', $email)->first();
    }
    public function addCategory(Request $request)
    {
        return  categorie::create($request->all());
    }
    public function addPlat(Request $request)
    {
        return  plat::create($request->all());
    }
    public function getCategorise()
    {
        return  categorie::all();
    }
    public function getPlats()
    {
        return  plat::all();
    }
    public function imageUpload(Request $request)
    {
     
        if($request->file('image'))
        {
        $image = $request->image;
        $extension = $image->getClientOriginalExtension();
        

        //$imageName = time().'.'.$extension;  
        $imageName = $image->getClientOriginalName();
   
        $path = $request->file('image')->move(public_path('../../AppResto/src/assets/img/uploadImages'), $imageName);
        }
        return 1;
   
    }
    public function profileUpload(Request $request)
    {
     
        if($request->file('image'))
        {
        $image = $request->image;
        $extension = $image->getClientOriginalExtension();
        
        $imageName = $image->getClientOriginalName();
   
        $path = $request->file('image')->move(public_path('../../AppResto/src/assets/img/avatars'), $imageName);
        }
        return 1;
   
    }  

    public function getEmployees()
    {
        return  User::all();
    }

    public function createCommande(Request $request)
    {
        $check = Commande::where('numero_table', $request->numero_table)->count();
        if($check == 1)
        return response()->json(['error' => 'La table est reservé'], 401);

        $com = Commande::create($request->all());
         return $com->id;
    }

    public function createLineOfCommande(Request $request)
    {
        return  LineOfCommande::create($request->all());
    }
    
    public function deletePlat($id)
    {
        return DB::table('plats')->delete($id);
    }

    public function getCommands()
    {
        return  Commande::all();
    }

    public function getLineCommands($id)
    {
        return  LineOfCommande::where('idCommande',$id)->get();
    }

    public function changeStatus(Request $request)
    {
        return DB::table('commandes')
        ->where('id', $request->id)
        ->update(['status'=>$request->status]);
    }
    
}
