<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contact;
use Carbon\Carbon;

class DeleteExpiredContacts extends Command
{
    protected $signature = 'contacts:delete-expired';
    protected $description = 'Delete contact messages older than 1 month';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Calculate the date 1 month ago
        $expirationDate = Carbon::now()->subMonth();

        // Delete contacts older than 1 month
        $deletedCount = Contact::where('created_at', '<', $expirationDate)->delete();

        $this->info("Deleted {$deletedCount} expired contact messages.");
    }
}