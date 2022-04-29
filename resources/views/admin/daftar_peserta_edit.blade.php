<form id="form_daftar_peserta_container" action="<?= url('daftar_peserta/submit/') ?>">
    <input type="hidden" data-bind="value:primary_id">

    <div id="alert_status" class="alert alert-danger" style="display: none;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Maaf!</strong>
        <p id="alert_message"></p>
    </div>

    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="<?= url('admin/daftar_peserta') ?>">Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Nomor Induk:</label>
                        <input type="text" class="form-control" data-bind="value:no_induk" id="no_induk" placeholder="No Induk">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="text" class="form-control" data-bind="value:password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="nama_peserta">Nama Peserta:</label>
                        <input type="text" class="form-control" data-bind="value:nama_peserta" id="nama_peserta" placeholder="Nama Peserta">
                    </div>

                    <div class="form-group">
                        <label for="kelompok_peserta">Kelompok Peserta:</label>
                        <!-- <select type="text" class="form-control" data-bind="" id="kelompok_peserta"></select> -->

                        <select id="kelompok_peserta" class="form-control" data-bind="options: opt_kelompok_peserta,
                       optionsText: 'nama_kelompok_peserta',
                       optionsValue: 'id_kelompok_peserta',
                       value: id_kelompok_peserta,
                       optionsCaption: 'Pilih Kelompok Peserta..'"></select>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                <div class="col-md-6">
                    <p>Keterangan Lain</p>

                    <table class="table">
                        <tbody data-bind="foreach:detail_lain">
                            <tr>
                                <td><input type="text" class="form-control input-sm" data-bind="value:parameter" placeholder="Tentang"> </td>
                                <td>:</td>
                                <td><input type="text" class="form-control input-sm" data-bind="value:value" placeholder="Keterangan"> </td>
                                <td>
                                    <span data-bind="click: $root.delete_detail" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <span data-bind="click: add_row_detail" class="btn btn-info btn-block btn-sm">
                                        <i class="fa fa-plus-circle"></i> Tambah keterangan
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- <textarea id="ko_output" style="display: none" data-bind="value: ko.toJSON($root)"></textarea> -->
                    <textarea id="ko_output" class="form-control d-none" data-bind="value: ko.toJSON($root)"></textarea>

                </div>

                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
</form>
@include('admin/daftar_peserta_edit_script')