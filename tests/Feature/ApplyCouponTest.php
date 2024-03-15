<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;

class ApplyCouponTest extends TestCase
{
    public function test_admin_can_create_coupon(): void
    {
        $user = User::factory()->create();
        $user->role = 'admin';
        $user->save();
        $response = $this->actingAs($user)->post('/admin/coupons', [
            'name' => 'couponName',
            'discount' => 10,
            'date' => date("Y-m-d")
        ]);
        $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/admin/coupons');
    }

    public function test_user_can_apply_coupon(): void
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
        $coupon = Coupon::factory()->create();
        $response = $this->post('/order/coupon', [
            'name' => $coupon['coupon_name']
        ]);
        $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/order');
    }

    public function test_user_cannot_apply_invalid_coupon(): void
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
        $coupon = Coupon::factory()->create();
        $response = $this->post('/order/coupon', [
            'name' => 'notCorrectCouponName'
        ]);
        $response->assertSessionHasErrors();
    }
}
