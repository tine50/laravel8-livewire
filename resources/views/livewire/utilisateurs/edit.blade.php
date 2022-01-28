<div class="row p-4 pt-5">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form wire:submit.prevent="updateUser()">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" wire:model="editUser.nom" class="form-control @error('editUser.nom') is-invalid @enderror">

                            @error('editUser.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" wire:model="editUser.prenom" class="form-control @error('editUser.prenom') is-invalid @enderror">
                            @error('editUser.prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Sexe</label>
                    <select name="" id="" wire:model="editUser.sexe" class="form-control @error('editUser.sexe') is-invalid @enderror">
                        <option value="">------------</option>
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                    @error('editUser.sexe')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Adresse e-mail</label>
                    <input type="text" wire:model="editUser.email" class="form-control @error('editUser.email') is-invalid @enderror">
                    @error('editUser.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Téléphone 1</label>
                            <input type="text" wire:model="editUser.telephone1" class="form-control @error('editUser.telephone1') is-invalid @enderror">
                        </div>
                        @error('editUser.telephone1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Téléphone 2</label>
                            <input type="text" wire:model="editUser.telephone2" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pièce d'identité</label>
                    <select name="" id="" wire:model="editUser.pieceIdentite" class="form-control @error('editUser.pieceIdentite') is-invalid @enderror">
                        <option value="">------------</option>
                        <option value="CNI">CNI</option>
                        <option value="PASSWORD">PASSWORD</option>
                        <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                    </select>
                    @error('editUser.pieceIdentite')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Numéro de pièce d'identité</label>
                    <input type="text" wire:model="editUser.numeroPieceIdentite" class="form-control @error('editUser.numeroPieceIdentite') is-invalid @enderror">

                    @error('editUser.numeroPieceIdentite')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
              <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retourner à la liste des utilisateurs</button>
            </div>
          </form>
        </div>
        <!-- /.card -->

    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-key fa-2x"></i> Réinitialisation de mot de passe</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                <a href="" class="btn btn-link" wire:click.prevent="confirmPwdReset">Réinitialiser le mot de passe</a>
                                <span>(Par défaut: "password")</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-fingerprint fa-2x"></i> Rôles & permissions</h3>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


