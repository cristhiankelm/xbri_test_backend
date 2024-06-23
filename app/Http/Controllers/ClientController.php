<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    // Método para exibir todos os clientes
    public function index(): JsonResponse
    {
        // Buscar todos os clientes
        $clients = Client::query()->get();

        // Retornar os clientes em formato JSON
        return response()->json($clients);
    }

    // Método para criar um novo cliente usando form request
    public function store(StoreClientRequest $request): JsonResponse
    {
        // Receber os dados do Form Request
        $data = $request->validated();

        // Criar um novo cliente usando os dados validados do Form Request
        $client = Client::create($data);

        // Retornar o cliente criado em formato JSON
        return response()->json($client, 201);
    }

    // Método para exibir os detalhes de um cliente específico
    public function show(string $id): JsonResponse
    {
        try {
            // Buscar o cliente com o ID informado
            $client = Client::findOrFail($id);

            // Retornar os detalhes do cliente em formato JSON
            return response()->json($client);
        } catch (ModelNotFoundException $e) {
            // Retornar uma mensagem de erro se o cliente não for encontrado
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
    }

    // Método para atualizar um cliente existente
    public function update(UpdateClientRequest $request, string $id): JsonResponse
    {
        try {
            // Receber os dados do Form Request
            $data = $request->validated();

            // Buscar o cliente com o ID informado
            $client = Client::query()->findOrFail($id);
            // Atualizar os dados do cliente com os dados validados do Form Request
            $client->update($data);

            // Retornar os detalhes do cliente atualizado em formato JSON
            return response()->json($client);
        } catch (ModelNotFoundException $e) {
            // Retornar uma mensagem de erro se o cliente não for encontrado
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
    }

    // Método para excluir um cliente existente
    public function destroy(string $id): JsonResponse
    {
        try {
            // Buscar o cliente com o ID informado
            $client = Client::findOrFail($id);

            // Deletar o cliente com o ID informado
            $client->delete();

            // Retornar uma mensagem de sucesso em formato JSON
            return response()->json(['message' => 'Cliente deletado com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            // Retornar uma mensagem de erro se o cliente não for encontrado
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
    }
}
