<form id="form_1" method="post">
    <input type="hidden" name="primary_id" value="<?= $form->primary_id ?>">

    <div id="alert_status" class="alert alert-danger" style="display: none;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Maaf!</strong>
        <p id="alert_message"></p>
    </div>

    <div class="card">

        <div class="card-header">
            <a class="btn btn-secondary" href="<?= url('admin/kelompok_kuis') ?>">Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_kuis">Nama Kuis:</label>
                        <input value="<?= $form->nama_kuis ?>" type="text" class="form-control" id="nama_kuis" name="nama_kuis" placeholder="Nama Kuis">
                    </div>



                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai:</label>
                        <input value="<?= $form->waktu_mulai ?>" type="text" class="form-control dtttimepicker" id="waktu_mulai" name="waktu_mulai" placeholder="Waktu Mulai">
                    </div>

                    <div class="form-group">
                        <label for="waktu_selesai">Waktu Selesai:</label>
                        <input value="<?= $form->waktu_selesai ?>" type="text" class="form-control dtttimepicker" id="waktu_selesai" name="waktu_selesai" placeholder="Waktu Selesai">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="detail">Keterangan:</label>
                        <textarea type="text" class="form-control" id="detail" name="detail" placeholder="Keterangan"><?= $form->detail ?></textarea>
                    </div>

                </div>

                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin/kelompok_kuis_edit_script')