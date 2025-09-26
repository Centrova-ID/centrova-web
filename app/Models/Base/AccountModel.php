<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Base model untuk database Account (centrova_account)
 * 
 * Gunakan model ini sebagai parent class untuk semua model
 * yang berinteraksi dengan database centrova_account
 */
abstract class AccountModel extends Model
{
    /**
     * Koneksi database yang digunakan
     */
    protected $connection = 'account';

    /**
     * Timestamps default Laravel
     */
    public $timestamps = true;

    /**
     * Format tanggal yang digunakan
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Kolom yang dapat diisi secara massal
     * Override di model turunan sesuai kebutuhan
     */
    protected $fillable = [];

    /**
     * Kolom yang disembunyikan saat serialization
     */
    protected $hidden = [];

    /**
     * Kolom yang di-cast ke tipe data tertentu
     */
    protected $casts = [];
}
