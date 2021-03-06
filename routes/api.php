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
Route::prefix('user')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/get_user', [UserController::class, 'GetUser'])->middleware('auth:api');
    Route::get('/edit/{id}', [UserController::class, 'Edit'])->middleware('auth:api');
    Route::post('/create_user', [UserController::class, 'CreateUser'])->middleware('auth:api');
    Route::post('/update_user', [UserController::class, 'UpdateUser'])->middleware('auth:api');
    Route::delete('/delete_user/{id}', [UserController::class, 'DeleteUser'])->middleware('auth:api');
});

/**
 * APi Category
 */
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
// Route::get('/category/most-funding', [CategoryController::class, 'most_funding']);

/**
 * Api Campaign
 */
Route::prefix('campaign')->group(function() {
    Route::get('/', [CampaignController::class, 'index']);
    Route::get('/get_campaign/{id}', [CampaignController::class, 'show']);
    Route::get('/users/{users_id}', [CampaignController::class, 'index_user'])->middleware('auth:api');
    Route::post('/', [CampaignController::class, 'store'])->middleware('auth:api');
    Route::post('/{campaign}', [CampaignController::class, 'update'])->middleware('auth:api');
    Route::delete('/{campaign}', [CampaignController::class, 'destroy'])->middleware('auth:api');
    Route::get('/collaboration/{id_user}', [CampaignController::class, 'get_list_collaboration'])->middleware('auth:api');

    /**
     * Api Updates
     */
    Route::get('/{campaign}/updates', [UpdateController::class, 'index'])->middleware('auth:api');
    Route::post('/{campaign}/updates', [UpdateController::class, 'store'])->middleware('auth:api');
    Route::post('/{campaign}/updates/update/{update_id}', [UpdateController::class, 'update'])->middleware('auth:api');
    Route::delete('/delete_update/{update_id}', [UpdateController::class, 'destroy'])->middleware('auth:api');

    /**
     * Api FAQ
     */
    Route::get('/{campaign}/faqs', [FaqController::class, 'index'])->middleware('auth:api');
    Route::post('/{campaign}/faqs', [FaqController::class, 'store'])->middleware('auth:api');
    Route::post('/{campaign}/faqs/faq/{faq_id}', [FaqController::class, 'update'])->middleware('auth:api');
    Route::delete('/delete_faq/{faq_id}', [FaqController::class, 'destroy'])->middleware('auth:api');

    /**
     * Api Rewards
     */
    Route::get('/{campaign}/rewards', [RewardController::class, 'index'])->middleware('auth:api');
    Route::post('/{campaign}/rewards', [RewardController::class, 'store'])->middleware('auth:api');
    Route::post('/{campaign}/rewards/reward/{reward_id}', [RewardController::class, 'update'])->middleware('auth:api');
    Route::delete('/delete_reward/{reward_id}', [RewardController::class, 'destroy'])->middleware('auth:api');

    // ** Approve Reject Campaign
    Route::put('approve_campaign/{id}', [CampaignController::class, 'approve_campaign'])->middleware('auth:api');
    Route::put('reject_campaign/{id}', [CampaignController::class, 'reject_campaign'])->middleware('auth:api');

    // ** Approve & reject delete campaign
    Route::put('approve_delete_campaign/{id}', [CampaignController::class, 'approve_delete_campaign'])->middleware('auth:api');
    Route::put('reject_delete_campaign/{id}', [CampaignController::class, 'reject_delete_campaign'])->middleware('auth:api');

    // ** For admin needs
    Route::get('/get_all_campaigns', [CampaignController::class, 'GetAllCampaigns'])->middleware('auth:api');
});

/**
 * Api Campaign Detail (Invitation)
 */
Route::prefix('profile')->group(function() {
    Route::get('/invitation/{users_id}', [InvitationController::class, 'index'])->middleware('auth:api');
    // Route::get('/invitation/{users_id}/accept/{campaign_id}', [InvitationController::class, 'accept']);
    // Route::get('/invitation/{users_id}/reject/{campaign_id}', [InvitationController::class, 'reject']);
    Route::post('/invitation/accept', [InvitationController::class, 'accept']);
    Route::post('/invitation/reject', [InvitationController::class, 'reject']);

    /**
     * Api Profile
     */
    Route::get('/', [ProfileController::class, 'index'])->middleware('auth:api');
    Route::post('/', [ProfileController::class, 'update'])->middleware('auth:api');
    Route::post('/password', [ProfileController::class, 'updatePassword'])->middleware('auth:api');
});

/**
 * APi Article
 */
Route::get('/articles', [ArticleController::class, 'index']);

/**
 * Api Payment
 */
Route::prefix('payment')->group(function() {
    Route::get('/', [PaymentController::class, 'index'])->middleware('auth:api');
    Route::post('/', [PaymentController::class, 'store'])->middleware('auth:api');
    Route::get('/get_payment_by_campaign/{id_campaign}', [PaymentController::class, 'GetPaymentByCampaign'])->middleware('auth:api');
    Route::post('/notification', [PaymentController::class, 'notificationHandler']);
});


/**
 * API Notification
 */
Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth:api');
Route::get('/notifications/mark_notif_as_read', [NotificationController::class, 'mark_notif_as_read'])->middleware('auth:api');

/**
 * Api Private Chat
 */
Route::prefix('chats')->group(function() {
    Route::get('/{user_id}', [ConversationController::class, 'index'])->middleware('auth:api');
    Route::post('/post_inbox', [ConversationController::class, 'post_inbox'])->middleware('auth:api');
    Route::post('/messages', [ConversationController::class, 'messages'])->middleware('auth:api');
    Route::post('/post_message', [ConversationController::class, 'post_message'])->middleware('auth:api');
});
