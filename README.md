# Chain of resposibility discount calculator

Academic purpouse discount calculator using the chain of responsibility pattern.

Implemented tests for these cases:

- Return 15% of discount given more than 300€ amount and more than 50 units.
- Return 12% of discount given less or equal than 300€ amount and more than 50 units.
- Return 10% of discount given any amount, more than 30 units and less or equal 50 units.
- Return 5% of discount given more than 100€ amount and less or equal 30 units.
- Return 0% else.

## Execute tests
```bash
./vendor/bin/phpunit tests
```
