<?php

it('redirige la page d\'accueil vers les tâches', function () {
    $this->get('/')->assertRedirect('/tasks');
});
