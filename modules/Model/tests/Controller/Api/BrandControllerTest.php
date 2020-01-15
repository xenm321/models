<?php

namespace Model\Tests\Controller\Api;

use App\Tests\DataFixtureTestCase;
use Model\Entity\Dictionary\Brand;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BrandControllerTest.
 */
class BrandControllerTest extends DataFixtureTestCase
{
    private $baseUrl = '/api/brand';

    public function testValidGetBrandsResponse()
    {
        $response = $this->getJson($this->baseUrl);

        $this->assertArrayHasKey('items', $response);
        $this->assertArrayHasKey('total', $response);
    }

    public function testCanRequestBrands()
    {
        $response = $this->getJson($this->baseUrl);

        $this->assertCount(10, $response['items']);
        $this->assertGreaterThanOrEqual(10, $response['total']);
    }

    public function testCanFilterBrandsByPage()
    {
        $brands1 = $this->getJson($this->baseUrl.'?page=1');
        $brands2 = $this->getJson($this->baseUrl.'?page=2');

        $this->assertNotEquals($brands1['items'], $brands2['items']);
    }

    /**
     * @dataProvider sortFieldsProvider
     */
    public function testCanSortBrandsByField($sortBy, $descending)
    {
        $brands1 = $this->getJson($this->baseUrl);
        $brands2 = $this->getJson($this->baseUrl.'?sortBy='.$sortBy.'&descending='.$descending);

        $this->assertNotEquals($brands1['items'], $brands2['items']);

        $brands2Items = $brands2['items'];

        uasort($brands2Items, function ($a, $b) use ($sortBy, $descending) {
            if ($a[$sortBy] == $b[$sortBy]) {
                return 0;
            }

            if ($descending) {
                return ($a[$sortBy] > $b[$sortBy]) ? -1 : 1;
            } else {
                return ($a[$sortBy] < $b[$sortBy]) ? -1 : 1;
            }
        });

        $this->assertEquals($brands2Items, $brands2['items']);
    }

    public function testCanFilterBrandsByPerPage()
    {
        $brands = $this->getJson($this->baseUrl.'?perPage=5');

        $this->assertCount(5, $brands['items']);
    }

    public function testCanFilterBrandsBySearchString()
    {
        $this->createEntity(Brand::class, [
            'code' => 'SEARCH_CODE',
            'title' => 'Search Title',
            'identifier' => 'Search Id',
        ]);

        $brands = $this->getJson($this->baseUrl.'?search=search');

        $this->assertCount(1, $brands['items']);
    }

    public function testCanGetOneBrand()
    {
        $brand = $this->createEntity(Brand::class, [
            'code' => 'CD',
            'title' => 'Brand Title',
            'identifier' => 'ID',
        ]);

        $createdBrand = $this->getJson($this->baseUrl.'/'.$brand->getId());

        $this->assertEquals($createdBrand['code'], $brand->getCode());
        $this->assertEquals($createdBrand['title'], $brand->getTitle());
        $this->assertEquals($createdBrand['identifier'], $brand->getIdentifier());
    }

    public function testCanGetListBrand()
    {
        $listBrands = $this->getJson($this->baseUrl.'/list');

        $this->assertGreaterThan(0, $listBrands);
    }

    public function sortFieldsProvider()
    {
        return [
            ['id', true],
            ['code', true],
            ['code', false],
            ['title', true],
            ['title', false],
            ['created', true],
            ['created', false],
        ];
    }

    public function testSuccessCreateBrand()
    {
        $created = (new \DateTime())->format('Y-m-d H:i');
        $response = $this->post($this->baseUrl, [
            'code' => 'CH',
            'title' => 'Chanel',
            'identifier' => 'CH',
        ]);

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());

        $brand = $this->getRepository()->findOneBy(['code' => 'CH']);

        $this->assertInstanceOf(Brand::class, $brand);
        $this->assertEquals($brand->getTitle(), 'Chanel');
        $this->assertEquals($brand->getIdentifier(), 'CH');
        $this->assertEquals($brand->getCreated()->format('Y-m-d H:i'), $created);
    }

    public function testBrandRequiresCode()
    {
        $response = $this->post($this->baseUrl, [
            'title' => 'Chanel',
            'identifier' => 'CH',
        ]);

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertArrayHasKey('code', json_decode($response->getContent(), true)['errors']);
    }

    public function testBrandRequiresTitle()
    {
        $response = $this->post($this->baseUrl, [
            'code' => 'CH',
            'identifier' => 'CH',
        ]);

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertArrayHasKey('title', json_decode($response->getContent(), true)['errors']);
    }

    public function testBrandRequiresIdentifier()
    {
        $response = $this->post($this->baseUrl, [
            'code' => 'CH',
            'title' => 'Chanel',
        ]);

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertArrayHasKey('identifier', json_decode($response->getContent(), true)['errors']);
    }

    public function testBrandRequiresUniqueCode()
    {
        $this->createEntity(Brand::class, [
            'code' => 'DUP',
            'title' => 'Chanel2',
            'identifier' => 'DUP',
        ]);

        $response = $this->post($this->baseUrl, [
            'code' => 'DUP',
            'title' => 'Chanel2',
            'identifier' => 'DUP',
        ]);

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertArrayHasKey('code', json_decode($response->getContent(), true)['errors']);
    }

    public function testCanUpdateBrand()
    {
        $brand = $this->createEntity(Brand::class, [
            'code' => 'DL',
            'title' => 'Brand Title',
            'identifier' => 'DL',
        ]);

        $updated = (new \DateTime())->format('Y-m-d H:i');
        $response = $this->put($this->baseUrl.'/'.$brand->getId(), [
            'code' => 'DL',
            'title' => 'Updated Title',
            'identifier' => 'DL_NEW',
        ]);

        $this->assertSame(Response::HTTP_NO_CONTENT, $response->getStatusCode());

        $brand = $this->getRepository()->findOneBy(['code' => 'DL']);

        $this->assertInstanceOf(Brand::class, $brand);
        $this->assertEquals($brand->getTitle(), 'Updated Title');
        $this->assertEquals($brand->getIdentifier(), 'DL_NEW');
        $this->assertEquals($brand->getUpdated()->format('Y-m-d H:i'), $updated);
    }

    public function testCanDeleteBrand()
    {
        $brand = $this->createEntity(Brand::class, [
            'code' => 'DL',
            'title' => 'Delete',
            'identifier' => 'DL',
        ]);

        $response = $this->delete($this->baseUrl.'/'.$brand->getId());

        $this->assertSame(Response::HTTP_NO_CONTENT, $response->getStatusCode());

        $brand = $this->getRepository()->findOneBy(['code' => 'DL']);
        $this->assertNull($brand);
    }

    private function getRepository()
    {
        return $this->entityManager->getRepository(Brand::class);
    }
}
