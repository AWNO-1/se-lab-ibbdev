<?php

use App\Models\Answer;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('يجب على الزائر تسجيل الدخول قبل طرح سؤال جديد', function () {
    $this->get(route('posts.create'))->assertRedirect(route('login'));
});

test('يمكن للمستخدم المسجل طرح سؤال برمجي بنجاح', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'كيف أستخدم Dependency Injection في Laravel؟',
        'body' => 'أريد معرفة كيفية ربط Interface بالـ Service عبر Service Container بطريقة صحيحة.',
    ]);

    $post = Post::first();

    $response
        ->assertRedirect(route('posts.show', $post))
        ->assertSessionHas('success', 'تم طرح السؤال بنجاح ✓');

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'title' => 'كيف أستخدم Dependency Injection في Laravel؟',
    ]);
});

test('يمكن للمستخدم الآخر الإجابة على سؤال زميله', function () {
    $author = User::factory()->create();
    $responder = User::factory()->create();

    $post = Post::factory()->create(['user_id' => $author->id]);

    $response = $this->actingAs($responder)->post(route('answers.store', $post), [
        'body' => 'يمكنك استخدام دالة $this->app->bind داخل ملف AppServiceProvider.',
    ]);

    $response
        ->assertRedirect(route('posts.show', $post))
        ->assertSessionHas('success', 'تم إضافة الإجابة بنجاح');

    $this->assertDatabaseHas('answers', [
        'post_id' => $post->id,
        'user_id' => $responder->id,
    ]);
});

test('حالة حافة (Edge Case): يُمنع صاحب السؤال من الإجابة على سؤاله الخاص', function () {
    $author = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $author->id]);

    $response = $this->actingAs($author)
        ->from(route('posts.show', $post))
        ->post(route('answers.store', $post), [
            'body' => 'هذه محاولة خاطئة للإجابة على سؤالي الخاص.',
        ]);

    $response
        ->assertRedirect(route('posts.show', $post))
        ->assertSessionHas('error', 'لا يمكنك الإجابة على سؤالك الخاص');

    $this->assertDatabaseMissing('answers', [
        'post_id' => $post->id,
        'user_id' => $author->id,
    ]);
});

test('يمكن لصاحب السؤال فقط اعتماد الإجابة كحل واحتساب 10 نقاط سمعة لصاحب الإجابة', function () {
    $author = User::factory()->create();
    $responder = User::factory()->create(['reputation_points' => 0]);

    $post = Post::factory()->create(['user_id' => $author->id]);
    $answer = Answer::factory()->create([
        'post_id' => $post->id,
        'user_id' => $responder->id,
        'is_accepted' => false,
    ]);

    $response = $this->actingAs($author)->post(route('answers.accept', $answer));

    $response
        ->assertSessionHas('success', 'تم اعتماد الإجابة و منحت صاحبها 10 نقاط');

    expect($answer->refresh()->is_accepted)->toBeTrue();
    expect($post->refresh()->is_solved)->toBeTrue();
    expect($responder->refresh()->reputation_points)->toBe(10);

    $this->assertDatabaseHas('reputation_logs', [
        'user_id' => $responder->id,
        'points' => 10,
    ]);
});

test('صلاحيات وحماية (Policy): يُمنع أي مستخدم آخر غير صاحب السؤال من اعتماد الإجابة', function () {
    $author = User::factory()->create();
    $stranger = User::factory()->create();
    $responder = User::factory()->create(['reputation_points' => 0]);

    $post = Post::factory()->create(['user_id' => $author->id]);
    $answer = Answer::factory()->create([
        'post_id' => $post->id,
        'user_id' => $responder->id,
        'is_accepted' => false,
    ]);

    // محاولة مستخدم غريب اعتماد الإجابة
    $response = $this->actingAs($stranger)->post(route('answers.accept', $answer));

    // يجب أن يعيد 403 Forbidden عبر Policy
    $response->assertForbidden();

    expect($answer->refresh()->is_accepted)->toBeFalse();
    expect($responder->refresh()->reputation_points)->toBe(0);
});
