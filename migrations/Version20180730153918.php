<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730153918 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $data = [
            ['A. Lange & Söhne', 'LS', 'Торговая марка немецкой часовой компании из Саксонии Lange Uhren GmbH, являющейся дочерней компанией холдинга Richemont', '', 100],
            ['Alain Silberstein', 'AS', 'Молодая часовая компания, основанная в 1986 году в Безансоне архитектором Аланом Зильберштейном', '', 100],
            ['Alexander McQueen', 'AQ', 'Дом высокой моды, основанный дизайнером Александром Маккуином в 1992 году.', '', 100],
            ['Alexander Wang', 'AW', '', 'Американский дизайнер одежды', 100],
            ['Antoine Preziuso', 'AN', 'Швейцарские часы', 100],
            ['Armani', 'AR', 'Giorgio Armani S.p.A. — итальянская компания, специализирующаяся на производстве одежды и различных аксессуаров.', 100],
            ['Audemars Piguet', 'AP', 'Швейцарская компания — производитель часов класса «люкс».', 100],
            ['Baldinini', 'BD', 'Baldinini srl - итальянский обувной производитель в провинции Рубикон в Форли-Чезене, Италия.', 100],
            ['Balenciaga', 'BL', 'Дом моды, основанный испанским дизайнером Кристобалем Баленсиагой, ныне дом принадлежит французской многонациональной компании Kering', 100],
            ['Bally', 'LL', 'Швейцарская компания по производству обуви, основанная Карлом Францем Балли[en] в 1851 году.', 100],
            ['Bell & Ross', 'BS', 'Марка французских часов, которую возглавляют швейцарские дизайнеры Бруно Беламиш и Карлос А. Росильо.', 100],
            ['Biege', 'BI', '', 100],
            ['Billionaire', 'BO', '', 100],
            ['Blancpain', 'BC', 'Марка швейцарских механических часов.', 100],
            ['Bottega Veneta', 'BV', '', 100],
            ['Boucheron', 'BH', '', 100],
            ['Breguet', 'BU', 'Марка швейцарских часов класса «люкс». С сентября 1999 года входит в группу компаний Swatch.', 100],
            ['Breitling', 'BT', 'Торговая марка, под которой выпускаются швейцарские часы класса люкс в кантоне Юра', 100],
            ['Brioni', 'BN', '', 100],
            ['Brunello Cucinelli', 'CU', '', 100],
            ['Burberry', 'BR', '', 100],
            ['Calvin Klein', 'CK', '', 100],
            ['Cartier', 'CR', 'Французский Дом по производству часов и ювелирных изделий, основанный Луи-Франсуа Картье в 1847 году', 100],
            ['Casadei', 'CA', '', 100],
            ['Celine', 'CE', '', 100],
            ['Chanel', 'CН', '', 100],
            ['Chloe', 'CL', '', 100],
            ['Chopard', 'CP', 'Швейцарский производитель часов и ювелирных украшений премиум класса.', 100],
            ['Chronoswiss', 'CS', '', 100],
            ['Concord', 'CN', '', 100],
            ['Corum', 'CM', '', 100],
            ['De Bethune', 'DB', '', 100],
            ['DeWitt', 'DW', '', 100],
            ['DIOR', 'CD', '', 100],
            ['Dolce & Gabbana', 'DG', '', 100],
            ['Dunhell', 'DH', '', 100],
            ['Ebel', 'EB', '', 100],
            ['Elma', 'El', '', 100],
            ['Ermenegildo Zegna', 'ZG', '', 100],
            ['Fendi', 'FN', '', 100],
            ['Ferrari', 'FE', '', 100],
            ['Franck Muller', 'FM', '', 100],
            ['Furla', 'FR', '', 100],
            ['Gentle Monster', 'GM', '', 100],
            ['Givenchy', 'GI', '', 100],
            ['Glanmarco Lorenzi', 'GL', '', 100],
            ['Graff', 'GF', '', 100],
            ['Graham', 'GR', '', 100],
            ['Gucci', 'GС', 'Итальянский дом моды, производитель одежды, парфюмерии, аксессуаров и текстиля. Принадлежит французскому конгломерату Kering и является второй крупнейшей по объёмам продаж компанией-производителем модных товаров после LVMH.', 100],
            ['Hermes', 'HR', '', 100],
            ['Hublot', 'HB', 'Швейцарская компания, производитель швейцарских часов класса «люкс». Основанная в 1980 году Карлом Крокком.', 100],
            ['IWC', 'IW', 'International Watch Company, — швейцарский производитель часов класса «люкс». Компания основана в 1868 году и располагается в городе Шаффхаузен.', 100],
            ['Jacob & Co', 'JA', '', 100],
            ['Jaeger-LeCoultre', 'JG', 'Производитель швейцарских часов класса «люкс». Мануфактура Jaeger-LeCoultre, основанная в первой половине XIX века, находится в местечке Ле-Сантье.', 100],
            ['Jaquet Droz', 'JQ', 'Марка швейцарских часов престижной категории.', 100],
            ['Jimmy Choo', 'JC', '', 100],
            ['LifeBox', 'LB', '', 100],
            ['Loewe', 'LW', '', 100],
            ['Longines', 'LN', '', 100],
            ['Loriblu', 'LI', '', 100],
            ['Louis Vuitton', 'LV', 'Французский дом моды, специализирующийся на производстве чемоданов и сумок, модной одежды и аксессуаров класса «люкс».', 100],
            ['Marc Jacobs', 'MJ', '', 100],
            ['Maurice Lacroix', 'MR', 'Марка наручных швейцарских часов класса «премиум».', 100],
            ['Michael Kors', 'MK', '', 100],
            ['Miu Miu', 'MI', '', 100],
            ['Montblanc', 'MB', 'Montblanc International GmbH — изначально немецкий производитель эксклюзивных ручек.', 100],
            ['Mulberry', 'ML', '', 100],
            ['Officine Panerai', 'OP', '', 100],
            ['Omega', 'OM', 'Марка швейцарских часов класса люкс.', 100],
            ['Oris', 'OR', 'Oris SA — швейцарская часовая компания, выпускающая наручные швейцарские часы и аксессуары под торговой маркой Oris. Основана в 1904 году, Полем Катеном и Жоржем Кристианом в пригороде Базеля, в деревне Хёльштайн на северо-западе Швейцарии.', 100],
            ['Parmigiani ', 'PM', 'Parmigiani Fleurier SA', 100],
            ['Patek Philippe', 'PF', 'Patek Philippe S.A. — швейцарская компания — производитель часов класса «люкс». Основана в 1839 году эмигрантом-поляком Антонием Патеком и Франсуа Чапеком.', 100],
            ['Perrelet', 'PL', '', 100],
            ['Philipp Plein', 'PP', '', 100],
            ['Piaget', 'PG', 'Производитель швейцарских часов премиум класса.', 100],
            ['Porsche', 'PO', '', 100],
            ['Prada', 'PR', '', 100],
            ['Rado', 'RD', 'Марка швейцарских часов класса "medium-luxury".', 100],
            ['Ray Ban', 'RB', '', 100],
            ['Richard Mille', 'RM', '', 100],
            ['Richmond ', 'RH', '', 100],
            ['Roberto Cavalli', 'RC', '', 100],
            ['Roger Dubuis', 'RG', 'Швейцарская компания — производитель часов, основаная в 1995 году часовым мастером Роже Дюбуи и дизайнером часов Карлосом Диасом.', 100],
            ['Rolex', 'RO', 'Rolex SA — швейцарская часовая компания, выпускающая наручные часы и аксессуары под торговой маркой Ролекс.', 100],
            ['S.T.Dupont', 'DP', '', 100],
            ['Salvatore Ferragamo', 'SF', '', 100],
            ['Sergio Rossi', 'SS', '', 100],
            ['Stefano Ricci', 'SR', '', 100],
            ['Swarovski', 'SW', '', 100],
            ['Tag Heuer', 'TH', '', 100],
            ['Tiffany & Co', 'TI', '', 100],
            ['Tissot', 'TS', 'Марка швейцарских часов', 100],
            ['Tom Ford', 'TF', '', 100],
            ['Tony burch', 'TY', '', 100],
            ['U-BOAT', 'UB', '', 100],
            ['Ulysse Nardin', 'UN', 'Швейцарская часовая мануфактура, производитель швейцарских часов класса «люкс», основаная в 1846 году', 100],
            ['Vacheron Constantin', 'VC', 'Марка швейцарских часов, считающаяся одной из самых дорогих, престижных и традиционных марок часов.', 100],
            ['Valentino', 'VL', '', 100],
            ['VCA', 'VA', '', 100],
            ['Versace', 'VS', 'Gianni Versace S.p.A. — итальянская компания, основанная в 1978 году модельером Джанни Версаче, производитель модной одежды, парфюмерии, часов, товаров для дома, аксессуаров и других предметов роскоши.', 100],
            ['Winter Lover', 'WL', '', 100],
            ['Yves Saint Laurent', 'SL', '', 100],
            ['Zenith', 'ZN', 'Zenith SA — бренд швейцарских часов класса "люкс", основанный в 1865 году 22-летним Жорж Февр-Жако.', 100],
            ['Zilli', 'ZI', '', 100],
        ];

        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $values = [];
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        foreach ($data as $row) {
            $values[] = '('
                . $this->connection->quote($row[0]) . ', '
                . $this->connection->quote($row[1]) . ', '
                . $this->connection->quote($row[1]) . ', '
                . $this->connection->quote($row[2]) . ', '
                . (int)$row[3] . ', '
                . $this->connection->quote($now) . ')';
        }

        $this->addSql('INSERT INTO brands (title, code, identifier, description, last_index_number, created) VALUES ' . implode(', ', $values));
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
