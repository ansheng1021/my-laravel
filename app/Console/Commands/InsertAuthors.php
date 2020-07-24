<?php

namespace App\Console\Commands;

use App\Http\Controllers\poertyAuthorController;
use Illuminate\Console\Command;
class InsertAuthors extends Command
{
    protected $name = 'Insert:info';
    protected $description = '描述一下吧';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $script = new poertyAuthorController();
        $script->poerty();
    }
}
