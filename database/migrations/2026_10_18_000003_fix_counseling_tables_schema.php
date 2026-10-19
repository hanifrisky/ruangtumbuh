<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('counseling_sessions')) {
            Schema::table('counseling_sessions', function (Blueprint $table) {
                if (!Schema::hasColumn('counseling_sessions', 'session_number')) {
                    $table->integer('session_number')->default(1)->after('konselor_id');
                }
                if (!Schema::hasColumn('counseling_sessions', 'platform')) {
                    $table->string('platform', 50)->nullable()->default('Google Meet')->after('scheduled_at');
                }
                if (!Schema::hasColumn('counseling_sessions', 'meeting_url')) {
                    $table->string('meeting_url', 500)->nullable()->after('platform');
                }
                if (!Schema::hasColumn('counseling_sessions', 'counselor_evaluation_notes')) {
                    $table->text('counselor_evaluation_notes')->nullable()->after('status');
                }
            });
        }

        if (Schema::hasTable('chat_messages')) {
            Schema::table('chat_messages', function (Blueprint $table) {
                if (!Schema::hasColumn('chat_messages', 'receiver_id')) {
                    $table->foreignId('receiver_id')->nullable()->after('sender_id')->constrained('users')->cascadeOnDelete();
                }
                if (!Schema::hasColumn('chat_messages', 'read_at')) {
                    $table->timestamp('read_at')->nullable()->after('message');
                }
            });
        }

        if (Schema::hasTable('session_reflections')) {
            Schema::table('session_reflections', function (Blueprint $table) {
                if (!Schema::hasColumn('session_reflections', 'answer_1')) {
                    $table->text('answer_1')->nullable()->after('session_date');
                }
                if (!Schema::hasColumn('session_reflections', 'answer_2')) {
                    $table->text('answer_2')->nullable()->after('answer_1');
                }
                if (!Schema::hasColumn('session_reflections', 'answer_3')) {
                    $table->text('answer_3')->nullable()->after('answer_2');
                }
                if (!Schema::hasColumn('session_reflections', 'submitted_at')) {
                    $table->timestamp('submitted_at')->nullable()->after('counselor_feedback');
                }
            });
        }
    }

    public function down(): void
    {
        // Safe no-op or drop added columns if needed
    }
};
