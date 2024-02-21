<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            'create trigger decrease_qty
            after insert on baskets
            for each row
            begin
                update products set quantity=quantity-1 where item_id=new.item_id;
            end'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared(('drop trigger if exists decrease_qty'));
    }
};
