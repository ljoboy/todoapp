<div class="box">
    <div class="box-header">
        <h3 class="box-title">Liste de toutes les taches</h3>
        <div class="pull-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Ajouter une
                tache</button>
        </div>
        <br />
        <hr />
        <div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Description</th>
                            <th>Date création</th>
                            <th>Etat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$i = 1;
						foreach ($taches as $tache) {
							$etat = ($tache->etat == 0) ? "En cours" : "Finie";
							$modifiable = ($tache->etat == 0) ? "<a class='text-green' title='Finir la tache' href='" . site_url('tache/finir/' . $tache->id) . "' onclick='javascript: return finir(\"" . $tache->description . "\")'><i class='fa fa-check fa-2x'></i></a> &nbsp;" .
								"<a data-toggle='modal' data-target='#modal-default2' href='#' title='Modifier' onclick='getText(\"" . $tache->description . "\"," . $tache->id . ")'><i class='fa fa-pencil fa-2x'></i></a> &nbsp;"
								: "<span title='Tache finie' style='cursor: not-allowed;'><i class='fa fa-check fa-2x'></i></a> &nbsp;<span title='Tache finie' style='cursor: not-allowed;'><i class='fa fa-pencil fa-2x'></i></a> &nbsp;";
							echo "
							<tr>
								<td> $i </td>
								<td style='text-transform: capitalize;'> " . $tache->description . "</td>
								<td> " . nice_date($tache->datecreation, 'd-m-Y H:i:s') . " </td>
								<td>" . $etat . " </td>
								<td>
									$modifiable
									<a class='text-red' title='Supprimer' href='" . site_url('tache/supprimer/' . $tache->id) . "' onclick='javascript: return supprimer(\"" . $tache->description . "\")'><i class='fa fa-times fa-2x'></i></a>
								</td>
							</tr>";
							$i++;
						} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <?= form_open('tache/ajouter'); ?>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter une tache</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="txt_desc" name="desc" class="form-control" rows="3"
                                placeholder="La description ici..."></textarea>
                            <span class="text-danger"><?php echo form_error('desc'); ?></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?= form_close(); ?>
        <?= form_open('tache/modifier'); ?>
        <div class="modal fade" id="modal-default2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter une tache</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="desc" name="desc" class="form-control" rows="3"
                                placeholder="La description ici..."></textarea>
                            <span class="text-danger"><?php echo form_error('desc'); ?></span>
                        </div>
                    </div>
                    <input type="hidden" name="idTache" id="idTache">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?= form_close(); ?>