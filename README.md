# Future Gadget Lab Management System

## Janji

Saya Lyan Nazhabil Dzuquwwa dengan NIM 2308428 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Diagram
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


## Dokumentasi

![Screenshot 1](screenshot1.jpg)