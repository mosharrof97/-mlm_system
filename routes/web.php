<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\userController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\dashboard\UserTransactionController;
use App\Http\Controllers\dashboard\AdminE_walletController;
use App\Http\Controllers\dashboard\AdminTransferController;
use App\Http\Controllers\dashboard\AdminProfileController;
use App\Http\Controllers\dashboard\AdminBlogController;
use App\Http\Controllers\dashboard\AdminNetworkController;
use App\Http\Controllers\dashboard\AdminNoticeController;
use App\Http\Controllers\dashboard\AdminWithdrawController;

use App\Http\Controllers\userdashboardController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\E_WalletController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\WithdrawController;

use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//==================== Admin DashBoard =================// 
Route::get('/welcome', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth', 'checkRole:1'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

    // ********  Role Route start*********//
    Route::get('add_role', [roleController::class, 'create'])->name('add_role');
    Route::post('add_role', [roleController::class, 'newroll']);
    // ********  Role Route end *********//

    //********** */ Admin TransactionController ************//
    Route::get('/deposit-wallet',[UserTransactionController::class, 'deposit_wallet']);
    Route::get('/deposit_approved/{id}',[UserTransactionController::class, 'edit']);
    Route::put('/deposit_approved/{id}',[UserTransactionController::class, 'update'])->name('deposit_approved');
    Route::get('/e-wallet', [AdminE_walletController::class, 'E_Wallet'])->name('admin_e_wallet');
    Route::get('/fund-transfer', [ AdminTransferController::class, 'fundTransfer'])->name('admin_view_transfer');

    // -----------Profile Start------------//
    Route::get('/my-profile',  [AdminProfileController::class, 'myProfile'])->name('admin_profile');
    Route::get('/manage-profile',  [AdminProfileController::class, 'edit'])->name('admin_profile.edit');
    Route::patch('/manage-profile', [AdminProfileController::class, 'update'])->name('admin_profile.update');
    Route::delete('/manage-profile', [AdminProfileController::class, 'destroy'])->name('admin_profile.destroy');
    Route::get('/referrals-list',[AdminProfileController::class, 'Referral']);
    Route::get('/notice', [ AdminProfileController::class,'profileAllNotice']);
    Route::get('/single_notice/{id}', [ AdminProfileController::class,'SingleNotice']);

    //Blog
    Route::get('/blogs', [ AdminBlogController::class,'allBlog']);
    // Route::get('/add-blogs', [ BlogController::class,'addbloge']);
    Route::post('/add-blogs', [ AdminBlogController::class,'store']);
    Route::delete('/delete-blogs/{id}', [ AdminBlogController::class,'delete'])->name('admin_delete_blog');


    // Network
    Route::get('/network', [ AdminNetworkController ::class,'Network'])->name('admin-network');

    //Notice 
    Route::get('/all-notice', [AdminNoticeController::class, 'AllNotice'])->name('admin-allNotice');
    Route::get('/add-notice', [AdminNoticeController::class, 'AddNotice'])->name('admin-addNotice');
    Route::post('/add-noticepost', [AdminNoticeController::class, 'store'])->name('admin-storeNotice');
    Route::get('/single-notice/{id}', [ AdminNoticeController::class,'SingleNotice'])->name('admin-singleNotice');
    
    //Notice End

    //Withdraw
    Route::get('/withdraw', [AdminWithdrawController::class, 'Withdraw'])->name('admin-withdraw');
    // Route::post('/withdraw_amount', [AdminWithdrawController::class, 'Withdraw_amount'])->name('withdraw_amount');
    Route::get('/approve-withdraw/{id}', [AdminWithdrawController::class, 'edit'])->name('editwithdraw');
    Route::put('/approve-withdraw/{id}', [AdminWithdrawController::class, 'ApproveWithdraw'])->name('Approvewithdraw');


});


Route::get('user_register', [RegisteredUserController::class, 'create']);
Route::get('/referral-user-register', [RegisteredUserController::class, 'referRegister']);
Route::post('user_registered', [RegisteredUserController::class, 'store'])->name('user_registered');
Route::get('/email_verification/{token}', [RegisteredUserController::class, 'emailVerification']);

//==================== Frontend Start =================//
Route::get('/', [FrontendController::class, 'index']);
//==================== Frontend End =================//

//==================== User DashBoard =================//
Route::middleware(['auth', 'checkRole:3'])->group(function () {
    Route::get('/user-dashboard', [userdashboardController::class, 'dashboard']);

    Route::get('/affiliate-dashboard', function () {
        return view('userDashboard\page\affiliate-dashboard');
    });

    Route::get('/usernetwork',[NetworkController::class, 'index']);

    Route::get('/my-e-wallet', [E_WalletController::class, 'E_Wallet']);

    Route::get('/deposit-wallet',[transactionController::class, 'deposit_wallet']);
    Route::post('/adddeposit',[transactionController::class, 'deposit'])->name('deposit');

    // Fund Transfer
    Route::get('/fund-transfer', [ TransferController::class, 'fundTransfer'])->name('fund-transfer');
    Route::post('/fund-transfer', [ TransferController::class, 'transferred'])->name('transferred');
    // Fund Transfer End

    // Withdraw Start
    Route::get('/withdraw', [WithdrawController::class, 'Withdraw'])->name('withdraw');
    Route::post('/withdraw_amount', [WithdrawController::class, 'Withdraw_amount'])->name('withdraw_amount');
    // Withdraw End

    // -----------Profile Start------------//
    Route::get('/my-profile',  [ProfileController::class, 'myProfile'])->name('my-profile');
    Route::get('/manage-profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/manage-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/manage-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/referrals-list',[ProfileController::class, 'Referral']);
    Route::get('/notice', [ ProfileController::class,'profileAllNotice']);
    Route::get('/single_notice/{id}', [ ProfileController::class,'SingleNotice']);

    //Blog
    Route::get('/blogs', [ BlogController::class,'allBlog'])->name('Admin.Blogs');
    // Route::get('/add-blogs', [ BlogController::class,'addbloge']);
    Route::post('/add-blogs', [ BlogController::class,'store']);
    //--------- Profile End----------//
    
    //Notice 
    Route::get('/all-notice', [NoticeController::class, 'AllNotice']);
    Route::get('/add-notice', [NoticeController::class, 'AddNotice']);
    Route::post('/add-noticepost', [NoticeController::class, 'store'])->name('addNotice');
    
    //Notice End

    Route::get('/income-report', function () {
        return view('userDashboard\page\income-report');
    });


    Route::get('/user-login', function () {
        return view('userDashboard.auth.login');
    });

    Route::get('/user-chart', function () {
        return view('userDashboard.page_copy.charts');
    });

});




require __DIR__.'/auth.php';
