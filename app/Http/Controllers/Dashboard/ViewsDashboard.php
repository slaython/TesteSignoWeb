<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewsDashboard extends Controller
{
    public function Dashboard(){
        return view('dashboard', [
            'MENU' => $this->Helpers->Menu(),
            'ENQUETES' => $this->Helpers->Enquetes(),
        ]);
    }
}
