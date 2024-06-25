<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chamar AdminUserSeeder para criar o usuário administrador
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Inserir o usuário administrador se não existir
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@xbri.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'),
            ]
        );

        // Criar 10 clientes para o usuário administrador
        Client::factory(15)->create()->each(function ($client) use ($adminUser) {
            // Criar 3 categorias
            Category::factory(5)->create()->each(function ($category) use ($client, $adminUser) {
                // Criar 5 produtos para cada categoria
                Product::factory(10)->create([
                    'category_id' => $category->id,
                ])->each(function ($product) use ($client, $adminUser) {
                    // Criar 2 pedidos para cada cliente
                    Order::factory(4)->create([
                        'client_id' => $client->id,
                        'user_id' => $adminUser->id,
                    ])->each(function ($order) use ($product) {
                        // Criar 3 itens do pedido para cada pedido
                        OrderItem::factory(3)->create([
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                        ]);

                        // Criar 1 pagamento para cada pedido
                        Payment::factory(1)->create([
                            'order_id' => $order->id,
                        ]);
                    });
                });
            });
        });
    }
}
