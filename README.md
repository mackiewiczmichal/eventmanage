
## Uruchamianie alikacji

By uruchomić aplikację należy wpierw utworzyć lokalnie bazę danych nazwaną 'laravel'
- Uruchomić następujące komendy
```bash
npm install
```
```bash
composer install
```
Utworzyć plik `.env` i skopiować do niego zawartość z pliku `.env.example`
- następnie przeprowadzić migracje uruchamiając ja komendą 

```bash
php artisan migrate
```
- a po poprawnej migracji uruchomić aplikację komendą
```bash
php artisan serve
```
