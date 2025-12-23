-- =========================================
-- DATABASE PERFORMANCE OPTIMIZATION QUERIES
-- Centrova Web - Production Ready
-- =========================================

-- 1. ADD INDEXES FOR FREQUENTLY QUERIED COLUMNS
-- =========================================

-- Users Table Indexes
ALTER TABLE users ADD INDEX idx_email (email);
ALTER TABLE users ADD INDEX idx_created_at (created_at);
ALTER TABLE users ADD INDEX idx_active_created (active, created_at);
ALTER TABLE users ADD INDEX idx_email_verified (email_verified_at);

-- Sessions Table (if using database sessions)
ALTER TABLE sessions ADD INDEX idx_user_id (user_id);
ALTER TABLE sessions ADD INDEX idx_last_activity (last_activity);

-- Cache Table (if using database cache)
ALTER TABLE cache ADD INDEX idx_key (key);
ALTER TABLE cache ADD INDEX idx_expiration (expiration);

-- Failed Jobs
ALTER TABLE failed_jobs ADD INDEX idx_failed_at (failed_at);

-- Add indexes for your custom tables
-- Example for posts/articles:
-- ALTER TABLE posts ADD INDEX idx_user_published (user_id, published_at);
-- ALTER TABLE posts ADD INDEX idx_status (status);

-- =========================================
-- 2. ANALYZE AND OPTIMIZE TABLES
-- =========================================

ANALYZE TABLE users;
ANALYZE TABLE sessions;
ANALYZE TABLE cache;

OPTIMIZE TABLE users;
OPTIMIZE TABLE sessions;
OPTIMIZE TABLE cache;

-- =========================================
-- 3. FIND SLOW QUERIES (Enable slow query log first)
-- =========================================

-- Check slow query log status
SHOW VARIABLES LIKE 'slow_query_log';

-- Enable slow query log (requires MySQL restart or SET GLOBAL)
-- SET GLOBAL slow_query_log = 'ON';
-- SET GLOBAL long_query_time = 1; -- Log queries taking > 1 second

-- =========================================
-- 4. CHECK TABLE SIZES AND INDEXES
-- =========================================

SELECT 
    TABLE_NAME,
    ROUND(((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024), 2) AS `Size (MB)`,
    TABLE_ROWS,
    ROUND((INDEX_LENGTH / 1024 / 1024), 2) AS `Index Size (MB)`
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = DATABASE()
ORDER BY (DATA_LENGTH + INDEX_LENGTH) DESC;

-- =========================================
-- 5. CHECK FOR MISSING INDEXES
-- =========================================

SELECT 
    t.TABLE_NAME,
    s.INDEX_NAME,
    s.SEQ_IN_INDEX,
    s.COLUMN_NAME
FROM information_schema.TABLES t
LEFT JOIN information_schema.STATISTICS s 
    ON t.TABLE_SCHEMA = s.TABLE_SCHEMA 
    AND t.TABLE_NAME = s.TABLE_NAME
WHERE t.TABLE_SCHEMA = DATABASE()
    AND t.TABLE_TYPE = 'BASE TABLE'
ORDER BY t.TABLE_NAME, s.INDEX_NAME, s.SEQ_IN_INDEX;

-- =========================================
-- 6. CLEAN UP OLD DATA (Run periodically)
-- =========================================

-- Delete old sessions (older than 30 days)
DELETE FROM sessions WHERE last_activity < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 DAY));

-- Delete expired cache entries
DELETE FROM cache WHERE expiration < UNIX_TIMESTAMP(NOW());

-- Delete old failed jobs (older than 7 days)
DELETE FROM failed_jobs WHERE failed_at < DATE_SUB(NOW(), INTERVAL 7 DAY);

-- =========================================
-- 7. MYSQL CONFIGURATION RECOMMENDATIONS
-- =========================================

-- Add to my.cnf or my.ini:
/*
[mysqld]
# InnoDB Settings
innodb_buffer_pool_size = 1G          # 70-80% of available RAM
innodb_log_file_size = 256M
innodb_flush_log_at_trx_commit = 2    # Better performance, slight risk
innodb_flush_method = O_DIRECT

# Query Cache (MySQL 5.7 and below)
query_cache_type = 1
query_cache_size = 64M
query_cache_limit = 2M

# Connection Settings
max_connections = 200
thread_cache_size = 16

# Table Cache
table_open_cache = 4000
table_definition_cache = 2000

# Temp Tables
tmp_table_size = 64M
max_heap_table_size = 64M

# Slow Query Log
slow_query_log = 1
long_query_time = 1
slow_query_log_file = /var/log/mysql/slow.log
*/

-- =========================================
-- 8. CHECK DATABASE PERFORMANCE
-- =========================================

-- Show current connections
SHOW PROCESSLIST;

-- Show global status
SHOW GLOBAL STATUS LIKE 'Threads_connected';
SHOW GLOBAL STATUS LIKE 'Questions';
SHOW GLOBAL STATUS LIKE 'Slow_queries';

-- Show InnoDB status
SHOW ENGINE INNODB STATUS;

-- =========================================
-- 9. EXAMPLE: EXPLAIN QUERY ANALYSIS
-- =========================================

-- Before optimization (check EXPLAIN)
EXPLAIN SELECT * FROM users WHERE email = 'test@example.com';

-- Should show 'type: const' and 'key: idx_email' if index is used

-- Check for full table scans (type: ALL is bad)
-- EXPLAIN SELECT * FROM users WHERE YEAR(created_at) = 2024;
-- BAD: Function on indexed column prevents index usage

-- GOOD: Use range instead
-- EXPLAIN SELECT * FROM users WHERE created_at >= '2024-01-01' AND created_at < '2025-01-01';

-- =========================================
-- 10. MONITORING QUERIES
-- =========================================

-- Create a stored procedure for monitoring
DELIMITER //
CREATE PROCEDURE check_performance()
BEGIN
    SELECT 'Active Connections:' AS metric, COUNT(*) AS value 
    FROM information_schema.PROCESSLIST;
    
    SELECT 'Table Sizes:' AS metric, 
           TABLE_NAME, 
           ROUND((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024, 2) AS size_mb
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = DATABASE()
    ORDER BY (DATA_LENGTH + INDEX_LENGTH) DESC
    LIMIT 10;
    
    SELECT 'Slow Queries:' AS metric, 
           VARIABLE_VALUE AS value
    FROM information_schema.GLOBAL_STATUS
    WHERE VARIABLE_NAME = 'Slow_queries';
END //
DELIMITER ;

-- Run monitoring
CALL check_performance();

-- =========================================
-- 11. VACUUM/OPTIMIZE SCHEDULE (Cron Job)
-- =========================================

-- Create shell script: /usr/local/bin/optimize_db.sh
/*
#!/bin/bash
mysql -u root -p'password' database_name << EOF
OPTIMIZE TABLE users;
OPTIMIZE TABLE sessions;
OPTIMIZE TABLE cache;
ANALYZE TABLE users;
ANALYZE TABLE sessions;
ANALYZE TABLE cache;
EOF
*/

-- Add to crontab (run weekly):
-- 0 3 * * 0 /usr/local/bin/optimize_db.sh

-- =========================================
-- NOTES:
-- - Run these optimizations during low-traffic periods
-- - Always backup before making schema changes
-- - Monitor query performance with EXPLAIN
-- - Use Laravel Query Builder for automatic query optimization
-- - Consider read replicas for high-traffic applications
-- =========================================
