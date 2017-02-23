<?php

namespace Illuminate\Tests\Pagination;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as Paginator;

class PaginationPaginatorTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testPaginatorGetPageName()
    {
        $p = new LengthAwarePaginator($array = ['item3', 'item4'], 4, 2, 2);
        $this->assertEquals('page', $p->getPageName());

        $p->setPageName('p');
        $this->assertEquals('p', $p->getPageName());
    }

    public function testPaginatorCanGiveMeRelevantPageInformation()
    {
        $p = new LengthAwarePaginator($array = ['item3', 'item4'], 4, 2, 2);

        $this->assertEquals(2, $p->lastPage());
        $this->assertEquals(2, $p->currentPage());
        $this->assertTrue($p->hasPages());
        $this->assertFalse($p->hasMorePages());
        $this->assertEquals(['item3', 'item4'], $p->items());
    }

    public function testPaginatorCanGenerateUrls()
    {
        $p = new LengthAwarePaginator($array = ['item1', 'item2', 'item3', 'item4'], 4, 2, 2, ['path' => 'http://website.com/', 'pageName' => 'foo']);

        $this->assertEquals('http://website.com?foo=2', $p->url($p->currentPage()));
        $this->assertEquals('http://website.com?foo=1', $p->url($p->currentPage() - 1));
        $this->assertEquals('http://website.com?foo=1', $p->url($p->currentPage() - 2));
    }

    public function testPaginatorCanGenerateUrlsWithQuery()
    {
        $p = new LengthAwarePaginator($array = ['item1', 'item2', 'item3', 'item4'], 4, 2, 2, ['path' => 'http://website.com?sort_by=date', 'pageName' => 'foo']);
        $this->assertEquals('http://website.com?sort_by=date&foo=2', $p->url($p->currentPage()));
    }

    public function testLengthAwarePaginatorCanGenerateUrlsWithoutTrailingSlashes()
    {
        $p = new LengthAwarePaginator($array = ['item1', 'item2', 'item3', 'item4'], 4, 2, 2, ['path' => 'http://website.com/test/', 'pageName' => 'foo']);

        $this->assertEquals('http://website.com/test?foo=2', $p->url($p->currentPage()));
        $this->assertEquals('http://website.com/test?foo=1', $p->url($p->currentPage() - 1));
        $this->assertEquals('http://website.com/test?foo=1', $p->url($p->currentPage() - 2));
    }

    public function testPresenterCanDetermineIfThereAreAnyPagesToShow()
    {
        $p = new LengthAwarePaginator($array = ['item1', 'item2', 'item3', 'item4'], 4, 2, 2);
        $window = new UrlWindow($p);
        $this->assertTrue($window->hasPages());
    }

    public function testPresenterCanGetAUrlRangeForASmallNumberOfUrls()
    {
        $p = new LengthAwarePaginator($array = ['item1', 'item2', 'item3', 'item4'], 4, 2, 2);
        $window = new UrlWindow($p);
        $this->assertEquals(['first' => [1 => '/?page=1', 2 => '/?page=2'], 'slider' => null, 'last' => null], $window->get());
    }

    public function testPresenterCanGetAUrlRangeForAWindowOfLinks()
    {
        $array = [];
        for ($i = 1; $i <= 13; $i++) {
            $array[$i] = 'item'.$i;
        }
        $p = new LengthAwarePaginator($array, count($array), 1, 7);
        $window = new UrlWindow($p);
        $slider = [];
        for ($i = 4; $i <= 10; $i++) {
            $slider[$i] = '/?page='.$i;
        }

        $this->assertEquals(['first' => [1 => '/?page=1', 2 => '/?page=2'], 'slider' => $slider, 'last' => [12 => '/?page=12', 13 => '/?page=13']], $window->get());

        /*
         * Test Being Near The End Of The List
         */
        $p = new LengthAwarePaginator($array, count($array), 1, 8);
        $window = new UrlWindow($p);
        $last = [];
        for ($i = 5; $i <= 13; $i++) {
            $last[$i] = '/?page='.$i;
        }

        $this->assertEquals(['first' => [1 => '/?page=1', 2 => '/?page=2'], 'slider' => null, 'last' => $last], $window->get());
    }

    public function testSimplePaginatorReturnsRelevantContextInformation()
    {
        $p = new Paginator($array = ['item3', 'item4', 'item5'], 2, 2);

        $this->assertEquals(2, $p->currentPage());
        $this->assertTrue($p->hasPages());
        $this->assertTrue($p->hasMorePages());
        $this->assertEquals(['item3', 'item4'], $p->items());

        $this->assertEquals([
            'per_page' => 2, 'current_page' => 2, 'next_page_url' => '/?page=3',
            'prev_page_url' => '/?page=1', 'from' => 3, 'to' => 4, 'data' => ['item3', 'item4'],
        ], $p->toArray());
    }

    public function testPaginatorRemovesTrailingSlashes()
    {
        $p = new Paginator($array = ['item1', 'item2', 'item3'], 2, 2, ['path' => 'http://website.com/test/']);

        $this->assertEquals('http://website.com/test?page=1', $p->previousPageUrl());
    }

    public function testPaginatorGeneratesUrlsWithoutTrailingSlash()
    {
        $p = new Paginator($array = ['item1', 'item2', 'item3'], 2, 2, ['path' => 'http://website.com/test']);

        $this->assertEquals('http://website.com/test?page=1', $p->previousPageUrl());
    }
}
