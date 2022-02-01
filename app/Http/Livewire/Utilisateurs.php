<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Utilisateurs extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";


    public $newUser = [];
    public $editUser = [];
    public $rolePermissions = [];

    public $currentPage = PAGELIST;


    // protected $messages = [
    //     'newUser.nom.required' => 'Le nom de l\'utilisateur est requis.',
    //     'newUser.prenom.required' => 'Le nom de l\'utilisateur est requis.',
    //     'newUser.email.required' => 'L\'email de l\'utilisateur est requis.',
    //     'newUser.email.required' => 'L\'email de l\'utilisateur est requis.',
    //     'email.email' => 'The Email Address format is not valid.',
    // ];

    public function render()
    {
        Carbon::setLocale('fr');
        return view('livewire.utilisateurs.index', [
            'users' => User::latest()->paginate(5),
        ])
        ->extends('layouts.master')
        ->section('contenu');
    }

    public function rules()
    {
        if($this->currentPage == PAGEEDITFORM)
        {
            return [
                'editUser.nom' => 'required',
                'editUser.prenom' => 'required',
                'editUser.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->editUser['id'])],
                'editUser.telephone1' => ['required', 'numeric', Rule::unique('users', 'telephone1')->ignore($this->editUser['id'])],
                'editUser.pieceIdentite' => 'required',
                'editUser.sexe' => 'required',
                'editUser.numeroPieceIdentite' => ['required', Rule::unique('users', 'numeroPieceIdentite')->ignore($this->editUser['id'])],
            ];
        }

        return [
            'newUser.nom' => 'required',
            'newUser.prenom' => 'required',
            'newUser.email' => 'required|email|unique:users,email',
            'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
            'newUser.pieceIdentite' => 'required',
            'newUser.sexe' => 'required',
            'newUser.numeroPieceIdentite' => 'required|unique:users,numeroPieceIdentite',
        ];
    }


    public function goToAddUser()
    {
        $this->currentPage = PAGECREATEFORM;
    }


    public function goToEditUser($id)
    {
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;

        $this->populateRolePermissions();
    }

    public function populateRolePermissions()
    {
        $this->rolePermissions['roles'] = [];
        $this->rolePermissions['permissions'] = [];


        $mapForCB = function($value) {
            return $value['id'];
        };

        $roleIds = array_map($mapForCB, User::find($this->editUser["id"])->roles->toArray());
        $permissionIds = array_map($mapForCB, User::find($this->editUser["id"])->permissions->toArray());

        foreach(Role::all() as $role){
            if(in_array($role->id, $roleIds)){
                array_push($this->rolePermissions['roles'], ['role_id' => $role->id, 'role_nom' => $role->nom, 'active' => true]);
            } else {
                array_push($this->rolePermissions['roles'], ['role_id' => $role->id, 'role_nom' => $role->nom, 'active' => false]);
            }
        }

        foreach(Permission::all() as $permission){
            if(in_array($permission->id, $permissionIds)){
                array_push($this->rolePermissions['permissions'], ['permission_id' => $permission->id, 'permission_nom' => $permission->nom, 'active' => true]);
            } else {
                array_push($this->rolePermissions['permissions'], ['permission_id' => $permission->id, 'permission_nom' => $permission->nom, 'active' => false]);
            }
        }

        // dd($roleIds);
    }

    public function updateRoleAndPermissions()
    {
        DB::table('user_role')->where('user_id', $this->editUser['id'])->delete();
        DB::table('user_permission')->where('user_id', $this->editUser['id'])->delete();

        foreach($this->rolePermissions['roles'] as $role){
            if($role['active'] == true){
                User::find($this->editUser['id'])->roles()->attach($role['role_id']);
            }
        }

        foreach($this->rolePermissions['permissions'] as $permission){
            if($permission['active'] == true){
                User::find($this->editUser['id'])->permissions()->attach($permission['permission_id']);
            }
        }
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Roles et permission misent à jour avec succès!']);
    }

    public function goToListUser()
    {
        $this->currentPage = PAGELIST;
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
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Utilisateur supprimé avec succès!']);
    }

    public function addUser()
    {
        $validationAttributes = $this->validate();

        $validationAttributes['newUser']['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        User::create($validationAttributes['newUser']);

        $this->newUser = [];

        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Utilisateur créé avec succès!']);
    }


    public function updateUser()
    {
        $validationAttributes = $this->validate();
        User::find($this->editUser['id'])->update($validationAttributes['editUser']);
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Utilisateur mis à jour avec succès!']);
    }

    public function confirmPwdReset()
    {
        $this->dispatchBrowserEvent('showConfirmMessage', ["message" => [
            "text" => "Vous êtes sur le point de réinitialiser le mot de passe de cet utilisateur. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            ]
        ]);
    }

    public function resetPassword()
    {
        User::find($this->editUser['id'])->update(['password' => Hash::make(DEFAULTPASSWORD)]);
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Mot de passe utilisateur réinitialisé avec succès!']);
    }
}
