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
        'f' => fn($v1, $v2) => $v1 !== $v2 && (in_array([$v1, $v2], []) || in_array([$v2, $v1], [])),
        'expectedCount' => 0
      ],

      '4 vertices, no edges, 4 connected components' => [
        'vertices' => [1, 2, 3, 4],
        'f' => fn($v1, $v2) => $v1 !== $v2 && (in_array([$v1, $v2], []) || in_array([$v2, $v1], [])),
        'expectedCount' => 4
      ],

      '3 vertices, 2 edges, 1 connected component' => [
        'vertices' => [1, 2, 3],
        'f' => fn($v1, $v2) => $v1 !== $v2 && (
          in_array([$v1, $v2], [
            [1, 2],
            [3, 2]
          ]) || in_array([$v2, $v1], [
            [1, 2],
            [3, 2]
          ])),
        'expectedCount' => 1
      ],

      '4 vertices, 2 edges, 1 connected component' => [
        'vertices' => [1, 2, 3, 4],
        'f' => fn($v1, $v2) => $v1 !== $v2 && (
          in_array([$v1, $v2], [
            [1, 2],
            [3, 4]
          ]) || in_array([$v2, $v1], [
            [1, 2],
            [3, 4]
          ])),
        'expectedCount' => 2
      ],

      '10 vertices, 2 edges, 1 connected component' => [
        'vertices' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        'f' => fn($v1, $v2) => $v1 !== $v2 && (
          in_array([$v1, $v2], [
            [1, 2],
            [2, 3],
            [4, 5],
            [4, 6],
            [7, 8],
            [9, 10],
          ]) || in_array([$v2, $v1], [
            [1, 2],
            [2, 3],
            [4, 5],
            [4, 6],
            [7, 8],
            [9, 10],
          ])),
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
        'f' => fn($v1, $v2) => $v1 !== $v2 && (
            in_array([$v1, $v2], [
              ['Toronto', 'Ottawa'],
              ['Ottawa', 'Montreal'],
              ['Ottawa', 'Kingston'],
              ['Kingston', 'Ottawa'],
              ['Montreal', 'Quebec City'],
              ['Boston', 'New York City'],
            ]) || in_array([$v2, $v1], [
              ['Toronto', 'Ottawa'],
              ['Ottawa', 'Montreal'],
              ['Ottawa', 'Kingston'],
              ['Kingston', 'Ottawa'],
              ['Montreal', 'Quebec City'],
              ['Boston', 'New York City'],
            ])
          ),
        'expectedCount' => 3,
      ]
    ];
  }

  #[DataProvider('dataProvider')]
  public function testCountLargestConnectedComponents(array $vertices, callable $f, int $expectedCount): void {
    $graph = new \App\Graph($vertices, $f);
    $this->assertIsInt($graph->countLargestConnectedComponents());
    $this->assertEquals($expectedCount, $graph->countLargestConnectedComponents());
  }
}
