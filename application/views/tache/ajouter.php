<?= form_open('tache/ajouter'); ?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Completer ces informations :</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Description</label>
            <textarea name="desc" class="form-control" rows="3" placeholder="La description ici..."></textarea>
            <span class="text-danger"><?php echo form_error('desc'); ?></span>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</div>
<?= form_close(); ?>