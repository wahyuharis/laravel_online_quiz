<script>
    // $(document).ready(function(){
    //     alert('hello');
    // });

    function f_detail_lain(parameter, value) {
        var self = this;

        self.parameter = ko.observable(parameter);;
        self.value = ko.observable(value);
    }



    function Form_daftar_peserta_model() {
        var self = this;

        self.primary_id = ko.observable('<?= $form->primary_id ?>');
        self.id_kelompok_peserta = ko.observable('<?= $form->id_kelompok_peserta ?>');
        self.opt_kelompok_peserta = ko.observableArray(<?= json_encode($form->opt_kelompok_peserta) ?>);
        self.no_induk = ko.observable('<?= $form->no_induk ?>');
        self.password = ko.observable('<?= $form->password ?>');
        self.nama_peserta = ko.observable('<?= $form->nama_peserta ?>');

        self.detail_lain = ko.observableArray([]);

        <?php foreach ($form->keterangan_lain as $row) { ?>
            self.detail_lain.push(new f_detail_lain('<?= $row['parameter'] ?>', '<?= $row['value'] ?>'));
        <?php } ?>

        // self.detail_lain.push(new f_detail_lain('', ''));

        self.add_row_detail = function(row) {
            self.detail_lain.push(new f_detail_lain('', ''));
        }

        self.delete_detail = function(row) {
            self.detail_lain.remove(row);
        }
    }

    $(document).ready(function() {
        ko.applyBindings(new Form_daftar_peserta_model(), document.getElementById("form_daftar_peserta_container"));


        $('#form_daftar_peserta_container').submit(function(e) {
            e.preventDefault();
            var formdata = $('#ko_output').val();
            JsLoadingOverlay.show();
            $.ajax({
                url: "<?= url('admin/daftar_peserta/submit') ?>",
                type: 'post',
                data: {
                    datapost:formdata
                },
                success: function(data) {
                    if (data.success) {
                        window.location.href = "<?= url('admin/daftar_peserta') ?>";
                    } else {
                        $('#alert_status').show();
                        $('#alert_message').html(data.message);
                    }
                    JsLoadingOverlay.hide();
                },
                error: function(err) {
                    alert(err);
                    JsLoadingOverlay.hide();

                }
            });
        });

    })
</script>