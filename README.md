# [Advent of Code](https://adventofcode.com/) solutions
This repository contains PHP solutions to Advent of Code.

To run my solution for a particular day (and part), run `php run.php YEAR DAY [PART]`.

## PHPUnit
(Regression) testing is done using PHPUnit and a lot of unnecessary magic. All `DayNNTest` classes extend `PuzzleSolverTestCase`, which figures out what day to test using reflection. Then, a data provider is used to figure out what examples to test, and what their expected outcomes are. Finally, when I finish solving a puzzle, I implement the `getSolutionForPartN` methods. When they do not return null, the actual puzzle input is tested.

This enables me to refactor code shared between tests, for example when a puzzle extends a previous puzzle or uses the same concepts, with some confidence that I'm not breaking existing rules or logic.

## License
MIT. See [LICENSE](LICENSE).