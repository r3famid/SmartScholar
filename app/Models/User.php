<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'jenjang',
        'nim',
        'nisn',
        'jurusan',
        'semester',
        'ipk',
        'universitas',
        'sekolah',
        'kelas',
        'last_education',
        'skills',
        'experience',
        'organisasi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials;
    }

    public function getJenjangLabelAttribute()
    {
        return match ($this->jenjang) {
            'smp' => 'SMP',
            'sma' => 'SMA',
            'smk' => 'SMK',
            'kuliah' => 'Kuliah',
            'tidak_bekerja' => 'Tidak Berkuliah',
            default => '-',
        };
    }

    public function getSubtitleAttribute()
    {
        if ($this->jenjang === 'kuliah') {
            return ($this->jurusan ?? 'Mahasiswa') . ' — Sem ' . ($this->semester ?? '?');
        }
        if (in_array($this->jenjang, ['sma', 'smk', 'smp'])) {
            return ($this->jurusan ?? $this->jenjang_label) . ' Kelas ' . ($this->kelas ?? '?') . ' — ' . ($this->sekolah ?? '-');
        }
        return $this->last_education ?? 'Tidak Berkuliah';
    }
}
