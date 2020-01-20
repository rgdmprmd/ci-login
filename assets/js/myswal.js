const wrongEmail = $('.wrong-email').data('wemail');
const activeEmail = $('.active-email').data('aemail');
const wrongPassword = $('.wrong-password').data('wpass');
const registrationSuccess = $('.registration-success').data('regsucs');
const wrongToken = $('.wrong-token').data('wtoken');
const expiredToken = $('.expired-token').data('etoken');
const successToken = $('.success-token').data('stoken');

const successforgot = $('.success-forgot').data('sforgot');
const wrongforgot = $('.wrong-forgot').data('wforgot');
const exToken = $('.ex-token').data('extoken');
const successReset = $('.success-reset').data('sreset');

const logout = $('.logout').data('logout');

const successEarning = $('.success-earning').data('searning');
const deleteEarning = $('.delete-earning').data('delearning');
const editEarning = $('.edit-earning').data('edearning');
const editEarningx = $('.edit-earningx').data('edearningx');

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

// Jika ada data yang dikirimkan oleh salah email
if (wrongEmail) {
    Swal.fire({
        icon: 'warning',
        width: 800,
        padding: '2em',
        title: 'Oops, wrong email!',
        html: "<span class='text-primary'>" + wrongEmail + "</span> isn't registered, please do some registration if you mind too."
    })
}

// Jika ada data yang dikirimkan oleh email unactive
if (activeEmail) {
    Swal.fire({
        icon: 'warning',
        width: 800,
        padding: '2em',
        title: 'Oops, email is not active!',
        html: "<span class='text-primary'>" + activeEmail + "</span> isn't activated, please check your email to activate."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (wrongPassword) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: 'Oops, wrong password!',
        html: "Do you forgot your password, dude?"
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (registrationSuccess) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Registration Success!',
        html: "Please check your email to activate your account."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (wrongToken) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: wrongToken + " Failed!",
        html: "Your token is not valid for some reason."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (expiredToken) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: 'Activation Failed!',
        html: "Your token is expired, please register again and make sure activate it before 24 hours."
    })
}

// Jika ada data yang dikirimkan oleh salah password
if (successToken) {
    Swal.fire({
        icon: 'success',
        width: 600,
        padding: '2em',
        title: 'Activation Success!',
        html: "<span class='text-primary'>" + successToken + "</span> activation success, please login."
    })
}

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
if (editEarningx) {
    Swal.fire({
        icon: 'warning',
        width: 600,
        padding: '2em',
        title: 'Edit earning failed!',
        html: "Edit earning kamu gagal, pastikan isi datanya dengan benar."
    })
}