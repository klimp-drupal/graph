<?php

namespace App;

class Graph {

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
  protected function dfs($vertex, array &$explored): void {
    // Mark vertex as explored.
    $explored[] = $vertex;

    // Get edges incident on the vertex.
    $edges = array_filter($this->edges, fn ($edge) => in_array($vertex, $edge));
    foreach ($edges as $edge) {
      // Gets a vertex from the edge which is not the current vertex.
      $another_endpoint = current(array_filter($edge, fn($v) => $v !== $vertex));

      // If another endpoint has not been explored - explore it.
      if (!in_array($another_endpoint, $explored)) {
        $this->dfs($another_endpoint, $explored);
      }
    }
  }

}
