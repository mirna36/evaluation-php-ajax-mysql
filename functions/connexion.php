<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=multiply_game_db;charset=utf8', 'root', '');
} catch (Exception $e) {
    exit('Erreur: ' . $e->getMessage());
}