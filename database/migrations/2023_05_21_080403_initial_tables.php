<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('value')->nullable();
            $table->string('type')->dafault('S');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->morphs('entity');
            $table->string('image');
            $table->integer('sort')->nullable()->default(500);
            $table->timestamps();
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('user_user_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_role_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['user_id', 'user_role_id']);
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->nullOnDelete()->cascadeOnUpdate();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('entrance')->nullable();
            $table->string('floor')->nullable();
            $table->string('flat')->nullable();
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('category_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_group_id')->nullOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('brand_id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('article')->nullable();
            $table->unsignedMediumInteger('stock')->default(0);
            $table->unsignedSmallInteger('sort')->default(500);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('offer_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->string('type')->dafault('S');
            $table->boolean('multiple')->dafault(false);
            $table->boolean('active');
            $table->unsignedSmallInteger('sort')->default(500);
            $table->timestamps();
        });

        Schema::create('offer_property_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_property_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('offer_property_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('offer_property_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('offer_property_list_id')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('offer_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('currency_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('price', $precision = 9, $scale = 2);
            $table->tinyInteger('discount')->default(0);
            $table->unique(['offer_id', 'currency_id']);
            $table->timestamps();
        });

        Schema::create('offer_offer_property_value', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('offer_property_value_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['offer_id', 'offer_property_value_id'], 'offer_offer_property_value_unique');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('delivery_id');
            $table->foreignId('payment_id');
            $table->foreignId('order_status_id');
            $table->foreignId('location_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('offer_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullOnDelete()->cascadeOnUpdate();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('offer_offer_property_value');
        Schema::dropIfExists('offer_prices');
        Schema::dropIfExists('offer_property_values');
        Schema::dropIfExists('offer_property_lists');
        Schema::dropIfExists('offer_properties');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('product_property_values');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_property_lists');
        Schema::dropIfExists('product_properties');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_groups');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('deliveries');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('user_user_role');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('settings');
    }
};
