<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExportDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export-sql {--filename= : Custom filename for the export} {--mysql : Export data formatted for MySQL/phpMyAdmin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export the SQLite database schema and all table data into a clean .sql dump file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database export...');

        $isMysql = $this->option('mysql');

        $backupDir = database_path('backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $timestamp = date('Y-m-d_H-i-s');
        $defaultPrefix = $isMysql ? "database_mysql_data_{$timestamp}" : "database_dump_{$timestamp}";
        $filename = $this->option('filename') ?: "{$defaultPrefix}.sql";
        if (!str_ends_with($filename, '.sql')) {
            $filename .= '.sql';
        }

        $outputPath = $backupDir . DIRECTORY_SEPARATOR . $filename;

        $tables = DB::select("SELECT name, sql FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name NOT LIKE 'migrations' ORDER BY name;");

        $sqlContent = "-- ========================================================\n";
        $sqlContent .= "-- PT. ANUGERAH TAMA SEJATI - DATABASE SQL EXPORT DUMP" . ($isMysql ? " (MySQL Mode)\n" : "\n");
        $sqlContent .= "-- Export Date: " . date('Y-m-d H:i:s') . "\n";
        $sqlContent .= "-- Total Tables: " . count($tables) . "\n";
        $sqlContent .= "-- ========================================================\n\n";

        if ($isMysql) {
            $sqlContent .= "SET FOREIGN_KEY_CHECKS = 0;\n";
            $sqlContent .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n\n";
        } else {
            $sqlContent .= "PRAGMA foreign_keys = OFF;\n\n";
        }

        $bar = $this->output->createProgressBar(count($tables));
        $bar->start();

        foreach ($tables as $table) {
            $tableName = $table->name;
            $tableSql = $table->sql;

            $sqlContent .= "-- --------------------------------------------------------\n";
            $sqlContent .= "-- Data for `{$tableName}`\n";
            $sqlContent .= "-- --------------------------------------------------------\n";

            if (!$isMysql) {
                $sqlContent .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                $sqlContent .= $tableSql . ";\n\n";
            }

            // Export rows
            $rows = DB::table($tableName)->get();
            if ($rows->isNotEmpty()) {
                $sqlContent .= "-- Data for `{$tableName}` (" . $rows->count() . " rows)\n";

                foreach ($rows as $row) {
                    $rowArray = (array) $row;
                    $columns = array_keys($rowArray);
                    $quotedColumns = array_map(fn($c) => "`{$c}`", $columns);

                    $values = array_map(function ($val) {
                        if (is_null($val)) {
                            return 'NULL';
                        }
                        if (is_numeric($val) && !str_starts_with((string)$val, '0')) {
                            return $val;
                        }
                        return "'" . str_replace("'", "''", (string)$val) . "'";
                    }, array_values($rowArray));

                    $sqlContent .= "INSERT INTO `{$tableName}` (" . implode(', ', $quotedColumns) . ") VALUES (" . implode(', ', $values) . ");\n";
                }
                $sqlContent .= "\n";
            }

            $bar->advance();
        }

        if ($isMysql) {
            $sqlContent .= "SET FOREIGN_KEY_CHECKS = 1;\n";
        } else {
            $sqlContent .= "PRAGMA foreign_keys = ON;\n";
        }

        File::put($outputPath, $sqlContent);

        // Also make a companion direct copy of database.sqlite
        $sqliteBackupName = "database_{$timestamp}.sqlite";
        $sqliteBackupPath = $backupDir . DIRECTORY_SEPARATOR . $sqliteBackupName;
        File::copy(database_path('database.sqlite'), $sqliteBackupPath);

        $bar->finish();
        $this->newLine(2);

        $this->info("Database exported successfully!");
        $this->line("<comment>SQL Dump File:</comment> {$outputPath} (" . number_format(filesize($outputPath) / 1024, 2) . " KB)");
        $this->line("<comment>SQLite Backup Copy:</comment> {$sqliteBackupPath} (" . number_format(filesize($sqliteBackupPath) / 1024, 2) . " KB)");

        return Command::SUCCESS;
    }
}
