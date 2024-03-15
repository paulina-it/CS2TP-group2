<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;

class UpdateStockTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_stock_updates_on_order(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user['id']
        ]);
        $book = Book::factory()->create();
        $orderItem = OrderItem::factory()->create([
            'book_id' => $book['id'],
            'order_id' => $order['id']
        ]);
        $quantity = $book['quantity'] - 1;
        $response = $this->actingAs($user)->post('/order', [
            'credit_card_no' => 2
        ]);
        $response
        ->assertSessionHasNoErrors();
        $this->assertSame($quantity, $book['quantity']);
    }
}
