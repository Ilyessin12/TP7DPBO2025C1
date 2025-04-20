# Future Gadget Lab Management System

## Janji

Saya Lyan Nazhabil Dzuquwwa dengan NIM 2308428 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Diagram
Berikut merupakan Diagram ERD dari program:
![Diagram Program](desain.jpg)

## Desain Program

Program ini mengimplementasikan sistem manajemen untuk Future Gadget Laboratory dengan konsep Object-Oriented Programming. Terdapat beberapa kelas utama:

1. **LabMember** - Kelas untuk mengelola data anggota laboratorium
   - Atribut: db (instance Database)
   - Method: getAllMembers(), getMembers(), addMember(), updateMember(), deleteMember()

2. **Gadget** - Kelas untuk mengelola data gadget di laboratorium
   - Atribut: db (instance Database)
   - Method: getAllGadgets(), getGadgets(), addGadget(), updateGadget(), deleteGadget()

3. **Experiment** - Kelas untuk mengelola eksperimen yang dilakukan
   - Atribut: db (instance Database)
   - Method: getAllExperiments(), getExperiments(), addExperiment(), updateExperiment(), deleteExperiment()

Setiap kelas mengimplementasikan operasi CRUD (Create, Read, Update, Delete) untuk entitas masing-masing.

## Alur Program

Pertama-tama, terdapat halaman awal atau index page dengan tampilan berikut:
![Tampilan Awal](screenshot3.jpg)
![Tampilan Awal Footer](screenshot11.jpg)

Lalu kita dapat mengunjungi bagian Lab Members, Gadgets, dan juga Experiments, misal kita mengunjungi bagian Gadgets:
![Gadgets](screenshot1.jpg)
Disini kita dapat menambah, menghapus, ataupun mengubah Gadget, misal kita ingin menambah maka tinggal kita isi field untuk menambah gadget baru lalu tinggal klik "Add Gadget"
![Add gadget](screenshot4.jpg)
Lalu jika kita ingin mengubah gadget maka klik salah satu gadget lalu kita tinggal ubah saja seperti kita menambah gadget. Berikut merupakan contohnya:
![Update gadget](screenshot14.jpg)
![Update successful](screenshot9.jpg)
Setelahnya, jika kita ingin menghapus maka kita tinggal klik tombol delete, nanti akan muncul alert apakah ingin menghapus atau tidak, jika diklik iya maka akan dihapus (Note: untuk gadget dan lab member, jika keduanya terdapat di salah satu experiment yang ada maka tidak akan dihapus karena primary key alias id nya sedang dipakai di entitas/class experiment)
![Alert](screenshot23.jpg)
![Delete success](screenshot8.jpg)
Selanjutnya, untuk fitur search kita tinggal memasukkan nama untuk yang Member dan Gadget:
![Search](screenshot22.jpg)
Untuk yang Experiment, tersedia dropdown list untuk member dan gadget yang ingin dicari
![Search Experiment1](screenshot19.jpg)
![Search Experiment2](screenshot20.jpg)
![Search Experiment3](screenshot18.jpg)

## Dokumentasi
Here are some more pictures to look at:
![More pics](screenshot2.jpg)
![More pics](screenshot5.jpg)
![More pics](screenshot6.jpg)
![More pics](screenshot7.jpg)
![More pics](screenshot10.jpg)
![More pics](screenshot12.jpg)
![More pics](screenshot13.jpg)
![More pics](screenshot15.jpg)
![More picsg](screenshot16.jpg)
![More pics](screenshot17.jpg)
![More pics](screenshot21.jpg)