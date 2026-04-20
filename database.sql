CREATE DATABASE kreaplin;
USE kreaplin;

CREATE TABLE hasil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    benar INT,
    salah INT,
    skor INT,
    rata FLOAT,
    durasi INT,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);