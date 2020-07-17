<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Annonce;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads_list = new Annonce();
        $ads = $ads_list->get();
        return view('/home',compact('ads'));

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ajout");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $annonce = new Annonce();

        $image = $request->file('photographie');
        
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('image'),$new_name);
        $annonce->titre = $request['titre'];
        $annonce->prix = $request['prix'];
        $annonce->description = $request['description'];
        
        $annonce->photographie = $new_name;
    
        $annonce->save();
        
        
        return redirect("/home");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Annonce::findOrFail($id);
        return view("view",compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Annonce::findOrFail($id);  
        return view('view_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request['hidden_image'];
        $image = $request->file('photographie');
        if($image != '')
        {
            $image_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'),$image_name);

        }
        $form_data = array(
            "titre" => $request['titre'],
            "description" => $request['description'],
            "prix" => $request['prix'],
            "photographie" => $image_name

        );
        
        Annonce::whereId($id)->update($form_data);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Annonce::find($id)->delete();

        return redirect('/home');
    }
    public function search(Request $request)
    {
        $search = $request['search'];
        $data = Annonce::table('annonces')->where('name','like','%'.$search.'%');
        return view('home',['ads'=>$data]);
    }
}
