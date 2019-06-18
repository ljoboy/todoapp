<div class="box">
    <div class="box-header">
        <h3 class="box-title">Liste des taches</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$i = 1;
				foreach ($taches as $tache) {
					echo "
					<tr>
						<td> $i </td>
						<td> " . nice_date($tache->date_debut, 'd-m-Y') . " </td>
						<td>" . nice_date($tache->date_fin, 'd-m-Y') . " </td>
						<td> $tache->description </td>
						<td>
							<a title='Modifier' href='" . site_url('welcome/modifier/' . $tache->id) . "'><i class='fa fa-pencil fa-2x'></i></a> &nbsp;
							<a class='text-red' title='Supprimer' href='" . site_url('welcome/supprimer/' . $tache->id) . "' onclick='javascript: return supprimer(\"" . $tache->description . "\")'><i class='fa fa-times fa-2x'></i></a>
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