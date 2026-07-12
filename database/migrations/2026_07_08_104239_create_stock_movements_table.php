<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity'); // quantité ajoutée ou retirée (négatif pour sortie)
            $table->integer('stock_before');
            $table->integer('stock_after');
            $table->string('type'); // 'order' (sortie), 'restock' (entrée), 'adjustment' (ajustement)
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null'); // lien vers la commande si sortie
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_movements');
    }
};