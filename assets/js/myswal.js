// Login swals
const wrongEmail = $('.wrong-email').data('wemail');
if (wrongEmail) {
    Swal.fire({
        icon: 'warning',
        width: 800,
        padding: '2em',
        title: 'Oops, email salah!',
        html: "<span class='text-primary'>" + wrongEmail + "</span> tidak terdaftar. Kamu harus registrasi dulu."
    })
}
const activeEmail = $('.active-email').data('aemail');
if (activeEmail) {
    Swal.fire({
        icon: 'warning',
        width: 800,
        padding: '2em',
        title: 'Oops, email kamu belum aktif!',
        html: "<span class='text-primary'>" + activeEmail + "</span> belum diaktivasi. Silahkan cek email kamu untuk melakukan aktivasi"
    })
}
const wrongPassword = $('.wrong-password').data('wpass');
if (wrongPassword) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: 'Oops, password salah!',
        html: "Kamu lupa password? mending kamu pakai fitur lupa passwordnya."
    })
}

// Register swals
const registrationSuccess = $('.registration-success').data('regsucs');
if (registrationSuccess) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Registrasi Berhasil!',
        html: "Silahkan cek email kamu untuk melakukan aktivasi. Email aktivasi akan expired dalam 24 jam."
    })
}
const wrongToken = $('.wrong-token').data('wtoken');
if (wrongToken) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: wrongToken + " Failed!",
        html: "Your token is not valid for some reason."
    })
}
const expiredToken = $('.expired-token').data('etoken');
if (expiredToken) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: 'Activation Failed!',
        html: "Your token is expired, please register again and make sure activate it before 24 hours."
    })
}
const successToken = $('.success-token').data('stoken');
if (successToken) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Activation Success!',
        html: "<span class='text-primary'>" + successToken + "</span> activation success, please login."
    })
}

const successforgot = $('.success-forgot').data('sforgot');
const wrongforgot = $('.wrong-forgot').data('wforgot');
const exToken = $('.ex-token').data('extoken');
const successReset = $('.success-reset').data('sreset');

const logout = $('.logout').data('logout');

const successEarning = $('.success-earning').data('searning');
const deleteEarning = $('.delete-earning').data('delearning');
const editEarning = $('.edit-earning').data('edearning');
const editEarningx = $('.edit-earningx').data('edearningx');

const produkAdded = $('.success-add').data('produkadd');
const produkUpdate = $('.success-update').data('produkupd');
const produkDelete = $('.success-delete').data('produkdel');

const cabangAdd = $('.success-addCabang').data('cabangadd');
const cabangEdit = $('.success-editCabang').data('cabangedit');
const cabangDelete = $('.success-deleteCabang').data('cabangdelete');

const orderAdd = $('.success-addOrder').data('addorder');
const orderFail = $('.fail-addorder').data('failorder');
const cancelOrder = $('.cancel-order').data('cancelorder');

$('.tombolHapus').on('click', function (e) {
    e.preventDefault();

    const href = $(this).attr('href');

    // Sweet alert, untuk confirm yakin ingin dihapus
    Swal.fire({
        title: 'Sure want to delete?',
        text: "You cant recover data what have been deleted.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete Data!'
    }).then((result) => {
        // Jika tombol ya ditekan, maka redirect bedasarkan href tombol yang diklik
        if (result.value) {
            document.location.href = href;
        }
    })
});


// Jika ada data yang dikirimkan oleh salah password
if (successforgot) {
    Swal.fire({
        icon: 'info',
        width: 800,
        padding: '2em',
        title: 'Forgot password success, but..!',
        html: "But itsn't finish yet, you must check your email to reset your password."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (wrongforgot) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: 'Oops, wrong email!',
        html: "<span class='text-primary'>" + wrongforgot + "</span> is not registered or activated."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (exToken) {
    Swal.fire({
        icon: 'warning',
        width: 800,
        padding: '2em',
        title: 'Reset Password Failed!',
        html: "Your token is expired, please forgot password again and make sure use it before 24 hours."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (successReset) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Reset Password Success!',
        html: "Please remember and keep your password carefully, and do not tell your password to anyone."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (logout) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Logout Success!',
        html: "Goodbye, please come back soon! we miss you already."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (successEarning) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Add new earning!',
        html: "Data transaksi kamu akan diakumulasikan setiap harinya."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (deleteEarning) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Delete earning!',
        html: "Earning otomatis di akumulasikan dengan data yang kamu hapus"
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (editEarning) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Edit earning success!',
        html: "Edit earning kamu berhasil"
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (produkDelete) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Delete Produk Berhasil!',
        html: 'Kamu berhasil menghapus produk. Produk yang sudah dihapus tidak dapat dikembalikan.'
    });
}

// Jika ada data yang dikirimkan oleh salah password
if (produkAdded) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Tambah Produk Berhasil!',
        html: 'Kamu berhasil menambahkan sebuah produk.'
    });
}

// Jika ada data yang dikirimkan oleh salah password
if (produkUpdate) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Edit Produk Berhasil!',
        html: 'Kamu berhasil mengedit produk <span class="text-primary">' + produkUpdate + '</span>'
    });
}

// Jika ada data yang dikirimkan oleh salah password
if (cabangAdd) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Tambah Cabang Baru Berhasil!',
        html: 'Kamu berhasil menambah <span class="text-primary">' + cabangAdd + '</span>'
    });
}

// Jika ada data yang dikirimkan oleh salah password
if (cabangEdit) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Edit Cabang Berhasil!',
        html: 'Kamu berhasil merubah data <span class="text-primary">' + cabangEdit + '</span>'
    });
}

// Jika ada data yang dikirimkan oleh salah password
if (cabangDelete) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Hapus Cabang Berhasil!',
        html: 'Kamu berhasil menghapus cabang. Cabang yang sudah kamu hapus tidak dapat dikembalikan.'
    });
}

// sweet alert untuk order
if (orderAdd) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Order Berhasil',
        html: 'Barang <i class="text-primary">' + orderAdd + '</i> berhasil di order, silahkan cek halaman order.'
    }).then((result) => {
        Swal.fire({
            title: 'Mau tambah order lagi?',
            text: "Jika tidak, kamu akan diarahkan ke halaman order.",
            width: '600px',
            padding: '2em',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, mau',
            cancelButtonText: 'Tidak, terima kasih'
        }).then((result) => {
            if (result.value) {

            } else {
                document.location.href = 'http://localhost:8080/uanq/inventory';
            }
        })
    })

}

if (orderFail) {
    // Sweet alert, untuk confirm yakin ingin dihapus
    Swal.fire({
        title: 'Oops, kamu sudah order barang ini!',
        html: "Barang <span class='text-primary'>" + orderFail + "</span> sudah pernah kamu order, mau cek?",
        width: 650,
        padding: '2em',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, cek order!',
        cancelButtonText: 'Tidak, terima kasih'
    }).then((result) => {
        // Jika tombol ya ditekan, maka redirect bedasarkan href tombol yang diklik
        if (result.value) {
            document.location.href = 'http://localhost:8080/uanq/inventory/orders';
        }
    });
}

if (cancelOrder) {
    Swal.fire({
        icon: 'success',
        width: 800,
        padding: '2em',
        title: 'Order Berhasil Dibatalkan',
        html: 'Kamu berhasil membatalkan order. Order yang sudah kamu batalkan tidak dapat dikembalikan.'
    });
}