<!-- Begin Page Content -->
<div class="container-fluid" id="isi">
    <?php if ($this->session->userdata('username')) {
    $key = 'Admin';
  } else {
    $key = 'User';
  } ?>
    <?php if ($this->session->flashdata('noticeGagalUbah')) : ?>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Data Sudah Ada!',
    })
    </script>
    <?php endif; ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-0 text-gray-800">Ubah Data Biro Perjalanan Wisata</h3>
    </div>
    <!-- <?php print_r($detailBPPById); ?> -->
    <hr class="divider">

    <a class="btn btn-<?= $customColor; ?> btn-sm"
        href="<?= base_url($key . '/indexDetailBPP' . $key . '/' . $detailBPPById->id); ?>">
        <i class="fa-solid fa-circle-left"></i>
        <span>Kembali</span>
    </a>

    <!-- Content Row -->
    <form class="user mt-3" enctype="multipart/form-data" id="inputFormTambah"
        action="<?= base_url('Admin/ubahDataBPP'); ?>" method="post">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <input type="hidden" name="FUinputId" value="<?= $detailBPPById->id; ?>" method="post">
                <div class="form-group mb-3">
                    <label for="FUinputNamaBPP">Nama Biro Perjalanan Pariwisata</label>
                    <input type="text" class="form-control" name="FUinputNamaBPP" id="FUinputNamaBPP"
                        value="<?= $detailBPPById->nmusaha; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group-prepend">
                        <label for="FUinputKecamatan">Kecamatan</label>
                    </div>
                    <select class="custom-select" name="FUinputKecamatan" id="FUinputKecamatan" required>
                        <?php foreach ($semua["dataKecamatan"] as $rowKec) : ?>
                        <?php if ($rowKec->nama == $detailBPPById->namaKecamatan) : ?>
                        <option value=<?= $detailBPPById->idkecamatan; ?> selected><?= $detailBPPById->namaKecamatan; ?>
                        </option>
                        <?php endif; ?>
                        <?php if ($rowKec->nama != $detailBPPById->namaKecamatan) : ?>
                        <option value=<?= $rowKec->id; ?>><?= $rowKec->nama; ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group-prepend">
                        <label for="FUinputKelurahan">Kelurahan</label>
                    </div>
                    <select class="custom-select" name="FUinputKelurahan" id="FUinputKelurahan" required>
                        <option value="<?= $detailBPPById->idkelurahan; ?>" selected>
                            <?= $detailBPPById->namaKelurahan . ' (selected)'; ?></option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="FUinputLink">Link</label>
                    <input type="text" class="form-control" id="FUinputLink" name="FUinputLink"
                        value="<?= $detailBPPById->link; ?>">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group mb-3">
                    <label for="FUinputAlamat">Alamat</label>
                    <input type="text" class="form-control" id="FUinputAlamat" name="FUinputAlamat"
                        value="<?= $detailBPPById->alamat; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="FUinputNamaPemilik">Nama Pemilik</label>
                    <input type="text" class="form-control" id="FUinputNamaPemilik" name="FUinputNamaPemilik"
                        value="<?= $detailBPPById->nmpemilik; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="FUinputNoTDUP">No TDUP</label>
                    <input type="text" class="form-control" id="FUinputNoTDUP" name="FUinputNoTDUP"
                        value="<?= $detailBPPById->notdup; ?>" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="resetTambah">
            <i class="fa-solid fa-circle-minus"></i>
            <span>Reset</span>
        </button>
        <button type="submit" class="btn btn-<?= $customColor; ?>">
            <i class="fa-solid fa-circle-check"></i>
            <span>Simpan</span>
        </button>
    </form>

    <script>
    $(document).ready(function() {

        //tombolResetFormTambah
        $('#resetTambah').click(function() {
            $('.custom-select').prop('selectedIndex', 0);
            $('#inputFormTambah').find("input[type=text], textarea").each(function() {
                $(this).val('');
                $('#FUinputKelurahan').val('');
            });
        })

        $("#FUinputKecamatan").change(function() {
            $idKecamatan = $(this).val();

            $.ajax({
                url: base_url + 'Admin/jsonGetKelurahanFU',
                method: 'post',
                data: {
                    FUidKecamatan: $idKecamatan
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    $html = "";
                    for ($i = 0; $i < data.length; $i++) {
                        $html += '<option value="' + data[$i].id + '">' + data[$i].nama +
                            '</option>';
                    }
                    $("#FUinputKelurahan").html($html);
                }
            });
        });
    });
    </script>