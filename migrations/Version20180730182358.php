<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Model\Entity\Dictionary\Type;
use Model\Model\PurchaseConfig\ItalyPurchaseConfig;
use Model\Model\PurchaseConfig\MoscowPurchaseConfig;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730182358 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $data = [
            ['Балахон', Type::TYPE_LOOSE_OVERALL, '37'],
            ['Банный халат', Type::TYPE_BATHROBE, '36'],
            ['Барсетка', Type::TYPE_MAN_BAG, '14'],
            ['Блузка', Type::TYPE_BLOUSE, '44'],
            ['Браслет', Type::TYPE_BRACELET, '10'],
            ['Брендовая коробка', Type::TYPE_BRAND_BOX, '20'],
            ['Брошь', Type::TYPE_BROOCH, '10'],
            ['Визитница', Type::TYPE_BUSINESS_CARD_CASE, '55'],
            ['Дипломат', Type::TYPE_DIPLOMAT, '01'],
            ['Дорожная сумка', Type::TYPE_TRAVEL_BAG, '15'],
            ['Ежедневник', Type::TYPE_DATEBOOK, '26'],
            ['Запонки', Type::TYPE_CUFFLINKS, '19'],
            ['Зонт', Type::TYPE_UMBRELLA, '22'],
            ['Клатч', Type::TYPE_CLUTCH, '02'],
            ['Ключница', Type::TYPE_KEY_BAG, '10'],
            ['Кольцо', Type::TYPE_RING, '10'],
            ['Конверт', Type::TYPE_ENVELOPE, '52'],
            ['Коробка для браслетов', Type::TYPE_BRACELET_BOX, '16'],
            ['Коробка для бус', Type::TYPE_BEADS_BOX, '16'],
            ['Коробка для колец', Type::TYPE_RING_BOX, '16'],
            ['Коробка для подвески', Type::TYPE_PENDANT_BOX, '16'],
            ['Коробка для сережек', Type::TYPE_EARRINGS_BOX, '16'],
            ['Коробка под часы', Type::TYPE_WATCH_BOX, '16'],
            ['Косметичка', Type::TYPE_BEAUTY_BAG, '11'],
            ['Костюм', Type::TYPE_SUITE, '43'],
            ['Кошелек', Type::TYPE_PURSE, '03'],
            ['Кошелёк КРЖ', Type::TYPE_PURSE_KRJ, '03'],
            ['Культовая сумка', Type::TYPE_CULT_BAG, '01'],
            ['Мужской портфель', Type::TYPE_BRIEFCASE, '14'],
            ['Муфта для платков', Type::TYPE_SHAWL_CLUTCH, '08'],
            ['Наборы украшений', Type::TYPE_JEWELRY_SET, '10'],
            ['Наволочка', Type::TYPE_PILLOWCASE, '38'],
            ['Несессер', Type::TYPE_DRESSING_BAG, '25'],
            ['Обложка для паспорта', Type::TYPE_PASSPORT_CASE, '23'],
            ['Обувь', Type::TYPE_SHOES, '52'],
            ['Обувь КРЖ', Type::TYPE_SHOES_KRJ, '52'],
            ['Органайзер', Type::TYPE_ORGANISER, '11'],
            ['Очки', Type::TYPE_GLASSES, '04'],
            ['Палантин', Type::TYPE_TIPPET, '09'],
            ['Папка для документов', Type::TYPE_DOCUMENT_BAG, '14'],
            ['Парео', Type::TYPE_PAREO, '12'],
            ['Перчатки', Type::TYPE_GLOVES, '17'],
            ['Пижама', Type::TYPE_PAJAMAS, '39'],
            ['Платок', Type::TYPE_SHAWL, '09'],
            ['Платье', Type::TYPE_DRESS, '42'],
            ['Плед', Type::TYPE_RUG, '34'],
            ['Повязка на голову', Type::TYPE_HEADBAND, '31'],
            ['Подвеска', Type::TYPE_PENDANT, '10'],
            ['Полотенце', Type::TYPE_TOWEL, '38'],
            ['Пончо', Type::TYPE_PONCHO, '41'],
            ['Портмоне для документов', Type::TYPE_PORTFOLIO, '24'],
            ['Портупея', Type::TYPE_SWORD_BELT, '26'],
            ['Постельное белье', Type::TYPE_BED_CLOTHES, '35'],
            ['Почтальонка', Type::TYPE_MESSENGER_BAG, '14'],
            ['Ремень', Type::TYPE_BELT, '07'],
            ['Ремень КРЖ', Type::TYPE_BELT_KRJ, '07'],
            ['Рюкзак', Type::TYPE_BACKPACK, '01'],
            ['Серьги', Type::TYPE_EARRINGS, '10'],
            ['Спортивная сумка', Type::TYPE_SPORT_BAG, '14'],
            ['Сумка', Type::TYPE_BAG, '01'],
            ['Сумка КРЖ', Type::TYPE_BAG_KRJ, '01'],
            ['Халат', Type::TYPE_DRESSING_GOWN, '40'],
            ['Чайный сервиз', Type::TYPE_TEA_SET, '30'],
            ['Часы', Type::TYPE_WATCH, '33'],
            ['Часы золотые', Type::TYPE_GOLD_WATCH, '33'],
            ['Часы-браслет', Type::TYPE_WRISTLET_WATCH, '13'],
            ['Часы-дубликаты', Type::TYPE_DUPLICATES_WATCH, '27'],
            ['Чемодан', Type::TYPE_SUITCASE, '15'],
            ['Чехол', Type::TYPE_PHONE_CASE, '05'],
            ['Шарф', Type::TYPE_SCARF, '28'],
            ['Шляпа', Type::TYPE_HAT, '29'],
            ['Шуба', Type::TYPE_FUR_COAT, '45'],
            ['Шуберы', Type::TYPE_SHUBER, '27'],
        ];

        $values = $configValues = [];
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        $i = 0;

        foreach ($data as $row) {
            $values[] = '('
                . ++$i . ', '
                . $this->connection->quote($row[0]) . ', '
                . $this->connection->quote($row[1]) . ', '
                . $this->connection->quote($row[2]) . ', '
                . $this->connection->quote($now) . ')';

            $configValues[] = '('
                . 1 . ', '
                . $i . ', '
                . $this->connection->quote($this->getItalyPurchaseConfig()) . ', '
                . $this->connection->quote($now) . ')';

            $configValues[] = '('
                . 2 . ', '
                . $i . ', '
                . $this->connection->quote($this->getMoscowPurchaseConfig()) . ', '
                . $this->connection->quote($now) . ')';
        }

        $this->addSql('INSERT INTO types (id, title, code, identifier, created) VALUES ' . implode(', ', $values));
        $this->addSql('INSERT INTO type_purchase_configs (direction_id, type_id, config, created) VALUES ' . implode(', ', $configValues));
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }

    /**
     * @return string
     */
    protected function getItalyPurchaseConfig()
    {
        $config = new ItalyPurchaseConfig();
        $config->setCheckPrice(2)
               ->setDeliveryPrice(7)
               ->setMotivationPrice(2)
               ->setPackagingPrice(0.5)
               ->setSearchPrice(0.5);

        return $config->serialize();
    }

    /**
     * @return string
     */
    protected function getMoscowPurchaseConfig()
    {
        $config = new MoscowPurchaseConfig();
        $config->setDeliveryPrice(100)
               ->setMotivationPercent(0.03);

        return $config->serialize();
    }
}
