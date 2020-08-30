<?php

namespace App\Http\Controllers;

use App\etudiant;
use App\Institution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=etudiant::all();
        if($list){
            return response()->json([
                "data"=>$list
            ]);
        }else{
            return response()->json([
                "message"=>'Aucun résultat'
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
            if(isset($request->matricule) && isset($request->sexe) && isset($request->nom) && isset($request->postnom) && isset($request->prenom) && isset($request->dn) && isset($request->ln) && isset($request->adr) && isset($request->prom) && isset($request->inst)){
                $etudiant=new etudiant();
                $etudiant->matricule=$request->matricule;
                $etudiant->nom=$request->nom;
                $etudiant->postnom=$request->postnom;
                $etudiant->prenom=$request->prenom;
                $etudiant->date_de_naissance=new \DateTime($request->dn);
                $etudiant->lieu_de_naissance=$request->ln;
                $etudiant->adresse=$request->adr;
                $etudiant->sexe=$request->sexe;
                $etudiant->promotion=$request->prom;
                $etudiant->institution=Institution::all()->find($request->inst)->id;
                if(etudiant::all()->where('matricule',$request->matricule)->count()!=0){
                    return response()->json([
                        'message'=>'Un etudiant avec ce numéro matricule existe déjà'
                ]);
                }else {
                    if ($etudiant->save()) {
                        return response()->json([
                            "message" => "Ajout avec success",
                            "data" => $etudiant
                        ]);
                    } else {
                        return response()->json([
                            "message" => "une erreur s'est produite"
                        ]);
                    }
                }
            }else{
                return response()->json([
                   "message"=>"Veuillez fournir toutes les informations requises"
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show($etudiant)
    {
        $etudiant=etudiant::all()->find($etudiant);
        if($etudiant){
            return response()->json([
                'data'=>$etudiant
            ]);
        }else{
            return response()->json([
                'message'=>'Aucun resultat'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$etudiant)
    {
        if(etudiant::all()->find($etudiant)
            ->update(['nom'=>$request->nom],['postnom'=>$request->postnom],
            ['prenom'=>$request->prenom],['sexe'=>$request->sexe],['date_de_naissance'=>$request->dn],
            ['lieu_de_naissance'=>$request->ln],['promotion'=>$request->promotion],
            ['adresse'=>$request->adresse],['institution'=>$request->inst])){

            return response()->json([
               'message'=>'Donnée mise à jour avec succes'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($etudiant)
    {
        if(etudiant::all()->find($etudiant)->delete()){
            return response()->json([
                "message"=>"Suppression réussie"
            ]);
        }else{
            return response()->json([
                "message"=>"la suppression a échouée"
            ]);
        }
    }
}
