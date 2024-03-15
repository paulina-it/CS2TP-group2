<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;

class ApplyCouponTest extends TestCase
{
    public function test_book_can_be_added_to_order(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $response = $this->post('/basket/'.strval($book['id']),[
            'product-qty' => 1
        ]);
        $response = $this->post('/order');
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/wishlist')
            ->assertSee($book['name']);
    }
}
