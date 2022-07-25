<?php

namespace App\Http\Controllers\Enquetes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewsEnquetes extends Controller
{
    public function GerenciarEnquetes(){
        return view('gerenciarEnquetes', [
            'MENU' => $this->Helpers->Menu(),
            'ENQUETES' => $this->Helpers->Enquetes(),
        ]);
    }

    public function Enquete(Request $Request){
        return view('enquete', [
            'ENQUETE' => $this->Helpers->Enquete($Request->ID),
            'RESPOSTAS' => $this->Helpers->Respostas($Request->ID),
        ]);
    }
}
