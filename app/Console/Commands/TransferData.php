<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TransferData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
protected $signature = 'transfer:data';

    /**
     * The console command description.
     *
     * @var string
     */
protected $description = 'Transfer data from SQLite to MySQL';

    /**
     * Execute the console command.
     */
public function handle()
{
    $this->info('Starting SQLite → MySQL data transfer...');

    $tablesOrder = [
        'users',
        'cities',
        'movies',
        'theatres',
        'shows',
        'bookings',
        'ratings' // Last to handle FK dependencies
    ];

    $sqlite = \DB::connection('sqlite');
    $mysql = \DB::connection('mysql');

    foreach ($tablesOrder as $table) {
        $this->transferTable($sqlite, $mysql, $table);
    }

    $this->info('✅ Data transfer completed successfully!');

    return self::SUCCESS;
}

private function transferTable($sqlite, $mysql, $table)
{
    $count = $sqlite->table($table)->count();

    if ($count === 0) {
        $this->warn("⚠️  Skipping empty table: {$table}");
        return;
    }

    $this->info("📊 Transferring {$table} ({$count} records)...");

    $records = $sqlite->table($table)->get();

    foreach ($records as $record) {
$mysql->table($table)->insertOrIgnore((array) $record);
    }

    $this->info("✅ {$table} transferred successfully ({$count} records)");
}

}
