<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    public function getByUser()
    {
        return response(Spending::where('user_id', request('user_id'))->get(), 200);
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

    public function entries()
    {
        return response(Spending::where('user_id', request('user_id'))->where('category', 'entrada')->sum('price'), 200);
    }

    public function outs()
    {
        return response(Spending::where('user_id', request('user_id'))->where('category', 'saida')->sum('price'), 200);
    }

    public function search()
    {
        if(request('search') != ''){
            return response(
                Spending::where('user_id', request('user_id'))
                ->where('description', 'like', '%'.request('search').'%')
                ->orWhere('price', 'like', '%'.request('search').'%')
                ->orWhere('category', 'like', '%'.request('search').'%')
                ->get(), 200);
        } else {
            return response(
                Spending::where('user_id', request('user_id'))
                ->get(), 200);
        }
    }
}
