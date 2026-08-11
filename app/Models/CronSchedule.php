<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronSchedule extends Model
{
    protected $table = 'cron_schedules';

    // Campos que pueden ser modificados de forma masiva
    protected $fillable = ['hora_ejecucion'];
}
