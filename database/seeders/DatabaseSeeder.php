<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\PaymentAccount;
use App\Models\Payment;
use App\Models\PaymentHistory;
use App\Models\Contact;
use App\Models\Cart;
use App\Models\Rating;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ========== USERS ==========
        $superadmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '09-123456789',
            'address' => 'Yangon, Myanmar',
        ]);

        $users = User::factory(10)->create([
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // ========== CATEGORIES ==========
        $categories = Category::insert([
            ['name' => 'Coffee Drippers', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Espresso Glasses', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Milk Pitchers', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coffee Beans', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grinders', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tamper & Accessories', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Filters & Paper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coffee Mugs', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $categoryIds = Category::pluck('id')->toArray();

        // ========== PRODUCTS ==========
        $products = [
            // Coffee Drippers
            ['name' => 'Hario V60 Dripper', 'category_id' => $categoryIds[0], 'price' => 15000, 'stock' => 30, 'description' => 'Hario V60 ceramic dripper, perfect for pour-over coffee brewing.'],
            ['name' => 'Kalita Wave Dripper', 'category_id' => $categoryIds[0], 'price' => 18000, 'stock' => 25, 'description' => 'Kalita Wave stainless steel dripper with flat bottom design.'],
            ['name' => 'Chemex Pour-Over', 'category_id' => $categoryIds[0], 'price' => 35000, 'stock' => 15, 'description' => 'Classic Chemex glass coffeemaker with wooden collar.'],

            // Espresso Glasses
            ['name' => 'Double Wall Espresso Glass', 'category_id' => $categoryIds[1], 'price' => 8000, 'stock' => 40, 'description' => 'Double wall borosilicate glass, 80ml espresso cup.'],
            ['name' => 'Espresso Shot Glass 60ml', 'category_id' => $categoryIds[1], 'price' => 5000, 'stock' => 50, 'description' => 'Thick glass espresso shot cup with handle.'],
            ['name' => 'Latte Art Glass 360ml', 'category_id' => $categoryIds[1], 'price' => 12000, 'stock' => 20, 'description' => 'Clear glass latte cup for latte art practice.'],

            // Milk Pitchers
            ['name' => 'Stainless Milk Pitcher 600ml', 'category_id' => $categoryIds[2], 'price' => 15000, 'stock' => 35, 'description' => 'Professional stainless steel milk frothing pitcher with thermometer.'],
            ['name' => 'Milk Pitcher 350ml', 'category_id' => $categoryIds[2], 'price' => 10000, 'stock' => 40, 'description' => 'Small stainless steel pitcher for single serving latte art.'],
            ['name' => 'Color Milk Pitcher 600ml', 'category_id' => $categoryIds[2], 'price' => 18000, 'stock' => 20, 'description' => 'Coated stainless steel pitcher in matte black, rose gold, or white.'],

            // Coffee Beans
            ['name' => 'Arabica Beans 250g', 'category_id' => $categoryIds[3], 'price' => 12000, 'stock' => 50, 'description' => 'Single origin Arabica beans from Shan State, medium roast.'],
            ['name' => 'Robusta Beans 250g', 'category_id' => $categoryIds[3], 'price' => 8000, 'stock' => 45, 'description' => 'Strong Robusta beans, dark roast, ideal for espresso blend.'],
            ['name' => 'Blend Coffee Beans 500g', 'category_id' => $categoryIds[3], 'price' => 20000, 'stock' => 30, 'description' => 'House blend Arabica and Robusta, medium-dark roast.'],
            ['name' => 'Specialty Geisha 100g', 'category_id' => $categoryIds[3], 'price' => 35000, 'stock' => 10, 'description' => 'Premium Geisha variety, light roast with floral notes.'],

            // Grinders
            ['name' => 'Hand Grinder Ceramic Burr', 'category_id' => $categoryIds[4], 'price' => 45000, 'stock' => 15, 'description' => 'Portable hand coffee grinder with ceramic burr, adjustable grind size.'],
            ['name' => 'Electric Grinder 600g', 'category_id' => $categoryIds[4], 'price' => 120000, 'stock' => 8, 'description' => 'Commercial electric coffee grinder with 600g hopper capacity.'],
            ['name' => 'Mini Hand Grinder', 'category_id' => $categoryIds[4], 'price' => 25000, 'stock' => 20, 'description' => 'Compact travel hand grinder with stainless steel burr.'],

            // Tamper & Accessories
            ['name' => 'Coffee Tamper 58mm', 'category_id' => $categoryIds[5], 'price' => 25000, 'stock' => 25, 'description' => 'Heavyweight stainless steel coffee tamper with rubber grip.'],
            ['name' => 'Tamping Mat Set', 'category_id' => $categoryIds[5], 'price' => 15000, 'stock' => 30, 'description' => 'Silicone tamping mat with distribution tool and tamper.'],
            ['name' => 'Portafilter 58mm', 'category_id' => $categoryIds[5], 'price' => 30000, 'stock' => 18, 'description' => 'Stainless steel bottomless portafilter for 58mm group head.'],

            // Filters & Paper
            ['name' => 'V60 Paper Filters 100pcs', 'category_id' => $categoryIds[6], 'price' => 8000, 'stock' => 60, 'description' => 'Bleached paper filters for Hario V60 size 02.'],
            ['name' => 'Kalita Wave Filters 50pcs', 'category_id' => $categoryIds[6], 'price' => 10000, 'stock' => 35, 'description' => 'Wave-shaped paper filters for Kalita Wave dripper.'],
            ['name' => 'Chemex Filters 100pcs', 'category_id' => $categoryIds[6], 'price' => 12000, 'stock' => 25, 'description' => 'Bonded paper filters for Chemex coffeemaker.'],

            // Coffee Mugs
            ['name' => 'Ceramic Coffee Mug 300ml', 'category_id' => $categoryIds[7], 'price' => 6000, 'stock' => 50, 'description' => 'Handmade ceramic coffee mug with minimalist design.'],
            ['name' => 'Double Wall Glass Mug 400ml', 'category_id' => $categoryIds[7], 'price' => 12000, 'stock' => 30, 'description' => 'Borosilicate double wall glass mug, keeps coffee warm longer.'],
            ['name' => 'Travel Tumbler 500ml', 'category_id' => $categoryIds[7], 'price' => 20000, 'stock' => 25, 'description' => 'Stainless steel vacuum insulated travel tumbler.'],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $productIds = Product::pluck('id')->toArray();

        // ========== PAYMENT ACCOUNTS ==========
        PaymentAccount::insert([
            ['account_name' => 'KBZ Bank', 'account_type' => 'Bank', 'account_number' => '1234567890', 'created_at' => now(), 'updated_at' => now()],
            ['account_name' => 'AYA Bank', 'account_type' => 'Bank', 'account_number' => '0987654321', 'created_at' => now(), 'updated_at' => now()],
            ['account_name' => 'Wave Money', 'account_type' => 'E-Wallet', 'account_number' => '09-111111111', 'created_at' => now(), 'updated_at' => now()],
            ['account_name' => 'K Pay', 'account_type' => 'E-Wallet', 'account_number' => '09-222222222', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $paymentAccountIds = PaymentAccount::pluck('id')->toArray();

        // ========== ORDERS ==========
        $statuses = ['preparing', 'completed', 'cancelled'];
        $orders = [];

        for ($i = 0; $i < 25; $i++) {
            $user = $users->random();
            $product = Product::find($productIds[array_rand($productIds)]);
            $count = rand(1, 5);
            $status = $statuses[array_rand($statuses)];

            $orders[] = Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'count' => $count,
                'total_price' => $product->price * $count,
                'status' => $status,
                'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        // ========== PAYMENTS ==========
        foreach ($orders as $order) {
            Payment::create([
                'order_id' => $order->id,
                'payment_account_id' => $paymentAccountIds[array_rand($paymentAccountIds)],
                'amount' => $order->total_price,
                'status' => $order->status === 'cancelled' ? 'cancelled' : ($order->status === 'completed' ? 'completed' : 'pending'),
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ]);
        }

        // ========== PAYMENT HISTORIES ==========
        foreach ($orders as $order) {
            if ($order->status !== 'cancelled') {
                PaymentHistory::create([
                    'user_id' => $order->user_id,
                    'payment_id' => $order->payments->first()->id,
                    'amount' => $order->total_price,
                    'status' => $order->status === 'completed' ? 'completed' : 'pending',
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                ]);
            }
        }

        // ========== CONTACTS ==========
        $contactSubjects = [
            'Product Inquiry',
            'Order Status',
            'Shipping Question',
            'Return Request',
            'Wholesale Inquiry',
            'Feedback',
            'Partnership Opportunity',
            'General Question',
        ];

        $contactMessages = [
            'I would like to know more about the Hario V60 dripper. Is it available in different colors?',
            'Can you provide bulk pricing for coffee beans? We run a cafe and need regular supply.',
            'My order has not arrived yet. Can you check the status?',
            'I received a damaged product. How can I get a replacement?',
            'Do you offer free shipping for orders over 50,000 MMK?',
            'Great quality products! Keep up the good work.',
            'I am interested in becoming a distributor for your coffee accessories.',
            'What is the warranty period for the electric grinder?',
        ];

        for ($i = 0; $i < 12; $i++) {
            $user = $users->random();
            $idx = $i % count($contactSubjects);
            Contact::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'subject' => $contactSubjects[$idx],
                'message' => $contactMessages[$idx],
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        // ========== CARTS ==========
        foreach ($users->take(5) as $user) {
            $cartCount = rand(1, 3);
            $cartProducts = collect($productIds)->random($cartCount);
            foreach ($cartProducts as $pid) {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $pid,
                    'quantity' => rand(1, 3),
                ]);
            }
        }

        // ========== RATINGS ==========
        foreach ($users->take(7) as $user) {
            $ratedProducts = collect($productIds)->random(min(5, count($productIds)));
            foreach ($ratedProducts as $pid) {
                Rating::create([
                    'user_id' => $user->id,
                    'product_id' => $pid,
                    'rating' => rand(3, 5),
                ]);
            }
        }

        // ========== COMMENTS ==========
        $comments = [
            'Excellent quality! Highly recommended.',
            'Works perfectly for my morning coffee.',
            'Good value for money.',
            'The build quality is impressive.',
            'Exactly what I needed for my home setup.',
            'Fast shipping and well packaged.',
            'My favorite coffee accessory so far.',
            'A bit pricey but worth it.',
        ];

        foreach ($users->take(6) as $user) {
            $commentProducts = collect($productIds)->random(min(3, count($productIds)));
            foreach ($commentProducts as $pid) {
                Comment::create([
                    'user_id' => $user->id,
                    'product_id' => $pid,
                    'comment' => $comments[array_rand($comments)],
                ]);
            }
        }
    }
}
