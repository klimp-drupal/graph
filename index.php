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

$f = fn($v1, $v2) => $v1 !== $v2 && (in_array([$v1, $v2], $edges) || in_array([$v2, $v1], $edges));
$graph = new \App\Graph($vertices, $f);

print "Largest Connected Components: " . $graph->countLargestConnectedComponents();
print PHP_EOL;
