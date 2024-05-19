<?php
require_once "connection_db.php";
require_once "header.php";
?>
<div class="form-group">
                <label for="cardholder-name">Nome del Titolare</label>
                <input type="text" id="cardholder-name" name="cardholder-name" required>
            </div>
            <div class="form-group">
                <label for="card-number">Numero della Carta</label>
                <input type="text" id="card-number" name="card-number" required pattern="\d{16}" title="Il numero della carta deve contenere 16 cifre">
            </div>
            <div class="form-group">
                <label for="expiry-date">Data di Scadenza</label>
                <input type="month" id="expiry-date" name="expiry-date" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required pattern="\d{3}" title="Il CVV deve contenere 3 cifre">
            </div>
            <div class="form-group">
                <input type="submit" value="Invia">
