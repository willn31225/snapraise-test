# snapraise-test

## Reverse Polish Notation Calculator

This is an implementation of an RPN Calculator using TDD and written in PHP 7.4 from scratch. The following packages were used during development:

- Symfony/Console
- PHPUnit

## Technical Choices and Architecture
PHP was chosen as it is what will be used in the position.

To speed up development Symfony/Console was used to facilitate the cli for the app.
PHPUnit was used for writing unit tests.

The code is broken up into the following class groups:

- Calculator
- IO
- Parser
- Validator

The Calculator uses a NumbersStack and OperatorsQueue that are populated by an InputParser.

Before this is allowed to happen Validation is applied on the input.

Once the stack and queue have been populated, the calculation is made by applying operators on the top two numbers on the stack.
The result is pushed back to the top of the stack.

This continues until there are no more operators to perform an operation on.

This process continues until the user uses Ctrl-C or enters 'q' to exit the application.

## Trade Offs etc.

Fixed! <strike>Issues were discovered involving the InputParser even though unit testing showed it to be working for the given cases.</strike>

More thought may need to be put into to implenting WebSocket and TCP IOs given the current state of the code.

## How To Run

cd to the root of the app directory and run:

```
./clirpn calculator
```
