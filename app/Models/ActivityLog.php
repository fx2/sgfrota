<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_log';
    protected $fillable = [
        'description',
        'subject',
        'causer',
        'properties',
        'setor_id',
        'setor',
        'log_name',
      'subject_type',
      'event',
      'subject_id',
      'causer_type',
      'causer_id',
      'properties',
      'batch_uuid',
      'nome',
    ];


    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'causer_id');
    }

}
