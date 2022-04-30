<div class="row">
    <div class="col-md-12">

        <?php foreach ($ujian_open as $row) { ?>
            <div class="card">
                <div class="card-header">
                    <h4> <?= $row->nama_kuis ?> </h4>
                </div>
                <div class="card-body">
                    <p> <?= $row->waktu_mulai ?> - <?= $row->waktu_selesai ?> </p>

                    <a class="btn btn-primary btn-sm" href="<?= url('peserta/mulai_ujian/?id_ujian=' . $row->id_kelompok_kuis) ?>">
                        Mulai Ujian
                    </a>

                </div>
            </div>
        <?php } ?>

    </div>
</div>