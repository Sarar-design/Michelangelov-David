DROP DATABASE IF EXISTS michelangelo_quiz;
CREATE DATABASE michelangelo_quiz CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE michelangelo_quiz;

CREATE TABLE vprasanja (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    vprasanje TEXT NOT NULL,
    tip ENUM('select','radio','checkbox','text') NOT NULL DEFAULT 'select',
    odgovori TEXT NULL,
    pravilni_odgovor TEXT NOT NULL,
    vrstni_red INT(11) NOT NULL DEFAULT 0,
    aktivno TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE quiz_rezultati (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(150) NOT NULL,
    tocke INT(11) NOT NULL,
    skupaj INT(11) NOT NULL,
    odstotek DECIMAL(5,2) NOT NULL,
    cas_sekund INT(11) DEFAULT NULL,
    odgovori_json TEXT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin_users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO vprasanja (vprasanje, tip, odgovori, pravilni_odgovor, vrstni_red) VALUES
(
    'Kam je bil kip Davida sprva namenjen, preden so ga postavili na mestni trg?',
    'select',
    '["Na vrh katedrale","Na dvorišče samostana","V zasebno palačo Medičejcev","Pred cerkev San Marco"]',
    '"Na vrh katedrale"',
    1
),
(
    'Kateri trenutek iz biblijske zgodbe predstavlja Michelangelov David?',
    'select',
    '["Trenutek tik preden zaluča kamen v Goljata.","Trenutek, ko zamahne z Goljatovim mečem, da bi ga ubil.","Trenutek, ko Goljata premaga in njegova glava leži pri Davidovih nogah.","Trenutek, preden David steče k Goljatu, potem ko zaluča kamen."]',
    '"Trenutek tik preden zaluča kamen v Goljata."',
    2
),
(
    'Ali je bila golota pogost element v renesančni umetnosti?',
    'radio',
    '["Da","Ne"]',
    '"Ne"',
    3
),
(
    'Kaj je kip Davida predstavljal za Firence?',
    'checkbox',
    '["Moč","Svoboda","Pogum","Bil je varuh mesta"]',
    '["Moč","Bil je varuh mesta"]',
    4
),
(
    'Kaj je kontrapost?',
    'select',
    '["Metoda kiparjenja s pretiranimi proporci, ki poudarjajo čustveno intenzivnost.","Kiparski pristop, pri katerem je človeška figura upodobljena v spiralnem zasuku.","Drža skulpture v podobi človeka, ki daje iluzijo, da je telo v gibanju.","Pristop, ki ne vključuje človeških figur."]',
    '"Drža skulpture v podobi človeka, ki daje iluzijo, da je telo v gibanju."',
    5
);