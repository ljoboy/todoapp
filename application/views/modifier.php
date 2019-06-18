<?= form_open('welcome/modifier/'.$tache->id); ?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Completer ces informations :</h3>
    </div>
    <div class="box-body">
        <!-- Date range -->
        <div class="form-group">
            <label>Date début et fin :</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input
                    value="<?= nice_date($tache->date_debut, 'm-d-Y') . " - " . nice_date($tache->date_fin, 'm-d-Y') ?>"
                    name="dates" type="text" class="form-control pull-right" id="reservation">
                <span class="text-danger"><?php echo form_error('dates'); ?></span>
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->

        <div class="form-group">
            <label>Description</label>
            <textarea name="desc" class="form-control" rows="3"
                placeholder="La description ici..."><?= $tache->description ?></textarea>
            <span class="text-danger"><?php echo form_error('desc'); ?></span>
        </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</div>
<?= form_close(); ?>