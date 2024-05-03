# TP3DPBO2024C2

/* Saya Talitha Fayarina Adhigunawan [2201271] mengerjakan TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. */

TP3 ini diberikan perintah untuk membuat suatu program dengan spesifikasi berikut:
- Tema program bebas
- Menggunakan minimal 3 buah tabel (kelas)
- Terdapat proses Create, Read, Update, dan Delete data pada setiap tabel
- Minimal Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas) pada salah satu tabel
- Menggunakan template/skin form tambah data dan ubah data yang sama
- 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel atau lebih sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
- Menggunakan template/skin tabel yang sama untuk menampilkan tabel

Program ini mengambil tema Album yang terdiri dari kelas Album, Musisi, dan Label. 
Database Album:
- album: id_album, nama_album, title_track, tahun_rilis, jumlah_lagu, id_musisi (foreign key), id_label(foreign key)
- musisi:  id_musisi, nama_musisi
- label: id_label, nama_label

Pada program ini ditampilkan daftar dari album yang sudah ada di dalam database dan saat diklik akan menampilkan detail dari album tersebut.
Ada juga halaman untuk menambahkan data album, nama musisi serta nama label. Selain bisa menambah, program ini juga bisa mengedit/ubah dan menghapus data.

1. Halaman Home
![Halaman Home](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/39f0e90e-8a4f-4870-a18b-6e1844ca2c30)

2. Halaman Detail
![Halaman Detail](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/b09b3ccf-107f-4db0-8d4f-ba2ac598b26d)

3. Halaman Ubah Album
![Halaman ubahAlbum](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/0bcd5086-11b6-4d96-880a-9471cdd2fdd0)

4. Halaman Tambah Album
![Halaman tambahAlbum](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/a8949a9e-3ad0-4549-8c15-a2672d84cf94)

5. Halaman Tabel Musisi
![Tabel Musisi](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/0ccc65a7-edc4-4c4c-b33f-779a70218286)

6. Halaman Tambah Musisi
![Halaman tambahMusisi](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/acb4eafc-74ca-4898-8152-8b3df64037c2)

7. Halaman Tabel Label
![Tabel Label](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/6e5985ef-f764-44ac-8383-de0f3d4adefa)

8. Halaman Tambah Labek
![Halaman tambahLabel](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/e3d625d0-cf07-4cb3-be75-d75c5b70e7ba)

9. Search nama album "Attacca"
![Saat mau search Attacca](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/029ba428-bb18-492b-904f-367ccdc4c7b5)

10. Attaca berhasil dicari
![Attacca Berhasil dicari](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/d1488877-1149-4c47-9300-627c22f2f52a)

11. Search nama musisi "Seventeen"
![Saat mau seaarch Seventeen](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/4642efa5-8343-4e22-ae29-b9018f8258af)

12. Seventeen berhasil dicari
![Seventeen Berhasil dicari](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/38d97528-b42f-46a1-b121-1a86c607c713)

13. Klik Urutkan A-Z (Ascending)
![Urut Ascending](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/8dc53d48-c9dc-4a8e-98c0-ad68e83599df)

14. Klik Urutkan Z-A (Descending)
![Urut Descending](https://github.com/faayyaa10/TP3DPBO2024C2/assets/114636102/14b27a52-4447-4692-944a-a78888fdb695)
