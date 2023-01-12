<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    public function getByUser()
    {
        return response(Spending::where('user_id', request('user_id'))->all(), 200);
    }

    public function store()
    {
        Spending::create(request()->all());

        return response("Controle guardado com sucesso!", 200);
    }

    public function show()
    {
        return response(Spending::findOrFail(request('spending_id'))->first(), 200);
    }

    public function update()
    {
        Spending::findOrFail(request('spending_id'))->update(request()->except('spending_id'));

        return response('Controle atualizado com sucesso!', 200);
    }

    public function delete()
    {
        Spending::findOrFail(request('spending_id'))->delete();

        return response('Controle deletado com sucesso!', 200);
    }
}
