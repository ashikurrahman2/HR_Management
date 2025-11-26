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
        Schema::table('salaries', function (Blueprint $table) {
            // Foreign key যোগ করুন
            $table->foreignId('employee_list_id')
                  ->after('id')
                  ->constrained('employee_lists')
                  ->onDelete('cascade');
            
            // Index যোগ করুন
            $table->index('salary_month');
            $table->index(['employee_list_id', 'salary_month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropForeign(['employee_list_id']);
            $table->dropColumn('employee_list_id');
            $table->dropIndex(['salary_month']);
            $table->dropIndex(['employee_list_id', 'salary_month']);
        });
    }
};