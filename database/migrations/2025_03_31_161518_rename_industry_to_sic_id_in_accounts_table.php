<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIndustryToSicIdInAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->renameColumn('industry', 'sic_id');
        });
    }

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->renameColumn('sic_id', 'industry');
        });
    }
}