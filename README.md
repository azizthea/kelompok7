# **📋 Dokumentasi Pengujian Fungsional**  

**Proyek:** Sistem Login & Registrasi  
**Versi:** 1.0.0  
**Terakhir Diperbarui:** `2023-11-15`  

---

## **🔍 Daftar Pengujian**  

Berikut adalah tabel pengujian untuk fitur **Login & Registrasi** beserta hasil verifikasinya.  

| No | Deskripsi Kebutuhan | User | Sistem | Status | Bukti Pengujian |
|----|---------------------|------|--------|--------|-----------------|
| 1  | User dapat memilih menu registrasi pada form login | ✔️ | - | ✅ Lulus | [📸 SS1](./evidence/SS1.png) |
| 2  | Sistem menampilkan form registrasi dengan data lengkap | - | ✔️ | ✅ Lulus | [📸 SS2](./evidence/SS2.png) |
| 3  | User menginputkan data diri | ✔️ | - | ✅ Lulus | [📸 SS3](./evidence/SS3.png) |
| 4  | User dapat memilih menu **"Create Akun"** | ✔️ | - | ✅ Lulus | [📸 SS4](./evidence/SS4.png) |
| 5  | Sistem menampilkan form verifikasi | - | ✔️ | ❌ Gagal | [📸 SS5](./evidence/SS5.png) |
| 6  | User menginputkan kode verifikasi | ✔️ | - | ⏳ Dalam Proses | [📸 SS6](./evidence/SS6.png) |
| 7  | Sistem menyimpan data user dan tampilkan halaman login | - | ✔️ | ⏳ Dalam Proses | [📸 SS7](./evidence/SS7.png) |
| 8  | User dapat memilih tombol **Cancel** | ✔️ | - | ✅ Lulus | [📸 SS8](./evidence/SS8.png) |
| 9  | Sistem menampilkan halaman utama | - | ✔️ | ✅ Lulus | [📸 SS9](./evidence/SS9.png) |

---

## **📌 Keterangan Simbol**  
- **✔️** = Bertanggung jawab  
- **-** = Tidak terlibat  
- **✅ Lulus** = Fungsi berhasil diuji  
- **❌ Gagal** = Fungsi tidak bekerja sesuai ekspektasi  
- **⏳ Dalam Proses** = Sedang dalam tahap pengujian  

---

## **⚠️ Masalah yang Ditemukan**  
1. **Form verifikasi (No.5) gagal ditampilkan**  
   - Sistem tidak mengirimkan form verifikasi setelah pendaftaran.  
   - *Solusi sementara:* Memeriksa konfigurasi email server.  

2. **Proses verifikasi kode (No.6-7) belum selesai diuji**  
   - Menunggu perbaikan bug pada No.5 sebelum melanjutkan pengujian.  

---

## **📂 Struktur Direktori**  
```
📁 project-root/
├── 📁 evidence/          # Screenshot pengujian
│   ├── SS1.png          # Bukti pengujian 1
│   ├── SS2.png          # Bukti pengujian 2
│   └── ...              # dst.
├── 📄 README.md         # Dokumen ini
└── 📄 laporan-bug.md    # Catatan bug (opsional)
```

---

## **🛠️ Cara Kontribusi**  
1. Clone repositori:  
   ```bash
   git clone https://github.com/username/repo.git
   ```
2. Jika menemukan bug, buka **Issues** atau laporkan di [laporan-bug.md](./laporan-bug.md).  
3. Untuk pengujian baru, update tabel di **README.md** dan lampirkan screenshot di `/evidence/`.  

---

**© 2023 Tim Pengembang**  
*Dokumen ini diperbarui secara berkala.*  

---

Format ini **siap di-upload ke GitHub** dengan:  
✔️ **Struktur jelas**  
✔️ **Tabel rapi**  
✔️ **Panduan kontribusi**  
✔️ **Dokumentasi bug**  
✔️ **Referensi screenshot**  

Jika butuh penyesuaian, bisa ditambahkan bagian **"Langkah Pengujian"** atau **"Environment Testing"**. 🚀
