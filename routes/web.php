<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ImportUserController;
use App\Http\Controllers\Backend\ExportUserController;
use App\Http\Controllers\Backend\SekolahController;
use App\Http\Controllers\Backend\JurusanController;
use App\Http\Controllers\Backend\KelasController;
use App\Http\Controllers\Backend\RombelController;
use App\Http\Controllers\Backend\GroupController;
use App\Http\Controllers\Backend\WaktuController;
use App\Http\Controllers\Backend\MapelController;
use App\Http\Controllers\Backend\BengkelController;
use App\Http\Controllers\Backend\TahunPelajaranController;
use App\Http\Controllers\Backend\SemesterController;
use App\Http\Controllers\Backend\JadwalPelajaranController;
use App\Http\Controllers\Backend\JurnalController;
use App\Http\Controllers\Backend\HariController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\ImportsGuruController;
use App\Http\Controllers\Backend\ProkaController;
use App\Http\Controllers\Backend\KehadiranController;
use App\Http\Controllers\Backend\RoleController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ScanAbsensiController;

use App\Http\Controllers\Backend\CouponController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'jenis_user:siswa', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/siswa/profile',[UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/siswa/profile/update',[UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::post('/siswa/password/update',[UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::get('/siswa/logout',[UserController::class, 'UserLogout'])->name('user.logout');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(WishListController::class)->group(function(){
        Route::get('/siswa/wishlist','AllWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-course','GetWishlistCourse');
        Route::get('/wishlist-remove/{id}','RemoveWishlist');
    });



});

require __DIR__.'/auth.php';



// Awal Admin Group Middleware
Route::middleware(['auth','jenis_user:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'adminPassword'])->name('admin.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');


    /*Staff Pimpinan Active */
    Route::controller(AdminController::class)->group(function(){
        Route::get('/staff/all', 'AllInstructor')->name('all.instructor');
        Route::post('/update/user/status', 'UpdateUserStatus')->name('update.user.status');
        Route::get('/instructor/add', 'AddInstructor')->name('add.instructor');
    });

    //Route Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category/all', 'AllCategory')->name('all.category');
        Route::get('/category/add', 'AddCategory')->name('add.category');
        Route::post('/category/store', 'StoreCategory')->name('store.category');
        Route::get('/category/edit/{id}', 'EditCategory')->name('edit.category');
        Route::post('/category/update', 'UpdateCategory')->name('update.category');
        Route::get('/category/delete/{id}', 'DeleteCategory')->name('delete.category');
    });

    // Sub Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/subcategory/all', 'AllSubCategory')->name('all.subcategory');
        Route::get('/subcategory/add', 'AddSubCategory')->name('add.subcategory');
        Route::post('/subcategory/store', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/subcategory/edit/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/subcategory/update', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/subcategory/delete/{id}', 'DeleteSubCategory')->name('delete.subcategory');

    });

    // Sekolah
    Route::controller(SekolahController::class)->group(function(){
        Route::get('/sekolah/all', 'ProfileSekolah')->name('profile.sekolah');
        Route::get('/sekolah/edit/{id}', 'EditProfileSekolah')->name('edit.profile.sekolah');
        Route::post('/sekolah/update', 'UpdateProfileSekolah')->name('update.profile.sekolah');
    });

    // Jurusan
    Route::controller(JurusanController::class)->group(function(){
        Route::get('/jurusan/all', 'SemuaJurusan')->name('semua.jurusan');
        Route::get('/jurusan/tambah', 'TambahJurusan')->name('tambah.jurusan');
        Route::get('/jurusan/edit/{id}', 'EditJurusan')->name('edit.jurusan');
        Route::post('/jurusan/simpan', 'SimpanJurusan')->name('simpan.jurusan');
        Route::post('/jurusan/update', 'UpdateJurusan')->name('update.jurusan');
    });

    // Kelas
    Route::controller(KelasController::class)->group(function(){
        Route::get('/kelas/all', 'SemuaKelas')->name('semua.kelas');
        Route::get('/kelas/tambah', 'TambahKelas')->name('tambah.kelas');
        Route::get('/kelas/edit/{id}', 'EditKelas')->name('edit.kelas');
        Route::post('/kelas/simpan', 'SimpanKelas')->name('simpan.kelas');
        Route::post('/kelas/update', 'UpdateKelas')->name('update.kelas');
    });

    // Rombel
    Route::controller(RombelController::class)->group(function(){
        Route::get('/rombel/all', 'SemuaRombel')->name('semua.rombel');
        Route::get('/rombel/tambah', 'TambahRombel')->name('tambah.rombel');
        Route::get('/rombel/edit/{id}', 'EditRombel')->name('edit.rombel');
        Route::get('/rombel/{id}', 'DetailRombel')->name('detail.rombel');
        Route::post('/rombel/simpan', 'SimpanRombel')->name('simpan.rombel');
        Route::post('/rombel/update', 'UpdateRombel')->name('update.rombel');
        Route::get('/jurusan/ajax/{proka_id}/','GetJurusan');
        Route::get('/rombel/ajax/{jurusan_id}/','GetRombel');
        Route::post('get-users-siswa', 'getUserSiswa')->name('get.user.siswa');

        Route::get('/anggota-rombel/tambah', 'TambahAnggotaRombel')->name('tambah.anggota.rombel');
        Route::post('/anggota-rombel/simpan', 'SimpanAnggotaRombel')->name('simpan.anggota.rombel');
        Route::get('/anggota-rombel/all', 'AllAnggotaRombel')->name('all.anggota.rombel');
        Route::get('/anggota-rombel/delete/{id}', 'HapusAnggotaRombel')->name('hapus.anggota.rombel');
    });

    // Group
    Route::controller(GroupController::class)->group(function(){
        Route::get('/group/all', 'SemuaGroup')->name('semua.group');
        Route::get('/group/tambah', 'TambahGroup')->name('tambah.group');
        Route::get('/group/edit/{id}', 'EditGroupl')->name('edit.group');
        Route::post('/group/simpan', 'SimpanGroup')->name('simpan.group');
        Route::post('/group/update', 'UpdateGroup')->name('update.group');
    });

    // Waktu
    Route::controller(WaktuController::class)->group(function(){
        Route::get('/waktu/all', 'SemuaWaktu')->name('semua.waktu');
        Route::get('/waktu/tambah', 'TambahWaktu')->name('tambah.waktu');
        Route::get('/waktu/edit/{id}', 'EditWaktu')->name('edit.waktu');
        Route::post('/waktu/simpan', 'SimpanWaktu')->name('simpan.waktu');
        Route::post('/waktu/update', 'UpdateWaktu')->name('update.waktu');
        Route::get('/waktu/delete/{id}', 'DeleteWaktu')->name('delete.waktu');
    });

    // Mapel
    Route::controller(MapelController::class)->group(function(){
        Route::get('/mapel/all', 'SemuaMapel')->name('semua.mapel');
        Route::get('/mapel/tambah', 'TambahMapel')->name('tambah.mapel');
        Route::get('/mapel/edit/{id}', 'EditMapel')->name('edit.mapel');
        Route::post('/mapel/simpan', 'SimpanMapel')->name('simpan.mapel');
        Route::post('/mapel/update', 'UpdateMapel')->name('update.mapel');
        Route::get('download-template-mapel', 'DownloadTemplateMapel')->name('download.template.mapel');
        Route::post('import/mapel', 'ImportMapel')->name('import.mapel');
        Route::get('/mapel/delete/{id}', 'HapusMapel')->name('hapus.mapel');
        Route::get('/mapel/cetak', 'CetakMapel')->name('cetak.mapel');
    });

    // Bengkel
    Route::controller(BengkelController::class)->group(function(){
        Route::get('/bengkel/all', 'SemuaBengkel')->name('semua.bengkel');
        Route::get('/bengkel/tambah', 'TambahBengkel')->name('tambah.bengkel');
        Route::get('/bengkel/edit/{id}', 'EditBengkel')->name('edit.bengkel');
        Route::post('/bengkel/simpan', 'SimpanBengkel')->name('simpan.bengkel');
        Route::post('/bengkel/update', 'UpdateBengkel')->name('update.bengkel');
        Route::get('download-template-bengkel', 'DownloadTemplateBengkel')->name('download.template.bengkel');
        Route::post('import/bengkel', 'ImportBengkel')->name('import.bengkel');
        Route::get('/bengkel/delete/{id}', 'HapusBengkel')->name('hapus.bengkel');
        Route::get('/bengkel/cetak', 'CetakBengkel')->name('cetak.bengkel');
        Route::get('/bengkel-cetak/{id}', 'CetakPerBengkel')->name('cetak.per.bengkel');

    });

    // Tahun Pelajaran
    Route::controller(TahunPelajaranController::class)->group(function(){
        Route::get('/tahun-pelajaran/all', 'SemuaTahunPelajaran')->name('semua.tahun.pelajaran');
        Route::get('/tahun-pelajaran/tambah', 'TambahTahunPelajaran')->name('tambah.tahun.pelajaran');
        Route::get('/tahun-pelajaran/edit/{id}', 'EditTahunPelajaran')->name('edit.tahun.pelajaran');
        Route::post('/tahun-pelajaran/simpan', 'SimpanTahunPelajaran')->name('simpan.tahun.pelajaran');
        Route::post('/tahun-pelajaran/update', 'UpdateTahunPelajaran')->name('update.tahun.pelajaran');
        Route::get('/tahun-pelajaran/delete/{id}', 'DeleteTahunPelajaran')->name('delete.tahun.pelajaran');
    });

    // Semester
    Route::controller(SemesterController::class)->group(function(){
        Route::get('/semester/all', 'SemuaSemester')->name('semua.semester');
        Route::get('/semester/tambah', 'TambahSemester')->name('tambah.semester');
        Route::get('/semester/edit/{id}', 'EditSemester')->name('edit.semester');
        Route::post('/semester/simpan', 'SimpanSemester')->name('simpan.semester');
        Route::post('/semester-simpan-ajax', 'SimpanSemesterAjax')->name('simpan.semester.ajax');
        Route::post('/semester/update', 'UpdateSemester')->name('update.semester');
        Route::post('/update/semester/status', 'UpdateSemesterStatus')->name('update.semester.status');
        Route::get('/semester/delete/{id}', 'DeleteSemester')->name('delete.semester');
    });

    // Jadwal
    Route::controller(JadwalPelajaranController::class)->group(function(){
        Route::get('/jadwal/all', 'SemuaJadwal')->name('semua.jadwal');
        Route::get('/jadwal/tambah', 'TambahJadwal')->name('tambah.jadwal');
        Route::get('/jadwal/edit/{id}', 'EditJadwal')->name('edit.jadwal');
        Route::post('/jadwal/simpan', 'SimpanJadwal')->name('simpan.jadwal');
        Route::post('/jadwal/update', 'UpdateJadwal')->name('update.jadwal');
        Route::post('/update/jadwal/status', 'UpdateJadwalStatus')->name('update.jadwal.status');
        Route::get('/jadwal/delete/{id}', 'DeleteJadwal')->name('delete.jadwal');
    });

    // Hari
    Route::controller(HariController::class)->group(function(){
        Route::get('/hari/all', 'SemuaHari')->name('semua.hari');
        Route::get('/hari/tambah', 'TambahHari')->name('tambah.hari');
        Route::get('/hari/edit/{id}', 'EditHari')->name('edit.hari');
        Route::post('/hari/simpan', 'SimpanHari')->name('simpan.hari');
        Route::post('/hari/update', 'UpdateHari')->name('update.hari');
        Route::post('/update/hari/status', 'UpdateHariStatus')->name('update.hari.status');
        Route::get('/hari/delete/{id}', 'DeleteHari')->name('delete.hari');
    });

    // Proka
    Route::controller(ProkaController::class)->group(function(){
        Route::get('/proka/all', 'SemuaProka')->name('semua.proka');
        Route::get('/proka/tambah', 'TambahProka')->name('tambah.proka');
        Route::get('/proka/edit/{id}', 'EditProka')->name('edit.proka');
        Route::post('/proka/simpan', 'SimpanProka')->name('simpan.proka');
        Route::post('/proka/update', 'UpdateProka')->name('update.proka');
        Route::post('/update/proka/status', 'UpdateProkaStatus')->name('update.proka.status');
        Route::get('/proka/delete/{id}', 'DeleteProka')->name('proka.hari');
    });

    // Hari
    Route::controller(ImportsGuruController::class)->group(function(){
        Route::get('/guru/all', 'LihatGuru')->name('lihat.guru');
        
    });

     // Kehadiran
     Route::controller(KehadiranController::class)->group(function(){
        Route::get('/kehadiran/all', 'LihatKehadiran')->name('lihat.kehadiran');
        Route::get('/kehadiran/tambah', 'TambahKehadiran')->name('tambah.kehadiran');
        Route::post('/kehadiran/simpan', 'SimpanKehadiran')->name('simpan.kehadiran');
        Route::get('/kehadiran/edit/{id}', 'EditKehadiran')->name('edit.kehadiran');
        Route::post('/kehadiran/update', 'UpdateKehadiran')->name('update.kehadiran');
        Route::get('/kehadiran/hapus/{id}', 'hapusKehadiran')->name('hapus.kehadiran');
        Route::post('/update/kehadiran/status', 'UpdateKehadiranStatus')->name('update.kehadiran.status');
    });

    // Role Controller
    Route::controller(RoleController::class)->group(function(){
        Route::get('all/permission', 'allPermission')->name('all.permission');
        Route::get('add/permission', 'addPermission')->name('add.permission');
        Route::post('store/permission', 'storePermission')->name('store.permission');
        Route::get('edit/permission/{id}', 'editPermission')->name('edit.permission');
        Route::get('delete/permission/{id}', 'deletePermission')->name('delete.permission');
        Route::post('update/permission', 'updatePermission')->name('update.permission');
        Route::get('all/roles', 'allRoles')->name('all.roles');
        Route::get('add/roles', 'addroles')->name('add.roles');
        Route::post('store/roles', 'storeroles')->name('store.roles');
        Route::get('edit/roles/{id}', 'editroles')->name('edit.roles');
        Route::get('delete/roles/{id}', 'deleteroles')->name('delete.roles');
        Route::post('update/roles', 'updateroles')->name('update.roles');
        Route::get('add/role/permission', 'addRolesPermission')->name('add.roles.permission');
        Route::post('store/role/permissions', 'storeRolePermissios')->name('store.role.permissions');
    });



    // Admin Coruses All Route
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/all/course','AdminAllCourse')->name('admin.all.course');
    Route::post('/update/course/stauts','UpdateCourseStatus')->name('update.course.stauts');
    Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');

});

    // Admin Coupon All Route
    Route::controller(CouponController::class)->group(function(){
        Route::get('/admin/all/coupon','AdminAllCoupon')->name('admin.all.coupon');
        Route::get('/admin/add/coupon','AdminAddCoupon')->name('admin.add.coupon');
        Route::post('/admin/store/coupon','AdminStoreCoupon')->name('admin.store.coupon');
        Route::get('/admin/edit/coupon/{id}','AdminEditCoupon')->name('admin.edit.coupon');
        Route::post('/admin/update/coupon','AdminUpdateCoupon')->name('admin.update.coupon');
        Route::get('/admin/delete/coupon/{id}','AdminDeleteCoupon')->name('admin.delete.coupon');

    });
    //User
    Route::get('users', [ImportUserController::class, 'index'])->name('lihat.user');
    Route::get('users-yajra', [ImportUserController::class, 'lihatUserYajra'])->name('lihat.user.yajra');
    Route::get('users-multi-select', [ImportUserController::class, 'userMultiSelectSelect'])->name('lihat.user.multi.select');
    Route::post('store-multi-select', [ImportUserController::class, 'storeuserMultiSelectSelect'])->name('store.user.multi.select');
    Route::get('import/users', [ImportUserController::class, 'ImportUser'])->name('import.user');
    Route::get('download-template-user', [ImportUserController::class, 'DownloadTemplateUser'])->name('download.template.user');
    Route::get('users-export', [ExportUserController::class, 'export'])->name('users.export');
    Route::post('users-import', [ImportUserController::class, 'import'])->name('users.import');
    Route::get('/user-cetak/{id}',[ImportUserController::class, 'CetakPerUser'])->name('cetak.per.user');
    Route::get('/user-all-cetak',[ImportUserController::class, 'CetakSemuaUser'])->name('cetak.semua.user');
    Route::get('/user-guru-cetak',[ImportUserController::class, 'CetakGuruUser'])->name('cetak.guru.user');
    Route::get('/user-wakil-cetak',[ImportUserController::class, 'CetakWakilUser'])->name('cetak.wakil.user');
    Route::post('get-users', [ImportUserController::class, 'getUser'])->name('get.user');
    Route::post('/update-user/status',[ImportUserController::class, 'UpdateStatusUser'])->name('update.status.user');
}); ///Akhir Admin Group Middleware

//tes



// Awal Staff Group Middleware
Route::middleware(['auth','jenis_user:wakil'])->group(function(){
    Route::get('/staff/dashboard', [StaffController::class, 'StaffDashboard'])->name('staff.dashboard');
    Route::get('/staff/logout', [StaffController::class, 'StaffLogout'])->name('staff.logout');
    Route::get('/staff/profile', [StaffController::class, 'StaffProfile'])->name('staff.profile');
    Route::post('/staff/profile/store', [StaffController::class, 'StaffProfileStore'])->name('staff.profile.store');

    Route::get('/staff/change/password', [StaffController::class, 'StaffPassword'])->name('staff.password');
    Route::post('/staff/update/password', [StaffController::class, 'StaffUpdatePassword'])->name('staff.update.password');

    // Course Group Middleware
    Route::controller(CourseController::class)->group(function(){
        Route::get('/course/all', 'AllCourse')->name('all.course');
        Route::get('/course/add', 'AddCourse')->name('add.course');

        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
        Route::post('/save-lecture','SaveLecture')->name('save-lecture');
        Route::post('/course/store', 'StoreCourse')->name('store.course');
        Route::get('/course/edit/{id}', 'EditCourse')->name('edit.course');
        Route::post('/course/update', 'UpdateCourse')->name('update.course');
        Route::get('/course/delete/{id}', 'DeleteCourse')->name('delete.course');
        Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal','UpdateCourseGoal')->name('update.course.goal');

    });

    // Course Section and Lecture All Route
    Route::controller(CourseController::class)->group(function(){
        Route::get('/course/lecture/add/{id}','AddCourseLecture')->name('add.course.lecture');
        Route::post('/course/section/add','AddCourseSection')->name('add.course.section');

        Route::get('/edit/lecture/{id}','EditLecture')->name('edit.lecture');
        Route::post('/update/course/lecture','UpdateCourseLecture')->name('update.course.lecture');
        Route::get('/delete/lecture/{id}','DeleteLecture')->name('delete.lecture');
        Route::post('/delete/section/{id}','DeleteSection')->name('delete.section');
    });


}); ///Akhir Staff Group Middleware

// Awal Guru Group Middleware
Route::middleware(['auth','jenis_user:guru'])->group(function(){
    Route::get('/guru/dashboard', [GuruController::class, 'GuruDashboard'])->name('guru.dashboard');
    Route::get('/guru/logout', [GuruController::class, 'GuruLogout'])->name('guru.logout');

    Route::get('/guru/profile', [GuruController::class, 'GuruProfile'])->name('guru.profile');
    Route::post('/guru/profile/store', [GuruController::class, 'GuruProfileStore'])->name('guru.profile.store');

    Route::get('/guru/change/password', [GuruController::class, 'GuruPassword'])->name('guru.password');
    Route::post('/guru/update/password', [GuruController::class, 'GuruUpdatePassword'])->name('guru.update.password');

    // Jadwal
    Route::controller(JadwalPelajaranController::class)->group(function(){
        Route::get('/guru/jadwal/all', 'SemuaJadwalGuru')->name('lihat.jadwal.guru');
        Route::get('/guru/jadwal/tambah', 'TambahJadwalGuru')->name('tambah.jadwal.guru');
        Route::get('/guru/jadwal/edit/{id}', 'EditJadwalGuru')->name('edit.jadwal.guru');
        Route::post('/guru/jadwal/simpan', 'SimpanJadwalGuru')->name('simpan.jadwal.guru');
        Route::post('/guru/jadwal/update', 'UpdateJadwalGuru')->name('update.jadwal.guru');
        Route::post('/guru/update/jadwal/status', 'UpdateJadwalGuruStatus')->name('update.jadwal.guru.status');
        Route::get('/guru/jadwal/delete/{id}', 'DeleteJadwal')->name('delete.jadwal.guru');
    });

   

    // Jurnal
    Route::controller(JurnalController::class)->group(function(){
        Route::get('/guru/jurnal/all', 'SemuaJurnalGuru')->name('lihat.jurnal.guru');
        Route::get('/guru/jurnal/tambah', 'TambahJurnalGuru')->name('tambah.jurnal.guru');
        Route::get('/guru/jurnal/edit/{id}', 'EditJurnalGuru')->name('edit.jurnal.guru');
        Route::post('/guru/jurnal/simpan', 'SimpanJurnalGuru')->name('simpan.jurnal.guru');
        Route::post('/guru/jurnal/update', 'UpdateJurnalGuru')->name('update.jurnal.guru');
        Route::post('/guru/update/jurnal/status', 'UpdateJurnalGuruStatus')->name('update.jurnal.guru.status');
        Route::get('/guru/jurnal/delete/{id}', 'DeleteJurnal')->name('delete.jurnal.guru');
        Route::get('/reg/getstudents', 'GetAnggotaRombel')->name('get.anggota.rombel');
    });
}); ///Akhir guru Group Middleware


// User Group Middleware
Route::middleware(['auth','jenis_user:user'])->group(function(){
        // User Wishlist All Route

});

// Route Accessable for ALl
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/staff/login', [StaffController::class, 'StaffLogin'])->name('staff.login');
Route::get('/guru/login', [GuruController::class, 'GuruLogin'])->name('guru.login');
Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::post('/become/instructor/register', [AdminController::class, 'BecomeInstructorRegister'])->name('become.instructor.register');

//scan absensi
Route::get('/absensi', [ScanAbsensiController::class, 'Absensi'])->name('absensi');
Route::get('/scan-absensi', [ScanAbsensiController::class, 'scanAbsensi'])->name('scan.absensi');
Route::get('/scan-absensi-html', [ScanAbsensiController::class, 'scanAbsensi1'])->name('scan.absensi.html');
// Akhsir Scan Absensi
Route::get('/course/details/{id}/{slug}', [IndexController::class, 'CourseDetails'])->name('course.details');
Route::get('/category/{id}/{slug}', [IndexController::class, 'CategoryCourse'])->name('category.course');
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'SubCategoryCourse']);
Route::get('/instructor/details/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');

Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'AddToWishList']);

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::post('/buy/data/store/{id}', [CartController::class, 'AddToCart']);

Route::get('/cart/data/', [CartController::class, 'CartData']);


// Get Data from Minicart
Route::get('/course/mini/cart/', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/course/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);




Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::post('/inscoupon-apply', [CartController::class, 'InsCouponApply']);


Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Cart All Route
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-course','GetCartCourse');
    Route::get('/cart-remove/{rowId}','CartRemove');

});

/// Checkout Page Route
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::post('/payment', [CartController::class, 'Payment'])->name('payment');
Route::post('/stripe_order', [CartController::class, 'StripeOrder'])->name('stripe_order');



// Route End Accessable for ALl





