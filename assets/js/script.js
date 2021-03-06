$(function () {

    // Tombol choose file, ahar bisa mengeluarkan nama file
    $('.custom-file-input').on('change', function () {
        // Ambil nama file
        let fileName = $(this).val().split('\\').pop();

        // Lalu nama filenya isi kedalam file inputnya
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Tombol edit menu
    $('.tombolEditMenu').on('click', function () {
        $('.judulModalMenu').html('Edit New Menu');
        $('.submitMenu').html('Edit Menu');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/menu/menuedit');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/uanq/menu/getmenuedit',
            data: { idJson: id },
            method: 'POST',
            dataType: 'json',
            success: function (data) {

                $('#idMenu').val(data.idMenu);
                $('#menu').val(data.namaMenu);

            }
        });

    });
    // Tombol tambah menu
    $('.tombolTambahMenu').on('click', function () {
        $('.judulModalMenu').html('Add New Menu');
        $('.submitMenu').html('Add Menu');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/menu');

        $('#idMenu').val('');
        $('#menu').val('');

    });


    // Tombol edit sub menu
    $('.tombolEditSubmenu').on('click', function () {
        $('.judulModalSubmenu').html('Edit New Submenu');
        $('.submitSubmenu').html('Edit Submenu');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/menu/submenuedit');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/uanq/menu/getsubmenuedit',
            data: { idJson: id },
            method: 'POST',
            dataType: 'json',
            success: function (data) {

                $('#idSubmenu').val(data.idSubMenu);
                $('#judulSubmenu').val(data.judulSubMenu);
                $('#menu_id').val(data.idMenu);
                $('#urlSubmenu').val(data.urlSubMenu);
                $('#iconSubmenu').val(data.iconSubMenu);
                $('#isActive').val(data.isActiveMenu);
            }
        });

    });
    // Tombol tambah sub menu
    $('.tombolTambahSubmenu').on('click', function () {
        $('.judulModalSubmenu').html('Add New Submenu');
        $('.submitSubmenu').html('Add Submenu');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/menu/submenu');

        $('#idSubmenu').val('');
        $('#judulSubmenu').val('');
        $('#menu_id').val('');
        $('#urlSubmenu').val('');
        $('#iconSubmenu').val('');
    });


    // Tombol checkbox dari roleAccess
    $('.cekbox').on('click', function () {

        // Tangkap idMenu dan idRole yang dikirimkan
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        // Lalu oper lagi ke method changeAccess() dengan type POST
        $.ajax({
            url: 'http://localhost:8080/uanq/admin/changeaccess',
            type: 'POST',
            data: { menuId: menuId, roleId: roleId },
            success: function () {
                document.location.href = 'http://localhost:8080/uanq/admin/roleaccess/' + roleId;
            }

        });
    });


    // Tombol edit sub menu
    $('.tombolEditEarning').on('click', function () {
        $('.judulModalEarning').html('Edit New Earning');
        $('.submitEarning').html('Edit Earning');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/user/earningEdit');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/uanq/user/earningGetAjax',
            data: { idJson: id },
            method: 'POST',
            dataType: 'json',
            success: function (data) {

                $('#idEarning').val(data.idEarning);
                $('#judulTransaksi').val(data.transaksi);
                $('#incomeTransaksi').val(data.income);
                $('#outcomeTransaksi').val(data.outcome);
                $('#dateCreated').val(data.dateCreated);

            }
        });

    });
    // Tombol tambah sub menu
    $('.tombolTambahEarning').on('click', function () {
        $('.judulModalEarning').html('Add New Earning');
        $('.submitEarning').html('Add Earning');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/user/earning');

        $('#judulTransaksi').val('');
        $('#incomeTransaksi').val('');
        $('#outcomeTransaksi').val('');
    });



    // Tombol order untuk inventory
    $('.tombolOrder').on('click', function () {

        const id = $(this).data('idorder');

        $.ajax({
            url: 'http://localhost:8080/uanq/inventory/ajaxGetProduk',
            data: { idJson: id },
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#idProduks').val(data.idProduk);
                $('#produk').val(data.namaProduk);
                $('#stoky').val(data.stokProduk);
                $('#qty').attr('max', data.stokProduk);

                $('#qty').keyup(function () {
                    let qty = parseInt($('#qty').val());

                    if (qty > data.stokProduk) {
                        $('#qty').val(data.stokProduk);
                    } else {
                        qty;
                    }
                })
            }
        });
    });
    // Edit Produk
    $('.tombolEditProduk').on('click', function () {
        $('.judulModalTambahProduk').html('Edit Data Produk');
        $('.submitProduk').html('Edit Produk');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/inventory/editProduk');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/uanq/inventory/ajaxGetProduk',
            data: { idJson: id },
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#email').val(data.email);
                $('#idProduk').val(data.idProduk);
                $('#cabang').val(data.idCabang);
                $('#namaProduk').val(data.namaProduk);
                $('#stokProduk').val(data.stokProduk);
                $('#hargaBeli').val(data.hargaBeli);
                $('#hargaJual').val(data.hargaJual);
                $('#dateCreated').val(data.dateCreated);

            }
        });
    });
    // Tambah Produk
    $('.tombolTambahProduk').on('click', function () {
        $('.judulModalTambahProduk').html('Tambah Data Produk');
        $('.submitProduk').html('Tambah Produk');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/inventory');

        $('#email').val('');
        $('#idProduks').val('');
        $('#cabang').val('0');
        $('#namaProduk').val('');
        $('#stokProduk').val('');
        $('#hargaBeli').val('');
        $('#hargaJual').val('');
        $('#dateCreated').val('');
        $('#dateModified').val('');
    });


    // Tombol Tambah Cabang
    $('.tombolTambahCabang').on('click', function () {
        $('.judulModalTambahCabang').html('Tambah Data Cabang');
        $('.submitCabang').html('Tambah Cabang');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/inventory/cabang');

        $('#namaCabang').val('');
        $('#alamatCabang').val('');
        $('#telpCabang').val('');
    });
    // Tombol Edit Cabang
    $('.tombolEditCabang').on('click', function () {
        $('.judulModalTambahCabang').html('Edit Data Cabang');
        $('.submitCabang').html('Edit Cabang');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/inventory/editCabang');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/uanq/inventory/ajaxGetCabang',
            data: { idJson: id },
            method: 'POST',
            dataType: 'json',
            success: function (data) {

                $('#idCabang').val(data.idCabang);
                $('#namaCabang').val(data.namaCabang);
                $('#alamatCabang').val(data.alamatCabang);
                $('#telpCabang').val(data.telpCabang);
            }
        });
    });


    // Date Picker Start Date
    let $startdate = $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome'
    });
    // Date Picker End Date
    $('#datepicker').on('change', function () {
        $('.end-date').html(`<label for="datepickers">Sampai tanggal</label><input type="text" width="276" autocomplete="off" class="form-control" id="datepickers" name="endDate">`);
        $('#datepickers').datepicker({
            format: 'yyyy-mm-dd',
            minDate: $startdate.value(),
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
    });


    // Orders
    let cekOrder = $('#tombolOrder').data('order');
    if (cekOrder < 1) {

        Swal.fire({
            title: 'Order kamu kosong!',
            html: 'Kamu bisa buat order baru melalui halaman inventory atau klik tombol <span class="text-primary">Tambah Order Baru</span>.',
            width: 800,
            padding: '2em',
            icon: 'info'
        });

        $('#tombolOrder').html('<a href="http://localhost:8080/uanq/inventory" title="Tambah order baru" class="btn btn-primary">Tambah Order Baru</a><a href="http://localhost:8080/uanq/inventory/deals" title="Cek transaksi" class="btn btn-secondary ml-2">Cek Transaksi</a>');
    } else {
        $('#tombolOrder').html('<a href="" class="btn btn-primary tombolProsesOrder" title="Proses seluruh order" data-toggle="modal" data-target="#formModal">Proses Order</a><a href="http://localhost:8080/uanq/inventory/cancelOrder" title="Tombol ini akan menghapus seluruh order" class="btn btn-secondary ml-2 tombolHapus">Batalkan Order</a>');
    }
    // Ketika tombol edit ditekan, ambil data produk menggunakan ajax
    $('.tombolEditOrder').on('click', function () {
        $('.judulModalOrder').html('Edit Data Order');
        $('.editOrder').html('Edit Order');

        $('.formActive').attr('action', 'http://localhost:8080/uanq/inventory/editOrder');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost:8080/uanq/inventory/ajaxGetOrder',
            data: { idJson: id },
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                let qty = parseInt(data.qtyOrder);
                let stok = parseInt(data.stokBarang);
                let stokAsli = qty + stok;

                $('#idOrders').val(data.idOrder);
                $('#namaBarang').val(data.namaBarang);
                $('#hargaJual').val(data.hargaJual);
                $('#qtyOrder').val(data.qtyOrder);
                $('#stokBarang').val(stokAsli);
                $('#stokAsli').val(stokAsli);
                $('#totalHarga').val(data.totalHarga);

            }
        });
    });
    // Ketika nilai qty di form edit di ubah maka otomatis kalkulasi stok dan total harga
    $('#qtyOrder').on('change', function () {

        let qty = parseInt($('#qtyOrder').val());
        let stokAsli = parseInt($('#stokAsli').val());

        if (isNaN(qty)) {
            $('#stokBarang').val(stokAsli);
        } else {
            if (qty > stokAsli) {
                $('#qtyOrder').val(stokAsli)
                qty = stokAsli;
            } else {
                qty;
            }

            let hargaJual = parseInt($('#hargaJual').val());
            let total = qty * hargaJual;
            let stokBarang = stokAsli - qty;

            $('#totalHarga').val(total);
            $('#stokBarang').val(stokBarang);
        }
    });
    $('#uangDiterima').autoNumeric('init', { aPad: false, vMin: '0.00' });
    $('#total-belanja').autoNumeric('init', { aPad: false, vMin: '0.00' });
    $('#kembalian').autoNumeric('init', { aPad: false, vMin: '-999999999999999.99' });

    $('#uangDiterima').keyup(function () {
        let bayar = parseInt($('#uangDiterima').autoNumeric('get'));
        let total = parseInt($('#total-belanja').autoNumeric('get'));
        let kembalian = bayar - total;
        console.log(kembalian);


        $('#kembalian').autoNumeric('set', kembalian);
    });

    // Deals
    let cekTransaksi = $('#tombolDeals').data('deals');
    if (cekTransaksi < 1) {
        Swal.fire({
            title: 'Transaksi kamu kosong!',
            html: 'Kamu bisa buat transaksi baru melalui halaman inventory atau klik tombol <span class="text-primary">Tambah Transaksi Baru</span>.',
            width: 800,
            padding: '2em',
            icon: 'info'
        });
    }

    $('#start-date').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome'
    }).on('change', function () {
        let mindate = $(this).val();

        $('#end-date').attr('readonly', false);
        $('.end-date-picker').html('<label for="end-date">End Date</label> <input type="text" autocomplete="off" class="form-control" name="end-date" id="end-date">')
        $('#end-date').datepicker({
            format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4',
            minDate: mindate,
            iconsLibrary: 'fontawesome'
        });
    });


});