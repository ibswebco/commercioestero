<?php

use IBSWebCO\CommercioEstero\BrowserClient;

beforeEach(function() {
    $this->ce = new BrowserClient(); 
});

dataset('utenti', [
    [
        'username' => 'TXIFSD',
        'password' => 'X4nZtc?SDGz2',
    ]
]);

describe('CE browser client', function() {
    test('effettua login', function(string $username, string $password) {
        $login = $this->ce->login(username: $username, password: $password);
        expect($login)->toContain('Benvenuto');
    })->with('utenti');

    test('legge elenco tipoPratica', function() {
        expect($this->ce->tipoPratica())->toBeString(); //array()->toHaveCount(6);
    });

    test('effettua logout', function() {
        expect($this->ce->logout())->toContain('correttamente');
    });     
});
