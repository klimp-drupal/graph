# Task

We will represent a graph, `G = (V, f)`, as 
* a set of vertices, `V`
* and a function `f(v1, v2)` which returns `TRUE` if and only if there is a **(single) edge between `v1` and `v2`**.

The function `f` is symmetric: `f(v1, v2) = f(v2, v1)`. There is no edge from `v` to itself: `f(v, v)=0`.

---

A graph is **connected** if there exists a **path of edges between any two vertices in the graph**.
A graph with one vertex is considered connected. 

---

Define a connected subgraph, `CSG=(SV,f)` of `G` to be a graph such that:

* `SV` is a subset of `V`
* `CSG` is connected
* There is no vertex, `v`, in `V` but not in `SV` such that the graph `(SV+v, f)` is connected. 
In other words CSG is as large as it can be and still be connected.

---

1. Write a PHP function that 
   * takes as input `V` (as an array) and `f`
   * and returns the number of connected subgraphs. 
   _Include one or more helper functions if that helps with clarity and organization._
2. Write a set of test functions that validate that the function in (1) is working correctly

---

# Implementation

The app implements **undirected simple graph** which consist of one or more **connected components**.

# Variations (branches)

1. [simple-dfs](https://github.com/klimp-drupal/graph/tree/simple-dfs)
   - does not implement the function `f(v1, v2)`
   - instead, passes edges to the `Graph` class constructor and saves them as a property
   - the Depth-first Search algorithm is based on the pseudocode taken from [wikipedia](@link https://en.wikipedia.org/wiki/Depth-first_search#Pseudocode)
   - the algorithm iterates through the edges directly connected to a vertex
2. [function](https://github.com/klimp-drupal/graph/tree/function)
   - passes the arrow function `f(v1, v2)` to the `Graph` class constructor and saves it as a property
   - calls the function in the Depth-first Search algorithm in order to identify if a vertex connected to the root vertex by a single edge
   - the Depth-first Search algorithm iterates through the vertices (not edges)
3. [master](https://github.com/klimp-drupal/graph/tree/master)
   - passes edges to the `Graph` class constructor and saves them as a property
   - implements the function `f(v1, v2)` as the `Graph` class method
   - iterates through the vertices and uses the `isSingleEdge` method to check if a vertex connected to the root vertex by a single edge

# Testing

For testing the `Graph` class the app uses `PHPUnit`. 
There is only one method in the test class `testCountLargestConnectedComponents` 
which corresponds to the only `public` method `countLargestConnectedComponents` of the tested `Graph` class.
6 different sets of vertices and edges come to the test method from a `DataProvider`.

## Running the tests
```shell
./vendor/bin/phpunit --testdox tests
```

## The output
```shell
PHPUnit 11.4.4 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.3.14

.......                                                             7 / 7 (100%)

Time: 00:00.012, Memory: 4.00 MB

Graph (App\Graph)
 ✔ Count largest connected components with data set "no vertices, no edges, 4 connected components"
 ✔ Count largest connected components with data set "4 vertices, no edges, 4 connected components"
 ✔ Count largest connected components with data set "3 vertices, 2 loop edges, 3 connected components"
 ✔ Count largest connected components with data set "3 vertices, 2 edges, 1 connected component"
 ✔ Count largest connected components with data set "4 vertices, 2 edges, 1 connected component"
 ✔ Count largest connected components with data set "10 vertices, 2 edges, 1 connected component"
 ✔ Count largest connected components with data set "8 cities, 6 roads, 3 connected components"

OK (7 tests, 14 assertions)


```
