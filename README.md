# Konferencijų administravimo sistema

Laravel 12 programa, skirta konferencijoms rodyti ir administruoti. Svečias gali matyti sąrašą ir konferencijos informaciją. Prisijungęs administratorius gali kurti, redaguoti ir šalinti įrašus. Šalinimas patvirtinamas „SweetAlert2“ lange.

## Reikalavimai

- PHP 8.2 ar naujesnė versija ir Composer
- Node.js, NPM
- SQLite arba kita Laravel palaikoma vietinė duomenų bazė

## Paleidimas

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
```

Prieš vykdydami „Seeder“, faile `.env` nustatykite `ADMIN_EMAIL` ir `ADMIN_PASSWORD`. Šie duomenys naudojami vietinei administratoriaus paskyrai sukurti. Slaptažodžio nekelkite į „Git“.

```bash
php artisan migrate --seed
npm ci --legacy-peer-deps
npm run build
php artisan serve
```

Atidarykite `http://127.0.0.1:8000`. Prisijungimo puslapis: `/login`. Pavyzdines konferencijas sukuria `ConferenceSeeder`. Jei naudojate MySQL, `.env` faile nustatykite `DB_CONNECTION=mysql` ir prisijungimo parametrus, tada sukurkite duomenų bazę ir vykdykite migracijas.

## Patikrinimas

```bash
php artisan test
./vendor/bin/pint --test
npm run build
```

## Projekto struktūra

- `ConferenceController` – konferencijų sąrašas, peržiūra, kūrimas, redagavimas ir šalinimas.
- `AuthController` – prisijungimas ir atsijungimas.
- `StoreConferenceRequest` ir `UpdateConferenceRequest` – serverio validacija.
- `resources/views/conferences/fields.blade.php` – bendri kūrimo ir redagavimo laukų rodiniai.
- `lang/lt` – naudotojui rodomi tekstai.
- `resources/css/app.scss` ir `resources/js/app.js` – stiliai ir JavaScript. „Laravel Mix“ surenka juos į `public/css` ir `public/js`.
- `config/conference.php` – administratoriaus duomenų konfigūracija iš `.env`.

Programa naudoja „Bootstrap“ CSS biblioteką ir „SweetAlert2“ JavaScript biblioteką. Žurnalai nustatyti kasdieniais failais per `LOG_CHANNEL=daily`.
