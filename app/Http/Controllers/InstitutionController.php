<?php

namespace App\Http\Controllers;

use App\Institution;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Institution::all();
        if($list){
            return response()->json([
                "data"=>$list
            ]);
        }else{
            return response()->json([
                "message"=>"Aucun résultat"
            ]);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request){
            if(isset($request->nom) && isset($request->type_inst) && isset($request->adresse) && isset($request->pseudo) && isset($request->province) && isset($request->password)){
                $institution=new Institution();
                $institution->nom_institution=ucfirst($request->nom);
                $institution->adresse=$request->adresse;
                $institution->pseudo=$request->pseudo;
                $institution->province=ucfirst($request->province);
                $institution->type=$request->type_inst;
                $institution->setPasswordAttributes($request->password);
                if(Institution::all()->where('pseudo',$institution->pseudo)->count()!=0){
                    return response()->json([
                        "message" => "Ce pseudo est déjà utilisé"
                    ]);
                }else {
                    if ($institution->save()) {
                        return response()->json([
                            "message" => "l'institution " . $institution->nom_institution . " a bien été ajoutée"
                        ]);
                    } else {
                        return response()->json([
                            "message" => "une erreur s'est produite"
                        ]);
                    }
                }
            }else{
                return response()->json([
                   "message"=>"Veuilllez fournir toutes les informations"
                ]);
            }
        }else{
            return response()->json([
                "message"=>"la requete ne doit pas etre vide"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show($institution)
    {
        $institution=Institution::all()->find($institution);
        if($institution){
            return response()->json([
                "data"=>$institution
            ]);
        }else{
            return response()->json([
                "message"=>"Aucun résultat"
            ]);
        }

    }
    public function login(Request $request){
        if($request){
            if(isset($request->pseudo) && isset($request->mdp)){
                $institution=new Institution();
                $institution=DB::table('institutions')->where([
                    ['pseudo','=',$request->pseudo]
                ])->first();
                $ts=DB::table('institutions')->where([['pseudo','=',$request->pseudo]])->value('password');
                if(password_verify($request->mdp,$ts)){
                    return response()->json([
                        "datas"=>$institution
                    ]);
                }else{
                    return response()->json([
                        "message"=>"Identifiants incorrests"
                    ]);
                }
            }else{
                return response()->json([
                    "message"=>"Fournissez tous les paramètres requis"
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $institution)
    {
        $o=new Institution();
        $o=Institution::all()->where('id',$institution);
        return response()->json($o);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        //
    }
}
