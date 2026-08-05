<?php
/**
 * YONBUS — PHP Database SQL Dump Generator
 * Run: php scripts/dump_sql.php
 * Output: yonbus_export.sql (in the project root)
 *
 * This generates a phpMyAdmin-compatible SQL file including:
 *  - Database creation
 *  - All table structures (CREATE TABLE)
 *  - All data (INSERT INTO)
 */

// ── Bootstrap Laravel ──────────────────────────────────────────
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// ── Config ─────────────────────────────────────────────────────
$dbName     = env('DB_DATABASE', 'yonbus');
$outputFile = __DIR__ . '/../yonbus_export.sql';

echo "[YONBUS] Generating SQL export for database: $dbName\n";

$sql = [];

// ── Header ─────────────────────────────────────────────────────
$sql[] = "-- ============================================================";
$sql[] = "-- YONBUS Tax & Accounting Services — Full Database Export";
$sql[] = "-- Generated: " . date('Y-m-d H:i:s');
$sql[] = "-- Import into phpMyAdmin: Import tab → select this file → Go";
$sql[] = "-- ============================================================";
$sql[] = "";
$sql[] = "SET NAMES utf8mb4;";
$sql[] = "SET FOREIGN_KEY_CHECKS=0;";
$sql[] = "SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';";
$sql[] = "SET time_zone='+00:00';";
$sql[] = "";
$sql[] = "-- Create database if it doesn't exist";
$sql[] = "CREATE DATABASE IF NOT EXISTS \`$dbName\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
$sql[] = "USE \`$dbName\`;";
$sql[] = "";

// ── Get all tables in correct order ────────────────────────────
$tables = DB::select('SHOW TABLES');
$tableKey = 'Tables_in_' . $dbName;
$tableNames = array_map(fn($t) => $t->$tableKey, $tables);

echo "[INFO] Found " . count($tableNames) . " tables\n";

foreach ($tableNames as $table) {
    echo "  → Exporting table: $table\n";

    // ── DROP + CREATE TABLE ────────────────────────────────────
    $sql[] = "-- ──────────────────────────────────────────────────────────";
    $sql[] = "-- Table: `$table`";
    $sql[] = "-- ──────────────────────────────────────────────────────────";
    $sql[] = "DROP TABLE IF EXISTS \`$table\`;";

    $createResult = DB::select("SHOW CREATE TABLE `{$table}`");
    $createRow = (array) $createResult[0];
    $createStatement = $createRow['Create Table'] ?? $createRow[array_key_last($createRow)] ?? '';

    $sql[] = $createStatement . ";";
    $sql[] = "";

    // ── INSERT DATA ────────────────────────────────────────────
    $rows = DB::table($table)->get();
    if ($rows->isEmpty()) {
        $sql[] = "-- (no data in $table)";
        $sql[] = "";
        continue;
    }

    $columns = array_keys((array) $rows->first());
    $colList  = implode(', ', array_map(fn($c) => "\`$c\`", $columns));

    $chunks = $rows->chunk(50);
    foreach ($chunks as $chunk) {
        $valueRows = $chunk->map(function ($row) {
            $values = array_map(function ($val) {
                if ($val === null) return 'NULL';
                if (is_int($val) || is_float($val)) return $val;
                // Escape the string
                return "'" . addslashes($val) . "'";
            }, (array) $row);
            return '(' . implode(', ', $values) . ')';
        });

        $sql[] = "INSERT INTO \`$table\` ($colList) VALUES";
        $sql[] = implode(",\n", $valueRows->toArray()) . ";";
        $sql[] = "";
    }
}

// ── Footer ─────────────────────────────────────────────────────
$sql[] = "";
$sql[] = "SET FOREIGN_KEY_CHECKS=1;";
$sql[] = "";
$sql[] = "-- ============================================================";
$sql[] = "-- Export complete. Admin login: admin@admin.com / admin";
$sql[] = "-- ============================================================";

// ── Write file ─────────────────────────────────────────────────
file_put_contents($outputFile, implode("\n", $sql));
$size = filesize($outputFile);
echo "\n[SUCCESS] Export saved to: yonbus_export.sql ($size bytes)\n";
echo "[INFO] Import this file into phpMyAdmin to set up your cPanel database.\n";
echo "[INFO] Admin credentials: admin@admin.com / admin\n\n";
