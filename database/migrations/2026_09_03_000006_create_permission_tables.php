<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $teams = false;
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $modelMorphKey = $columnNames['model_morph_key'] ?? 'model_id';

        Schema::create($tableNames['permissions'], function (Blueprint $table) { $table->bigIncrements('id'); $table->string('name'); $table->string('guard_name'); $table->timestamps(); $table->unique(['name','guard_name']); });
        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams) { $table->bigIncrements('id'); if ($teams) { $table->unsignedBigInteger('team_id')->nullable(); $table->index('team_id'); } $table->string('name'); $table->string('guard_name'); $table->timestamps(); if ($teams) { $table->unique(['team_id','name','guard_name']); } else { $table->unique(['name','guard_name']); } });
        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $modelMorphKey, $columnNames) { $table->unsignedBigInteger('permission_id'); $table->string('model_type'); $table->unsignedBigInteger($modelMorphKey); $table->index([$modelMorphKey,'model_type']); $table->foreign('permission_id')->references('id')->on($tableNames['permissions'])->cascadeOnDelete(); $table->primary(['permission_id',$modelMorphKey,'model_type']); });
        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $modelMorphKey) { $table->unsignedBigInteger('role_id'); $table->string('model_type'); $table->unsignedBigInteger($modelMorphKey); $table->index([$modelMorphKey,'model_type']); $table->foreign('role_id')->references('id')->on($tableNames['roles'])->cascadeOnDelete(); $table->primary(['role_id',$modelMorphKey,'model_type']); });
        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) { $table->unsignedBigInteger('permission_id'); $table->unsignedBigInteger('role_id'); $table->foreign('permission_id')->references('id')->on($tableNames['permissions'])->cascadeOnDelete(); $table->foreign('role_id')->references('id')->on($tableNames['roles'])->cascadeOnDelete(); $table->primary(['permission_id','role_id']); });
    }
    public function down(): void { foreach (['role_has_permissions','model_has_roles','model_has_permissions','roles','permissions'] as $table) Schema::dropIfExists(config('permission.table_names.'.$table, $table)); }
};
