<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddToWishlistTest extends TestCase
{
    use RefreshDatabase;

    public function test_wishlist_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/wishlist');

        $response->assertOk();
    }

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
?>