<?php declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Direction;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use App\Entity\Shop;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180729173822 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $data = [
            ['BagsBoutique', Shop::SHOP_BG, 'Интернет-бутик итальянских сумок Bags Boutique'],
            ['VipTime', Shop::SHOP_VT, 'Интернет-салон элитных часов Vip-TimeClub'],
            ['LifeBox', Shop::SHOP_LB, 'LifeBox'],
        ];

        $values = [];
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        foreach ($data as $row) {
            $values[] = '('
                . $this->connection->quote($row[0]) . ', '
                . $this->connection->quote($row[1]) . ', '
                . $this->connection->quote($row[2]) . ', '
                . $this->connection->quote($now) . ')';
        }

        $this->addSql('INSERT INTO shops (title, code, description, created) VALUES ' . implode(', ', $values));


        $data = [
            ['Италия', Direction::DIRECTION_ITALY],
            ['Москва', Direction::DIRECTION_MOSCOW]
        ];

        $values = [];
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        foreach ($data as $row) {
            $values[] = '('
                . $this->connection->quote($row[0]) . ', '
                . $this->connection->quote($row[1]) . ', '
                . $this->connection->quote($now) . ')';
        }

        $this->addSql('INSERT INTO purchase_directions (title, code, created) VALUES ' . implode(', ', $values));


        $data = [
            ['DAN ER SI ACCESSORIES', 'Trade center baiyun world leather jiefang north road gz 3a003', 1],
            ['OUPIN SHOP', 'Trade center baiyun world leather jiefang north road gz 2a128', 1],
            ['LUO HAO QIN', 'Trade center baiyun world leather jiefang north road gz 1a030', 1],
            ['JING ZANG', 'Trade center baiyun world leather jiefang north road gz -a039', 1],
            ['Jenny', 'optical market', 1],
            ['Kindo', 'зонты', 1],
            ['Haizhu', 'зонты Chanel, Hermes, Gucci', 1],
            ['Ray Lee', '', 1],
            ['Vivian', '', 1],
            ['Azur', 'ремни кожа и крж', 1],
            ['Sjao Chi', '', 1],
            ['Lin Lin', 'на проходе минус 1 старый сумочный', 1]
        ];

        $values = [];
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        foreach ($data as $row) {
            $values[] = '('
                . $this->connection->quote($row[0]) . ', '
                . $this->connection->quote($row[1]) . ', '
                . $row[2] . ', '
                . $this->connection->quote($now) . ')';
        }

        $this->addSql('INSERT INTO suppliers (title, description, direction_id, created) VALUES ' . implode(', ', $values));
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
