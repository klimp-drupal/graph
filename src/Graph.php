<?php

declare(strict_types=1);

namespace App;

final class Graph {

  public function __construct(
    private readonly array $vertices,
    private $function) {}

  /**
   * Counts largest connected components.
   *
   * @return int
   *   Components count.
   */
  public function countLargestConnectedComponents(): int {
    $explored = [];
    $count = 0;

    foreach ($this->vertices as $vertex) {
      if (!in_array($vertex, $explored)) {
        // Depth-first search returns only when it reaches
        // the end of connected component.
        $this->dfs($vertex, $explored);
        $count++;
      }
    }

    return $count;
  }

  /**
   * Runs depth-first search.
   *
   * @param $vertex
   *   Vertex to explore.
   * @param array $explored
   *   Explored vertices.
   *
   * @return void
   *
   * @link https://en.wikipedia.org/wiki/Depth-first_search#Pseudocode
   */
  private function dfs($vertex, array &$explored): void {
    // Mark vertex as explored.
    $explored[] = $vertex;

    foreach ($this->vertices as $v) {
      // If the vertex is not explored and connected to the root vertex by a single edge.
      if (!in_array($v, $explored) && ($this->function)($vertex, $v)) {
        $this->dfs($v, $explored);
      }
    }
  }

}
