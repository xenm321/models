#!/usr/bin/env bash

npm run-script build
if [ $? -ne 0 ]; then
    exit 1
fi

printf "\n******************************************************************\n"
printf "    Validate schema\n"
printf "******************************************************************\n\n"

./bin/console doctrine:schema:validate --skip-sync
if [ $? -ne 0 ]; then
    exit 1
fi


printf "\n******************************************************************\n"
printf "    Drop all tables\n"
printf "******************************************************************\n\n"

./bin/console doctrine:schema:drop --force
if [ $? -ne 0 ]; then
    exit 1
fi

printf "\n******************************************************************\n"
printf "    Delete all migrations\n"
printf "******************************************************************\n\n"

yes y | ./bin/console doctrine:migrations:version --delete --all
if [ $? -ne 0 ]; then
    exit 1
fi


printf "\n******************************************************************\n"
printf "    Create schema\n"
printf "******************************************************************\n\n"

./bin/console doctrine:schema:create
if [ $? -ne 0 ]; then
    exit 1
fi


printf "\n******************************************************************\n"
printf "    Run migrations\n"
printf "******************************************************************\n\n"

yes y | ./bin/console doctrine:migrations:migrate
if [ $? -ne 0 ]; then
    exit 1
fi

printf "\n******************************************************************\n"
printf "    Clear cache\n"
printf "******************************************************************\n\n"

./bin/console cache:clear
if [ $? -ne 0 ]; then
    exit 1
fi

printf "\n******************************************************************\n"
printf "    Clear doctrine orm cache\n"
printf "******************************************************************\n\n"

./bin/console doctrine:cache:clear-query
if [ $? -ne 0 ]; then
    exit 1
fi

./bin/console doctrine:cache:clear-metadata
if [ $? -ne 0 ]; then
    exit 1
fi

./bin/console doctrine:cache:clear-result
if [ $? -ne 0 ]; then
    exit 1
fi

