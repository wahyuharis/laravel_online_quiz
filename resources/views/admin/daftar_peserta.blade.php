<div class="card mt-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <a href="<?= url('admin/daftar_peserta/add') ?>" class="btn btn-primary">Tambah</a>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="form_filter" class="mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_kelompok_peserta">Kelompok Peserta:</label>
                        <select class="form-control" id="id_kelompok_peserta" placeholder="Kelompok Peserta" name="id_kelompok_peserta">
                            <option value="">Pilih Kelompok Peserta</option>
                            <?php foreach ($kelompok_peserta as $opt) { ?>
                                <option value="<?= $opt->id_kelompok_peserta ?>"><?= $opt->nama_kelompok_peserta ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary d-none" ><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>

        <table id="table_dtt" class="table ">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col" style="width:130px">Aksi</th>
                    <th scope="col">No Induk</th>
                    <th scope="col">Nama Peserta</th>
                    <th scope="col">Kelompok Peserta</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    // $(document).ready(function() {
    $(document).ready(function() {
        var table = $('#table_dtt').DataTable({
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
            "ajax": '<?= url('admin/daftar_peserta/datatables') ?>',
            "drawCallback": function(settings) {
                delete_handler();
            },
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }, ],
            // "order": [[ 0, "desc" ]],
            "ordering": false
        });

        $('#form_filter').submit(function(e) {
            e.preventDefault();
            // formdata = new FormData(this);
            formdata = $(this).serialize();

            table.ajax.url('<?= url('admin/daftar_peserta/datatables?') ?>' + formdata).load();

        });

        $('#id_kelompok_peserta').change(function(){
            $('#form_filter').submit();
        });

        function delete_handler() {
            $('.delete_btn').click(function(e) {
                e.preventDefault();
                let delete_url = $(this).attr('href');

                let text = "Yakin Menghapus Data ? ";
                if (confirm(text) == true) {
                    window.location.href = delete_url;
                } else {
                    // text = "You canceled!";
                }

            });
        }
    });
    // });
</script>