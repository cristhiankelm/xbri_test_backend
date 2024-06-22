<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    // Método para exibir todos os clientes
    public function index()
    {
        // Buscar todos os clientes
        $clients = Client::query()->get();

        // Retornar os clientes em formato JSON
        return response()->json($clients);
    }

    // Método para criar um novo cliente usando form request
    public function store(StoreClientRequest $request)
    {
        // Receber os dados do Form Request
        $data = $request->validated();

        // Criar um novo cliente usando os dados validados do Form Request
        $client = Client::create($data);

        // Retornar o cliente criado em formato JSON
        return response()->json($client, 201);
    }

    // Método para exibir os detalhes de um cliente específico
    public function show(string $id)
    {
        // Buscar o cliente com o ID informado
        $client = Client::query()->findOrFail($id);

        // Retornar os detalhes do cliente em formato JSON
        return response()->json($client);
    }

    // Método para atualizar um cliente existente
    public function update(UpdateClientRequest $request, string $id)
    {
        // Receber os dados do Form Request
        $data = $request->validated();

        // Buscar o cliente com o ID informado
        $client = Client::query()->findOrFail($id);
        // Atualizar os dados do cliente com os dados validados do Form Request
        $client->update($data);

        // Retornar os detalhes do cliente atualizado em formato JSON
        return response()->json($client);
    }

    // Método para excluir um cliente existente
    public function destroy(string $id)
    {
        // Buscar o cliente com o ID informado
        $client = Client::query()->findOrFail($id);
        // Deletar o cliente com o ID informado
        $client->delete();

        // Retornar uma mensagem de sucesso em formato JSON
        return response()->json(['message' => 'Cliente deletado com sucesso'], 200);
    }
}
