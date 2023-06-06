<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Dados;


class DadosController extends Controller
{
    private $model;


    public function __construct(Dados $model)
    {
        $this->Dados = $model;
    }

    public function getAllClientes()
    {
        $clientes = Dados::get()->toJson(JSON_PRETTY_PRINT);
        return response($clientes, 200);
    }

    public function Create(Request $request)
    {
        try {
            $this->Dados->name = $request->name;
            $this->Dados->email = $request->email;
            $this->Dados->phone = $request->phone;
            $this->Dados->password = $request->password;
            $this->Dados->date = $request->date;

            $this->Dados->save();

            return response()->json([
                "Mensagem" => "Cadastro feito com sucesso"
            ], 201);

        } catch (\Exception $error){
            return response()->json([
                "Mensagem" => 'Deu não, motivo: <br>'.$error
            ], 400);
        }


    }

    public function edit(Request $request, $id)
    {
        if (Dados::where('id', $id)->exists()) {
            $clientes = Dados::find($id);
            $clientes->name = is_null($request->name) ? $clientes->name : $request->name;
            $clientes->email = is_null($request->email) ? $clientes->email : $request->email;
            $clientes->phone = is_null($request->phone) ? $clientes->phone : $request->phone;
            $clientes->date = is_null($request->date) ? $clientes->date : $request->date;
            $clientes->save();

            return response()->json([
                "Mensagem" => "Cadastro atualizado com Sucesso!"
            ], 200);
        } else {
            return response()->json([
                "Mensagem" => "Cliente não Existe!!"
            ], 404);
        }
    }

    public function delete(string $id)
    {
        if (Dados::where('id', $id)->exists())
        {
            $cliente = Dados::find($id);
            $cliente->delete();

            return response()->json([
                "Mensagem" => "Cadastro deletado com sucesso!"
            ], 202);
        } else{
            return response()->json([
                "Mensagem" => "Cliente não existe!"
            ], 404);
        }
    }

}
