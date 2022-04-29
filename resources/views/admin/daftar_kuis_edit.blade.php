<form id="form_1" method="post">
    <input type="hidden" name="primary_id" value="<?= $form->primary_id ?>">

    <div id="alert_status" class="alert alert-danger" style="display: none;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Maaf!</strong>
        <p id="alert_message"></p>
    </div>

    <div class="card">
    <div class="card-header">
            <a class="btn btn-secondary" href="<?= url('admin/daftar_kuis') ?>">Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="detail">Kelompok Kuis:</label>
                        <!-- <input type="text" class="form-control" id="key_ans" name="key_ans" value="<?= $form->key_ans ?>" placeholder="Keterangan"> -->
                        <select class="form-control" id="id_kelompok_kuis" name="id_kelompok_kuis">
                            <option value=""> -- Pilih Kelompok kuis -- </option>

                            <?php foreach ($kelompok_kuis as $kelkuis) { ?>
                                <?php
                                $selected = "";
                                if ($kelkuis->id_kelompok_kuis == $form->id_kelompok_kuis) {
                                    $selected = ' selected="" ';
                                }
                                ?>
                                <option value="<?= $kelkuis->id_kelompok_kuis ?>" <?= $selected ?>><?= $kelkuis->nama_kuis ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_kuis">Pertanyaan:</label>
                        <textarea type="text" class="form-control" id="pertanyaan" name="pertanyaan" placeholder="pertanyaan"><?= $form->pertanyaan ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="nama_kuis">Jawaban a:</label>
                        <textarea type="text" class="form-control" id="ans_a" name="ans_a" placeholder="Jawaban a"><?= $form->ans_a ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ans_b">Jawaban b:</label>
                        <textarea type="text" class="form-control" id="ans_b" name="ans_b" placeholder="Jawaban b"><?= $form->ans_b ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ans_c">Jawaban c:</label>
                        <textarea type="text" class="form-control" id="ans_c" name="ans_c" placeholder="Jawaban c"><?= $form->ans_c ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ans_d">Jawaban d:</label>
                        <textarea type="text" class="form-control" id="ans_d" name="ans_d" placeholder="Jawaban d"><?= $form->ans_d ?></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="detail">Kunci:</label>
                        <!-- <input type="text" class="form-control" id="key_ans" name="key_ans" value="<?= $form->key_ans ?>" placeholder="Keterangan"> -->
                        <select class="form-control" id="key_ans" name="key_ans">
                            <option value=""> -- Pilih Kunci Jawaban -- </option>

                            <?php foreach ($key_ans_opt as $kopt) { ?>
                                <?php
                                $selected = "";
                                if ($kopt == $form->key_ans) {
                                    $selected = ' selected="" ';
                                }
                                ?>
                                <option value="<?= $kopt ?>" <?= $selected ?>><?= $kopt ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
</form>

@include('admin/daftar_kuis_edit_script')