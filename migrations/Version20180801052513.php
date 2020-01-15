<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Model\Entity\Model;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180801052513 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // ToDo: Временная миграция, удалить

        /**
         * Types:  60 - сумки
         *         61 - сумка КРЖ
         *         68 - чемодан
         *         14 - клатч
         *
         * Brands: 26 - Chanel
         *         35 - Dolce & Gabbana
         *         61 - Louis Vuitton
         *         77 - Prada
         *         82 - Roberto Cavalli
         *         91 - Tiffany & Co
         */

        $data = [
            [1, 60, 26, Model::STATUS_NEW, 'Сумка шанель', 'Супер шумка шанель', 'Описание сумки', '654654166', 255000, 500000, 575, 1],
            [2, 61, 26, Model::STATUS_NEW, 'Крокодиловая сумка шанель', 'Супер шумка шанель мз кожи крокодила', 'Описание крокодиловой сумки', '000164501', 1255000, 2500000, 575, 1],
            [3, 68, 26, Model::STATUS_NEW, 'Чемодан шанель', 'Супер чемодан шанель', 'Описание чемодана', '0654644', 25000, 42000, 1575, 0],
            [4, 68, 26, Model::STATUS_NEW, 'Чемодан шанель2', 'Супер чемодан шанель2', 'Описание чемодана2', '0654644-2', 25000, 42000, 1575, 0],
            [5, 68, 26, Model::STATUS_NEW, 'Чемодан шанель3', 'Супер чемодан шанель3', 'Описание чемодана3', '0654644-3', 25000, 42000, 1575, 0],
            [6, 60, 35, Model::STATUS_PREPARE, 'Сумка шанель', 'Супер шумка шанель', 'Описание сумки', '654654166', 255000, 500000, 575, 1],
            [7, 60, 61, Model::STATUS_PREPARE, 'Сумка Луи Вуитон', 'Супер шумка Луи Вуитон', 'Описание сумки Луи Вуитон', '654654166', 255000, 500000, 575, 1],
            [8, 60, 77, Model::STATUS_ACTIVE, 'Сумка Прада', 'Супер шумка Прада', 'Описание сумки Прада', '654654166', 255000, 500000, 575, 1],
            [9, 60, 82, Model::STATUS_ARCHIVE, 'Сумка Роберто Кавалли', 'Супер шумка Роберто Кавалли', 'Описание сумки Роберто Кавалли', '654654166', 255000, 500000, 575, 1],
            [10, 60, 91, Model::STATUS_ACTIVE, 'Сумка тиффани', 'Супер шумка тиффани', 'Описание сумки тиффани', '654654166', 1255000, 2500000, 790, 0],
        ];

        $values = [];
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        foreach ($data as $row) {
            $values[] = '('
                . $this->connection->quote($row[0]) . ', '  // id
                . $this->connection->quote($row[1]) . ', '  // type_id
                . $this->connection->quote($row[2]) . ', '  // brand_id
                . $this->connection->quote($row[3]) . ', '  // status
                . $this->connection->quote($row[4]) . ', '  // title
                . $this->connection->quote($row[5]) . ', '  // seo_title
                . $this->connection->quote($row[6]) . ', '  // description
                . $this->connection->quote($row[7]) . ', '  // original_articul
                . $this->connection->quote($row[8]) . ', '  // original_price
                . $this->connection->quote($row[9]) . ', '  // original_price_rur
                . $this->connection->quote($row[10]) . ', '  // weight
                . $this->connection->quote($row[11]) . ', ' // gender
                . $this->connection->quote($now) . ')';
        }

        $this->addSql('INSERT INTO models (
            `id`,
            `type_id`,
            `brand_id`,
            `status`,
            `title`,
            `seo_title`,
            `description`,
            `original_articul`,
            `original_price`,
            `original_price_rur`,
            `weight`,
            `gender`,
            `created`) VALUES ' . implode(', ', $values));



        $data = [
            [1, 1, 1, 'Сумка шанель BG', 'Супер шумка шанель BG', 'Описание сумки BG', 'CH21-01', 2500, 204500],
            [2, 1, 2, 'Сумка шанель VT', 'Супер шумка шанель VT', 'Описание сумки VT', 'CH21-01', 2500, 204500],

            [3, 2, 1, 'Крокодиловая сумка шанель BG', 'Супер шумка шанель мз кожи крокодила BG', 'Описание крокодиловой сумки BG', 'CH41-01', 12500, 2204500],
            [4, 2, 2, 'Крокодиловая сумка шанель VT', 'Супер шумка шанель мз кожи крокодила VT', 'Описание крокодиловой сумки VT', 'CH41-01', 12500, 3204500],

            [5, 3, 1, 'Чемодан шанель BG', 'Супер чемодан шанель BG', 'Описание чемодана BG', 'CH41-01', 12500, 2204500],
            [6, 3, 2, 'Чемодан шанель VT', 'Супер чемодан шанель VT', 'Описание чемодана VT', 'CH41-01', 12500, 3204500],

            [7, 7, 1, 'Сумка Луи Вуитон BG', 'Супер шумка Луи Вуитон BG', 'Описание сумки Луи Вуитон BG', 'LV41-01', 812500, 42204500],
            [8, 7, 2, 'Сумка Луи Вуитон VT', 'Супер шумка Луи Вуитон VT', 'Описание сумки Луи Вуитон VT', 'LV41-01', 812500, 43204500],

            [9, 9, 1, 'Сумка Роберто Кавалли BG', 'Супер шумка Роберто Кавалли BG', 'Описание сумки Роберто Кавалли BG', 'RC14-15', 8500, 21000],
            [10, 9, 2, 'Сумка Роберто Кавалли VT', 'Супер шумка Роберто Кавалли VT', 'Описание сумки Роберто Кавалли VT', 'RC14-15', 9500, 31500],

            [11, 8, 1, 'Сумка Прада BG', 'Супер шумка Прада BG', 'Описание супер шумка Прада BG', 'PD11-15', 8500, 21000],
            [12, 8, 2, 'Сумка Прада VT', 'Супер шумка Прада VT', 'Описание супер шумка Прада VT', 'PD11-15', 9500, 31500],

            [13, 10, 1, 'Сумка тиффани BG', 'Супер шумка тиффани BG', 'Описание сумки тиффани BG', 'TF65-15', 8500, 21000],
            [14, 10, 2, 'Сумка тиффани VT', 'Супер шумка тиффани VT', 'Описание сумки тиффани VT', 'TF65-15', 9500, 31500],
        ];

        $values = [];

        foreach ($data as $row) {
            $values[] = '('
                . $this->connection->quote($row[0]) . ', ' // id
                . $this->connection->quote($row[1]) . ', ' // model_id
                . $this->connection->quote($row[2]) . ', ' // shop
                . $this->connection->quote($row[3]) . ', ' // title
                . $this->connection->quote($row[4]) . ', ' // seo_title
                . $this->connection->quote($row[5]) . ', ' // description
                . $this->connection->quote($row[6]) . ', ' // articul
                . $this->connection->quote($row[7]) . ', ' // price
                . $this->connection->quote($row[8]) . ', ' // full_price
                . $this->connection->quote($now) . ')';
        }

        $this->addSql('INSERT INTO models_ext (
            `id`, 
            `model_id`, 
            `shop_id`, 
            `title`, 
            `seo_title`, 
            `description`, 
            `articul`, 
            `price`, 
            `full_price`, 
            `created`) VALUES ' . implode(', ', $values));
    }

    public function down(Schema $schema) : void
    {
    }
}
