<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\categorie;
use App\plat;
use App\Commande;
use App\LineOfCommande;
use App\commandesLog;
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

    public function changeStatusCaissier(Request $request)
    {
        return DB::table('commandes')
        ->where('id', $request->id)
        ->update(['status'=>$request->status, 'numero_table'=>$request->numero_table]);
    }
    public function saveCommands()
    {
        $nb = Commande::all()->count();
        $all = Commande::all();
        $total = 0;
        $list = DB::table('commandes')->select('total')->get();
        foreach ($list as $one)
        {   
            $total = $total + (float)$one->total;
        }
        DB::table('commandes')->delete();
        DB::table('line_of_commandes')->delete();

        return  commandesLog::create(['nombre' => $nb, 'total' => $total]);
    }
    
    public function getLastDay()
    {
        return commandesLog::all()->last()->created_at;
    } 

    public function getNumOfCat()
    {
        return categorie::all()->count();
    }    
    
    public function getNumOfPl()
    {
        return plat::all()->count();
    }


    function updateCategory(Request $request)
    {
        $oldCat= categorie::findOrFail($request->id)->name;

        DB::table('categories')
                ->where('id', $request->id)
                ->update([
                'name'=>$request->name,
                'description'=>$request->description,
                ]);

        DB::table('plats')
                ->where('categorie', $oldCat)
                ->update([
                'categorie'=>$request->name,
                ]);
    }
          
    function deleteCategory($id)
    {
        $catName= categorie::findOrFail($id)->name;
        categorie::where('id', $id)->delete();
        plat::where('categorie', $catName)->delete();

    }

    function getCommandsLog()
    {
        return DB::table('commandes_logs')->orderBy('id', 'DESC')->limit(7)->get();
    }

    function deleteEmp($email)
    {
        User::where('email', $email)->delete();
    }
    

}
