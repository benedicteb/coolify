<?php

use App\Http\Controllers\Webhook\Bitbucket;
use App\Http\Controllers\Webhook\Github;
use App\Http\Controllers\Webhook\Gitlab;
use App\Http\Controllers\Notifications\Slack;
use App\Http\Controllers\Webhook\Stripe;
use App\Http\Controllers\Webhook\Waitlist;
use Illuminate\Support\Facades\Route;

Route::get('/source/github/redirect', [Github::class, 'redirect']);
Route::get('/source/github/install', [Github::class, 'install']);
Route::get('/notifications/slack/install', [Slack::class, 'install']);
Route::post('/source/github/events', [Github::class, 'normal']);
Route::post('/source/github/events/manual', [Github::class, 'manual']);

Route::post('/source/gitlab/events/manual', [Gitlab::class, 'manual']);

Route::post('/source/bitbucket/events/manual', [Bitbucket::class, 'manual']);

Route::post('/payments/stripe/events', [Stripe::class, 'events']);

Route::get('/waitlist/confirm', [Waitlist::class, 'confirm'])->name('webhooks.waitlist.confirm');
Route::get('/waitlist/cancel', [Waitlist::class, 'cancel'])->name('webhooks.waitlist.cancel');
