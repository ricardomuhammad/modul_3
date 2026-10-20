<?php
declare(strict_types=1);
require_once __DIR__ . '/Mahasiswa.php';
 
class DataMahasiswa
{
    /** @var array<string, Mahasiswa> */
    private array $data = [];
 
    public function __construct(array $data = [])
    {
        foreach ($data as $nim => $item) {
            if ($item instanceof Mahasiswa) {
                $this->data[(string) $nim] = $item;
            }
        }
    }
 
    public function tambah(Mahasiswa $mahasiswa): bool
    {
        if (isset($this->data[$mahasiswa->nim])) return false;
        $this->data[$mahasiswa->nim] = $mahasiswa;
        return true;
    }
 
    /** @return array<string, Mahasiswa> */
    public function semua(): array { return $this->data; }
 
    public function cari(string $nim): ?Mahasiswa
    {
        return $this->data[$nim] ?? null;
    }
 
    public function ubah(string $nimLama, Mahasiswa $baru): bool
    {
        if (!isset($this->data[$nimLama])) return false;
        if ($nimLama !== $baru->nim && isset($this->data[$baru->nim])) return false;
        unset($this->data[$nimLama]);
        $this->data[$baru->nim] = $baru;
        return true;
    }
 
    public function hapus(string $nim): bool
    {
        if (!isset($this->data[$nim])) return false;
        unset($this->data[$nim]);
        return true;
    }
 
    // ===== METHOD PUBLIK BARU (Tugas Praktikum) =====
 
    /** Mengembalikan jumlah mahasiswa yang tersimpan di array private $data. */
    public function jumlahMahasiswa(): int
    {
        return count($this->data);
    }
 
    /**
     * Mencari mahasiswa berdasarkan program studi (tidak peka huruf besar/kecil,
     * boleh sebagian kata).
     * @return array<string, Mahasiswa>
     */
    public function cariBerdasarkanProdi(string $prodi): array
    {
        $hasil = [];
        foreach ($this->data as $nim => $mhs) {
            if (stripos($mhs->prodi, $prodi) !== false) {
                $hasil[$nim] = $mhs;
            }
        }
        return $hasil;
    }
    
}
