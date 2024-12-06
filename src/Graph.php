<?php

declare(strict_types=1);

namespace App;

final class Graph {

  public function __construct(
    private readonly array $vertices,
    private readonly array $edges) {}

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
   * Checks if given vertices are connected by a single edge.
   *
   * @param $v1
   *   Vertex 1.
   * @param $v2
   *   Vertex 2
   *
   * @return bool
   *   TRUE if there is a (single) edge between `v1` and `v2`.
   */
  private function isSingleEdge($v1, $v2): bool {
    // There is no edge from v to itself and combination of vertices exists in the edges array.
    return $v1 !== $v2 && (in_array([$v1, $v2], $this->edges) || in_array([$v2, $v1], $this->edges));
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
   */
  private function dfs($vertex, array &$explored): void {
    // Mark vertex as explored.
    $explored[] = $vertex;

    foreach ($this->vertices as $v) {
      // If the vertex is not explored and connected to the root vertex by a single edge.
      if (!in_array($v, $explored) && $this->isSingleEdge($vertex, $v)) {
        $this->dfs($v, $explored);
      }
    }
  }

}
