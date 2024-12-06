<?php

require './vendor/autoload.php';

$vertices = [
  'Toronto',
  'Ottawa',
  'Kingston',
  'Montreal',
  'Quebec City',
  'Boston',
  'New York City',
  'Philadelphia',
];
$edges = [
  ['Toronto', 'Ottawa'],
  ['Ottawa', 'Montreal'],
  ['Ottawa', 'Kingston'],
  ['Kingston', 'Ottawa'],
  ['Montreal', 'Quebec City'],
  ['Boston', 'New York City'],
];
$graph = new \App\Graph($vertices, $edges);

print "Largest Connected Components: " . $graph->countLargestConnectedComponents();
print PHP_EOL;
