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

The Calculator uses a NumbersStack and OperatorsQueue that are populated by an InputParser. Before this is allowed to happen Validation is applied on the input. Once the stack and queue have been populated the calculation is made by applying operators on the top two numbers on the stack and pushing the result back to the top of the stack. This continues until there are no more operators to perform an operation on.

This process contiues until the user uses Ctrl-C or enters 'q' to exit the application.

## How To Run

cd to app directory and run:

```
./clirpn calculator
```
