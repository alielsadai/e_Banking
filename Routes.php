<?php
/**
     * Ova datoteka vraca niz asocijativnih nizova koji predstavljaju rute koje
     * postoje u ovoj aplikaciji.
     * <pre>
     * Svaka ruta je asocijativni niz koji mora da sadrzi indekse:
     *  - Pattern    - Regularni izraz koji treba da odgovara zahtevu da se ruta izvrsi
     *  - Controller - Ime kontrolera koji treba koristiti za odgovor zahtevu.
     *                 Ako je ime kontrolera Index, ime klase je IndexController.
     *                 Kao vrednost ovog indeksa asocijatvinog niza ide samo Main,
     *                 a ne IndexController kako je puno ime klase.
     *  - Method     - Ime metoda izabranog kontrolera koji treba izvrsiti za
     *                 odgovor na pristigli zahtev koji odgovara ovoj ruti.
     * </pre>
     * 
     * Primer:
     * <pre><code>
     * return [
     *   [
     *     'Pattern'    => '|^login/?$|',
     *     'Controller' => 'Index',
     *     'Method'     => 'login'
     *   ],
     *   [
     *     'Pattern'    => '|^logout/?$|',
     *     'Controller' => 'Index',
     *     'Method'     => 'logout'
     *   ],
     *   [ # Poslednja ruta koja ce se izvrsiti ako ni jedna pre ne odgovara pristiglom zahtevu.
     *     'Pattern'    => '|^.*$|',
     *     'Controller' => 'Main',
     *     'Method'     => 'index'
     *   ]
     * ];
     * <code></pre>
     */
    return [
        [
            'Pattern'       => '|^home/?$|',
            'Controller'    => 'Page',
            'Method'        => 'home'
        ],
        [
            'Pattern'       => '|^about-us/?$|',
            'Controller'    => 'Page',
            'Method'        => 'aboutUs'
        ],
        [
            'Pattern'       => '|^contact-us/?$|',
            'Controller'    => 'Page',
            'Method'        => 'contactUs'
        ],
        [
            'Pattern'       => '|^admin/index/?$|',
            'Controller'    => 'Cms',
            'Method'        => 'index'
        ],
        [
            'Pattern'       => '|^admin/add/?$|',
            'Controller'    => 'Cms',
            'Method'        => 'add'
        ],
        [
            'Pattern'       => '|^templates/admin/add/?$|',
            'Controller'    => 'Cms',
            'Method'        => 'addTemplate'
        ],
        [
            'Pattern'       => '|^admin/view/([0-9]+)/?$|',
            'Controller'    => 'Cms',
            'Method'        => 'view'
        ],
        [
            'Pattern'       => '|^templates/admin/edit/?$|',
            'Controller'    => 'Cms',
            'Method'        => 'editTemplate'
        ],
        [
            'Pattern'       => '|^admin/edit/([0-9]+)/?$|',
            'Controller'    => 'Cms',
            'Method'        => 'edit'
        ],
        [
            'Pattern'       => '|^profile/?$|',
            'Controller'    => 'Profile',
            'Method'        => 'index'
        ],
        [
            'Pattern'       => '|^transactionsList/([0-9]+)/?$|',
            'Controller'    => 'Transactions',
            'Method'        => 'transactionsList'
        ],
        [
            'Pattern'       => '|^downloadExcel/([0-9]+)/?$|',
            'Controller'    => 'Transactions',
            'Method'        => 'downloadExcel'
        ],
        [
            'Pattern'       => '|^makeTransaction/([0-9]+)/?$|',
            'Controller'    => 'Transactions',
            'Method'        => 'makeTransaction'
        ],
        [
            'Pattern'       => '|^login/?$|',
            'Controller'    => 'User',
            'Method'        => 'login'
        ],
        [
            'Pattern'       => '|^logout/?$|',
            'Controller'    => 'User',
            'Method'        => 'logout'
        ],
        [ # Poslednja ruta za sve
            'Pattern'       => '|^.*$|',
            'Controller'    => 'Page',
              'Method'        => 'home'
        ]
    ];
