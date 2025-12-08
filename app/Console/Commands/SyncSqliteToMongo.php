<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\PublicProduct;
use Exception;

class SyncSqliteToMongo extends Command
{
    /*
     *Crear un comando en laravel

     php artisan make:command RegistrationStatus
     php artisan make:command ElComando  

     */
    protected $signature = 'sync:sqlite-mongo'; //ejecutar en terminal : php artisan sync:sqlite-mongo   

    protected $description = 'Sincroniza datos de SQLite hacia MongoDB solo si Mongo está vacío';

    public function handle()
    {
        $this->info("🔍 Verificando contenido en MongoDB...");

        // Verificar si Mongo tiene datos
        if (PublicProduct::count() > 0) {
            $this->error("❌ No se puede ejecutar la migración. MongoDB no está vacío.");
            return Command::FAILURE;
        }

        $this->info("✔️ MongoDB está vacío. Iniciando migración desde SQLite...");

        // Traer todos los productos de SQLite
        $products = Product::all();

        if ($products->count() === 0) {
            $this->warn("⚠️ No hay productos en SQLite para migrar.");
            return Command::SUCCESS;
        }

        $this->info("📦 Productos encontrados en SQLite: {$products->count()}");

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        foreach ($products as $product) {
            try {
                PublicProduct::create([
                    '_id' => $product->product_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'stock' => $product->stock,
                    'price' => $product->price,
                    'is_active' => $product->is_active,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ]);
            } catch (Exception $e) {
                $this->error("\n❌ Error al migrar ID {$product->product_id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();

        $this->info("\n\n✅ Migración completada correctamente.");
        return Command::SUCCESS;
    }
}
