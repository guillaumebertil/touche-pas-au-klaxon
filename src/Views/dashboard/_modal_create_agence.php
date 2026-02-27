<!-- Modal -->
<div class="modal fade" id="createAgenceModal" tabindex="-1" role="dialog" aria-labelledby="createAgenceModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        <!-- Modal header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter une agence</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="<?= BASE_URL ?>/dashboard/agences" method="POST">
                <div class="mb-3">
                    <label for="ville" class="form-label">Nom de la ville</label>
                    <input type="text" class="form-control" id="ville" name="ville">
                </div>

                <div class="container d-flex justify-content-center">
                    <button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success mx-2">Ajouter</button>
                </div>
            </form>
        </div>

        </div>
    </div>
</div>