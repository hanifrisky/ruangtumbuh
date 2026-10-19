<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 30)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'grade_class')) {
                $table->string('grade_class', 100)->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'school_origin')) {
                $table->string('school_origin', 255)->nullable()->after('grade_class');
            }
        });

        Schema::table('counselor_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('counselor_profiles', 'is_developer')) {
                $table->boolean('is_developer')->default(false)->after('whatsapp_number');
            }
            if (!Schema::hasColumn('counselor_profiles', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_developer');
            }
            if (!Schema::hasColumn('counselor_profiles', 'order_number')) {
                $table->integer('order_number')->default(0)->after('is_active');
            }
        });

        Schema::table('questions', function (Blueprint $table) {
            if (!Schema::hasColumn('questions', 'category')) {
                $table->string('category', 50)->default('well_being')->after('id');
            }
            if (!Schema::hasColumn('questions', 'dimension')) {
                $table->string('dimension', 100)->nullable()->after('category');
            }
        });

        Schema::table('wellbeing_answers', function (Blueprint $table) {
            if (!Schema::hasColumn('wellbeing_answers', 'well_being_score')) {
                $table->integer('well_being_score')->nullable()->after('total_score');
            }
            if (!Schema::hasColumn('wellbeing_answers', 'suicide_ideation_score')) {
                $table->integer('suicide_ideation_score')->nullable()->after('well_being_score');
            }
        });

        if (!Schema::hasTable('counseling_sessions')) {
            Schema::create('counseling_sessions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('konseli_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('konselor_id')->constrained('users')->cascadeOnDelete();
                $table->integer('session_number')->default(1);
                $table->dateTime('scheduled_at')->nullable();
                $table->string('platform', 50)->nullable()->default('Google Meet');
                $table->string('meeting_platform', 50)->nullable()->default('Google Meet');
                $table->string('meeting_url', 500)->nullable();
                $table->string('meeting_link', 500)->nullable();
                $table->string('status', 30)->default('pending'); // pending, requested, scheduled, completed, cancelled
                $table->text('counselor_evaluation_notes')->nullable();
                $table->text('evaluation_notes')->nullable();
                $table->text('recommendations')->nullable();
                $table->timestamp('evaluated_at')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('chat_messages')) {
            Schema::create('chat_messages', function (Blueprint $table) {
                $table->id();
                $table->foreignId('counseling_session_id')->nullable()->constrained('counseling_sessions')->cascadeOnDelete();
                $table->foreignId('konseli_id')->nullable()->constrained('users')->cascadeOnDelete();
                $table->foreignId('konselor_id')->nullable()->constrained('users')->cascadeOnDelete();
                $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('receiver_id')->nullable()->constrained('users')->cascadeOnDelete();
                $table->text('message');
                $table->timestamp('read_at')->nullable();
                $table->boolean('is_read')->default(false);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('session_reflections')) {
            Schema::create('session_reflections', function (Blueprint $table) {
                $table->id();
                $table->foreignId('counseling_session_id')->nullable()->constrained('counseling_sessions')->nullOnDelete();
                $table->foreignId('konseli_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('konselor_id')->nullable()->constrained('users')->nullOnDelete();
                $table->integer('session_number')->default(1);
                $table->date('session_date')->nullable();
                $table->text('answer_1')->nullable();
                $table->text('answer_2')->nullable();
                $table->text('answer_3')->nullable();
                $table->text('answer_q1')->nullable();
                $table->text('answer_q2')->nullable();
                $table->text('answer_q3')->nullable();
                $table->text('counselor_feedback')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('session_reflections');
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('counseling_sessions');

        Schema::table('wellbeing_answers', function (Blueprint $table) {
            $table->dropColumn(['well_being_score', 'suicide_ideation_score']);
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['category', 'dimension']);
        });

        Schema::table('counselor_profiles', function (Blueprint $table) {
            $table->dropColumn(['is_developer', 'is_active', 'order_number']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'gender', 'grade_class', 'school_origin']);
        });
    }
};
