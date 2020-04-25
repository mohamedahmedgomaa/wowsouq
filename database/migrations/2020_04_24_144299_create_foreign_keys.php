<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('seller_id')->references('id')->on('sellers')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
        Schema::table('files', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('files', function (Blueprint $table) {
            $table->foreign('seller_id')->references('id')->on('sellers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_product_id_foreign');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_client_id_foreign');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign('likes_product_id_foreign');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign('likes_client_id_foreign');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_client_id_foreign');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_payment_method_id_foreign');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_seller_id_foreign');
        });
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign('files_product_id_foreign');
        });
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign('files_seller_id_foreign');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_client_id_foreign');
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign('ads_product_id_foreign');
        });
    }
}
