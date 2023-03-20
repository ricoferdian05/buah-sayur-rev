<?php

namespace Tests\Unit;

use App\Http\Controllers\AdminCategoryController;
use App\Models\User;
use Carbon\Factory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->call('POST', '/admin', [
            'email' => 'reynaldi.octavially@gmail.com',
            'password' => 'password'
        ]);
        // dd($response);
        $response->assertRedirect('/dashboard/posts');
    }

    public function test_categoryStore()
    {
        $response = $this->call('POST', '/dashboard/categories', [
            'name' => 'Contoh5',
            'slug' => 'contoh5'
        ]);
        // dd($response);
        $response->assertRedirect('/dashboard/categories');
    }
}
