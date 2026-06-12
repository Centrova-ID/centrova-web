<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add performance indexes to frequently queried tables
     */
    public function up(): void
    {
        // Users table indexes
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Email index (if not exists from unique constraint)
                if (!$this->indexExists('users', 'users_email_index')) {
                    $table->index('email', 'users_email_index');
                }
                
                // Created at index for sorting/filtering
                if (!$this->indexExists('users', 'users_created_at_index')) {
                    $table->index('created_at', 'users_created_at_index');
                }
                
                // Composite index for active users sorted by date
                if (!$this->indexExists('users', 'users_active_created_index')) {
                    $table->index(['email_verified_at', 'created_at'], 'users_active_created_index');
                }
            });
        }

        // Sessions table indexes (if using database sessions)
        if (Schema::hasTable('sessions')) {
            Schema::table('sessions', function (Blueprint $table) {
                if (!$this->indexExists('sessions', 'sessions_user_id_index')) {
                    $table->index('user_id', 'sessions_user_id_index');
                }
                
                if (!$this->indexExists('sessions', 'sessions_last_activity_index')) {
                    $table->index('last_activity', 'sessions_last_activity_index');
                }
            });
        }

        // Cache table indexes (if using database cache)
        if (Schema::hasTable('cache')) {
            Schema::table('cache', function (Blueprint $table) {
                // Key is usually primary, but add expiration index
                if (!$this->indexExists('cache', 'cache_expiration_index')) {
                    $table->index('expiration', 'cache_expiration_index');
                }
            });
        }

        // Failed jobs table
        if (Schema::hasTable('failed_jobs')) {
            Schema::table('failed_jobs', function (Blueprint $table) {
                if (!$this->indexExists('failed_jobs', 'failed_jobs_failed_at_index')) {
                    $table->index('failed_at', 'failed_jobs_failed_at_index');
                }
            });
        }

        // Add indexes for custom tables
        // Example: Domain Orders
        if (Schema::hasTable('domain_orders')) {
            Schema::table('domain_orders', function (Blueprint $table) {
                if (!$this->indexExists('domain_orders', 'domain_orders_user_id_index')) {
                    $table->index('user_id', 'domain_orders_user_id_index');
                }
                
                if (!$this->indexExists('domain_orders', 'domain_orders_status_index')) {
                    $table->index('status', 'domain_orders_status_index');
                }
                
                if (!$this->indexExists('domain_orders', 'domain_orders_created_at_index')) {
                    $table->index('created_at', 'domain_orders_created_at_index');
                }
            });
        }

        // Example: Chat Messages
        if (Schema::hasTable('chat_messages')) {
            Schema::table('chat_messages', function (Blueprint $table) {
                if (!$this->indexExists('chat_messages', 'chat_messages_conversation_id_index')) {
                    $table->index('conversation_id', 'chat_messages_conversation_id_index');
                }
                
                if (!$this->indexExists('chat_messages', 'chat_messages_user_id_index')) {
                    $table->index('user_id', 'chat_messages_user_id_index');
                }
                
                if (!$this->indexExists('chat_messages', 'chat_messages_created_at_index')) {
                    $table->index('created_at', 'chat_messages_created_at_index');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes in reverse order
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropIndex('users_active_created_index');
                $table->dropIndex('users_created_at_index');
                $table->dropIndex('users_email_index');
            });
        }

        if (Schema::hasTable('sessions')) {
            Schema::table('sessions', function (Blueprint $table) {
                $table->dropIndex('sessions_last_activity_index');
                $table->dropIndex('sessions_user_id_index');
            });
        }

        if (Schema::hasTable('cache')) {
            Schema::table('cache', function (Blueprint $table) {
                $table->dropIndex('cache_expiration_index');
            });
        }

        if (Schema::hasTable('failed_jobs')) {
            Schema::table('failed_jobs', function (Blueprint $table) {
                $table->dropIndex('failed_jobs_failed_at_index');
            });
        }

        if (Schema::hasTable('domain_orders')) {
            Schema::table('domain_orders', function (Blueprint $table) {
                $table->dropIndex('domain_orders_created_at_index');
                $table->dropIndex('domain_orders_status_index');
                $table->dropIndex('domain_orders_user_id_index');
            });
        }

        if (Schema::hasTable('chat_messages')) {
            Schema::table('chat_messages', function (Blueprint $table) {
                $table->dropIndex('chat_messages_created_at_index');
                $table->dropIndex('chat_messages_user_id_index');
                $table->dropIndex('chat_messages_conversation_id_index');
            });
        }
    }

    private function indexExists(string $table, string $index): bool
    {
        $indexes = Schema::getIndexes($table);
        foreach ($indexes as $idx) {
            if ($idx['name'] === $index) {
                return true;
            }
        }
        return false;
    }
};
