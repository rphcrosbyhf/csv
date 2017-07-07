.PHONY: all dependencies
NO_COLOR=\033[0m
OK_COLOR=\033[32;01m
WARN_COLOR=\033[33;01m

all: dependencies

dependencies:
	@printf "$(OK_COLOR)==> Installing dependencies...$(NO_COLOR)\n"
	@docker run -it --rm -v $(PWD):/app -w /app prooph/composer:7.1 update --prefer-dist --no-interaction --optimize-autoloader --no-progress

test:
	@printf "$(OK_COLOR)==> Running unit tests...$(NO_COLOR)\n"
	@docker run -it --rm -v $(PWD):/app -w /app averor/docker-phpunit-php-7.1 vendor/bin/phpunit --coverage-text=tests/coverage.txt