<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Utilisateurs extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $isBtnAddClicked = false;

    public $newUser = [];

    protected $rules = [
        'newUser.nom' => 'required',
        'newUser.prenom' => 'required',
        'newUser.email' => 'required|email|unique:users,email',
        'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
        'newUser.pieceIdentite' => 'required',
        'newUser.sexe' => 'required',
        'newUser.numeroPieceIdentite' => 'required|unique:users,numeroPieceIdentite',
    ];

    // protected $messages = [
    //     'newUser.nom.required' => 'Le nom de l\'utilisateur est requis.',
    //     'newUser.prenom.required' => 'Le nom de l\'utilisateur est requis.',
    //     'newUser.email.required' => 'L\'email de l\'utilisateur est requis.',
    //     'newUser.email.required' => 'L\'email de l\'utilisateur est requis.',
    //     'email.email' => 'The Email Address format is not valid.',
    // ];

    public function render()
    {
        return view('livewire.utilisateurs.index', [
            'users' => User::latest()->paginate(5),
        ])
        ->extends('layouts.master')
        ->section('contenu');
    }

    public function goToAddUser()
    {
        $this->isBtnAddClicked = true;
    }

    public function goToListUser()
    {
        $this->isBtnAddClicked = false;
    }

    public function confirmDelete($name, $id)
    {
        $this->dispatchBrowserEvent('showConfirmMessage', ["message" => [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "user_id" => $id
            ]
            ]
        ]);
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Utilisateur créé avec succès!']);
    }

    public function addUser()
    {
        $validationAttributes = $this->validate();

        $validationAttributes['newUser']['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        User::create($validationAttributes['newUser']);

        $this->newUser = [];

        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Utilisateur supprimé avec succès!']);
    }
}
