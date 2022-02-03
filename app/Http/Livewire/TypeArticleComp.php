<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class TypeArticleComp extends Component
{
    Use WithPagination;

    protected  $paginationTheme = "bootstrap";
    public $search = "";
    public $isAddTyperticle = false;
    public $newTypeArticleName = "";
    public $newValue = "";

    public function render()
    {
        Carbon::setLocale('fr');
        $searchCriteria = '%'.$this->search.'%';
        $data = [
            'typearticles' => TypeArticle::where('nom', 'like', $searchCriteria)->latest()->paginate(5),
        ];
        return view('livewire.typearticles.index', $data)
            ->extends('layouts.master')
            ->section('contenu');
    }

    public function toggleShowAddTypeArticleForm()
    {
        if($this->isAddTyperticle)
        {
            $this->isAddTyperticle = false;
            $this->newTypeArticleName = "";
            $this->resetErrorBag(['newTypeArticleName']);
        } else{
            $this->isAddTyperticle = true;
        }
    }

    public function addNewTypeArticle()
    {
        $validated = $this->validate([
            "newTypeArticleName" => "required|max:50|unique:type_articles,nom"
        ]);

        TypeArticle::create([
            "nom" => $validated["newTypeArticleName"]
        ]);

        $this->toggleShowAddTypeArticleForm();
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Type d\'article ajouté avec succès!']);
    }

    public function editTypeArticle(TypeArticle $typeArticle)
    {
        $this->dispatchBrowserEvent("showEditForm", ["typearticle" => $typeArticle]);
    }

    public function updateTypeArticle(TypeArticle $typeArticle, $value)
    {
        $this->newValue = $value;

        $validated = $this->validate([
            "newValue" => ["required", Rule::unique('type_articles', 'nom')->ignore($typeArticle->id)]
        ]);

        $typeArticle->update(["nom" => $validated["newValue"]]);
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Type d\'article mis à jour avec succès!']);
    }

    public function confirmDelete($name, $id)
    {
        $this->dispatchBrowserEvent('showConfirmMessage', ["message" => [
            "text" => "Vous êtes sur le point de supprimer '$name' de la liste des types d'articles. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "type_article_id" => $id
            ]
            ]
        ]);
    }

    public function deleteTypeArticle(TypeArticle $typeArticle)
    {
        $typeArticle->delete();
        $this->dispatchBrowserEvent('showSuccessMessage', ['message' => 'Type d\'article supprimé avec succès!']);
    }
}
