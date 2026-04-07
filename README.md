# project-gitlab

Contoh mini project PHP untuk UTS Agile Software Development.
Fokusnya:
- Automation test untuk menstandarkan kualitas kode sebelum merge ke branch utama.
- Simulasi task management sederhana (CRUD task).
- Demo alur version control dengan Git Flow sampai merge.

## Struktur Folder

```text
project-gitlab/
|
|-- index.php
|-- test.php
|-- .github/
|   `-- workflows/
|       `-- php-ci.yml
|-- README.md
`-- crud/
    |-- create.php
    |-- read.php
    |-- update.php
    |-- delete.php
    |-- task_service.php
    |-- storage.php
    `-- tasks.json
```

## Penjelasan Project

- `index.php`: tampilan web sederhana untuk membuat, melihat, update, dan delete task.
- `crud/*.php`: endpoint CRUD.
- `crud/task_service.php`: business logic CRUD agar bisa dipakai aplikasi dan test.
- `test.php`: automation test (tanpa framework) untuk validasi fungsi create/read/update/delete.
- `.github/workflows/php-ci.yml`: workflow GitHub Actions untuk lint PHP dan automation test.

## Menjalankan Project (Local)

```bash
php -S localhost:8000
```

Buka: `http://localhost:8000/index.php`

Jalankan test:

```bash
php test.php
```

## Pipeline CI (Automation Test)

Workflow pada `.github/workflows/php-ci.yml` akan:
1. Menjalankan lint untuk semua file PHP.
2. Menjalankan test otomatis melalui `test.php`.

Tujuannya: kode baru wajib lolos quality gate sebelum masuk branch utama (`main/master`).

## Version Control + Git Flow (Demo Sampai Merge)

Contoh langkah di GitHub:

```bash
git init
git checkout -b main
git add .
git commit -m "chore: initial project"

git checkout -b develop
git push -u origin main
git push -u origin develop

# mulai fitur baru
git checkout -b feature/crud-improvement
git add .
git commit -m "feat: improve CRUD task"
git push -u origin feature/crud-improvement
```

Lalu buat Pull Request:
- source: `feature/crud-improvement`
- target: `develop`
- CI harus hijau (lint + test pass)
- lakukan code review
- merge ke `develop`

Setelah siap rilis:

```bash
git checkout main
git merge --no-ff develop -m "merge: release develop to main"
git push origin main
```

## Task Management dan Tools Agile

Contoh tools yang dipakai:
- `GitHub Projects` untuk Kanban board.
- `Issues` untuk backlog item.
- `Pull Request` untuk code review.
- `CI/CD Pipeline` untuk quality gate otomatis.

Contoh board singkat:
- To Do: "Tambah validasi input"
- In Progress: "Refactor service CRUD"
- Done: "Setup pipeline lint + test"

Dengan flow ini, tim bisa menjaga standar kode, kolaborasi lebih aman, dan merge ke branch utama lebih terkontrol.
