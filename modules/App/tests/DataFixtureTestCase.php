<?php

namespace App\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Client;

class DataFixtureTestCase extends WebTestCase
{
    /**
     * @var Application
     */
    protected static $application;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var Client
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::runCommand('doctrine:database:drop --force');
        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:create');
        self::runCommand('doctrine:fixtures:load --no-interaction');

        static::bootKernel();

        $this->entityManager = self::$container->get('doctrine.orm.entity_manager');
        $this->client = $this->createAuthenticatedClient();

        parent::setUp();
    }

    protected static function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    protected static function getApplication()
    {
        if (null === self::$application) {
            $client = static::createClient();

            self::$application = new Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    protected function getJson(string $url)
    {
        $this->client->request('GET', $url);

        return json_decode($this->client->getResponse()->getContent(), true);
    }

    protected function post(string $url, array $data = [], bool $isJson = false): Response
    {
        $headers = [];
        $content = '';

        if($isJson) {
            $headers['CONTENT_TYPE'] = 'application/json';
            $content = json_encode($data);
            $data = [];
        }

        $this->client->request('POST', $url, $data, [], $headers, $content);

        return $this->client->getResponse();
    }

    protected function put(string $url, array $data = []): Response
    {
        $this->client->request('PUT', $url, $data);

        return $this->client->getResponse();
    }

    protected function delete(string $url): Response
    {
        $this->client->request('DELETE', $url);

        return $this->client->getResponse();
    }

    protected function getSerializer(): SerializerInterface
    {
        if (null === $this->serializer) {
            $this->serializer = self::$container->get('serializer');
        }

        return $this->serializer;
    }

    protected function makeEntity($type, array $data)
    {
        $brand = $this->getSerializer()->deserialize(json_encode($data), $type, 'json');

        return $brand;
    }

    protected function createEntity($type, array $data)
    {
        $entity = $this->getSerializer()->deserialize(json_encode($data), $type, 'json');

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    protected function createAuthenticatedClient($username = 'admin', $password = 'admin')
    {
        $userData = [
            'username' => $username,
            'password' => $password,
        ];

        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($userData)
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        self::runCommand('doctrine:database:drop --force');

        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
