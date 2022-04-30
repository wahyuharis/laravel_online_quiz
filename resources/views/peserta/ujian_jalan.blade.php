<div class="row">
    <div class="col-md-12">
        <form id="form_1" method="post" action="<?= url('peserta/ujian_ans_submit') ?>">

            <?php $no = 1; ?>
            <?php foreach ($soals as $row) { ?>
                <div class="card mb-5 mt-5">
                    <div class="card-body">
                        <?= $no ?>. &nbsp;<?= $row->pertanyaan ?>

                        <div class="row">
                            <div class="col-6">
                                <label>
                                    <input type="radio" name="ans_<?= $no ?>" value="a">
                                    A. <?= $row->ans_a ?>
                                </label><br>
                                <label>
                                    <input type="radio" name="ans_<?= $no ?>" value="b">
                                    B. <?= $row->ans_b ?>
                                </label>

                            </div>

                            <div class="col-6">

                                <label>
                                    <input type="radio" name="ans_<?= $no ?>" value="c">
                                    C. <?= $row->ans_c ?>
                                </label><br>

                                <label>
                                    <input type="radio" name="ans_<?= $no ?>" value="d">
                                    D. <?= $row->ans_d ?>
                                </label>

                            </div>
                        </div>

                    </div>
                </div>
                <?php $no++ ?>
            <?php } ?>

            <button class="btn btn-primary" type="submit">kirim</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <br><br><br>
    </div>
</div>