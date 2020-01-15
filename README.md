<h1>Установка</h1>
<ul>
    <li>git clone ...</li>
    <li>yarn</li>
    <li>composer install</li>
    <li>npm run-script build</li>
    <li>Создать .env файл, можно пока копию .env.dist</li>
    <li>php bin/console doctrine:database:create</li>
    <li>php bin/console doctrine:schema:create</li>
    <li>php bin/console doctrine:migrations:migrate</li>
    <li>php bin/console doctrine:fixtures:load</li>
    <li>php bin/console server:start</li>
</ul>


openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem