<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

test('guests are redirected to the login page', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {

    if (DB::getDriverName() === 'sqlite') {
        $this->markTestSkipped('SQLite does not support MONTH() function used in dashboard query.');
    }

    $this->actingAs(User::factory()->create());

    $this->get('/dashboard')->assertStatus(200);
});
