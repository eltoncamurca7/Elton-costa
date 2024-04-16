<?php

namespace App\Http\Controllers;

use App\helpers\ValidateCpf;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repository\Client\ClientRepository;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $validateCpf;
    private $clientRepository;

    public function __construct(ValidateCpf $validateCpf, ClientRepository $clientRepository)
    {
        $this->validateCpf = $validateCpf;
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {

        $clients = $this->clientRepository->all();

        return view('clients.index', ['clients' => $clients]);
    }

    public function newClient()
    {
        return view('clients.create');
    }

    public function createClient(ClientRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->validateCpf->validate($data['cpf'])) {
                $this->clientRepository->create($data);
                return redirect()->route('index-client');
            }
            return response()->json(['message' => 'cpf invalido'], 400);
        } catch (Exception $error) {
            return response()->json(['message' => 'Erro ao registrar cliente: '], 500);
        }
    }

    public function listClients()
    {
        try {
            return $this->clientRepository->all();
        } catch (Exception $error) {
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }

    public function deleteClient($id)
    {
        try {
            $this->clientRepository->delete($id);
            return redirect()->route('index-client');
        } catch (Exception $error) {
            return response()->json(['message' => 'Erro interno: ' . $error->getMessage()], 500);
        }
    }

    public function updateClient(Request $request)
    {
        try {
            $data = $request->all();
            $this->clientRepository->update($data);
            return redirect()->route('index-client');
        } catch (Exception $error) {
            return response()->json(['message' => 'Erro ao atualizar cliente: ' . $error->getMessage()], 500);
        }
    }

    public function editClient($id)
    {
        try {
            $client = $this->clientRepository->find($id);
            if (empty($client)) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }
            return view('clients.edit', ['client' => $client]);
        } catch (Exception $error) {
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }

    public function getClientById($id)
    {
        try {
            $client = $this->clientRepository->find($id);
            if (empty($client)) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }
            return $client;
            // return view('clients.show', ['client' => $client]);
        } catch (Exception $error) {
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }

    public function detailsClient($id)
    {
        try {
            $client = $this->clientRepository->find($id);
            if (empty($client)) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }
            return view('clients.show', ['client' => $client]);
        } catch (Exception $error) {
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }

    public function sortClients($field)
    {
        $sort = Client::query();

        if ($field === 'id' || $field === 'name' || $field === 'email') {
            $sort->orderBy($field);
        }

        $clients = $sort->paginate(20);

        return view('clients.index', compact('clients'));
    }

    public function deleteSelected(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);
        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'Nenhum item selecionado.');
        }

        try {
            $this->clientRepository->deleteSelected($selectedItems);

            return redirect()->back()->with('success', 'Clientes deletados com sucesso.');
        } catch (Exception $error) {
            return redirect()->back()->with('error', 'Erro ao deletar os clientes.');
        }
    }
}
