<?php

declare(strict_types=1);

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
        Schema::create('user_auth', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->string('type')->nullable(false)->comment('类型:wechat_open_id,wechat_union_id,ding_talk_open_id');
            $table->string('identifier')->nullable(false)->comment('标识:如openid');
            $table->string('credentials')->default('')->nullable(false)->comment('凭证');
            $table->unsignedTinyInteger('status')->nullable(false)->comment('状态:1正常,2禁用');
            $table->timestamps();
            $table->softDeletes();
            $table->index('user_id');
            $table->unique(['type', 'identifier'], 'type_identifier_unique');
            $table->index('status');
            $table->comment('用户认证表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_auth');
    }
};
