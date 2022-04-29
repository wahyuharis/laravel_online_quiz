<div class="card mt-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <a href="<?=url('admin/kelompok_kuis/add')?>" class="btn btn-primary">Tambah</a>
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
                    <th scope="col">Waktu mulai</th>
                    <th scope="col">Waktu Selesai</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table_native_dtt').DataTable({
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
            "ajax": '<?= url('admin/kelompok_kuis/datatables') ?>',
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

            table.ajax.url('<?= url('admin/kelompok_kuis/datatables?') ?>' + formdata).load();

        })

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
</script>