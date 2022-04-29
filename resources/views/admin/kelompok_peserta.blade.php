
<!-- <h2>Kelompok Peserta</h2> -->

<div class="card" id="form_1_card" style="display: none;">
    <div class="card-body">
        <form method="post" action="<?= url('admin/kelompok_peserta/submit') ?>">
            <div class="form-group">
                <input type="hidden" name="primary_id" value="<?= $form->primary_id ?>">
                <label for="nama_kelompok_peserta">Nama Kelompok Peserta:</label>
                <input type="text" class="form-control" value="<?= $form->nama_kelompok_peserta ?>" id="nama_kelompok_peserta" placeholder="Nama Kelompok Peserta" name="nama_kelompok_peserta">
            </div>
            <button id="add_btn" type="submit" class="btn btn-primary">Save</button>
            <a href="<?= url('admin/kelompok_peserta') ?>" class="btn btn-secondary">Batal</a>

        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php if (Request::input('tambah') == 1 or Request::input('edit') == 1) { ?>
            $("#form_1_card").slideDown("slow");
        <?php } ?>
    });
</script>

<div class="card mt-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <a href="<?= url('admin/kelompok_peserta?tambah=1') ?>" class="btn btn-primary">Tambah</a>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
    <div class="card-body">

        <table id="table_native_dtt" class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Nama Kelompok</th>
                </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                <?php foreach ($kelompok_peserta as $row) { ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="<?= url('admin/kelompok_peserta?edit=1&id=' . $row->id_kelompok_peserta) ?>">
                                Edit
                            </a>
                            <a class="btn btn-sm btn-danger" href="<?= url('admin/kelompok_peserta/delete?id=' . $row->id_kelompok_peserta) ?>">
                                Delete
                            </a>
                        </td>
                        <td><?= $row->nama_kelompok_peserta ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#table_native_dtt').DataTable({
            "pageLength": 5,
            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
        });
    });
</script>