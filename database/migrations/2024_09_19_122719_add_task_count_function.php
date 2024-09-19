<?php

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
        \Illuminate\Support\Facades\DB::unprepared('
DROP FUNCTION
IF
	EXISTS task_count;

CREATE FUNCTION task_count (
	user_id INT,
	task_status VARCHAR ( 255 )) RETURNS INT DETERMINISTIC BEGIN
	RETURN ( SELECT COUNT(*) FROM tasks WHERE assigned_to = user_id AND tasks.STATUS = task_status );
END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::unprepared('
DROP FUNCTION
IF
	EXISTS task_count;');
    }
};
