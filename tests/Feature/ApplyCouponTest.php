<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplyCouponTest extends TestCase
{
    public function test_book_can_be_added_to_wishlist(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $response = $this->post('/wishlist/'.strval($book['id']));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/wishlist')
            ->assertSee($book['name']);
    }
}
