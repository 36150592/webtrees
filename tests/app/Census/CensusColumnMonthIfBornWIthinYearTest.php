<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2015 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fisharebest\Webtrees\Census;

use Fisharebest\Localization\Translator;
use Fisharebest\Webtrees\Date;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Individual;
use Mockery;

/**
 * Test harness for the class CensusColumnMonthIfBornwithinYear
 */
class CensusColumnMonthIfBornwithinYearTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Delete mock objects
	 */
	public function tearDown() {
		Mockery::close();
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnMonthIfBornwithinYear
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testBornWithinYear() {
		$individual = Mockery::mock(Individual::class);
		$individual->shouldReceive('getBirthDate')->andReturn(new Date('01 JAN 1860'));

		$census = Mockery::mock(CensusInterface::class);
		$census->shouldReceive('censusDate')->andReturn('01 JUN 1860');

		$column = new CensusColumnMonthIfBornwithinYear($census, '', '');

		$this->assertSame('Jan', $column->generate($individual));
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnMonthIfBornwithinYear
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testNotBornWithinYear() {
		$individual = Mockery::mock(Individual::class);
		$individual->shouldReceive('getBirthDate')->andReturn(new Date('01 JAN 1859'));

		$census = Mockery::mock(CensusInterface::class);
		$census->shouldReceive('censusDate')->andReturn('01 JUN 1860');

		$column = new CensusColumnMonthIfBornwithinYear($census, '', '');

		$this->assertSame('', $column->generate($individual));
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnMonthIfBornwithinYear
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testNoBirth() {
		$individual = Mockery::mock(Individual::class);
		$individual->shouldReceive('getBirthDate')->andReturn(new Date(''));

		$census = Mockery::mock(CensusInterface::class);
		$census->shouldReceive('censusDate')->andReturn('01 JUN 1860');

		$column = new CensusColumnMonthIfBornwithinYear($census, '', '');

		$this->assertSame('', $column->generate($individual));
	}
}
