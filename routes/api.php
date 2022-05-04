<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Api Register
 */
Route::post('/register', [RegisterController::class, 'register']);

/**
 * Api Login
 */
// Broadcast::routes(['middleware' => ['auth:api']]);
Route::post('/login', [LoginController::class, 'login']);

/**
 * Api User
 */
Route::get('/user', [UserController::class, 'index']);


/**
 * APi Category
 */
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
// Route::get('/category/most-funding', [CategoryController::class, 'most_funding']);

/**
 * Api Campaign
 */
Route::get('/campaign', [CampaignController::class, 'index']);
Route::get('/campaign/{id}', [CampaignController::class, 'show']);
Route::get('/campaign/users/{users_id}', [CampaignController::class, 'index_user'])->middleware('auth:api');
Route::post('/campaign', [CampaignController::class, 'store'])->middleware('auth:api');
Route::post('/campaign/{campaign}', [CampaignController::class, 'update'])->middleware('auth:api');
Route::delete('/campaign/{campaign}', [CampaignController::class, 'destroy'])->middleware('auth:api');

/**
 * Api Campaign Detail (Invitation)
 */
Route::get('/profile/invitation/{users_id}', [InvitationController::class, 'index']);
// Route::get('/profile/invitation/{users_id}/accept/{campaign_id}', [InvitationController::class, 'accept']);
// Route::get('/profile/invitation/{users_id}/reject/{campaign_id}', [InvitationController::class, 'reject']);
Route::post('/profile/invitation/accept', [InvitationController::class, 'accept']);
Route::post('/profile/invitation/reject', [InvitationController::class, 'reject']);

/**
 * Api Updates
 */
Route::get('/campaign/{campaign}/updates', [UpdateController::class, 'index'])->middleware('auth:api');
Route::post('/campaign/{campaign}/updates', [UpdateController::class, 'store'])->middleware('auth:api');
Route::post('/campaign/{campaign}/updates/update/{update_id}', [UpdateController::class, 'update'])->middleware('auth:api');
Route::delete('/campaign/delete_update/{update_id}', [UpdateController::class, 'destroy'])->middleware('auth:api');

/**
 * Api FAQ
 */
Route::get('/campaign/{campaign}/faqs', [FaqController::class, 'index'])->middleware('auth:api');
Route::post('/campaign/{campaign}/faqs', [FaqController::class, 'store'])->middleware('auth:api');
Route::post('/campaign/{campaign}/faqs/faq/{faq_id}', [FaqController::class, 'update'])->middleware('auth:api');
Route::delete('/campaign/delete_faq/{faq_id}', [FaqController::class, 'destroy'])->middleware('auth:api');

/**
 * Api Rewards
 */
Route::get('/campaign/{campaign}/rewards', [RewardController::class, 'index'])->middleware('auth:api');
Route::post('/campaign/{campaign}/rewards', [RewardController::class, 'store'])->middleware('auth:api');
Route::post('/campaign/{campaign}/rewards/reward/{reward_id}', [RewardController::class, 'update'])->middleware('auth:api');
Route::delete('/campaign/delete_reward/{reward_id}', [RewardController::class, 'destroy'])->middleware('auth:api');

/**
 * APi Article
 */
Route::get('/articles', [ArticleController::class, 'index']);

/**
 * Api Profile
 */
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth:api');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth:api');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->middleware('auth:api');

/**
 * Api Payment
 */
Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth:api');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('auth:api');
Route::post('/payment/notification', [PaymentController::class, 'notificationHandler']);


/**
 * Api Private Chat
 */
// Route::group(['middleware' => 'auth:api'], function(){
//     // Route::post('/logout', [LoginController::class, 'logout']);
//     Route::get('me', MeController::class);

//     Route::get('user', [UserController::class, 'index']);
//     Route::get('user/{id}', [UserController::class, 'show']);

//     Route::get('conversation/{user_two}', [ConversationController::class, 'show'])->name('conversation.show');
//     Route::post('conversation/{conversation}/message', [ConversationController::class, 'store'])->name('conversation.store');
// });

/**
 * API Notification
 */
Route::prefix('notifications')->group(function(){
    Route::get('/', [NotificationController::class, 'index'])->middleware('auth:api');
    Route::get('/mark_notif_as_read', [NotificationController::class, 'mark_notif_as_read'])->middleware('auth:api');
});

