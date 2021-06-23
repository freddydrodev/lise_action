<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=bellisestyle', 'root', '');
} catch (Exception $e) {
    Die('Erreur : ' . $e->getMessage());
}
