<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GraphTest extends TestCase {
  public static function dataProvider(): array {
    return [

      'no vertices, no edges, 4 connected components' => [
        'vertices' => [],
        'edges' => [],
        'expectedCount' => 0
      ],

      '4 vertices, no edges, 4 connected components' => [
        'vertices' => [1, 2, 3, 4],
        'edges' => [],
        'expectedCount' => 4
      ],

      '3 vertices, 2 loop edges, 3 connected components' => [
        'vertices' => [1, 2, 3],
        'edges' => [
          [1, 1],
          [2, 2],
        ],
        'expectedCount' => 3
      ],

      '3 vertices, 2 edges, 1 connected component' => [
        'vertices' => [1, 2, 3],
        'edges' => [
          [1, 2],
          [3, 2],
        ],
        'expectedCount' => 1
      ],

      '4 vertices, 2 edges, 1 connected component' => [
        'vertices' => [1, 2, 3, 4],
        'edges' => [
          [1, 2],
          [3, 4],
        ],
        'expectedCount' => 2
      ],

      '10 vertices, 2 edges, 1 connected component' => [
        'vertices' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        'edges' => [
          [1, 2],
          [2, 3],
          [4, 5],
          [4, 6],
          [7, 8],
          [9, 10],
        ],
        'expectedCount' => 4
      ],

      // 8 vertices, 6 edges, 3 connected components
      '8 cities, 6 roads, 3 connected components' => [
        'vertices' => [
          'Toronto',
          'Ottawa',
          'Kingston',
          'Montreal',
          'Quebec City',
          'Boston',
          'New York City',
          'Philadelphia',
        ],
        'edges' => [
          ['Toronto', 'Ottawa'],
          ['Ottawa', 'Montreal'],
          ['Ottawa', 'Kingston'],
          ['Kingston', 'Ottawa'],
          ['Montreal', 'Quebec City'],
          ['Boston', 'New York City'],
        ],
        'expectedCount' => 3,
      ]
    ];
  }

  #[DataProvider('dataProvider')]
  public function testCountLargestConnectedComponents(array $vertices, array $edges, int $expectedCount): void {
    $graph = new \App\Graph($vertices, $edges);
    $this->assertIsInt($graph->countLargestConnectedComponents());
    $this->assertEquals($expectedCount, $graph->countLargestConnectedComponents());
  }
}
